<x-crm::layout title="Dashboard">

{{-- Stats Grid --}}
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1rem;margin-bottom:1.5rem;">

    <div class="crm-stat">
        <div class="crm-stat-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:1.25rem;height:1.25rem;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <span class="crm-stat-label">Total Clients</span>
        <span class="crm-stat-value">{{ number_format($stats['total_clients']) }}</span>
        <span class="crm-stat-meta">{{ $stats['leads'] }} leads</span>
    </div>

    <div class="crm-stat">
        <div class="crm-stat-icon">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:1.25rem;height:1.25rem;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <span class="crm-stat-label">Active Jobs</span>
        <span class="crm-stat-value">{{ $stats['active_jobs'] }}</span>
        <span class="crm-stat-meta">{{ $stats['completed_month'] }} completed this month</span>
    </div>

    <div class="crm-stat">
        <div class="crm-stat-icon" style="background:#ecfdf3;color:#12b76a;">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:1.25rem;height:1.25rem;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        </div>
        <span class="crm-stat-label">Revenue This Month</span>
        <span class="crm-stat-value" style="font-size:1.35rem;">R {{ number_format($stats['revenue_paid'], 2) }}</span>
        <span class="crm-stat-meta" style="color:var(--color-success-text);">Paid invoices</span>
    </div>

    <div class="crm-stat">
        <div class="crm-stat-icon" style="background:#fffaeb;color:#f79009;">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:1.25rem;height:1.25rem;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <span class="crm-stat-label">Outstanding</span>
        <span class="crm-stat-value" style="font-size:1.35rem;">R {{ number_format($stats['revenue_pending'], 2) }}</span>
        <span class="crm-stat-meta">Pending payment</span>
    </div>

    @if($stats['overdue_count'] > 0)
    <div class="crm-stat" style="border-color:#fecdca;">
        <div class="crm-stat-icon" style="background:#fef3f2;color:#f04438;">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:1.25rem;height:1.25rem;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <span class="crm-stat-label" style="color:var(--color-danger-text);">Overdue Invoices</span>
        <span class="crm-stat-value" style="color:var(--color-danger-text);">{{ $stats['overdue_count'] }}</span>
        <span class="crm-stat-meta" style="color:var(--color-danger-text);">R {{ number_format($stats['overdue_value'], 2) }}</span>
    </div>
    @endif

    <div class="crm-stat">
        <div class="crm-stat-icon" style="background:#eff8ff;color:#2e90fa;">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:1.25rem;height:1.25rem;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
        <span class="crm-stat-label">Open Quotes</span>
        <span class="crm-stat-value">{{ $stats['open_quotes'] }}</span>
        <span class="crm-stat-meta">R {{ number_format($stats['open_quotes_value'], 2) }} pipeline</span>
    </div>

</div>

{{-- Revenue Chart + Activity --}}
<div style="display:grid;grid-template-columns:1fr 360px;gap:1.25rem;margin-bottom:1.5rem;" class="crm-dashboard-grid">

    {{-- Revenue Chart --}}
    <div class="crm-card">
        <div class="crm-card-header">
            <span class="crm-card-title">Revenue vs Expenses</span>
            <span style="font-size:0.8125rem;color:var(--color-ink-3);">Last 6 months</span>
        </div>
        <div class="crm-card-body" style="padding:1.5rem;">
            <canvas id="revenueChart" height="200"></canvas>
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="crm-card">
        <div class="crm-card-header">
            <span class="crm-card-title">Recent Activity</span>
            <a href="{{ route('crm.notifications.index') }}" style="font-size:0.8125rem;color:var(--color-ink-3);">View all</a>
        </div>
        <div style="padding:0.5rem 0;">
            @forelse($recentActivity as $log)
            <div style="display:flex;align-items:flex-start;gap:0.75rem;padding:0.625rem 1.25rem;border-bottom:1px solid var(--color-border);">
                <div style="width:2rem;height:2rem;border-radius:50%;background:var(--color-bg);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:0.75rem;font-weight:600;color:var(--color-ink-2);">
                    {{ strtoupper(substr($log->user->name ?? 'S', 0, 2)) }}
                </div>
                <div style="flex:1;min-width:0;">
                    <p style="font-size:0.8125rem;color:var(--color-ink-1);line-height:1.4;" class="crm-truncate">{{ $log->description }}</p>
                    <p style="font-size:0.75rem;color:var(--color-ink-3);margin-top:2px;">{{ $log->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
            <div class="crm-empty" style="padding:2rem;">
                <p class="crm-empty-text">No activity yet</p>
            </div>
            @endforelse
        </div>
    </div>

</div>

{{-- Upcoming Jobs + Overdue Invoices --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;" class="crm-dashboard-grid">

    {{-- Upcoming Jobs --}}
    <div class="crm-card">
        <div class="crm-card-header">
            <span class="crm-card-title">Upcoming Jobs</span>
            <a href="{{ route('crm.jobs.index') }}" class="crm-btn crm-btn-secondary crm-btn-sm">View all</a>
        </div>
        <div class="crm-table-wrap" style="border:none;border-radius:0;box-shadow:none;">
            <table class="crm-table">
                <thead><tr>
                    <th>Job</th><th>Client</th><th>Status</th><th>Date</th>
                </tr></thead>
                <tbody>
                @forelse($upcomingJobs as $job)
                <tr onclick="window.location='{{ route('crm.jobs.show', $job) }}'">
                    <td>
                        <p style="font-weight:500;font-size:0.875rem;" class="crm-truncate" style="max-width:200px;">{{ $job->job_title }}</p>
                        <p style="font-size:0.75rem;color:var(--color-ink-3);">{{ $job->job_id }}</p>
                    </td>
                    <td style="font-size:0.875rem;">{{ $job->client->full_name ?? '—' }}</td>
                    <td>
                        @include('crm.partials.job-badge', ['status' => $job->job_status])
                    </td>
                    <td style="font-size:0.8125rem;color:var(--color-ink-3);">{{ $job->job_date_time ? $job->job_date_time->format('d M') : '—' }}</td>
                </tr>
                @empty
                <tr><td colspan="4"><div class="crm-empty" style="padding:1.5rem;"><p class="crm-empty-text">No upcoming jobs</p></div></td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Overdue Invoices --}}
    <div class="crm-card">
        <div class="crm-card-header">
            <span class="crm-card-title" style="color:var(--color-danger-text);">Overdue Invoices</span>
            <a href="{{ route('crm.invoices.index', ['status' => 'Overdue']) }}" class="crm-btn crm-btn-secondary crm-btn-sm">View all</a>
        </div>
        <div class="crm-table-wrap" style="border:none;border-radius:0;box-shadow:none;">
            <table class="crm-table">
                <thead><tr>
                    <th>Invoice</th><th>Client</th><th>Amount</th><th>Due</th>
                </tr></thead>
                <tbody>
                @forelse($overdueInvoices as $inv)
                <tr onclick="window.location='{{ route('crm.invoices.show', $inv) }}'">
                    <td style="font-size:0.875rem;font-weight:500;">{{ $inv->invoice_id }}</td>
                    <td style="font-size:0.875rem;">{{ $inv->client->full_name ?? '—' }}</td>
                    <td style="font-size:0.875rem;font-weight:600;color:var(--color-danger-text);">R {{ number_format($inv->balance, 2) }}</td>
                    <td style="font-size:0.8125rem;color:var(--color-danger-text);">{{ $inv->due_date ? $inv->due_date->format('d M') : '—' }}</td>
                </tr>
                @empty
                <tr><td colspan="4"><div class="crm-empty" style="padding:1.5rem;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:1.5rem;height:1.5rem;color:var(--color-success);margin:0 auto 0.5rem;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <p class="crm-empty-text">No overdue invoices</p>
                </div></td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
<script>
const ctx = document.getElementById('revenueChart');
const labels = @json(collect($revenueChart)->pluck('label'));
const revenues = @json(collect($revenueChart)->pluck('revenue'));
const expenses = @json(collect($revenueChart)->pluck('expenses'));

new Chart(ctx, {
    type: 'line',
    data: {
        labels,
        datasets: [
            {
                label: 'Revenue',
                data: revenues,
                borderColor: '#12b76a',
                backgroundColor: 'rgba(18,183,106,0.08)',
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointBackgroundColor: '#12b76a',
                borderWidth: 2,
            },
            {
                label: 'Expenses',
                data: expenses,
                borderColor: '#f04438',
                backgroundColor: 'rgba(240,68,56,0.06)',
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointBackgroundColor: '#f04438',
                borderWidth: 2,
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        interaction: { mode: 'index', intersect: false },
        plugins: {
            legend: { labels: { font: { family: 'Inter', size: 12 }, color: '#5a6a7e', boxWidth: 12 } },
            tooltip: { callbacks: { label: ctx => 'R ' + ctx.raw.toFixed(2) } }
        },
        scales: {
            x: { grid: { display: false }, ticks: { font: { family: 'Inter', size: 11 }, color: '#8898aa' } },
            y: { grid: { color: '#e4e9f0' }, ticks: { font: { family: 'Inter', size: 11 }, color: '#8898aa', callback: v => 'R' + v } }
        }
    }
});
</script>
@endpush

<style>
@media(max-width:900px){.crm-dashboard-grid{grid-template-columns:1fr!important;}}
</style>

</x-crm::layout>

