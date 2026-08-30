<x-crm::layout title="Website Leads">
<div class="crm-page-header">
    <div><h1 class="crm-page-title">Website Leads</h1><p class="crm-page-subtitle">Contact form submissions from your website</p></div>
</div>
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.5rem;">
    <div class="crm-stat"><span class="crm-stat-label">Total</span><span class="crm-stat-value">{{ $stats['total'] }}</span></div>
    <div class="crm-stat"><span class="crm-stat-label">New</span><span class="crm-stat-value" style="color:var(--color-info-text);">{{ $stats['new'] }}</span></div>
    <div class="crm-stat"><span class="crm-stat-label">Reviewed</span><span class="crm-stat-value">{{ $stats['reviewed'] }}</span></div>
    <div class="crm-stat"><span class="crm-stat-label">Converted</span><span class="crm-stat-value" style="color:var(--color-success-text);">{{ $stats['converted'] }}</span></div>
</div>
<div class="crm-table-wrap">
    <div class="crm-table-toolbar">
        <form method="GET" style="display:contents;">
            <div class="crm-search">
                <svg class="crm-search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search leads…">
            </div>
            <select name="status" class="crm-select" style="width:auto;" onchange="this.form.submit()">
                <option value="">All</option>
                @foreach(['New','Reviewed','Converted','Closed'] as $s)
                <option value="{{ $s }}" {{ request('status')==$s?'selected':'' }}>{{ $s }}</option>
                @endforeach
            </select>
            <button type="submit" class="crm-btn crm-btn-secondary crm-btn-sm">Search</button>
        </form>
        <div style="margin-left:auto;">@include('crm.partials.per-page-selector', ['paginator' => $leads])</div>
    </div>
    <table class="crm-table">
        <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Service</th><th>Status</th><th>Date</th><th></th></tr></thead>
        <tbody>
        @forelse($leads as $lead)
        <tr onclick="window.location='{{ route('crm.leads.show', $lead) }}'">
            <td style="font-weight:500;">{{ $lead->name }}</td>
            <td style="color:var(--color-ink-2);">{{ $lead->email }}</td>
            <td style="color:var(--color-ink-2);">{{ $lead->phone ?? '—' }}</td>
            <td>{{ $lead->service_interest ?? '—' }}</td>
            <td><span class="crm-badge {{ $lead->status === 'New' ? 'crm-badge-info' : ($lead->status === 'Converted' ? 'crm-badge-success' : 'crm-badge-neutral') }}">{{ $lead->status }}</span></td>
            <td style="color:var(--color-ink-3);">{{ $lead->created_at->format('d M Y') }}</td>
            <td>
                @if($lead->status !== 'Converted')
                <form method="POST" action="{{ route('crm.leads.convert', $lead) }}" style="display:inline;" onsubmit="event.stopPropagation()">@csrf
                    <button type="submit" class="crm-btn crm-btn-ghost crm-btn-sm" onclick="event.stopPropagation()">→ Client</button>
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr><td colspan="7"><div class="crm-empty"><p class="crm-empty-title">No leads yet</p><p class="crm-empty-text">Leads appear here when someone fills in the contact form</p></div></td></tr>
        @endforelse
        </tbody>
    </table>
    @if($leads->hasPages())<div style="padding:1rem 1.25rem;border-top:1px solid var(--color-border);">{{ $leads->links() }}</div>@endif
</div>
</x-crm::layout>


