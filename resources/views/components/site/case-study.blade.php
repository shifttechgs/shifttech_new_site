@props([
    'label' => '',
    'title' => '',
    'image' => '',
    'imageAlt' => '',
    'quote' => null,
    'cite' => null,
    'stack' => null,
    'flip' => false,   {{-- media on the right instead of the left --}}
])

<article {{ $attributes->merge(['class' => 'case' . ($flip ? ' case--flip' : '')]) }}>
    <div class="case-media">
        <img src="{{ $image }}" alt="{{ $imageAlt }}" width="800" height="600" loading="lazy">
    </div>
    <div class="case-body">
        <span class="case-label">{{ $label }}</span>
        <h3>{{ $title }}</h3>
        <p>{{ $slot }}</p>
        @if ($quote)
            <blockquote class="case-quote">
                &ldquo;{{ $quote }}&rdquo;
                @if ($cite)<footer>{{ $cite }}</footer>@endif
            </blockquote>
        @endif
        @if ($stack)
            <p class="case-tech">{{ $stack }}</p>
        @endif
    </div>
</article>
