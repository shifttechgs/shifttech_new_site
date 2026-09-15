<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BusinessService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Real CRM records first, so their password hashes and SVC- IDs win.
        // The defaults below are firstOrCreate on email and name, so once the
        // real admin and the real services are in place they are left alone —
        // which keeps the service IDs that quote and invoice line items point
        // at. Reversing this order would create the services fresh with new
        // IDs and leave every line item pointing at nothing.
        $this->call(ProductionDataSeeder::class);

        // Super Admin
        User::firstOrCreate(
            ['email' => 'admin@shifttechgs.com'],
            [
                'name'        => 'ShiftTech Admin',
                'password'    => Hash::make('ShiftTech@2025!'),
                'role'        => 'SuperAdmin',
                'is_active'   => true,
                'business_id' => 'ST-001',
            ]
        );

        // Expense Categories (12 default)
        $this->call(ExpenseCategorySeeder::class);

        // Default Business Services.
        //
        // These names must match migration 2026_04_18_100002 exactly. That
        // migration soft-deletes everything else and establishes this list as
        // canonical, so any name here that is not on it gets inserted as a
        // second live row for a service that already exists. That is how
        // production ended up offering "Web Design", "Web Application
        // Development", "DevOps / Cloud Setup" and "IT Consulting (Hourly)"
        // alongside their canonical equivalents.
        //
        // withTrashed so a soft-deleted row is found rather than resurrected as
        // a duplicate. Prices are dev defaults only: production takes its real
        // catalogue, IDs and pricing from the encrypted payload above, and
        // firstOrCreate leaves those rows untouched.
        foreach ([
            ['name' => 'Web Design & Development', 'category' => 'Development',    'unit_price' => 15000, 'unit_type' => 'job'],
            ['name' => 'Mobile App Development',   'category' => 'Development',    'unit_price' => 20000, 'unit_type' => 'job'],
            ['name' => 'Custom Software',          'category' => 'Development',    'unit_price' => 25000, 'unit_type' => 'job'],
            ['name' => 'MVP Development',          'category' => 'Development',    'unit_price' => 0,     'unit_type' => 'job'],
            ['name' => 'UI/UX Design',             'category' => 'Design',         'unit_price' => 0,     'unit_type' => 'job'],
            ['name' => 'AI & Automation',          'category' => 'Development',    'unit_price' => 0,     'unit_type' => 'job'],
            ['name' => 'Cloud & DevOps',           'category' => 'Infrastructure', 'unit_price' => 8000,  'unit_type' => 'job'],
            ['name' => 'IT Consulting',            'category' => 'Consulting',     'unit_price' => 850,   'unit_type' => 'hour'],
            ['name' => 'Monthly Maintenance',      'category' => 'Support',        'unit_price' => 2500,  'unit_type' => 'month'],
        ] as $svc) {
            BusinessService::withTrashed()->firstOrCreate(['name' => $svc['name']], array_merge($svc, ['is_active' => true, 'business_id' => 'ST-001']));
        }

        $this->command->info('✅  CRM seeded! Login: admin@shifttechgs.com / ShiftTech@2025!');
        $this->command->info('    URL: /useluminii');
    }
}
