<?php

namespace App\Http\Controllers;

use App\Services\SiteUrls;

class SitemapController extends Controller
{
    /**
     * The URL list and its lastmod logic live in SiteUrls because IndexNow
     * submits the same set. Keeping one copy means a page added to the site
     * cannot end up in the sitemap but missing from the crawler pings.
     */
    public function index()
    {
        return response()
            ->view('sitemap', ['urls' => SiteUrls::all()])
            ->header('Content-Type', 'application/xml');
    }
}
