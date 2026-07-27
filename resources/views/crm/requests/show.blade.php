<x-crm::layout title="{{ $clientRequest->title }}">
<div class="crm-page-header">
    <div>
        <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.25rem;">
            <a href="{{ route('crm.requests.index') }}" style="color:var(--color-ink-3);font-size:0.875rem;">Requests</a>
            <span style="color:var(--color-ink-3);">/</span><span style="font-size:0.875rem;">{{ $clientRequest->title }}</span>
        </div>
        <h1 class="crm-page-title">{{ $clientRequest->title }}</h1>
    </div>
    <div style="display:flex;gap:0.5rem;">
        <form method="POST" action="{{ route('crm.requests.convert', $clientRequest) }}">@csrf
            <button type="submit" class="crm-btn crm-btn-secondary">Convert to Quote</button>
        </form>
        <a href="{{ route('crm.requests.edit', $clientRequest) }}" class="crm-btn crm-btn-primary">Edit</a>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 280px;gap:1.25rem;">
    <div style="display:flex;flex-direction:column;gap:1.25rem;">
        @if($clientRequest->description)
        <div class="crm-card"><div class="crm-card-header"><span class="crm-card-title">Description</span></div><div class="crm-card-body"><p style="font-size:0.875rem;color:var(--color-ink-2);line-height:1.6;white-space:pre-wrap;">{{ $clientRequest->description }}</p></div></div>
        @endif
        @if($clientRequest->assessment_notes)
        <div class="crm-card"><div class="crm-card-header"><span class="crm-card-title">Assessment Notes</span><span class="crm-badge crm-badge-warning">Internal</span></div><div class="crm-card-body"><p style="font-size:0.875rem;color:var(--color-ink-2);line-height:1.6;white-space:pre-wrap;">{{ $clientRequest->assessment_notes }}</p></div></div>
        @endif
    </div>
    <div style="display:flex;flex-direction:column;gap:1.25rem;">
        <div class="crm-card">
            <div class="crm-card-header"><span class="crm-card-title">Details</span></div>
            <div class="crm-card-body">
                <div class="crm-detail-row"><span class="crm-detail-label">Client</span><span class="crm-detail-value"><a href="{{ route('crm.clients.show', $clientRequest->client) }}" style="color:var(--color-info-text);">{{ $clientRequest->client->full_name }}</a></span></div>
                <div class="crm-detail-row"><span class="crm-detail-label">Status</span><span class="crm-detail-value"><span class="crm-badge crm-badge-info">{{ $clientRequest->status }}</span></span></div>
                @php $prioMap = ['Low'=>'crm-badge-neutral','Medium'=>'crm-badge-info','High'=>'crm-badge-warning','Urgent'=>'crm-badge-danger']; @endphp
                <div class="crm-detail-row"><span class="crm-detail-label">Priority</span><span class="crm-detail-value">@if($clientRequest->priority)<span class="crm-badge {{ $prioMap[$clientRequest->priority] ?? 'crm-badge-neutral' }}">{{ $clientRequest->priority }}</span>@else—@endif</span></div>
                <div class="crm-detail-row"><span class="crm-detail-label">Received</span><span class="crm-detail-value">{{ $clientRequest->created_at->format('d M Y') }}</span></div>
            </div>
        </div>
        <div class="crm-card" x-data="{ deleteOpen: false }"><div class="crm-card-body">
            <button type="button" @click="deleteOpen = true" class="crm-btn crm-btn-danger" style="width:100%;">Delete Request</button>
        </div>
        <div x-show="deleteOpen" class="crm-modal-overlay" @click.self="deleteOpen = false">
            <div class="crm-modal" @click.stop style="max-width:420px;">
                <div class="crm-modal-header">
                    <h3 class="crm-modal-title">Delete Request</h3>
                    <button type="button" @click="deleteOpen = false" class="crm-icon-btn"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                </div>
                <div class="crm-modal-body">
                    <p style="font-size:0.9375rem;color:var(--color-ink-2);">Are you sure you want to delete this request? This action cannot be undone.</p>
                </div>
                <div class="crm-modal-footer">
                    <button type="button" @click="deleteOpen = false" class="crm-btn crm-btn-secondary">Cancel</button>
                    <form method="POST" action="{{ route('crm.requests.destroy', $clientRequest) }}" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="crm-btn crm-btn-danger">Delete Request</button>
                    </form>
                </div>
            </div>
        </div></div>
    </div>
</div>
</x-crm::layout>

