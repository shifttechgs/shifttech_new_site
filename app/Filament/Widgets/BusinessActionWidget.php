<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use App\Models\Job;
use App\Models\Quote;
use App\Models\ClientRequest;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BusinessActionWidget extends BaseWidget
{
    protected static ?int $sort = 4;
    protected static ?string $heading = 'Needs Attention';

    protected function getStats(): array
    {
        $overdueInvoices    = Invoice::where('status', 'Overdue')->count();
        $overdueValue       = Invoice::where('status', 'Overdue')->sum('balance');
        $jobsUnassigned     = Job::where('assigned_status', 'Unassigned')
                                 ->whereNotIn('job_status', ['Completed','Cancelled'])
                                 ->count();
        $jobsNeedInvoice    = Job::where('job_status', 'Completed')
                                 ->whereNull('invoice_id')
                                 ->count();
        $newRequests        = ClientRequest::where('status', 'New')->count();
        $pendingQuotes      = Quote::whereIn('status', ['Draft', 'Sent'])->count();
        $pendingValue       = Quote::whereIn('status', ['Draft', 'Sent'])->sum('grand_total');

        return [
            Stat::make('Overdue Invoices', $overdueInvoices)
                ->description('R ' . number_format($overdueValue, 2) . ' outstanding')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($overdueInvoices > 0 ? 'danger' : 'gray')
                ->url('/useluminii/invoices'),

            Stat::make('Jobs Without Invoice', $jobsNeedInvoice)
                ->description('Completed jobs awaiting billing')
                ->descriptionIcon('heroicon-m-document-plus')
                ->color($jobsNeedInvoice > 0 ? 'warning' : 'gray')
                ->url('/useluminii/jobs'),

            Stat::make('Unassigned Jobs', $jobsUnassigned)
                ->description('Need a team member assigned')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color($jobsUnassigned > 0 ? 'warning' : 'gray')
                ->url('/useluminii/jobs'),

            Stat::make('New Client Requests', $newRequests)
                ->description('Awaiting review in pipeline')
                ->descriptionIcon('heroicon-m-inbox')
                ->color($newRequests > 0 ? 'info' : 'gray')
                ->url('/useluminii/pipeline'),

            Stat::make('Open Quotes Pipeline', $pendingQuotes)
                ->description('R ' . number_format($pendingValue, 2) . ' potential value')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning')
                ->url('/useluminii/quotes'),
        ];
    }
}

