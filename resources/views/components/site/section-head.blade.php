@props([
    'eyebrow' => null,
    'rule' => true,   {{-- show the hairline top rule --}}
])

{{-- Section header device: hairline rule -> mono eyebrow -> display heading.
     The heading markup is passed as the slot so callers control <strong> emphasis. --}}
@if ($rule)
    <hr class="section-rule">
@endif
@if ($eyebrow)
    <x-site.eyebrow>{{ $eyebrow }}</x-site.eyebrow>
@endif
<h2 class="display-l">{{ $slot }}</h2>
