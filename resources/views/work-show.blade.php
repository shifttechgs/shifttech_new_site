@extends('layouts.site')

@section('title', $project['title'] . ' Case Study | ShiftTech')
@section('meta_description', $project['meta_description'] ?? $project['summary'])
@section('body_class', 'has-dark-hero')

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

    // Long-form narrative fields. A study that fills these renders the full
    // challenge / solution / value structure; one that doesn't falls back to
    // the single-paragraph challenge and approach it already carries, so every
    // study keeps working on this layout without being rewritten first.
    $challengeBody  = $project['challenge_body']  ?? array_filter([$project['challenge'] ?? null]);
    $solutionPoints = $project['solution_points'] ?? [];
    $valuePoints    = $project['value_points']    ?? [];
    $hasLongForm    = $solutionPoints || $valuePoints;

    // Opt-in only. Most covers are UI screenshots, which stay legible behind a
    // headline and read as a second page competing with the first; those get the
    // flat pine hero and show the artefact in the rail instead. Set hero_image
    // on a study that has actual photography (bsl-yard, say).
    $heroBase = $project['hero_image'] ?? null;

    // The approach block is the same three phases as the home page — the work
    // the reader just finished reading about, described as a repeatable process.
    $approach = [
        ['n' => '01', 'title' => 'Understand the problem', 'body' => "We start with your business, not your tech stack: what's breaking, what's slowing you down, and what a good outcome looks like."],
        ['n' => '02', 'title' => 'Build the solution',     'body' => 'You react to real screens before anything is coded, then we build in short cycles with working software every week.'],
        ['n' => '03', 'title' => 'Launch and support',     'body' => 'A calm go-live, your team trained, and 30 days of post-launch support included.'],
    ];

    $approachFigures = [
        '<svg viewBox="0 0 120 120" fill="none" stroke="currentColor" stroke-width="1"><line x1="40" y1="18" x2="40" y2="102"/><line x1="40" y1="60" x2="106" y2="30"/><line x1="40" y1="60" x2="108" y2="46"/><line x1="40" y1="60" x2="108" y2="60"/><line x1="40" y1="60" x2="108" y2="74"/><line x1="40" y1="60" x2="106" y2="90"/><line x1="40" y1="60" x2="88" y2="18"/><line x1="40" y1="60" x2="88" y2="102"/><line x1="22" y1="102" x2="98" y2="102"/><circle cx="40" cy="60" r="3"/></svg>',
        '<svg viewBox="0 0 120 120" fill="none" stroke="currentColor" stroke-width="1"><rect x="22" y="22" width="76" height="76"/><line x1="60" y1="22" x2="60" y2="98"/><line x1="22" y1="60" x2="98" y2="60"/><rect x="64" y="26" width="32" height="32"/></svg>',
        '<svg viewBox="0 0 120 120" fill="none" stroke="currentColor" stroke-width="1"><line x1="20" y1="96" x2="100" y2="96"/><path d="M28 92 L92 28"/><path d="M74 28 L92 28 L92 46"/><circle cx="46" cy="74" r="2.5"/><circle cx="64" cy="56" r="2.5"/></svg>',
    ];
@endphp

@section('content')
<main id="main">
    <div class="rails" aria-hidden="true"></div>

    {{-- ==================== HERO — full-bleed image under a pine wash, with the
         eyebrow and an oversized uppercase headline anchored bottom-left. ==== --}}
    <section class="cs-hero{{ $heroBase ? '' : ' cs-hero--flat' }}">
        @if ($heroBase)
            <div class="cs-hero__media" aria-hidden="true">
                <picture>
                    <source srcset="{{ asset('assets/images/thumbs/work/' . $heroBase . '.webp') }}" type="image/webp">
                    <img src="{{ asset('assets/images/thumbs/work/' . $heroBase . '.jpg') }}" alt="" loading="eager" fetchpriority="high">
                </picture>
            </div>
        @endif
        <div class="container cs-hero__inner">
            <span class="cs-hero__eyebrow">Case<br>study</span>
            <h1 class="cs-hero__title">{{ $project['title'] }}</h1>
        </div>
    </section>

    {{-- ==================== BODY — asymmetric two-column grid. Left rail holds
         the artefact, the client fact table and the client descriptor; the right
         column carries the narrative. ===================================== --}}
    <section class="section section--cs-body">
        <div class="container cs-grid">

            {{-- ---------- Left rail ---------- --}}
            <aside class="cs-rail reveal">
                <div class="cs-rail__media">
                    @if ($project['has_webp'] ?? false)
                        <picture>
                            <source srcset="{{ asset('assets/images/thumbs/work/' . $imgBase . '.webp') }}" type="image/webp">
                            <img src="{{ asset('assets/images/thumbs/work/' . $imgBase . '.jpg') }}" alt="{{ $project['hero_image_alt'] ?? $project['title'] }}" loading="lazy">
                        </picture>
                    @else
                        <img src="{{ asset('assets/images/thumbs/work/' . $project['featured_image']) }}" alt="{{ $project['hero_image_alt'] ?? $project['title'] }}" loading="lazy">
                    @endif
                </div>

                <dl class="cs-facts">
                    <div class="cs-facts__row">
                        <dt>Client</dt>
                        <dd>{{ $project['client_name'] }}</dd>
                    </div>
                    <div class="cs-facts__row">
                        <dt>Industry</dt>
                        <dd><span class="cs-chip">{{ $project['industry'] }}</span></dd>
                    </div>
                    <div class="cs-facts__row">
                        <dt>Service</dt>
                        <dd><span class="cs-chip cs-chip--ghost">{{ $project['service_label'] }}</span></dd>
                    </div>
                </dl>

                @if (! empty($project['client_descriptor']))
                    <p class="cs-descriptor">{{ $project['client_descriptor'] }}</p>
                @endif

                <a class="cs-back" href="{{ url('/work') }}"><span aria-hidden="true">+</span>Back</a>
            </aside>

            {{-- ---------- Narrative ---------- --}}
            <div class="cs-narrative reveal">
                <p class="cs-lede">{{ $project['summary'] }}</p>

                @if ($challengeBody)
                    <h2 class="cs-h2"><b>The challenge:</b> {{ $project['challenge_title'] ?? 'What was in the way' }}</h2>
                    @foreach ($challengeBody as $para)
                        <p>{{ $para }}</p>
                    @endforeach
                @endif

                @if ($solutionPoints)
                    <h2 class="cs-h2"><b>The solution:</b> {{ $project['solution_title'] ?? 'What we built' }}</h2>
                    <ul class="cs-points">
                        @foreach ($solutionPoints as $point)
                            <li><b>{{ $point['title'] }}:</b> {{ $point['body'] }}</li>
                        @endforeach
                    </ul>
                @elseif (! empty($project['approach']))
                    <h2 class="cs-h2"><b>The solution:</b> What we built</h2>
                    <p>{{ $project['approach'] }}</p>
                @endif

                @if ($service)
                    <p class="cs-servicelink">More on how we approach <a href="{{ route($service['route']) }}">{{ $service['anchor'] }}</a>.</p>
                @endif

                @if ($valuePoints || $results)
                    <h2 class="cs-h2"><b>Business value &amp; impact:</b> {{ $project['value_title'] ?? 'What changed' }}</h2>
                    @if (! empty($project['value_intro']))
                        <p>{{ $project['value_intro'] }}</p>
                    @endif
                    <ul class="cs-points">
                        @foreach ($valuePoints as $point)
                            <li><b>{{ $point['title'] }}:</b> {{ $point['body'] }}</li>
                        @endforeach
                        @foreach ($results as $result)
                            <li>{{ $result }}</li>
                        @endforeach
                    </ul>
                @endif

                @if ($quote)
                    <figure class="cs-quote">
                        <blockquote>{{ $quote['quote'] }}</blockquote>
                        <figcaption>
                            <span class="cs-quote__who">{{ $quote['author'] }}</span>
                            @if (! empty($quote['role']))
                                <span class="cs-quote__role">{{ $quote['role'] }}</span>
                            @endif
                        </figcaption>
                    </figure>
                @endif

                <h2 class="cs-h2"><b>Built with</b></h2>
                <div class="cs-tech">
                    @foreach ($project['technologies'] as $tech)
                        <span class="cs-chip cs-chip--ghost">{{ $tech }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== OUR APPROACH — the same bordered three-phase grid
         the home page uses, so the process reads as repeatable rather than
         specific to this one project. ==================================== --}}
    <section class="section section--approach">
        <div class="container">
            <div class="approach-head reveal">
                <span class="approach-head__eyebrow">Our approach</span>
                <h2 class="approach-head__title">Think outside the box</h2>
            </div>

            <div class="approach-grid reveal">
                @foreach ($approach as $i => $a)
                    <article class="approach-card">
                        <div class="approach-card__head">
                            <h3 class="approach-card__title">{{ $a['title'] }}</h3>
                            <span class="approach-card__num">{{ $a['n'] }}</span>
                        </div>
                        <p class="approach-card__body">{{ $a['body'] }}</p>
                        <div class="approach-card__figure" aria-hidden="true">{!! $approachFigures[$i] !!}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== FINAL CTA — same pine bookend as the home page. --}}
    <section class="section final section--say-hello" id="contact">
        <div class="say-hello__inner reveal">
            <span class="say-hello__marks" aria-hidden="true"></span>
            <p class="say-hello__eyebrow">Next step</p>
            <h2 class="say-hello__title">Thirty minutes.<br>Then you'll know.</h2>
            <p class="say-hello__sub">Tell us what's slowing your business down. We'll tell you honestly whether software can fix it and what it would take.</p>
            <a class="say-hello__cta" href="{{ $contact }}">Book a discovery call</a>
            <p class="cta-reassure cta-reassure--onpine">Free &middot; 30 minutes &middot; reply within 24 hours &middot; no sales pressure</p>
            <div class="say-hello__contact">
                <a href="mailto:sales@shifttechgs.com">sales@shifttechgs.com</a>
                <a href="tel:+27814303023">+27 81 430 3023</a>
                <span>Cape Town &middot; Harare</span>
            </div>
        </div>
    </section>

    @if ($related)
    {{-- ==================== OTHER CASE STUDIES — photo-led cards with an
         overlapping tinted panel, the same device as the home page showcase.
         Placed after the CTA so it doesn't pull clicks out of the funnel. == --}}
    <section class="section section--cs-more">
        <div class="container">
            <div class="cs-more__head reveal">
                <div class="cs-more__text">
                    <span class="cs-more__eyebrow">Case studies</span>
                    <h2 class="cs-more__title">Other case studies.</h2>
                </div>
                <a class="cs-more__cta" href="{{ url('/work') }}">All studies</a>
            </div>

            <div class="cs-more__grid reveal">
                @foreach ($related as $other)
                    @php $otherBase = pathinfo($other['featured_image'], PATHINFO_FILENAME); @endphp
                    <a href="{{ route('work.show', $other['slug']) }}" class="cs-more__card">
                        <span class="cs-more__media" aria-hidden="true">
                            @if ($other['has_webp'] ?? false)
                                <picture>
                                    <source srcset="{{ asset('assets/images/thumbs/work/' . $otherBase . '.webp') }}" type="image/webp">
                                    <img src="{{ asset('assets/images/thumbs/work/' . $otherBase . '.jpg') }}" alt="" loading="lazy">
                                </picture>
                            @else
                                <img src="{{ asset('assets/images/thumbs/work/' . $other['featured_image']) }}" alt="" loading="lazy">
                            @endif
                        </span>
                        <span class="cs-more__panel">
                            <span class="cs-more__chips">
                                <span class="cs-chip">{{ $other['industry'] }}</span>
                                <span class="cs-chip cs-chip--ghost">{{ $other['service_label'] }}</span>
                            </span>
                            <span class="cs-more__name">{{ $other['title'] }}</span>
                            <span class="cs-more__more"><span aria-hidden="true">+</span>Read more</span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

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
