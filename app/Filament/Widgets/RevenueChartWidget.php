<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class RevenueChartWidget extends ChartWidget
{
    protected static ?int    $sort    = 2;
    protected static ?string $heading = 'Monthly Revenue (Last 6 Months)';
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $months = collect(range(5, 0))->map(fn ($i) => now()->subMonths($i));

        $revenue = $months->map(fn ($m) =>
            Invoice::where('status', 'Paid')
                ->whereYear('paid_at', $m->year)
                ->whereMonth('paid_at', $m->month)
                ->sum('total_amount')
        );

        $expenses = $months->map(fn ($m) =>
            \App\Models\Expense::whereYear('expense_date', $m->year)
                ->whereMonth('expense_date', $m->month)
                ->sum('amount')
        );

        return [
            'datasets' => [
                [
                    'label'           => 'Revenue (R)',
                    'data'            => $revenue->values()->toArray(),
                    'backgroundColor' => 'rgba(99,91,255,0.2)',
                    'borderColor'     => '#635bff',
                    'fill'            => true,
                ],
                [
                    'label'           => 'Expenses (R)',
                    'data'            => $expenses->values()->toArray(),
                    'backgroundColor' => 'rgba(244,63,94,0.2)',
                    'borderColor'     => '#f43f5e',
                    'fill'            => true,
                ],
            ],
            'labels' => $months->map(fn ($m) => $m->format('M Y'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

