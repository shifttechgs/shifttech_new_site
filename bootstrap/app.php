<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('crm:recurring-invoices')->dailyAt('06:00');
        $schedule->command('crm:overdue-invoices')->dailyAt('07:00');
        $schedule->command('crm:expire-quotes')->dailyAt('08:00');
    })
    ->withMiddleware(function (Middleware $middleware): void {
        // TLS terminates at the proxy in front of the app, so without this
        // Laravel sees every request as plain http: route()/url() render
        // http:// links (the contact form fetch then dies on mixed content)
        // and request()->ip() returns the proxy address instead of the
        // visitor's, which collapses the contact form rate limiter into a
        // single shared bucket for the whole site.
        // Pass the raw string: TrustProxies only honours the '*' wildcard
        // as a string, and splits a comma-separated list itself.
        $middleware->trustProxies(
            at: env('TRUSTED_PROXIES', '*'),
            headers: Request::HEADER_X_FORWARDED_FOR
                | Request::HEADER_X_FORWARDED_HOST
                | Request::HEADER_X_FORWARDED_PORT
                | Request::HEADER_X_FORWARDED_PROTO,
        );

        $middleware->redirectGuestsTo('/useluminii/login');
        $middleware->web(append: [
            \App\Http\Middleware\SecurityHeaders::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
