<x-crm::layout title="Services & Pricing">
<div class="crm-page-header">
    <div>
        <h1 class="crm-page-title">Services & Pricing</h1>
        <p class="crm-page-subtitle">Services shown in quote and invoice dropdowns</p>
    </div>
    <a href="{{ route('crm.services.create') }}" class="crm-btn crm-btn-primary">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Service
    </a>
</div>

@php
    $categories = $services->groupBy('category');
    $unitLabels = ['hour' => '/hr', 'day' => '/day', 'item' => '/item', 'job' => ' fixed', 'month' => '/mo'];
@endphp

<div class="crm-table-wrap">
    <table class="crm-table">
        <thead>
            <tr>
                <th>Service</th>
                <th>Category</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @forelse($services as $svc)
        <tr>
            <td>
                <p style="font-weight:500;">{{ $svc->name }}</p>
                @if($svc->description)
                    <p style="font-size:0.75rem;color:var(--color-ink-3);margin-top:2px;">{{ Str::limit($svc->description, 60) }}</p>
                @endif
            </td>
            <td><span class="crm-badge crm-badge-neutral" style="font-size:0.6875rem;">{{ $svc->category ?? '—' }}</span></td>
            <td style="color:var(--color-ink-2);font-size:0.875rem;">{{ ucfirst($svc->unit_type) }}</td>
            <td style="font-weight:600;font-family:monospace;font-size:0.875rem;">
                R{{ number_format($svc->unit_price, 2) }}{{ $unitLabels[$svc->unit_type] ?? '' }}
            </td>
            <td>
                <span class="crm-badge {{ $svc->is_active ? 'crm-badge-success' : 'crm-badge-neutral' }}">
                    {{ $svc->is_active ? 'Active' : 'Inactive' }}
                </span>
            </td>
            <td style="display:flex;gap:0.375rem;align-items:center;" x-data="{ open: false }">
                <a href="{{ route('crm.services.edit', $svc) }}" class="crm-btn crm-btn-ghost crm-btn-sm">Edit</a>
                <button type="button" @click="open = true" class="crm-btn crm-btn-ghost crm-btn-sm" style="color:var(--color-danger);">Delete</button>
                <div x-show="open" class="crm-modal-overlay" @click.self="open=false">
                    <div class="crm-modal" @click.stop style="max-width:380px;">
                        <div class="crm-modal-header">
                            <h3 class="crm-modal-title">Delete Service</h3>
                            <button type="button" @click="open=false" class="crm-icon-btn"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                        </div>
                        <div class="crm-modal-body">
                            <p style="font-size:0.9375rem;color:var(--color-ink-2);">Are you sure you want to delete <strong>{{ $svc->name }}</strong>? This action cannot be undone.</p>
                        </div>
                        <div class="crm-modal-footer">
                            <button type="button" @click="open=false" class="crm-btn crm-btn-secondary">Cancel</button>
                            <form method="POST" action="{{ route('crm.services.destroy', $svc) }}" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="crm-btn crm-btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">
                <div class="crm-empty">
                    <p class="crm-empty-title">No services yet</p>
                    <a href="{{ route('crm.services.create') }}" class="crm-btn crm-btn-primary" style="margin-top:1rem;">Add Service</a>
                </div>
            </td>
        </tr>
        @endforelse
        </tbody>
    </table>
</div>
</x-crm::layout>
