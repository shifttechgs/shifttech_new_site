<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * A second pass at show_on_contact_form.
     *
     * The first migration matched the names in the local catalogue, but
     * production carries a different set: DatabaseSeeder inserts its canonical
     * list by name while ProductionDataSeeder inserts the real catalogue from
     * the encrypted payload, and the two name the same services differently
     * ("IT Consulting" vs "IT Consulting (Hourly)", "Cloud & DevOps" vs
     * "DevOps / Cloud Setup"). Neither seeder's name check sees the other's
     * row, so production ends up holding both.
     *
     * These three were still being offered on the live form. Listed under both
     * spellings where a pair exists, so this applies in either environment and
     * is a no-op wherever a name is absent.
     */
    private const HIDE = [
        // Recurring platform billing, not a first-enquiry option.
        'Auction Platform Subscription & Monthly SLA',
        'Auction Server Hosting',

        // Duplicate of "IT Consulting", which stays on the form.
        'IT Consulting (Hourly)',

        // Duplicate of "Cloud & DevOps", which is the canonical name (see
        // migration 2026_04_18_100002) and stays on the form.
        'DevOps / Cloud Setup',

        // Three overlapping web services were on the form at once, which left a
        // prospect guessing which one to tick. "Web Design & Development" is
        // the one that stays; these two are the duplicate spellings.
        'Web Design',
        'Web Application Development',
    ];

    public function up(): void
    {
        DB::table('business_services')
            ->whereIn('name', self::HIDE)
            ->update(['show_on_contact_form' => false]);
    }

    public function down(): void
    {
        DB::table('business_services')
            ->whereIn('name', self::HIDE)
            ->update(['show_on_contact_form' => true]);
    }
};
