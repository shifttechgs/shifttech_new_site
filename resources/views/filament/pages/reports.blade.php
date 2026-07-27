<x-filament-panels::page>
    @php
        $stats   = $this->getSummaryStats();
        $chart   = $this->getRevenueChartData();
        $topClients   = $this->getTopClients();
        $jobsBreakdown = $this->getJobsBreakdown();
        $expBreakdown  = $this->getExpenseBreakdown();
        $leadSources   = $this->getLeadSourceBreakdown();
        $invBreakdown  = $this->getInvoiceBreakdown();

        $jobColors = [
            'New'       => '#635bff',
            'Scheduled' => '#3b82f6',
            'InProgress'=> '#f59e0b',
            'Completed' => '#10b981',
            'Cancelled' => '#f43f5e',
        ];
    @endphp

    {{-- ── Filters ────────────────────────────────────────────────────────── --}}
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
        <form wire:submit.prevent>
            {{ $this->form }}
        </form>
    </div>

    {{-- ── Summary Cards ──────────────────────────────────────────────────── --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">

        {{-- Revenue --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Revenue (Paid)</p>
            <p class="text-2xl font-bold text-emerald-600 mt-1">R {{ number_format($stats['revenue'], 2) }}</p>
            <p class="text-xs text-gray-400 mt-1">R {{ number_format($stats['pending'], 2) }} pending</p>
        </div>

        {{-- Expenses --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Expenses</p>
            <p class="text-2xl font-bold text-rose-500 mt-1">R {{ number_format($stats['expenses'], 2) }}</p>
            <p class="text-xs text-gray-400 mt-1">Period total</p>
        </div>

        {{-- Profit --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Net Profit</p>
            <p class="text-2xl font-bold mt-1 {{ $stats['profit'] >= 0 ? 'text-emerald-600' : 'text-rose-500' }}">
                R {{ number_format($stats['profit'], 2) }}
            </p>
            <p class="text-xs text-gray-400 mt-1">Revenue − Expenses</p>
        </div>

        {{-- Jobs Completed --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Jobs Completed</p>
            <p class="text-2xl font-bold text-indigo-600 mt-1">{{ $stats['jobsCompleted'] }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ $stats['newClients'] }} new clients</p>
        </div>

        {{-- Quote Conversion --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Quote Conversion</p>
            <p class="text-2xl font-bold text-amber-500 mt-1">{{ $stats['conversionRate'] }}%</p>
            <p class="text-xs text-gray-400 mt-1">{{ $stats['quotesAccepted'] }} accepted</p>
        </div>

        {{-- Overdue --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border {{ $stats['overdue'] > 0 ? 'border-rose-200' : 'border-gray-200 dark:border-gray-700' }} p-5 shadow-sm col-span-2 md:col-span-1">
            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Overdue Balance</p>
            <p class="text-2xl font-bold mt-1 {{ $stats['overdue'] > 0 ? 'text-rose-500' : 'text-gray-400' }}">
                R {{ number_format($stats['overdue'], 2) }}
            </p>
            <p class="text-xs text-gray-400 mt-1">Needs attention</p>
        </div>

    </div>

    {{-- ── Revenue vs Expenses Chart ───────────────────────────────────────── --}}
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-semibold text-gray-800 dark:text-gray-100">Revenue vs Expenses (Last 6 Months)</h3>
        </div>
        <canvas id="revenueChart" height="90"></canvas>
    </div>

    {{-- ── Row: Top Clients + Invoice Breakdown ───────────────────────────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Top Clients --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-semibold text-gray-800 dark:text-gray-100">Top Clients by Revenue</h3>
                <span class="text-xs text-gray-400">{{ $this->date_from }} – {{ $this->date_to }}</span>
            </div>
            @forelse($topClients as $i => $row)
            @php $client = $row->client; @endphp
            <div class="flex items-center justify-between py-2.5 {{ $i < count($topClients) - 1 ? 'border-b border-gray-100 dark:border-gray-700' : '' }}">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-full bg-indigo-100 text-indigo-700 text-xs font-bold flex items-center justify-center">{{ $i + 1 }}</span>
                    <div>
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-100">
                            {{ $client?->firstname }} {{ $client?->lastname }}
                        </p>
                        <p class="text-xs text-gray-400">{{ $row->invoice_count }} invoice(s)</p>
                    </div>
                </div>
                <span class="text-sm font-bold text-emerald-600">R {{ number_format($row->total_revenue, 2) }}</span>
            </div>
            @empty
            <p class="text-sm text-gray-400 py-4 text-center">No paid invoices in this period.</p>
            @endforelse
        </div>

        {{-- Invoice Breakdown --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
            <h3 class="text-base font-semibold text-gray-800 dark:text-gray-100 mb-4">Invoice Status Breakdown</h3>
            @php
                $invColors = ['Draft'=>'bg-gray-100 text-gray-600','Sent'=>'bg-blue-100 text-blue-700','Paid'=>'bg-emerald-100 text-emerald-700','PartiallyPaid'=>'bg-amber-100 text-amber-700','Overdue'=>'bg-rose-100 text-rose-700','Cancelled'=>'bg-slate-100 text-slate-500'];
            @endphp
            @forelse($invBreakdown as $status => $row)
            <div class="flex items-center justify-between py-2.5 border-b border-gray-100 dark:border-gray-700 last:border-0">
                <div class="flex items-center gap-3">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $invColors[$status] ?? 'bg-gray-100 text-gray-600' }}">{{ $status }}</span>
                    <span class="text-xs text-gray-400">{{ $row['count'] }} invoice(s)</span>
                </div>
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-200">R {{ number_format($row['total'], 2) }}</span>
            </div>
            @empty
            <p class="text-sm text-gray-400 py-4 text-center">No invoices in this period.</p>
            @endforelse
        </div>
    </div>

    {{-- ── Row: Jobs + Lead Sources + Expenses ────────────────────────────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Jobs Breakdown --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
            <h3 class="text-base font-semibold text-gray-800 dark:text-gray-100 mb-4">Jobs by Status</h3>
            @forelse($jobsBreakdown as $status => $count)
            @php $total = array_sum($jobsBreakdown); $pct = $total > 0 ? round(($count/$total)*100) : 0; @endphp
            <div class="mb-3">
                <div class="flex justify-between text-xs mb-1">
                    <span class="text-gray-600 dark:text-gray-300 font-medium">{{ $status }}</span>
                    <span class="text-gray-400">{{ $count }} ({{ $pct }}%)</span>
                </div>
                <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2">
                    <div class="h-2 rounded-full" style="width:{{ $pct }}%; background:{{ $jobColors[$status] ?? '#635bff' }}"></div>
                </div>
            </div>
            @empty
            <p class="text-sm text-gray-400 py-4 text-center">No jobs in this period.</p>
            @endforelse
        </div>

        {{-- Lead Sources --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
            <h3 class="text-base font-semibold text-gray-800 dark:text-gray-100 mb-4">Client Acquisition Sources</h3>
            @forelse($leadSources as $row)
            @php $total = $leadSources->sum('count'); $pct = $total > 0 ? round(($row->count/$total)*100) : 0; @endphp
            <div class="mb-3">
                <div class="flex justify-between text-xs mb-1">
                    <span class="text-gray-600 dark:text-gray-300 font-medium capitalize">{{ $row->lead_source ?: 'Unknown' }}</span>
                    <span class="text-gray-400">{{ $row->count }} ({{ $pct }}%)</span>
                </div>
                <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2">
                    <div class="h-2 rounded-full bg-indigo-500" style="width:{{ $pct }}%"></div>
                </div>
            </div>
            @empty
            <p class="text-sm text-gray-400 py-4 text-center">No new clients in this period.</p>
            @endforelse
        </div>

        {{-- Expense Categories --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
            <h3 class="text-base font-semibold text-gray-800 dark:text-gray-100 mb-4">Expenses by Category</h3>
            @forelse($expBreakdown as $row)
            @php $totalExp = $expBreakdown->sum('total'); $pct = $totalExp > 0 ? round(($row->total/$totalExp)*100) : 0; @endphp
            <div class="mb-3">
                <div class="flex justify-between text-xs mb-1">
                    <span class="text-gray-600 dark:text-gray-300 font-medium">{{ optional($row->category)->name ?? 'Uncategorised' }}</span>
                    <span class="text-gray-400">R {{ number_format($row->total, 2) }}</span>
                </div>
                <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2">
                    <div class="h-2 rounded-full bg-rose-400" style="width:{{ $pct }}%"></div>
                </div>
            </div>
            @empty
            <p class="text-sm text-gray-400 py-4 text-center">No expenses in this period.</p>
            @endforelse
        </div>

    </div>

    {{-- ── Export Buttons ──────────────────────────────────────────────────── --}}
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
        <h3 class="text-base font-semibold text-gray-800 dark:text-gray-100 mb-4">Export Data</h3>
        <div class="flex flex-wrap gap-3">
            <button wire:click="exportInvoices"
                class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Export Invoices CSV
            </button>
            <button wire:click="exportExpenses"
                class="inline-flex items-center gap-2 px-4 py-2 bg-rose-500 hover:bg-rose-600 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Export Expenses CSV
            </button>
            <button wire:click="exportJobs"
                class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Export Jobs CSV
            </button>
            <span class="inline-flex items-center text-xs text-gray-400 self-center">
                Period: {{ $this->date_from }} to {{ $this->date_to }}
            </span>
        </div>
    </div>

    {{-- ── Chart.js ─────────────────────────────────────────────────────────── --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        function initRevenueChart() {
            const ctx = document.getElementById('revenueChart');
            if (!ctx || window._revenueChart) return;

            window._revenueChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels:   @json($chart['labels']),
                    datasets: [
                        {
                            label: 'Revenue (R)',
                            data:  @json($chart['revenue']),
                            borderColor: '#635bff',
                            backgroundColor: 'rgba(99,91,255,0.08)',
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#635bff',
                            pointRadius: 5,
                        },
                        {
                            label: 'Expenses (R)',
                            data:  @json($chart['expenses']),
                            borderColor: '#f43f5e',
                            backgroundColor: 'rgba(244,63,94,0.08)',
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#f43f5e',
                            pointRadius: 5,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'top' },
                        tooltip: {
                            callbacks: {
                                label: ctx => 'R ' + ctx.parsed.y.toFixed(2)
                            }
                        }
                    },
                    scales: {
                        y: {
                            ticks: { callback: val => 'R ' + val.toLocaleString() },
                            grid: { color: 'rgba(0,0,0,0.05)' }
                        }
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', initRevenueChart);

        // Re-init after Livewire navigations
        document.addEventListener('livewire:navigated', () => {
            if (window._revenueChart) { window._revenueChart.destroy(); delete window._revenueChart; }
            initRevenueChart();
        });
    </script>

    <x-filament-actions::modals />
</x-filament-panels::page>

