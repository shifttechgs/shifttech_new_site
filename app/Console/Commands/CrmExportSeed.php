<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CrmExportSeed extends Command
{
    protected $signature = 'crm:export-seed
        {--key= : Encryption key to use. Defaults to config(\'crm.seed_key\').}
        {--out= : Where to write the payload. Defaults to config(\'crm.seed_payload\').}
        {--dry-run : Print the row counts that would be exported, then stop.}';

    protected $description = 'Export the local CRM records to the encrypted payload that ProductionDataSeeder loads on the pod';

    /**
     * Tables in dependency order, with the column that identifies a row across
     * databases. Every relation in this schema is by business ID string
     * (CLI-, QUO-, INV-, SVC-) rather than by auto-increment id, so nothing has
     * to be remapped on import and this order only needs to be sane for
     * reading, not for foreign keys — there are none on these tables.
     *
     * The auto-increment `id` is dropped on export for the same reason: keeping
     * it would collide with whatever the pod has already allocated.
     */
    public const TABLES = [
        'business_services' => 'service_id',
        'users'             => 'email',
        'business_clients'  => 'client_id',
        'client_requests'   => 'request_id',
        'quotes'            => 'quote_id',
        'quote_items'       => null,
        'invoices'          => 'invoice_id',
        'invoice_items'     => null,
        'payments'          => 'payment_id',
    ];

    public function handle(): int
    {
        $tables = [];

        foreach (self::TABLES as $table => $key) {
            $rows = DB::table($table)->get()
                ->map(function ($row) {
                    $row = (array) $row;
                    unset($row['id']);

                    return $row;
                })
                ->all();

            $tables[$table] = ['key' => $key, 'rows' => $rows];

            $this->line(sprintf('  %-20s %d rows', $table, count($rows)));
        }

        if ($this->option('dry-run')) {
            $this->info('Dry run: nothing written.');

            return self::SUCCESS;
        }

        $key = $this->option('key') ?: config('crm.seed_key');

        if (! $key) {
            $this->error('No encryption key. Set CRM_SEED_KEY in .env or pass --key=base64:...');

            return self::FAILURE;
        }

        $payload = json_encode([
            'exported_at' => now()->toIso8601String(),
            'source'      => config('database.default') . ':' . config('database.connections.' . config('database.default') . '.database'),
            'tables'      => $tables,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        // gzip before encrypting: the ciphertext is committed to a public repo
        // and the raw JSON is mostly repeated column names.
        $ciphertext = $this->encrypter($key)->encrypt(gzencode($payload, 9), false);

        $out = $this->option('out') ?: config('crm.seed_payload');
        File::ensureDirectoryExists(dirname($out));
        File::put($out, $ciphertext . PHP_EOL);

        $this->newLine();
        $this->info('Wrote ' . $out . ' (' . number_format(strlen($ciphertext) / 1024, 1) . ' KB encrypted)');
        $this->line('Commit it. The plaintext never touches the repo.');

        return self::SUCCESS;
    }

    public static function encrypter(string $key): Encrypter
    {
        return new Encrypter(
            str_starts_with($key, 'base64:') ? base64_decode(substr($key, 7)) : $key,
            'AES-256-CBC'
        );
    }
}
