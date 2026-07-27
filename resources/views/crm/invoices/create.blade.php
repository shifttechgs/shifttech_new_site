<x-crm::layout title="New Invoice">
<div class="crm-page-header">
    <div>
        <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.25rem;">
            <a href="{{ route('crm.invoices.index') }}" style="color:var(--color-ink-3);font-size:0.875rem;">Invoices</a>
            <span style="color:var(--color-ink-3);">/</span><span style="font-size:0.875rem;">New Invoice</span>
        </div>
        <h1 class="crm-page-title">New Invoice</h1>
    </div>
</div>

<form method="POST" action="{{ route('crm.invoices.store') }}">
@csrf
<div style="display:grid;grid-template-columns:1fr 300px;gap:1.25rem;">
    <div style="display:flex;flex-direction:column;gap:1.25rem;">
        <div class="crm-card">
            <div class="crm-card-header"><span class="crm-card-title">Invoice Details</span></div>
            <div class="crm-card-body" style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div style="grid-column:1/-1;">
                    <label class="crm-label">Client <span style="color:var(--color-danger);">*</span></label>
                    <select name="client_id" class="crm-select" required>
                        <option value="">— Select Client —</option>
                        @foreach($clients as $c)
                        <option value="{{ $c->client_id }}" {{ (old('client_id', $selectedClient?->client_id)==$c->client_id)?'selected':'' }}>{{ $c->full_name }}{{ $c->company ? ' — '.$c->company : '' }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="crm-label">Invoice Date <span style="color:var(--color-danger);">*</span></label>
                    <input type="date" name="invoice_date" value="{{ old('invoice_date', now()->format('Y-m-d')) }}" class="crm-input" required>
                </div>
                <div>
                    <label class="crm-label">Due Date <span style="color:var(--color-danger);">*</span></label>
                    <input type="date" name="due_date" value="{{ old('due_date', now()->addDays(30)->format('Y-m-d')) }}" class="crm-input" required>
                </div>
                <div>
                    <label class="crm-label">Payment Method</label>
                    <select name="payment_method" class="crm-select">
                        @foreach(['EFT','Cash','PayPal','Card','Cheque'] as $m)
                        <option value="{{ $m }}" {{ old('payment_method','EFT')==$m?'selected':'' }}>{{ $m }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="crm-label">Discount (R)</label>
                    <input type="number" name="discount" value="{{ old('discount', 0) }}" class="crm-input" min="0" step="0.01">
                </div>
                <div style="grid-column:1/-1;">
                    <label class="crm-label">Client Message</label>
                    <textarea name="client_message" class="crm-textarea" rows="2" placeholder="Thank you for your business…">{{ old('client_message') }}</textarea>
                </div>
                <div style="grid-column:1/-1;">
                    <label class="crm-label">Internal Notes</label>
                    <textarea name="internal_notes" class="crm-textarea" rows="2">{{ old('internal_notes') }}</textarea>
                </div>
            </div>
        </div>
        @include('crm.partials.line-items', ['items' => old('items', [])])
    </div>
    <div style="display:flex;flex-direction:column;gap:1.25rem;">
        <div class="crm-card">
            <div class="crm-card-header"><span class="crm-card-title">Status</span></div>
            <div class="crm-card-body">
                <select name="status" class="crm-select">
                    @foreach(['Draft','Sent','PartiallyPaid','Paid','Overdue','Cancelled'] as $s)
                    <option value="{{ $s }}" {{ old('status','Draft')==$s?'selected':'' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div style="display:flex;flex-direction:column;gap:0.5rem;">
            <button type="submit" class="crm-btn crm-btn-primary crm-btn-lg" style="width:100%;">Create Invoice</button>
            <a href="{{ route('crm.invoices.index') }}" class="crm-btn crm-btn-ghost" style="width:100%;justify-content:center;">Cancel</a>
        </div>
    </div>
</div>
</form>
</x-crm::layout>

