<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ClientHubController;
use App\Http\Controllers\InvoicePdfController;
use App\Http\Controllers\QuotePdfController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\RobotsController;
use App\Http\Controllers\LlmsTxtController;
use App\Http\Controllers\CrmSessionController;


Route::view('/', 'welcome')->name('home');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [RobotsController::class, 'index'])->name('robots');
Route::get('/llms.txt', [LlmsTxtController::class, 'index'])->name('llms-txt');
Route::get('/contact',[ContactsController::class, 'index'])->name('contact.page');

// Contact form with anti-spam protection (rate limiting: 3 submissions per hour)
Route::post('/contact/submit',[ContactsController::class, 'submitForm'])
    ->middleware(\App\Http\Middleware\ThrottleContactForm::class)
    ->name('contact.submit');

// Hero quick-audit form — single email field, shares the same rate limit bucket
Route::post('/contact/quick-audit',[ContactsController::class, 'submitQuickAudit'])
    ->middleware(\App\Http\Middleware\ThrottleContactForm::class)
    ->name('contact.quick-audit');
Route::get('/agency',[AgencyController::class, 'index'])->name('agency.page');
Route::get('/work',[WorkController::class, 'index'])->name('work.page');
Route::get('/work/{slug}',[WorkController::class, 'show'])->name('work.show');
Route::get('/blog',[BlogController::class, 'index'])->name('blog.page');
Route::get('/blog/{post}',[BlogController::class, 'show'])->name('blog.show');

// Services Routes
Route::get('/services/web-design',[ServicesController::class, 'webDesign'])->name('services.web-design');
Route::get('/services/mobile-app-development',[ServicesController::class, 'mobileApps'])->name('services.mobile-app-development');
Route::get('/services/web-application-development',[ServicesController::class, 'webApps'])->name('services.web-application-development');
Route::get('/services/custom-software-development',[ServicesController::class, 'customSoftware'])->name('services.custom-software-development');
Route::get('/services/devops-cloud',[ServicesController::class, 'devOps'])->name('services.devops-cloud');
Route::get('/services/ai',[ServicesController::class, 'ai'])->name('services.ai');

// ─── Client Hub (public, token-based — no login required) ───────────────────
Route::prefix('client-hub')->name('client-hub.')->middleware(\App\Http\Middleware\NoIndex::class)->group(function () {
    Route::get('/quote/{token}',           [ClientHubController::class, 'viewQuote'])->name('quote');
    Route::post('/quote/{token}/accept',   [ClientHubController::class, 'acceptQuote'])->name('quote.accept');
    Route::post('/quote/{token}/decline',  [ClientHubController::class, 'declineQuote'])->name('quote.decline');
    Route::post('/quote/{token}/comment',  [ClientHubController::class, 'postComment'])->name('quote.comment');
    Route::get('/invoice/{token}',         [ClientHubController::class, 'viewInvoice'])->name('invoice');
    Route::get('/invoice/{token}/pay',     [ClientHubController::class, 'paypalCheckout'])->name('payment.checkout');
    Route::get('/invoice/{token}/success', [ClientHubController::class, 'paypalSuccess'])->name('payment.success');
});

// ─── PayPal Webhook (exclude CSRF) ───────────────────────────────────────────
Route::post('/webhooks/paypal', [ClientHubController::class, 'paypalWebhook'])
    ->name('paypal.webhook')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

// ─── Invoice PDF download (CRM users) ────────────────────────────────────────
Route::get('/useluminii/pdf/invoice/{invoiceId}', [InvoicePdfController::class, 'download'])
    ->middleware(['auth'])
    ->name('invoice.pdf');

Route::get('/useluminii/pdf/quote/{quoteId}', [QuotePdfController::class, 'download'])
    ->middleware(['auth'])
    ->name('quote.pdf');

Route::get('/useluminii/pdf/quote/{quoteId}/preview', [QuotePdfController::class, 'preview'])
    ->middleware(['auth'])
    ->name('quote.pdf.preview');

// ─── Luminii CRM — Blade SaaS UI ────────────────────────────────────────────
Route::prefix('luminii')->name('crm.')->middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', [\App\Http\Controllers\Crm\DashboardController::class, 'index'])->name('dashboard');

    // Clients
    Route::resource('clients', \App\Http\Controllers\Crm\ClientController::class)->names('clients');

    // Client Requests
    Route::resource('requests', \App\Http\Controllers\Crm\RequestController::class)->names('requests');
    Route::post('requests/{clientRequest}/convert', [\App\Http\Controllers\Crm\RequestController::class, 'convertToQuote'])->name('requests.convert');

    // Website Leads
    Route::get('leads', [\App\Http\Controllers\Crm\LeadsController::class, 'index'])->name('leads.index');
    Route::get('leads/{lead}', [\App\Http\Controllers\Crm\LeadsController::class, 'show'])->name('leads.show');
    Route::post('leads/{lead}/convert', [\App\Http\Controllers\Crm\LeadsController::class, 'convert'])->name('leads.convert');
    Route::delete('leads/{lead}', [\App\Http\Controllers\Crm\LeadsController::class, 'destroy'])->name('leads.destroy');

    // Pipeline
    Route::get('pipeline', [\App\Http\Controllers\Crm\PipelineController::class, 'index'])->name('pipeline');
    Route::post('pipeline/{clientRequest}/move', [\App\Http\Controllers\Crm\PipelineController::class, 'move'])->name('pipeline.move');

    // Quotes
    Route::resource('quotes', \App\Http\Controllers\Crm\QuoteController::class)->names('quotes');
    Route::post('quotes/{quote}/send', [\App\Http\Controllers\Crm\QuoteController::class, 'send'])->name('quotes.send');
    Route::post('quotes/{quote}/convert-to-job', [\App\Http\Controllers\Crm\QuoteController::class, 'convertToJob'])->name('quotes.convert-to-job');
    // Smart quote helpers (AJAX)
    Route::get('quotes/ajax/client-requests', [\App\Http\Controllers\Crm\QuoteController::class, 'clientRequests'])->name('quotes.ajax.requests');
    Route::get('quotes/ajax/services', [\App\Http\Controllers\Crm\QuoteController::class, 'services'])->name('quotes.ajax.services');

    // Jobs — AJAX helpers MUST be before resource to avoid {job} binding conflict
    Route::get('jobs/ajax/client-requests', [\App\Http\Controllers\Crm\JobController::class, 'clientRequests'])->name('jobs.ajax.requests');
    Route::get('jobs/ajax/services', [\App\Http\Controllers\Crm\JobController::class, 'servicesCatalogue'])->name('jobs.ajax.services');
    Route::resource('jobs', \App\Http\Controllers\Crm\JobController::class)->names('jobs');
    Route::post('jobs/{job}/create-invoice', [\App\Http\Controllers\Crm\JobController::class, 'createInvoice'])->name('jobs.create-invoice');
    Route::post('jobs/{job}/status', [\App\Http\Controllers\Crm\JobController::class, 'updateStatus'])->name('jobs.status');

    // Job Calendar
    Route::get('calendar', [\App\Http\Controllers\Crm\CalendarController::class, 'index'])->name('calendar');
    Route::post('calendar/schedule', [\App\Http\Controllers\Crm\CalendarController::class, 'schedule'])->name('calendar.schedule');
    Route::get('calendar/events', [\App\Http\Controllers\Crm\CalendarController::class, 'events'])->name('calendar.events');

    // Invoices
    Route::resource('invoices', \App\Http\Controllers\Crm\InvoiceController::class)->names('invoices');
    Route::post('invoices/{invoice}/send', [\App\Http\Controllers\Crm\InvoiceController::class, 'send'])->name('invoices.send');
    Route::post('invoices/{invoice}/payment', [\App\Http\Controllers\Crm\InvoiceController::class, 'recordPayment'])->name('invoices.payment');

    // Expenses
    Route::resource('expenses', \App\Http\Controllers\Crm\ExpenseController::class)->names('expenses');

    // Recurring Invoices
    Route::resource('recurring', \App\Http\Controllers\Crm\RecurringInvoiceController::class)->names('recurring');

    // Reports
    Route::get('reports', [\App\Http\Controllers\Crm\ReportsController::class, 'index'])->name('reports');

    // Notifications
    Route::get('notifications', [\App\Http\Controllers\Crm\NotificationsController::class, 'index'])->name('notifications.index');
    Route::post('notifications/{notification}/read', [\App\Http\Controllers\Crm\NotificationsController::class, 'markRead'])->name('notifications.read');
    Route::post('notifications/read-all', [\App\Http\Controllers\Crm\NotificationsController::class, 'readAll'])->name('notifications.read-all');

    // Settings
    Route::get('settings', [\App\Http\Controllers\Crm\SettingsController::class, 'index'])->name('settings');
    Route::post('settings', [\App\Http\Controllers\Crm\SettingsController::class, 'update'])->name('settings.update');

    // Business Services
    Route::resource('services', \App\Http\Controllers\Crm\BusinessServiceController::class)->names('services');

    // Team Members
    Route::resource('team', \App\Http\Controllers\Crm\TeamController::class)->names('team');
    Route::post('team/{teamMember}/invite', [\App\Http\Controllers\Crm\TeamController::class, 'resendInvite'])->name('team.invite');

    // Users
    Route::resource('users', \App\Http\Controllers\Crm\UserController::class)->names('users');
});

// CRM login redirect
Route::get('/luminii/login', [CrmSessionController::class, 'login'])->name('crm.login');

Route::post('/logout', [CrmSessionController::class, 'logout'])->name('logout');


