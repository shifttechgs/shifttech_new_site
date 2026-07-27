@props([
    'href' => '#',
    'title' => '',
    'action' => null,   {{-- mono arrow label, e.g. "Custom software" --}}
    'ask' => false,     {{-- highlight variant for the "not sure?" card --}}
])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'service-card reveal' . ($ask ? ' service-card--ask' : '')]) }}>
    <h3>{{ $title }}</h3>
    <p>{{ $slot }}</p>
    @if ($action)
        <span class="service-arrow">{{ $action }} &rarr;</span>
    @endif
</a>
