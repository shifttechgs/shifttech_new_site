<?php

namespace Database\Seeders;

use App\Console\Commands\CrmExportSeed;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Throwable;

/**
 * Loads the real CRM records — admin user, clients, quotes, invoices, payments —
 * from the encrypted payload committed at database/seeders/data/crm-payload.enc.
 *
 * The repository is public, so the payload is ciphertext and this seeder is a
 * no-op anywhere CRM_SEED_KEY is not set. That is the intended behaviour on a
 * contributor's clone: no key, no client data.
 *
 * deploy.sh runs `db:seed --force` on every deploy, so every write here is
 * keyed and skips rows that already exist. Nothing is ever updated or deleted —
 * a record edited in the production panel is never clobbered by a later deploy.
 */
class ProductionDataSeeder extends Seeder
{
    /**
     * Line-item tables have no business ID of their own. They are written as a
     * set, once, and only when their parent has no items at all — otherwise a
     * redeploy would duplicate every line on every invoice.
     */
    private const ITEM_PARENTS = [
        'quote_items'   => 'quote_id',
        'invoice_items' => 'invoice_id',
    ];

    /**
     * Payload service_id => the service_id this database already uses for that
     * same service name.
     *
     * Migration 2026_04_18_100002 inserts the canonical service list with
     * 'SVC-' . uniqid() IDs, so every database generates different ones and the
     * payload's IDs never match production's. Inserting by ID therefore
     * produced a second copy of all 13 services. Matching on name instead and
     * rewriting the line items through this map keeps one row per service and
     * still leaves every quote and invoice line pointing at a real service.
     */
    private array $serviceMap = [];

    public function run(): void
    {
        $key = config('crm.seed_key');
        $path = config('crm.seed_payload');

        if (! $key) {
            $this->command?->warn('  ProductionDataSeeder: CRM_SEED_KEY not set, skipping CRM records.');

            return;
        }

        if (! is_file($path)) {
            $this->command?->warn('  ProductionDataSeeder: no payload at ' . $path . ', skipping.');

            return;
        }

        try {
            $json = gzdecode(
                CrmExportSeed::encrypter($key)->decrypt(trim(file_get_contents($path)), false)
            );
            $payload = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            // A wrong key and a truncated file both land here. Fail loudly:
            // set -euo pipefail in deploy.sh should stop the deploy rather than
            // report success over a production database that got nothing.
            throw new \RuntimeException(
                'ProductionDataSeeder: could not read the payload (' . $e->getMessage() . '). '
                . 'Check CRM_SEED_KEY matches the key it was exported with.',
                previous: $e
            );
        }

        $this->command?->line('  Payload exported ' . ($payload['exported_at'] ?? 'unknown'));

        foreach ($payload['tables'] as $table => $spec) {
            if (! Schema::hasTable($table)) {
                $this->command?->warn(sprintf('  %-20s table missing, skipped', $table));

                continue;
            }

            $inserted = match (true) {
                $table === 'business_services'      => $this->seedServices($spec['rows']),
                isset(self::ITEM_PARENTS[$table])   => $this->seedItems($table, self::ITEM_PARENTS[$table], $spec['rows']),
                default                             => $this->seedKeyed($table, $spec['key'], $spec['rows']),
            };

            $this->command?->line(sprintf(
                '  %-20s %d inserted, %d already present',
                $table,
                $inserted,
                count($spec['rows']) - $inserted
            ));
        }
    }

    /**
     * Insert rows whose business ID is not in the table yet.
     */
    private function seedKeyed(string $table, string $key, array $rows): int
    {
        if ($rows === []) {
            return 0;
        }

        $existing = DB::table($table)->pluck($key)->all();
        $new = array_values(array_filter(
            $rows,
            fn (array $row) => isset($row[$key]) && ! in_array($row[$key], $existing, true)
        ));

        foreach (array_chunk($new, 100) as $chunk) {
            DB::table($table)->insert($this->fit($table, $chunk));
        }

        return count($new);
    }

    /**
     * Insert services that this database does not have under either the
     * payload's ID or the payload's name, and record the ID this database uses
     * for the rest so the line items can be pointed at them.
     */
    private function seedServices(array $rows): int
    {
        $byId   = DB::table('business_services')->pluck('service_id')->all();
        $byName = DB::table('business_services')->pluck('service_id', 'name')->all();

        $new = [];

        foreach ($rows as $row) {
            if (in_array($row['service_id'], $byId, true)) {
                continue;
            }

            if (isset($byName[$row['name']])) {
                $this->serviceMap[$row['service_id']] = $byName[$row['name']];

                continue;
            }

            $new[] = $row;
        }

        foreach (array_chunk($new, 100) as $chunk) {
            DB::table('business_services')->insert($this->fit('business_services', $chunk));
        }

        if ($this->serviceMap !== []) {
            $this->command?->line(sprintf(
                '  %-20s %d matched by name, line items remapped',
                '',
                count($this->serviceMap)
            ));
        }

        return count($new);
    }

    /**
     * Insert a parent's line items only when it currently has none.
     */
    private function seedItems(string $table, string $parentKey, array $rows): int
    {
        if ($rows === []) {
            return 0;
        }

        $stocked = DB::table($table)->distinct()->pluck($parentKey)->all();
        $new = array_values(array_filter(
            $rows,
            fn (array $row) => isset($row[$parentKey]) && ! in_array($row[$parentKey], $stocked, true)
        ));

        // Point each line at whichever service_id this database uses.
        $new = array_map(function (array $row) {
            if (isset($row['service_id'], $this->serviceMap[$row['service_id']])) {
                $row['service_id'] = $this->serviceMap[$row['service_id']];
            }

            return $row;
        }, $new);

        foreach (array_chunk($new, 100) as $chunk) {
            DB::table($table)->insert($this->fit($table, $chunk));
        }

        return count($new);
    }

    /**
     * Drop any column the payload carries that this database does not have, so
     * an export taken after a migration the pod has not run yet still loads
     * instead of throwing on an unknown column.
     */
    private function fit(string $table, array $rows): array
    {
        $columns = array_flip(Schema::getColumnListing($table));

        return array_map(fn (array $row) => array_intersect_key($row, $columns), $rows);
    }
}
