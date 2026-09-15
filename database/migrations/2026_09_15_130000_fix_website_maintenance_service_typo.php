<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * "Website Maintenace" was missing the n, and the service is one of the
     * nine still offered on the public contact form, so the typo was live.
     *
     * Matched on service_id rather than the name so the rename is stable, and
     * the line-item copy is only corrected on quotes still in Draft: a quote
     * that has been issued is a record of what the client was actually sent,
     * and this must not rewrite one.
     */
    private const SERVICE_ID = 'SVC-EF2468';
    private const WRONG      = 'Website Maintenace';
    private const RIGHT      = 'Website Maintenance';

    public function up(): void
    {
        $this->rename(self::WRONG, self::RIGHT);
    }

    public function down(): void
    {
        $this->rename(self::RIGHT, self::WRONG);
    }

    private function rename(string $from, string $to): void
    {
        DB::table('business_services')
            ->where('service_id', self::SERVICE_ID)
            ->where('name', $from)
            ->update(['name' => $to]);

        DB::table('quote_items')
            ->where('service_id', self::SERVICE_ID)
            ->where('description', $from)
            ->whereIn('quote_id', function ($q) {
                $q->select('quote_id')->from('quotes')->where('status', 'Draft');
            })
            ->update(['description' => $to]);
    }
};
