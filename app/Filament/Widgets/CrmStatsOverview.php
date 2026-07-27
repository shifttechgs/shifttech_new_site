<?php

namespace App\Filament\Widgets;

use App\Models\BusinessClient;
use App\Models\Invoice;
use App\Models\Job;
use App\Models\Quote;
use App\Models\ContactFormSubmission;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CrmStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalRevenue   = Invoice::where('status', 'Paid')->sum('total_amount');
        $pendingRevenue = Invoice::whereIn('status', ['Sent', 'PartiallyPaid'])->sum('balance');
        $overdueCount   = Invoice::where('status', 'Overdue')->count();
        $newLeads       = ContactFormSubmission::where('status', 'New')->count();

        return [
            Stat::make('Total Clients', BusinessClient::where('client_type', 'Client')->count())
                ->description(BusinessClient::where('client_type', 'Lead')->count() . ' new leads')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Active Jobs', Job::whereIn('job_status', ['New', 'Scheduled', 'InProgress'])->count())
                ->description(Job::where('job_status', 'Completed')->whereMonth('updated_at', now()->month)->count() . ' completed this month')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('info'),

            Stat::make('Revenue (Paid)', 'R ' . number_format($totalRevenue, 2))
                ->description('R ' . number_format($pendingRevenue, 2) . ' pending')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Overdue Invoices', $overdueCount)
                ->description($newLeads . ' new website leads')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($overdueCount > 0 ? 'danger' : 'gray'),

            Stat::make('Open Quotes', Quote::whereIn('status', ['Draft', 'Sent'])->count())
                ->description(Quote::where('status', 'Accepted')->whereMonth('updated_at', now()->month)->count() . ' accepted this month')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning'),
        ];
    }
}

