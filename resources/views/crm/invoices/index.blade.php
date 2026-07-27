<x-crm::layout title="Invoices">
<div class="crm-page-header">
    <div><h1 class="crm-page-title">Invoices</h1><p class="crm-page-subtitle">Billing, payments and outstanding balances</p></div>
    <a href="{{ route('crm.invoices.create') }}" class="crm-btn crm-btn-primary">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        New Invoice
    </a>
</div>

<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.5rem;">
    <div class="crm-stat"><span class="crm-stat-label">Total</span><span class="crm-stat-value">{{ $stats['total'] }}</span></div>
    <div class="crm-stat"><span class="crm-stat-label">Revenue Paid</span><span class="crm-stat-value" style="font-size:1.1rem;color:var(--color-success-text);">R {{ number_format($stats['revenue'], 0) }}</span></div>
    <div class="crm-stat"><span class="crm-stat-label">Outstanding</span><span class="crm-stat-value" style="font-size:1.1rem;color:var(--color-warning-text);">R {{ number_format($stats['outstanding'], 0) }}</span></div>
    <div class="crm-stat" style="{{ $stats['overdue']>0 ? 'border-color:#fecdca;' : '' }}">
        <span class="crm-stat-label" style="{{ $stats['overdue']>0 ? 'color:var(--color-danger-text);' : '' }}">Overdue</span>
        <span class="crm-stat-value" style="{{ $stats['overdue']>0 ? 'color:var(--color-danger-text);' : '' }}">{{ $stats['overdue'] }}</span>
    </div>
</div>

<div class="crm-table-wrap">
    <div class="crm-table-toolbar">
        <form method="GET" action="{{ route('crm.invoices.index') }}" style="display:contents;">
            <div class="crm-search">
                <svg class="crm-search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search invoices…">
            </div>
            <select name="status" class="crm-select" style="width:auto;" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                @foreach(['Draft','Sent','PartiallyPaid','Paid','Overdue','Cancelled'] as $s)
                <option value="{{ $s }}" {{ request('status')==$s?'selected':'' }}>{{ $s }}</option>
                @endforeach
            </select>
            <button type="submit" class="crm-btn crm-btn-secondary crm-btn-sm">Search</button>
            @if(request('q')||request('status'))<a href="{{ route('crm.invoices.index') }}" class="crm-btn crm-btn-ghost crm-btn-sm">Clear</a>@endif
        </form>
        <span style="margin-left:auto;font-size:0.8125rem;color:var(--color-ink-3);">{{ $invoices->total() }} records</span>
    </div>
    <table class="crm-table">
        <thead><tr><th>Invoice</th><th>Client</th><th>Amount</th><th>Balance</th><th>Status</th><th>Due Date</th><th></th></tr></thead>
        <tbody>
        @forelse($invoices as $inv)
        <tr onclick="window.location='{{ route('crm.invoices.show', $inv) }}'">
            <td class="crm-mono">{{ $inv->invoice_id }}</td>
            <td>{{ $inv->client->full_name ?? '—' }}</td>
            <td style="font-weight:500;">R {{ number_format($inv->total_amount, 2) }}</td>
            <td style="font-weight:600;{{ $inv->balance > 0 ? 'color:var(--color-warning-text);' : 'color:var(--color-success-text);' }}">R {{ number_format($inv->balance, 2) }}</td>
            <td>@include('crm.partials.invoice-badge', ['status' => $inv->status])</td>
            <td style="color:var(--color-ink-3);{{ $inv->due_date && $inv->due_date->isPast() && $inv->status !== 'Paid' ? 'color:var(--color-danger-text);font-weight:600;' : '' }}">
                {{ $inv->due_date ? $inv->due_date->format('d M Y') : '—' }}
            </td>
            <td><a href="{{ route('crm.invoices.edit', $inv) }}" class="crm-btn crm-btn-ghost crm-btn-sm" onclick="event.stopPropagation()">Edit</a></td>
        </tr>
        @empty
        <tr><td colspan="7"><div class="crm-empty"><p class="crm-empty-title">No invoices found</p><a href="{{ route('crm.invoices.create') }}" class="crm-btn crm-btn-primary" style="margin-top:1rem;">New Invoice</a></div></td></tr>
        @endforelse
        </tbody>
    </table>
    @if($invoices->hasPages())<div style="padding:1rem 1.25rem;border-top:1px solid var(--color-border);">{{ $invoices->links() }}</div>@endif
</div>
</x-crm::layout>

