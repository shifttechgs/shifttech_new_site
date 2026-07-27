@props([
    'href' => null,
    'variant' => 'primary',   {{-- primary | lime | ghost-pine | sm --}}
    'arrow' => false,
    'link' => false,          {{-- render as the underlined text "link-arrow" style --}}
])

@php
    $classes = $link
        ? 'link-arrow'
        : 'btn btn-' . $variant;
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}@if ($arrow)<span aria-hidden="true">&rarr;</span>@endif
    </a>
@else
    <button type="{{ $attributes->get('type', 'button') }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}@if ($arrow)<span aria-hidden="true">&rarr;</span>@endif
    </button>
@endif
