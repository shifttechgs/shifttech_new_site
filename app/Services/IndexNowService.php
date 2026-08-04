<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IndexNowService
{
    /** Protocol ceiling for a single POST. */
    public const MAX_URLS_PER_REQUEST = 10000;

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

    /**
     * Submit many URLs in one POST.
     *
     * submit() above is the automatic path: one URL, fire and forget, called
     * from PostObserver when a post is published or rewritten. This is the
     * manual path for pages with no model behind them (services, case studies,
     * the home page), so it returns what happened instead of swallowing it.
     *
     * $force exists because the environment guard makes the automatic path
     * untestable outside production. Running the command is an explicit act,
     * so it is allowed to override that.
     *
     * @param  list<string>  $urls
     * @return list<array{ok: bool, status: int|null, count: int, message: string}>
     */
    public static function submitMany(array $urls, bool $force = false): array
    {
        $urls = array_values(array_unique(array_filter($urls)));

        if ($urls === []) {
            return [['ok' => false, 'status' => null, 'count' => 0, 'message' => 'No URLs to submit.']];
        }

        if (! $force && ! app()->environment('production')) {
            return [[
                'ok' => false,
                'status' => null,
                'count' => count($urls),
                'message' => 'Skipped: not running in production. Pass --force to submit anyway.',
            ]];
        }

        $key  = config('services.indexnow.key');
        $host = parse_url($urls[0], PHP_URL_HOST);

        return array_map(
            fn (array $chunk) => self::postBatch($chunk, $key, $host),
            array_chunk($urls, self::MAX_URLS_PER_REQUEST)
        );
    }

    /**
     * @param  list<string>  $urls
     * @return array{ok: bool, status: int|null, count: int, message: string}
     */
    private static function postBatch(array $urls, string $key, string $host): array
    {
        try {
            // Longer timeout than submit(): a batch is not on a request path,
            // so there is no visitor waiting on it.
            $response = Http::timeout(15)
                ->asJson()
                ->post('https://api.indexnow.org/indexnow', [
                    'host'        => $host,
                    'key'         => $key,
                    'keyLocation' => "https://{$host}/{$key}.txt",
                    'urlList'     => $urls,
                ]);

            return [
                'ok'      => $response->successful(),
                'status'  => $response->status(),
                'count'   => count($urls),
                'message' => self::explain($response->status()),
            ];
        } catch (\Throwable $e) {
            Log::warning('IndexNow bulk submission failed', ['count' => count($urls), 'error' => $e->getMessage()]);

            return ['ok' => false, 'status' => null, 'count' => count($urls), 'message' => $e->getMessage()];
        }
    }

    private static function explain(int $status): string
    {
        return match ($status) {
            200 => 'Submitted.',
            202 => 'Accepted. The key is still being validated, which is normal on a first submission.',
            400 => 'Bad request: IndexNow rejected the payload.',
            403 => 'Key not valid: the hosted key file did not match the submitted key.',
            422 => 'Unprocessable: the URLs are not on the submitted host, or the key does not match.',
            429 => 'Rate limited. Try again later.',
            default => "Unexpected HTTP {$status}.",
        };
    }
}
