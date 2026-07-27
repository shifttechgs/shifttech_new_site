<x-crm::layout title="Recurring Invoice">
<div class="crm-page-header">
    <div>
        <a href="{{ route('crm.recurring.index') }}" style="color:var(--color-ink-3);font-size:0.875rem;">Recurring</a> / <span style="font-size:0.875rem;">{{ $recurringInvoice->recurring_invoice_id }}</span>
        <div style="display:flex;align-items:center;gap:0.75rem;margin-top:0.25rem;">
            <h1 class="crm-page-title">{{ $recurringInvoice->client->full_name ?? '—' }}</h1>
            @php $rcMap = ['Active'=>'crm-badge-success','Paused'=>'crm-badge-warning','Cancelled'=>'crm-badge-neutral']; @endphp
            <span class="crm-badge {{ $rcMap[$recurringInvoice->status] ?? 'crm-badge-neutral' }}">{{ $recurringInvoice->status }}</span>
        </div>
    </div>
    <div style="display:flex;gap:0.5rem;">
        <a href="{{ route('crm.recurring.edit', $recurringInvoice) }}" class="crm-btn crm-btn-primary">Edit</a>
        <form method="POST" action="{{ route('crm.recurring.destroy', $recurringInvoice) }}" onsubmit="return confirm('Delete this recurring invoice?')">
            @csrf @method('DELETE')
            <button type="submit" class="crm-btn crm-btn-secondary">Delete</button>
        </form>
    </div>
</div>
<div style="display:grid;grid-template-columns:1fr 280px;gap:1.25rem;">
    <div class="crm-card">
        <div class="crm-card-header"><span class="crm-card-title">Line Items</span></div>
        <table class="crm-table">
            <thead><tr><th>Description</th><th>Qty</th><th>Unit Price</th><th>Total</th></tr></thead>
            <tbody>
            @forelse($recurringInvoice->items as $item)
            <tr><td>{{ $item->description }}</td><td>{{ $item->quantity }}</td><td>R {{ number_format($item->unit_price, 2) }}</td><td style="font-weight:600;">R {{ number_format($item->total, 2) }}</td></tr>
            @empty
            <tr><td colspan="4"><div class="crm-empty" style="padding:1rem;"><p class="crm-empty-text">No items</p></div></td></tr>
            @endforelse
            </tbody>
        </table>
        <div class="crm-card-footer">
            <div style="margin-left:auto;min-width:200px;">
                <div class="crm-detail-row" style="font-size:1rem;font-weight:700;">
                    <span class="crm-detail-label" style="font-weight:700;color:var(--color-ink-1);">Total per Invoice</span>
                    <span class="crm-detail-value">R {{ number_format($recurringInvoice->total_amount, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="crm-card">
        <div class="crm-card-header"><span class="crm-card-title">Schedule</span></div>
        <div class="crm-card-body">
            <div class="crm-detail-row"><span class="crm-detail-label">ID</span><span class="crm-detail-value crm-mono">{{ $recurringInvoice->recurring_invoice_id }}</span></div>
            <div class="crm-detail-row"><span class="crm-detail-label">Frequency</span><span class="crm-detail-value">{{ $recurringInvoice->frequency }}</span></div>
            <div class="crm-detail-row"><span class="crm-detail-label">Start Date</span><span class="crm-detail-value">{{ $recurringInvoice->start_date?->format('d M Y') ?? '—' }}</span></div>
            <div class="crm-detail-row"><span class="crm-detail-label">End Date</span><span class="crm-detail-value">{{ $recurringInvoice->end_date?->format('d M Y') ?? 'No end' }}</span></div>
            <div class="crm-detail-row"><span class="crm-detail-label">Next Invoice</span><span class="crm-detail-value" style="color:var(--color-info-text);font-weight:600;">{{ $recurringInvoice->next_invoice_date ? \Carbon\Carbon::parse($recurringInvoice->next_invoice_date)->format('d M Y') : '—' }}</span></div>
        </div>
    </div>
</div>
</x-crm::layout>

