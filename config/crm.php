<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Seed payload key
    |--------------------------------------------------------------------------
    |
    | The repository is public, so the CRM records shipped to production
    | (clients, quotes, invoices, payments) are committed encrypted rather than
    | as readable JSON. This key decrypts them.
    |
    | It lives in .env only — never commit a value here. Without it the
    | production data seeder skips silently, which is the correct behaviour on
    | any machine that has no business holding the payload.
    |
    | Read through config() rather than env() because deploy.sh runs
    | config:cache before it seeds, and env() returns null once config is
    | cached.
    |
    */

    'seed_key' => env('CRM_SEED_KEY'),

    /*
     | Absolute path to the encrypted payload written by `crm:export-seed`.
     */
    'seed_payload' => database_path('seeders/data/crm-payload.enc'),

];
