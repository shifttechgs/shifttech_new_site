<x-crm::layout title="Lead: {{ $lead->name }}">
<div class="crm-page-header">
    <div>
        <a href="{{ route('crm.leads.index') }}" style="color:var(--color-ink-3);font-size:0.875rem;">Leads</a> / <span style="font-size:0.875rem;">{{ $lead->name }}</span>
        <h1 class="crm-page-title">{{ $lead->name }}</h1>
        <span class="crm-badge {{ $lead->status === 'New' ? 'crm-badge-info' : ($lead->status === 'Converted' ? 'crm-badge-success' : 'crm-badge-neutral') }}" style="margin-top:0.375rem;">{{ $lead->status }}</span>
    </div>
    <div style="display:flex;gap:0.5rem;" x-data="{ deleteOpen: false }">
        @if($lead->status !== 'Converted')
        <form method="POST" action="{{ route('crm.leads.convert', $lead) }}">@csrf
            <button type="submit" class="crm-btn crm-btn-primary">Convert to Client</button>
        </form>
        @endif
        <button type="button" @click="deleteOpen = true" class="crm-btn crm-btn-secondary">Delete</button>
        <div x-show="deleteOpen" class="crm-modal-overlay" @click.self="deleteOpen = false">
            <div class="crm-modal" @click.stop style="max-width:420px;">
                <div class="crm-modal-header">
                    <h3 class="crm-modal-title">Delete Lead</h3>
                    <button type="button" @click="deleteOpen = false" class="crm-icon-btn"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                </div>
                <div class="crm-modal-body">
                    <p style="font-size:0.9375rem;color:var(--color-ink-2);">Are you sure you want to delete <strong>{{ $lead->name }}</strong>? This action cannot be undone.</p>
                </div>
                <div class="crm-modal-footer">
                    <button type="button" @click="deleteOpen = false" class="crm-btn crm-btn-secondary">Cancel</button>
                    <form method="POST" action="{{ route('crm.leads.destroy', $lead) }}" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="crm-btn crm-btn-danger">Delete Lead</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 280px;gap:1.25rem;">
    <div class="crm-card">
        <div class="crm-card-header"><span class="crm-card-title">Message</span></div>
        <div class="crm-card-body"><p style="font-size:0.875rem;color:var(--color-ink-2);line-height:1.6;white-space:pre-wrap;">{{ $lead->message }}</p></div>
    </div>
    <div class="crm-card">
        <div class="crm-card-header"><span class="crm-card-title">Contact Details</span></div>
        <div class="crm-card-body">
            <div class="crm-detail-row"><span class="crm-detail-label">Name</span><span class="crm-detail-value">{{ $lead->name }}</span></div>
            <div class="crm-detail-row"><span class="crm-detail-label">Email</span><span class="crm-detail-value">{{ $lead->email }}</span></div>
            <div class="crm-detail-row"><span class="crm-detail-label">Phone</span><span class="crm-detail-value">{{ $lead->phone ?? '—' }}</span></div>
            <div class="crm-detail-row"><span class="crm-detail-label">Service</span><span class="crm-detail-value">{{ $lead->service_interest ?? '—' }}</span></div>
            <div class="crm-detail-row"><span class="crm-detail-label">Source</span><span class="crm-detail-value">Website</span></div>
            <div class="crm-detail-row"><span class="crm-detail-label">Received</span><span class="crm-detail-value">{{ $lead->created_at->format('d M Y H:i') }}</span></div>
        </div>
    </div>
</div>
</x-crm::layout>


