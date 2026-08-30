{{--
    Drop-in "Show: 5 / 10 / 15 / 20" control for any paginated CRM table.
    Usage: @include('crm.partials.per-page-selector', ['paginator' => $invoices])

    Navigates via plain JS rather than a form field so it works inside any
    table's toolbar regardless of what search/filter fields that table
    already has — it only ever touches the per_page and page params and
    leaves everything else in the query string untouched.
--}}
<div style="display:flex;align-items:center;gap:0.5rem;">
    <span style="font-size:0.8125rem;color:var(--color-ink-3);">Show</span>
    <select class="crm-select" style="width:auto;"
            onchange="const u=new URL(window.location); u.searchParams.set('per_page', this.value); u.searchParams.delete('page'); window.location = u.toString();">
        @foreach([5, 10, 15, 20] as $n)
            <option value="{{ $n }}" {{ (int) request('per_page', 10) === $n ? 'selected' : '' }}>{{ $n }}</option>
        @endforeach
    </select>
    <span style="font-size:0.8125rem;color:var(--color-ink-3);">of {{ $paginator->total() }}</span>
</div>
