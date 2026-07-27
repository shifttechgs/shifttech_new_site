<x-crm::layout title="New Quote">

<div class="crm-page-header">
    <div>
        <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.25rem;">
            <a href="{{ route('crm.quotes.index') }}" style="color:var(--color-ink-3);font-size:0.875rem;">Quotes</a>
            <span style="color:var(--color-ink-3);">/</span>
            <span style="font-size:0.875rem;">New Quote</span>
        </div>
        <h1 class="crm-page-title">New Quote</h1>
    </div>
</div>

<form method="POST" action="{{ route('crm.quotes.store') }}">
@csrf
<div style="display:grid;grid-template-columns:1fr 300px;gap:1.25rem;">

    <div style="display:flex;flex-direction:column;gap:1.25rem;">
        {{-- Details --}}
        <div class="crm-card">
            <div class="crm-card-header"><span class="crm-card-title">Quote Details</span></div>
            <div class="crm-card-body" style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div style="grid-column:1/-1;">
                    <label class="crm-label">Client <span style="color:var(--color-danger);">*</span></label>
                    <select name="client_id" class="crm-select" required>
                        <option value="">— Select Client —</option>
                        @foreach($clients as $c)
                        <option value="{{ $c->client_id }}" {{ (old('client_id', $selectedClient?->client_id) == $c->client_id) ? 'selected' : '' }}>
                            {{ $c->full_name }}{{ $c->company ? ' — ' . $c->company : '' }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div style="grid-column:1/-1;">
                    <label class="crm-label">Quote Title / Scope <span style="color:var(--color-danger);">*</span></label>
                    <input type="text" name="job_title" value="{{ old('job_title') }}" class="crm-input" placeholder="e.g. Website Redesign Project" required>
                </div>
                <div>
                    <label class="crm-label">Quote Date <span style="color:var(--color-danger);">*</span></label>
                    <input type="date" name="quote_date" value="{{ old('quote_date', now()->format('Y-m-d')) }}" class="crm-input" required>
                </div>
                <div>
                    <label class="crm-label">Expiry Date</label>
                    <input type="date" name="expiry_date" value="{{ old('expiry_date', now()->addDays(30)->format('Y-m-d')) }}" class="crm-input">
                </div>
                <div>
                    <label class="crm-label">Required Deposit (R)</label>
                    <input type="number" name="required_deposit" value="{{ old('required_deposit', 0) }}" class="crm-input" min="0" step="0.01">
                </div>
                <div>
                    <label class="crm-label">Discount (R)</label>
                    <input type="number" name="discount" value="{{ old('discount', 0) }}" class="crm-input" min="0" step="0.01">
                </div>
                <div style="grid-column:1/-1;">
                    <label class="crm-label">Client Message <span class="crm-label-hint">(visible on quote)</span></label>
                    <textarea name="client_notes" class="crm-textarea" rows="3" placeholder="Thank you for your enquiry…">{{ old('client_notes') }}</textarea>
                </div>
                <div style="grid-column:1/-1;">
                    <label class="crm-label">Internal Notes <span class="crm-label-hint">(private)</span></label>
                    <textarea name="internal_notes" class="crm-textarea" rows="2">{{ old('internal_notes') }}</textarea>
                </div>
            </div>
        </div>

        {{-- Line Items --}}
        @include('crm.partials.line-items', ['items' => old('items', [])])
    </div>

    {{-- Sidebar --}}
    <div style="display:flex;flex-direction:column;gap:1.25rem;">
        <div class="crm-card">
            <div class="crm-card-header"><span class="crm-card-title">Status</span></div>
            <div class="crm-card-body">
                <select name="status" class="crm-select">
                    @foreach(['Draft','Sent','Accepted','Declined','Expired'] as $s)
                    <option value="{{ $s }}" {{ old('status','Draft')==$s?'selected':'' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div style="display:flex;flex-direction:column;gap:0.5rem;">
            <button type="submit" class="crm-btn crm-btn-primary crm-btn-lg" style="width:100%;">Create Quote</button>
            <a href="{{ route('crm.quotes.index') }}" class="crm-btn crm-btn-ghost" style="width:100%;justify-content:center;">Cancel</a>
        </div>
    </div>

</div>
</form>

</x-crm::layout>

