<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Carbon;

class SitemapController extends Controller
{
    public function index()
    {
        // The blog index changes whenever any post does, not when its own
        // template is edited.
        $newestPost = Post::published()->max('updated_at');
        $newestPost = $newestPost ? Carbon::parse($newestPost)->toAtomString() : null;

        $staticPages = [
            ['url' => url('/'), 'priority' => '1.0', 'changefreq' => 'weekly', 'lastmod' => $this->viewLastmod('welcome')],
            ['url' => url('/agency'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $this->viewLastmod('agency')],
            ['url' => url('/work'), 'priority' => '0.8', 'changefreq' => 'weekly', 'lastmod' => $this->viewLastmod('work')],
            ['url' => url('/blog'), 'priority' => '0.8', 'changefreq' => 'daily', 'lastmod' => $newestPost ?: $this->viewLastmod('blog')],
            ['url' => url('/contact'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $this->viewLastmod('contact')],
            ['url' => url('/services/ai'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $this->viewLastmod('services.ai')],
            ['url' => url('/services/web-design'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $this->viewLastmod('services.web-design')],
            ['url' => url('/services/web-application-development'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $this->viewLastmod('services.web-application-development')],
            ['url' => url('/services/custom-software-development'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $this->viewLastmod('services.custom-software-development')],
            ['url' => url('/services/devops-cloud'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $this->viewLastmod('services.devops-cloud')],
            ['url' => url('/services/mobile-app-development'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $this->viewLastmod('services.mobile-app-development')],
        ];

        $posts = Post::published()->get()->map(fn (Post $post) => [
            'url' => url('/blog/' . $post->slug),
            'priority' => '0.6',
            'changefreq' => 'monthly',
            'lastmod' => $post->updated_at?->toAtomString(),
        ]);

        // Case studies rank for "<service> <industry>" intent and are the
        // pages AI engines quote results from, so they sit above blog posts.
        // Case study copy lives in config/case-studies.php, so that file's
        // mtime is when any of these pages last actually changed.
        $caseStudyLastmod = $this->fileLastmod(config_path('case-studies.php'));

        $caseStudies = collect(WorkController::all())->map(fn (array $project) => [
            'url' => url('/work/' . $project['slug']),
            'priority' => '0.7',
            'changefreq' => 'monthly',
            'lastmod' => $caseStudyLastmod,
        ]);

        $urls = collect($staticPages)->concat($caseStudies)->concat($posts);

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }

    private function viewLastmod(string $view): ?string
    {
        return $this->fileLastmod(
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
    private function fileLastmod(string $path): ?string
    {
        if (! is_file($path)) {
            return null;
        }

        return Carbon::createFromTimestamp(filemtime($path))->toAtomString();
    }
}
