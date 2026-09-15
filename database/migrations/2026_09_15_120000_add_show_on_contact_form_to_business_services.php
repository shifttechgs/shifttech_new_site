<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * `is_active` governs whether a service appears in the CRM's own dropdowns
     * (quotes, invoices, jobs). That is a different question from whether a
     * prospect should be offered it on the public contact form: hosting,
     * renewals and maintenance are real billable services we still quote for,
     * but they are not what someone picks when they are enquiring for the
     * first time. This flag separates the two so both stay admin-managed.
     */
    public function up(): void
    {
        Schema::table('business_services', function (Blueprint $table) {
            $table->boolean('show_on_contact_form')->default(true)->after('is_active');
        });

        // Existing aftercare and infrastructure line items are hidden from the
        // public form; everything else keeps the default.
        \Illuminate\Support\Facades\DB::table('business_services')
            ->whereIn('name', [
                'Auction Server Hosting',
                'Domain Renewal',
                'Monthly Maintenance',
                'Website Hosting',
                'Website Setup',
            ])
            ->update(['show_on_contact_form' => false]);
    }

    public function down(): void
    {
        Schema::table('business_services', function (Blueprint $table) {
            $table->dropColumn('show_on_contact_form');
        });
    }
};
