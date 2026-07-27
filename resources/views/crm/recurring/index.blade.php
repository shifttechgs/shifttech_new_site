<x-crm::layout title="Recurring Invoices">
<div class="crm-page-header">
    <div><h1 class="crm-page-title">Recurring Invoices</h1><p class="crm-page-subtitle">Auto-generate invoices on a schedule</p></div>
    <a href="{{ route('crm.recurring.create') }}" class="crm-btn crm-btn-primary">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        New Recurring
    </a>
</div>

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.5rem;">
    <div class="crm-stat"><span class="crm-stat-label">Active</span><span class="crm-stat-value" style="color:var(--color-success-text);">{{ $stats['active'] }}</span></div>
    <div class="crm-stat"><span class="crm-stat-label">Paused</span><span class="crm-stat-value">{{ $stats['paused'] }}</span></div>
    <div class="crm-stat"><span class="crm-stat-label">Monthly Revenue</span><span class="crm-stat-value" style="font-size:1.2rem;">R {{ number_format($stats['monthly'], 2) }}</span></div>
</div>

<div class="crm-table-wrap">
    <div class="crm-table-toolbar">
        <form method="GET" style="display:contents;">
            <select name="status" class="crm-select" style="width:auto;" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                @foreach(['Active','Paused','Cancelled'] as $s)
                <option value="{{ $s }}" {{ request('status')==$s?'selected':'' }}>{{ $s }}</option>
                @endforeach
            </select>
        </form>
        <span style="margin-left:auto;font-size:0.8125rem;color:var(--color-ink-3);">{{ $recurring->total() }} records</span>
    </div>
    <table class="crm-table">
        <thead><tr><th>Client</th><th>Frequency</th><th>Amount</th><th>Status</th><th>Next Invoice</th><th></th></tr></thead>
        <tbody>
        @forelse($recurring as $r)
        <tr onclick="window.location='{{ route('crm.recurring.show', $r) }}'">
            <td style="font-weight:500;">{{ $r->client->full_name ?? '—' }}</td>
            <td>{{ $r->frequency }}</td>
            <td style="font-weight:600;">R {{ number_format($r->total_amount, 2) }}</td>
            <td>
                @php $rcMap = ['Active'=>'crm-badge-success','Paused'=>'crm-badge-warning','Cancelled'=>'crm-badge-neutral']; @endphp
                <span class="crm-badge {{ $rcMap[$r->status] ?? 'crm-badge-neutral' }}"><span class="crm-badge-dot"></span>{{ $r->status }}</span>
            </td>
            <td style="color:var(--color-ink-3);">{{ $r->next_invoice_date ? \Carbon\Carbon::parse($r->next_invoice_date)->format('d M Y') : '—' }}</td>
            <td>
                <a href="{{ route('crm.recurring.edit', $r) }}" class="crm-btn crm-btn-ghost crm-btn-sm" onclick="event.stopPropagation()">Edit</a>
                <form method="POST" action="{{ route('crm.recurring.destroy', $r) }}" style="display:inline;" onsubmit="return confirm('Delete?');event.stopPropagation()">
                    @csrf @method('DELETE')
                    <button type="submit" class="crm-btn crm-btn-ghost crm-btn-sm" style="color:var(--color-danger-text);" onclick="event.stopPropagation()">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6"><div class="crm-empty"><p class="crm-empty-title">No recurring invoices</p><a href="{{ route('crm.recurring.create') }}" class="crm-btn crm-btn-primary" style="margin-top:1rem;">Create One</a></div></td></tr>
        @endforelse
        </tbody>
    </table>
    @if($recurring->hasPages())<div style="padding:1rem 1.25rem;border-top:1px solid var(--color-border);">{{ $recurring->links() }}</div>@endif
</div>
</x-crm::layout>

