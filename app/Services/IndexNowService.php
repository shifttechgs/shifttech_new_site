<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IndexNowService
{
    public static function submit(string $url): void
    {
        if (! app()->environment('production')) {
            return;
        }

        $key = config('services.indexnow.key');

        try {
            Http::timeout(5)->get('https://api.indexnow.org/indexnow', [
                'url' => $url,
                'key' => $key,
                'keyLocation' => url("/{$key}.txt"),
            ]);
        } catch (\Throwable $e) {
            Log::warning('IndexNow submission failed', ['url' => $url, 'error' => $e->getMessage()]);
        }
    }
}
