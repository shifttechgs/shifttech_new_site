<?php

use App\Http\Controllers\LlmsTxtController;
use App\Http\Controllers\RobotsController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Stateless crawler endpoints
|--------------------------------------------------------------------------
|
| Registered in bootstrap/app.php outside the web group, so these skip
| StartSession, cookies and CSRF.
|
| Only bots read these, and bots do not carry cookies, so inside the web
| group every crawl minted a fresh row in the database-backed sessions table
| and every response wrote to it. robots.txt renders a static template with
| no data of its own, yet still could not be served without MySQL. Session
| GC then runs on 2% of requests (config/session.php), sweeping a table the
| crawlers themselves kept growing.
|
| That mattered because Google fetches robots.txt before anything else. A
| stall there aborts the crawl and Search Console reports the sitemap as
| "Couldn't fetch" even when the sitemap itself would have served fine.
|
| CanonicalHost is kept. Without it www serves these on a second host, and
| the sitemap builds its <loc> values from url(), so a sitemap fetched over
| www would advertise www URLs and contradict the canonical apex.
|
| SecurityHeaders is kept because it touches nothing but the response.
|
| sitemap.xml and llms.txt still query posts for their content. This removes
| the session round trip, not their own reads.
|
*/

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [RobotsController::class, 'index'])->name('robots');
Route::get('/llms.txt', [LlmsTxtController::class, 'index'])->name('llms-txt');
