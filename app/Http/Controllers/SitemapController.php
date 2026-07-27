<?php

namespace App\Http\Controllers;

use App\Models\Post;

class SitemapController extends Controller
{
    public function index()
    {
        $staticPages = [
            ['url' => url('/'), 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => url('/agency'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => url('/work'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => url('/blog'), 'priority' => '0.8', 'changefreq' => 'daily'],
            ['url' => url('/contact'), 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => url('/services/ai'), 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => url('/services/web-design'), 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => url('/services/web-application-development'), 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => url('/services/custom-software-development'), 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => url('/services/devops-cloud'), 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => url('/services/mobile-app-development'), 'priority' => '0.9', 'changefreq' => 'monthly'],
        ];

        $posts = Post::published()->get()->map(fn (Post $post) => [
            'url' => url('/blog/' . $post->slug),
            'priority' => '0.6',
            'changefreq' => 'monthly',
            'lastmod' => $post->updated_at?->toAtomString(),
        ]);

        $urls = collect($staticPages)->concat($posts);

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
