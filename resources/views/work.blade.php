@extends('layouts.site')

@section('title', 'Our Work | ShiftTech')
@section('meta_description', 'Real projects for real businesses — web apps, mobile apps, and custom software still running in production today.')
@section('body_class', 'has-dark-hero is-work')

@php
    $contact = url('/contact');
@endphp

@section('content')
<main id="main">
    <div class="rails" aria-hidden="true"></div>

    {{-- ==================== HERO (dark) ==================== --}}
    <section class="hero hero--dark work-hero">
        <div class="container">
            {{-- Same shape as the service heroes: the headline spans the full
                 width, then the copy and the stat stack sit as two columns
                 beneath it. --}}
            <div class="hero-split">
                <div class="hero-head">
                    <x-site.eyebrow>Our Work</x-site.eyebrow>
                    <h1 class="display-xl hero-headline"><span class="dim">Anyone can show you mockups.</span><br><span class="hl">These are all live in production.</span></h1>
                </div>

                <div class="hero-copy">
                    <p class="lede">Real projects, for real businesses. Not concepts, systems people use every day.</p>

                    <div class="hero-ctas">
                        <x-site.btn :href="$contact" variant="lime">Book a discovery call</x-site.btn>
                        <x-site.btn href="#filterControls" :link="true" :arrow="true">See the work</x-site.btn>
                    </div>
                    <p class="cta-reassure cta-reassure--hero">Free &middot; 30 minutes &middot; reply within 24 hours &middot; no sales pressure</p>
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

    {{-- ==================== FINAL CTA — same pine bookend as the home page,
         the case studies and the service pages. --}}
    <section class="section final section--say-hello" id="contact">
        <div class="say-hello__inner reveal">
            <span class="say-hello__marks" aria-hidden="true"></span>
            <p class="say-hello__eyebrow">Next step</p>
            <h2 class="say-hello__title">Thirty minutes.<br>Then you'll know.</h2>
            <p class="say-hello__sub">Tell us what you're trying to build. We'll tell you honestly what it would take.</p>
            <a class="say-hello__cta" href="{{ $contact }}">Book a discovery call</a>
            <p class="cta-reassure cta-reassure--onpine">Free &middot; 30 minutes &middot; reply within 24 hours &middot; no sales pressure</p>
            <div class="say-hello__contact">
                <a href="mailto:sales@shifttechgs.com">sales@shifttechgs.com</a>
                <a href="tel:+27814303023">+27 81 430 3023</a>
                <span>Cape Town &middot; Harare</span>
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
