@props([
    'logo' => null,
    'logoAlt' => '',
    'name' => '',
    'role' => '',
    'highlight' => null,
    'reveal' => true,
])

@php
    // Quote text is escaped first, then the trusted highlight phrase is wrapped —
    // this lets us inject <mark> safely without marking the whole slot as raw HTML.
    $quote = e($slot);
    if ($highlight) {
        $quote = str_ireplace(e($highlight), '<mark>' . e($highlight) . '</mark>', $quote);
    }
    $initial = $name !== '' ? mb_strtoupper(mb_substr($name, 0, 1)) : '';
@endphp

<figure {{ $attributes->merge(['class' => 'quote-card' . ($reveal ? ' reveal' : '')]) }}>
    <span class="quote-mark" aria-hidden="true">&ldquo;</span>
    @if ($logo)
        <img src="{{ $logo }}" alt="{{ $logoAlt }}" loading="lazy">
    @endif
    <blockquote>{!! $quote !!}</blockquote>
    <figcaption>
        <span class="quote-avatar" aria-hidden="true">{{ $initial }}</span>
        <span class="quote-who"><b>{{ $name }}</b>{{ $role }}</span>
    </figcaption>
</figure>
