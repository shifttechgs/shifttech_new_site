<?php

namespace App\Console\Commands;

use App\Services\IndexNowService;
use App\Services\SiteUrls;
use Illuminate\Console\Command;

class IndexNowSubmit extends Command
{
    protected $signature = 'indexnow:submit
        {--url=* : Submit these URLs instead of the whole site. Repeatable.}
        {--base= : Base URL to build the site URLs against. Defaults to APP_URL.}
        {--dry-run : Print what would be submitted, then stop.}
        {--force : Submit even when the app is not in the production environment.}';

    protected $description = 'Ping IndexNow with the site URLs so Bing and the other participating engines recrawl changed pages quickly';

    public function handle(): int
    {
        $urls = $this->option('url')
            ?: SiteUrls::all($this->option('base') ?: config('app.url'))->pluck('url')->all();

        $hosts = collect($urls)
            ->map(fn (string $url) => parse_url($url, PHP_URL_HOST))
            ->filter()
            ->unique()
            ->values();

        // IndexNow verifies ownership of one host per submission and 422s a
        // mixed batch, so catch it here where the message can be useful.
        if ($hosts->count() !== 1) {
            $this->error('All URLs must be on a single host. Found: ' . ($hosts->implode(', ') ?: 'none'));

            return self::FAILURE;
        }

        $host = $hosts->first();

        // Without this the default APP_URL of http://localhost silently
        // produces a batch that IndexNow can only reject.
        if (in_array($host, ['localhost', '127.0.0.1', '::1'], true)) {
            $this->error("Refusing to submit URLs on {$host}: IndexNow only accepts the verified public host.");
            $this->line('Pass the real base, for example: --base=https://shifttechgs.com');

            return self::FAILURE;
        }

        $key = config('services.indexnow.key');

        if (blank($key)) {
            $this->error('No IndexNow key configured. Set INDEXNOW_KEY or services.indexnow.key.');

            return self::FAILURE;
        }

        if ($this->option('dry-run')) {
            $this->info(count($urls) . " URL(s) would be submitted for {$host}:");
            foreach ($urls as $url) {
                $this->line("  {$url}");
            }
            $this->newLine();
            $this->line("Key location: https://{$host}/{$key}.txt");

            return self::SUCCESS;
        }

        $failed = false;

        foreach (IndexNowService::submitMany($urls, (bool) $this->option('force')) as $result) {
            $status = $result['status'] ? "HTTP {$result['status']}: " : '';
            $line   = "{$result['count']} URL(s) — {$status}{$result['message']}";

            $result['ok'] ? $this->info($line) : $this->error($line);

            $failed = $failed || ! $result['ok'];
        }

        return $failed ? self::FAILURE : self::SUCCESS;
    }
}
