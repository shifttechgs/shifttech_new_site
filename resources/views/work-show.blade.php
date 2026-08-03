@extends('layouts.site')

@section('title', $project['title'] . ' Case Study | ShiftTech')
@section('meta_description', $project['meta_description'] ?? $project['summary'])

@php
    $contact  = url('/contact');
    $results  = array_filter($project['results'] ?? []);
    $quote    = $project['testimonial'] ?? null;
    $imgBase  = pathinfo($project['featured_image'], PATHINFO_FILENAME);

    // Case studies carried no in-body links to the service pages, so the
    // strongest pages on the site pushed nothing into the pages that convert.
    // Keyed off the service_type each case study already declares rather than
    // a hand-maintained second list that could drift out of sync.
    $serviceLinks = [
        'custom-software' => ['route' => 'services.custom-software-development', 'anchor' => 'custom software development'],
        'mobile-app'      => ['route' => 'services.mobile-app-development',      'anchor' => 'mobile app development'],
        'web-app'         => ['route' => 'services.web-application-development', 'anchor' => 'web application development'],
        'website'         => ['route' => 'services.web-design',                  'anchor' => 'web and product design'],
    ];

    $service = $serviceLinks[$project['service_type']] ?? null;
@endphp

@section('content')
<main id="main">
    <div class="rails" aria-hidden="true"></div>

    <section class="section" style="padding-top: calc(72px + clamp(2.5rem, 5vw, 4rem));">
        <div class="container">
            <div style="max-width: 42rem; margin-inline: auto; margin-bottom: 2.5rem;">
                <x-site.btn href="{{ url('/work') }}" :link="true">&larr; All Work</x-site.btn>
            </div>

            <div class="post-header">
                <x-site.eyebrow>{{ $project['service_label'] }}</x-site.eyebrow>
                <h1 class="display-l" style="margin-inline: auto; max-width: 100%;">{{ $project['title'] }}</h1>
                <div class="post-header__meta">
                    <span>{{ $project['client_name'] }}</span>
                    <span class="dot" aria-hidden="true"></span>
                    <span>{{ $project['industry'] }}</span>
                </div>
            </div>

            <div class="post-cover">
                @if ($project['has_webp'] ?? false)
                    <picture>
                        <source srcset="{{ asset('assets/images/thumbs/work/' . $imgBase . '.webp') }}" type="image/webp">
                        <img src="{{ asset('assets/images/thumbs/work/' . $imgBase . '.jpg') }}" alt="{{ $project['title'] }}" loading="eager">
                    </picture>
                @else
                    <img src="{{ asset('assets/images/thumbs/work/' . $project['featured_image']) }}" alt="{{ $project['title'] }}" loading="eager">
                @endif
            </div>

            <div class="post-body">
                {{-- Answer-first: the whole project in one paragraph, before any
                     detail. This is the block extraction engines lift. --}}
                <p class="lede">{{ $project['summary'] }}</p>

                @if (! empty($project['challenge']))
                    <h2>What was the problem?</h2>
                    <p>{{ $project['challenge'] }}</p>
                @endif

                @if (! empty($project['approach']))
                    <h2>What we built</h2>
                    <p>{{ $project['approach'] }}</p>

                    @if ($service)
                        {{-- Industry and service label are already in the meta row
                             under the H1. Repeating them here produced "a Education
                             web application build", so this keeps only the link. --}}
                        <p>More on how we approach <a href="{{ route($service['route']) }}">{{ $service['anchor'] }}</a>.</p>
                    @endif
                @endif

                @if ($results)
                    <h2>Results</h2>
                    <ul class="case-results">
                        @foreach ($results as $result)
                            <li>{{ $result }}</li>
                        @endforeach
                    </ul>
                @endif

                @if ($quote)
                    <blockquote class="case-testimonial">
                        <p>{{ $quote['quote'] }}</p>
                        <cite>{{ $quote['author'] }}@if (! empty($quote['role'])), {{ $quote['role'] }}@endif</cite>
                    </blockquote>
                @endif

                <h2>What we built it with</h2>
                <div class="project-card__tech">
                    @foreach ($project['technologies'] as $tech)
                        <span class="tech-badge">{{ $tech }}</span>
                    @endforeach
                </div>
            </div>

            @if ($related)
                <div class="post-footer">
                    <p class="post-footer__related">More work:</p>
                    <ul class="case-related">
                        @foreach ($related as $other)
                            <li>
                                <a href="{{ route('work.show', $other['slug']) }}">{{ $other['title'] }}</a>
                                <span>{{ $other['service_label'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </section>

    {{-- ==================== FINAL CTA ==================== --}}
    <section class="section final" id="contact">
        <div class="container">
            <x-site.eyebrow>Next step</x-site.eyebrow>
            <h2><strong>Thirty minutes. No obligation.</strong><br>Just clarity on what we'd build for you.</h2>
            <p class="lede">Tell us what you're trying to build. We'll tell you honestly what it would take.</p>

            <ul class="final-trust">
                <li><svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M13.5 4.5 6.5 11.5 3 8" stroke="#74B812" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>Free 30-minute call</li>
                <li><svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M13.5 4.5 6.5 11.5 3 8" stroke="#74B812" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>Response within 24 hours</li>
                <li><svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M13.5 4.5 6.5 11.5 3 8" stroke="#74B812" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>No sales pressure</li>
            </ul>

            <div class="final-actions">
                <x-site.btn :href="$contact" variant="lime">Book a Free Discovery Call</x-site.btn>
            </div>

            <div class="final-contact">
                <a href="mailto:sales@shifttechgs.com">sales@shifttechgs.com</a>
                <a href="tel:+27814303023">+27 81 430 3023</a>
                <span>Cape Town &middot; Harare</span>
            </div>
        </div>
    </section>

</main>
@endsection

@push('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
        { "@type": "ListItem", "position": 2, "name": "Work", "item": "{{ url('/work') }}" },
        { "@type": "ListItem", "position": 3, "name": {!! json_encode($project['title']) !!}, "item": {!! json_encode(url()->current()) !!} }
    ]
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "Article",
    "headline": {!! json_encode($project['title'] . ' — ' . $project['service_label'] . ' case study') !!},
    "description": {!! json_encode($project['meta_description'] ?? $project['summary']) !!},
    "image": {!! json_encode(asset('assets/images/thumbs/work/' . $project['featured_image'])) !!},
    "mainEntityOfPage": { "@type": "WebPage", "@id": {!! json_encode(url()->current()) !!} },
    "about": {
        "@type": "Organization",
        "name": {!! json_encode($project['client_name']) !!}
    },
    "keywords": {!! json_encode(implode(', ', $project['technologies'])) !!},
    "author": {
        "@type": "Person",
        "@id": {!! json_encode(url('/agency') . '#founder') !!},
        "name": "Prosper",
        "url": {!! json_encode(url('/agency') . '#founder') !!}
    },
    "publisher": {
        "@type": "Organization",
        "name": "ShiftTech",
        "logo": { "@type": "ImageObject", "url": {!! json_encode(asset('assets/images/logo/shifttech.png')) !!} }
    }
}
</script>
@endpush
