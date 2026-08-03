<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Serves the site from one hostname only.
 *
 * Both shifttechgs.com and www.shifttechgs.com returned 200 with no redirect,
 * and because the canonical tag is built from url()->current() each host
 * declared itself canonical. Google therefore saw two complete copies of the
 * site competing with each other and split the ranking signals between them.
 *
 * Strips a leading "www." rather than redirecting to a configured APP_URL, so
 * it cannot loop if APP_URL is wrong or unset, and it leaves any other host
 * (local dev, the pod's internal hostname, health checks) untouched.
 */
class CanonicalHost
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();

        if (! str_starts_with($host, 'www.')) {
            return $next($request);
        }

        $target = $request->fullUrl();
        $target = preg_replace('#^(https?://)www\.#i', '$1', $target, 1);

        // 301: this is a permanent canonicalisation, and a 302 would leave the
        // duplicate in the index indefinitely.
        return redirect($target, 301);
    }
}
