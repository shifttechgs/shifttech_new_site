<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Retire the duplicate service rows DatabaseSeeder created.
     *
     * Migration 2026_04_18_100002 established a canonical list of nine
     * services. DatabaseSeeder then ran its own list, four names of which were
     * not on it, so firstOrCreate inserted a second live row for services that
     * already existed. Hiding them from the contact form dealt with the
     * symptom; this removes the rows, and the seeder has been aligned so they
     * do not come back.
     *
     * Line items are repointed before anything is soft-deleted, so no quote,
     * invoice or client request is left pointing at a retired service. The rows
     * are soft-deleted rather than removed, so this is reversible and nothing is
     * destroyed if a reference was missed.
     */
    private const MERGE = [
        // duplicate                      => canonical
        'Web Design'                      => 'Web Design & Development',
        'Web Application Development'     => 'Web Design & Development',
        'DevOps / Cloud Setup'            => 'Cloud & DevOps',
        'IT Consulting (Hourly)'          => 'IT Consulting',
    ];

    private const REFERENCES = ['quote_items', 'invoice_items', 'client_requests'];

    public function up(): void
    {
        foreach (self::MERGE as $duplicate => $canonical) {
            $dupId   = $this->idFor($duplicate);
            $canonId = $this->idFor($canonical);

            // Only act when both exist. A database that never had the duplicate,
            // or that is missing the canonical row to merge into, is left alone.
            if ($dupId === null || $canonId === null || $dupId === $canonId) {
                continue;
            }

            foreach (self::REFERENCES as $table) {
                DB::table($table)->where('service_id', $dupId)->update(['service_id' => $canonId]);
            }

            DB::table('business_services')
                ->where('service_id', $dupId)
                ->update(['deleted_at' => now(), 'is_active' => false, 'updated_at' => now()]);
        }
    }

    /**
     * Not reversed. Restoring the row is easy enough, but the line items moved
     * to the canonical service cannot be told apart from ones that always
     * pointed there, so a down() would have to guess which to move back.
     */
    public function down(): void
    {
        //
    }

    private function idFor(string $name): ?string
    {
        return DB::table('business_services')
            ->whereNull('deleted_at')
            ->where('name', $name)
            ->value('service_id');
    }
};
