@extends('layouts.site')

@section('title', 'Our Work | ShiftTech')
@section('meta_description', 'Real projects for real businesses — web apps, mobile apps, and custom software still running in production today.')
@section('body_class', 'has-dark-hero')

@php
    $contact = url('/contact');
@endphp

@section('content')
<main id="main">
    <div class="rails" aria-hidden="true"></div>

    {{-- ==================== HERO (dark) ==================== --}}
    <section class="hero hero--dark work-hero">
        <div class="container">
            <div style="max-width: 40rem;">
                <x-site.eyebrow>Our Work</x-site.eyebrow>
                <h1 class="display-xl hero-headline"><span class="dim">Anyone can show you mockups.</span><br><span class="hl">These are all live in production.</span></h1>
                <p class="lede">Real projects, for real businesses. Not concepts, systems people use every day.</p>

                <div class="hero-ctas">
                    <x-site.btn :href="$contact" variant="lime">Book a Free Discovery Call</x-site.btn>
                    <x-site.btn href="#filterControls" :link="true" :arrow="true">See the work</x-site.btn>
                </div>

                <div class="work-hero-stats">
                    <div class="work-stat"><strong>10+</strong><span>Systems shipped &amp; still running</span></div>
                    <div class="work-stat"><strong>90%+</strong><span>Repeat partnerships</span></div>
                    <div class="work-stat"><strong>100%</strong><span>Founder-led, start to finish</span></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== FILTER CONTROLS ==================== --}}
    <section class="filter-controls" id="filterControls">
        <div class="container">
            <div class="filter-controls__wrapper">
                <div class="filter-controls__label">Filter by</div>
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">All Projects</button>
                    <button class="filter-btn" data-filter="web-app">Web Apps</button>
                    <button class="filter-btn" data-filter="mobile-app">Mobile Apps</button>
                    <button class="filter-btn" data-filter="website">Websites</button>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== PORTFOLIO GRID ==================== --}}
    <section class="section">
        <div class="container">
            <div class="portfolio-grid-wrap" id="portfolioGrid">
                @foreach ($projects as $project)
                    <div class="portfolio-item" data-category="{{ $project['service_type'] }}">
                        <article class="project-card">
                            <div class="project-card__image project-card__image--{{ $project['image_fit'] ?? 'contain' }}">
                                @if ($project['has_webp'] ?? false)
                                    @php $base = pathinfo($project['featured_image'], PATHINFO_FILENAME); @endphp
                                    <picture>
                                        <source srcset="{{ asset('assets/images/thumbs/work/' . $base . '.webp') }}" type="image/webp">
                                        <img src="{{ asset('assets/images/thumbs/work/' . $base . '.jpg') }}" alt="{{ $project['title'] }}" loading="lazy">
                                    </picture>
                                @else
                                    <img src="{{ asset('assets/images/thumbs/work/' . $project['featured_image']) }}" alt="{{ $project['title'] }}" loading="lazy">
                                @endif
                            </div>
                            <div class="project-card__content">
                                <div class="project-card__tags">
                                    <span class="tag tag--service">{{ $project['service_label'] }}</span>
                                    <span class="tag tag--industry">{{ $project['industry'] }}</span>
                                </div>
                                <h3 class="project-card__title">
                                    <a href="{{ route('work.show', $project['slug']) }}">{{ $project['title'] }}</a>
                                </h3>
                                <p class="project-card__client">{{ $project['client_name'] }}</p>
                                <p class="project-card__value">{{ $project['summary'] }}</p>
                                <div class="project-card__tech">
                                    @foreach ($project['technologies'] as $tech)
                                        <span class="tech-badge">{{ $tech }}</span>
                                    @endforeach
                                </div>
                                <div class="project-card__cta">
                                    <x-site.btn :href="route('work.show', $project['slug'])" :link="true" :arrow="true">Read the case study</x-site.btn>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
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
                <span>Cape Town · Harare</span>
            </div>
        </div>
    </section>

</main>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/work-portfolio.js') }}" defer></script>
@endpush

@push('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
        { "@type": "ListItem", "position": 2, "name": "Work", "item": "{{ url('/work') }}" }
    ]
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "ItemList",
    "name": "ShiftTech case studies",
    "itemListElement": [
        @foreach ($projects as $project)
        {
            "@type": "ListItem",
            "position": {{ $loop->iteration }},
            "url": {!! json_encode(route('work.show', $project['slug'])) !!},
            "name": {!! json_encode($project['title']) !!}
        }@if (! $loop->last),@endif
        @endforeach
    ]
}
</script>
@endpush
