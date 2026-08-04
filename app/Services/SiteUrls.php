<?php

namespace App\Services;

use App\Http\Controllers\WorkController;
use App\Models\Post;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class SiteUrls
{
    /**
     * Every public, indexable URL on the site, with its sitemap metadata.
     *
     * Single source for both the <urlset> and IndexNow, so the two cannot
     * drift into disagreeing about which pages exist. Whatever is left out
     * here is left out of both: the CRM, /client-hub, the PayPal webhook and
     * the /about redirect.
     *
     * $base overrides the host. The sitemap passes null and gets url(), which
     * is correct while a request is being served. The console has no request,
     * so url() falls back to APP_URL, which is http://localhost in dev, and
     * IndexNow rejects any submission whose URLs are not on the verified host.
     * Hence the override rather than trusting APP_URL from a CLI context.
     */
    public static function all(?string $base = null): Collection
    {
        $root = $base === null ? null : rtrim($base, '/');

        // Mirrors url(): the site root renders without a trailing slash.
        $url = static fn (string $path): string => $root === null
            ? url($path)
            : ($path === '/' ? $root : $root . $path);

        // The blog index changes whenever any post does, not when its own
        // template is edited.
        $newestPost = Post::published()->max('updated_at');
        $newestPost = $newestPost ? Carbon::parse($newestPost)->toAtomString() : null;

        $staticPages = [
            ['url' => $url('/'), 'priority' => '1.0', 'changefreq' => 'weekly', 'lastmod' => self::viewLastmod('welcome')],
            ['url' => $url('/agency'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => self::viewLastmod('agency')],
            ['url' => $url('/work'), 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => self::viewLastmod('work')],
            ['url' => $url('/blog'), 'priority' => '0.8', 'changefreq' => 'daily', 'lastmod' => $newestPost ?: self::viewLastmod('blog')],
            ['url' => $url('/contact'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => self::viewLastmod('contact')],
            ['url' => $url('/services/ai'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => self::viewLastmod('services.ai')],
            ['url' => $url('/services/web-design'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => self::viewLastmod('services.web-design')],
            ['url' => $url('/services/web-application-development'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => self::viewLastmod('services.web-application-development')],
            ['url' => $url('/services/custom-software-development'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => self::viewLastmod('services.custom-software-development')],
            ['url' => $url('/services/devops-cloud'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => self::viewLastmod('services.devops-cloud')],
            ['url' => $url('/services/mobile-app-development'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => self::viewLastmod('services.mobile-app-development')],
        ];

        $posts = Post::published()->get()->map(fn (Post $post) => [
            'url' => $url('/blog/' . $post->slug),
            'priority' => '0.6',
            'changefreq' => 'monthly',
            'lastmod' => $post->updated_at?->toAtomString(),
        ]);

        // Case studies rank for "<service> <industry>" intent and are the
        // pages AI engines quote results from, so they sit above blog posts.
        // Case study copy lives in config/case-studies.php, so that file's
        // mtime is when any of these pages last actually changed.
        $caseStudyLastmod = self::fileLastmod(config_path('case-studies.php'));

        $caseStudies = collect(WorkController::all())->map(fn (array $project) => [
            'url' => $url('/work/' . $project['slug']),
            'priority' => '0.7',
            'changefreq' => 'monthly',
            'lastmod' => $caseStudyLastmod,
        ]);

        return collect($staticPages)->concat($caseStudies)->concat($posts);
    }

    private static function viewLastmod(string $view): ?string
    {
        return self::fileLastmod(
            resource_path('views/' . str_replace('.', '/', $view) . '.blade.php')
        );
    }

    /**
     * lastmod taken from the source file's modification time.
     *
     * This is a real signal rather than a decorative one: the file changes
     * when the page's content changes, and `git reset --hard` on deploy only
     * rewrites the mtime of files whose content actually differs, so an
     * untouched page keeps its old date across deploys.
     *
     * Deliberately not now(). A sitemap where every lastmod is the current
     * timestamp tells a crawler nothing and gets discounted for it.
     */
    private static function fileLastmod(string $path): ?string
    {
        if (! is_file($path)) {
            return null;
        }

        return Carbon::createFromTimestamp(filemtime($path))->toAtomString();
    }
}
