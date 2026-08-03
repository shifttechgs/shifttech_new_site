@extends('layouts.site')

@section('title', 'Mobile App Development in Cape Town | ShiftTech')
@section('meta_description', 'iOS and Android apps for Cape Town and Harare businesses, built with Flutter and backed by real infrastructure, from first screen to App Store and Play Store launch.')
@section('body_class', 'has-dark-hero')

@php
    $contact = url('/contact');

    $capabilityAreas = [
        [
            'label' => 'Product & UX',
            'items' => [
                'Screens designed for thumbs and small screens, not a shrunk-down website',
                'Offline and slow-connection states designed in, not bolted on afterward',
                'Following iOS and Android conventions, so the app feels native on both',
                'A clickable prototype you can react to before a single screen gets built',
            ],
        ],
        [
            'label' => 'Build',
            'items' => [
                'One Flutter codebase covering both iOS and Android, so features ship once, not twice',
                'Native modules where a feature genuinely needs deeper device access',
                'A backend built to handle real traffic, not just the demo',
                'Automated tests covering the flows your users actually rely on',
            ],
        ],
        [
            'label' => 'Integrations',
            'items' => [
                'Push notifications that reach users, not spam filters',
                'Payments, live location, and maps, wired in and tested on real devices',
                'Camera, file storage, and offline sync, when your app actually needs them',
                'Connections to the backend systems your business already runs on',
            ],
        ],
        [
            'label' => 'Launch & Support',
            'items' => [
                'App Store and Google Play submission, including the review requirements that trip people up',
                'Crash and performance monitoring from day one',
                'Updates that ship without forcing a full re-review every time',
                'A support plan after launch, on your terms',
            ],
        ],
    ];

    $process = [
        ['n' => '01', 'title' => 'Discovery', 'body' => "We map what your app actually needs to do, and for which users, before opening a design tool."],
        ['n' => '02', 'title' => 'Design', 'body' => 'A clickable prototype in your brand, built around mobile conventions and real device sizes.'],
        ['n' => '03', 'title' => 'Build', 'body' => 'Sprint-based development, with working builds you can install and test on your own phone as we go.'],
        ['n' => '04', 'title' => 'Test on real devices', 'body' => "Tested across real iOS and Android hardware, not just a simulator, since that's where the odd bugs actually show up."],
        ['n' => '05', 'title' => 'Submit', 'body' => 'App Store and Play Store submission handled end to end, with buffer time built in for review.'],
        ['n' => '06', 'title' => 'Support', 'body' => 'Crash monitoring, updates, and fixes after launch, so the app keeps working as OS versions change.'],
    ];

    $faqs = [
        ['q' => 'Do we need a native app, or is cross-platform enough?', 'a' => "For most business apps, Flutter is the right call, one codebase covering both iOS and Android, which means features ship once instead of twice. We only recommend a fully native build when a specific feature genuinely needs deeper device access than Flutter can give it. We'll tell you honestly which one your app needs."],
        ['q' => 'How long does it take to build and launch an app?', 'a' => "A focused app can take a couple of months. Something with heavier integrations, payments, live location, offline sync, takes longer. We also build in buffer time for App Store and Play Store review, which is outside our control but is part of any realistic timeline."],
        ['q' => 'What does it cost?', 'a' => "It depends on scope. A clearly defined app gets a fixed price. A larger or evolving build runs time-and-materials, so you're not paying for padding on work that isn't scoped yet. We agree on which model applies before any work starts."],
        ['q' => 'Do you handle App Store and Play Store submission?', 'a' => "Yes, end to end. We handle developer accounts, store listings, and the review requirements for both platforms, including the ones that catch first-time submitters off guard."],
        ['q' => 'Who actually builds and maintains the app?', 'a' => "The engineer who builds it, directly. We're founder-led, so there's no account manager layer between you and the person who understands your app. If something needs fixing after launch, you reach the person who can actually fix it."],
    ];
@endphp

@section('content')
<main id="main">
    <div class="rails" aria-hidden="true"></div>

    {{-- ==================== HERO (dark) ==================== --}}
    <section class="hero hero--dark">
        <div class="container">
            <div class="hero-split">
                <div class="hero-copy" style="max-width: 34rem;">
                    <x-site.eyebrow>Mobile Apps</x-site.eyebrow>
                    <h1 class="display-xl hero-headline"><span class="dim">A shrunk-down website isn't an app.</span><br><span class="hl">We build for the hand it's in.</span></h1>
                    <p class="lede">iOS and Android apps built with Flutter, backed by real infrastructure, from first screen to store approval.</p>

                    <div class="hero-ctas">
                        <x-site.btn :href="$contact" variant="lime">Book a Free Discovery Call</x-site.btn>
                        <x-site.btn href="#capabilities" :link="true" :arrow="true">See how we build</x-site.btn>
                    </div>
                </div>

                {{-- A phone with a simple UI (header, list rows, floating
                     action button) syncing to a highlighted backend node.
                     Original SVG, our own palette. --}}
                <div class="hero-tilegrid" aria-hidden="true">
                    <svg viewBox="0 0 480 360" xmlns="http://www.w3.org/2000/svg">
                        {{-- sync connector --}}
                        <g fill="none" stroke="rgba(244,242,234,.18)" stroke-width="2">
                            <path d="M255 175h55"/>
                        </g>
                        <circle cx="255" cy="175" r="3" fill="rgba(244,242,234,.4)"/>
                        <circle cx="310" cy="175" r="4" fill="#74B812">
                            <animate attributeName="opacity" values="1;0.25;1" dur="2s" repeatCount="indefinite"/>
                        </circle>

                        {{-- Phone --}}
                        <rect x="140" y="40" width="130" height="270" rx="20" fill="rgba(244,242,234,.05)" stroke="rgba(244,242,234,.16)" stroke-width="2"/>
                        <rect x="152" y="58" width="106" height="234" rx="6" fill="rgba(11,20,16,.5)"/>

                        {{-- status/header bar --}}
                        <rect x="152" y="58" width="106" height="26" rx="6" fill="rgba(244,242,234,.08)"/>
                        <circle cx="166" cy="71" r="5" fill="rgba(244,242,234,.3)"/>
                        <rect x="180" y="67" width="50" height="8" rx="4" fill="rgba(244,242,234,.25)"/>

                        {{-- list rows --}}
                        <g fill="rgba(244,242,234,.06)">
                            <rect x="160" y="96" width="90" height="36" rx="8"/>
                            <rect x="160" y="140" width="90" height="36" rx="8"/>
                            <rect x="160" y="184" width="90" height="36" rx="8"/>
                        </g>
                        <g fill="rgba(244,242,234,.3)">
                            <circle cx="176" cy="114" r="8"/>
                            <circle cx="176" cy="158" r="8"/>
                            <circle cx="176" cy="202" r="8"/>
                        </g>
                        <g fill="rgba(244,242,234,.22)">
                            <rect x="192" y="109" width="46" height="6" rx="3"/>
                            <rect x="192" y="153" width="46" height="6" rx="3"/>
                            <rect x="192" y="197" width="46" height="6" rx="3"/>
                        </g>

                        {{-- floating action button (highlighted) --}}
                        <g style="filter: drop-shadow(0 0 14px rgba(116,184,18,.5));">
                            <circle cx="228" cy="256" r="18" fill="#74B812"/>
                            <path d="M228 248v16M220 256h16" stroke="#0B1410" stroke-width="2.4" stroke-linecap="round"/>
                        </g>

                        {{-- home indicator --}}
                        <rect x="192" y="298" width="56" height="4" rx="2" fill="rgba(244,242,234,.25)"/>

                        {{-- backend node (highlighted) --}}
                        <g style="filter: drop-shadow(0 0 18px rgba(116,184,18,.5));">
                            <rect x="320" y="145" width="110" height="60" rx="12" fill="#182B10" stroke="#74B812" stroke-width="1.5"/>
                            <rect x="338" y="164" width="55" height="9" rx="4" fill="#74B812"/>
                            <rect x="338" y="180" width="40" height="6" rx="3" fill="rgba(244,242,234,.35)"/>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== WHY IT MATTERS ==================== --}}
    <section class="section">
        <div class="container">
            <hr class="section-rule">
            <x-site.eyebrow>Why it matters</x-site.eyebrow>

            <div class="why-grid">
                <h2 class="display-l">Your users will judge the app <strong>in the first ten seconds.</strong></h2>

                <div class="why-grid__body">
                    <p class="lede">A mobile app lives or dies on how it feels in someone's hand, on a train, with one bar of signal, thumb barely reaching the top of the screen. Get that wrong and it doesn't matter how solid the backend is, people delete it before they find out.</p>
                    <p class="lede" style="margin-top: 1rem;">We design and build for that reality from day one: real devices, real network conditions, real thumbs, not a polished demo on a fast office wifi connection.</p>

                    <blockquote class="founder-pull" style="margin-top: 2rem;">
                        "An app that only works on a good connection, in a demo, in your hand, isn't finished. It's a prototype with a launch date."
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== CAPABILITIES ==================== --}}
    <section class="section section--flush-top" id="capabilities">
        <div class="container">
            <x-site.section-head eyebrow="How we build">Four areas behind every app we ship.</x-site.section-head>

            <p class="lede" style="max-width: 42rem; margin-top: 1.5rem;">Whether it's a simple booking app or something with live tracking and payments, every build covers these four areas.</p>

            <div class="capabilities-grid">
                @foreach ($capabilityAreas as $area)
                    <div class="capability-block">
                        <x-site.eyebrow>{{ $area['label'] }}</x-site.eyebrow>
                        <ul class="capability-list">
                            @foreach ($area['items'] as $item)
                                <li><svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M13.5 4.5 6.5 11.5 3 8" stroke="#74B812" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== PROCESS ==================== --}}
    <section class="section section--flush-top" id="process">
        <div class="container">
            <x-site.section-head eyebrow="What it looks like">Six steps, from idea to the app store.</x-site.section-head>

            <p class="lede" style="max-width: 42rem; margin-top: 1.5rem;">Including the parts most timelines forget, like store review, so launch day doesn't come as a surprise.</p>

            <div class="framework-grid">
                @foreach ($process as $p)
                    <div class="framework-card">
                        <span class="rule-num">{{ $p['n'] }}</span>
                        <h3 class="framework-title">{{ $p['title'] }}</h3>
                        <p>{{ $p['body'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="framework-note">
                <span class="framework-note__label">Beyond the launch</span>
                <p>An app stops being finished the moment iOS or Android ships an update. We keep watching for crashes and breaking changes after launch, not just before it.</p>
            </div>
        </div>
    </section>

    {{-- ==================== PROOF ==================== --}}
    <section class="section">
        <div class="container">
            <x-site.section-head eyebrow="Proof, not promises">A real result, from a real client.</x-site.section-head>

            <div style="max-width: 34rem; margin: 2.5rem auto 0;">
                <x-site.testimonial
                    class="quote-card--spotlight"
                    :logo="asset('assets/images/logo/clients/logo.png')" logo-alt="Ray and Sons Plumbing"
                    name="Ray" role="Director, Ray &amp; Sons Plumbers"
                    highlight="partners, not just service providers"
                    :reveal="false"
                >ShiftTech helped us launch a professional website and is now supporting us with Useluminii to streamline our day-to-day operations. The team really understands our business and works with us as partners, not just service providers. Everything feels more organised and easier to manage.</x-site.testimonial>
            </div>

            <div class="section-cta">
                <p>Want an app your users actually keep?</p>
                <x-site.btn :href="$contact" variant="lime">Book a Free Discovery Call</x-site.btn>
            </div>
        </div>
    </section>

    {{-- ==================== FAQ ==================== --}}
    <section class="section" id="faq">
        <div class="container">
            <div class="faq-panel">

                <div class="faq-head">
                    <span class="faq-watermark" aria-hidden="true">FAQ</span>
                    <x-site.eyebrow>Questions</x-site.eyebrow>
                    <h2 class="display-l">Before you <strong>book.</strong></h2>
                    <p class="faq-sub">If something's still unclear after reading these, just ask, or reach us directly.</p>

                    <div class="faq-contacts">
                        <a class="faq-contact" href="tel:+27814303023">
                            <span class="faq-contact__icon" aria-hidden="true">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </span>
                            <span>+27 81 430 3023</span>
                        </a>
                        <a class="faq-contact" href="mailto:sales@shifttechgs.com">
                            <span class="faq-contact__icon" aria-hidden="true">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 6l-10 7L2 6"/></svg>
                            </span>
                            <span>sales@shifttechgs.com</span>
                        </a>
                    </div>
                </div>

                <div class="faq-list">
                    @foreach ($faqs as $i => $faq)
                        <details class="faq-item" open>
                            <summary class="faq-item__head">
                                <span class="faq-item__num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="faq-item__q">{{ $faq['q'] }}</span>
                                <span class="faq-item__toggle" aria-hidden="true">
                                    <svg width="12" height="8" viewBox="0 0 12 8" fill="none"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                            </summary>
                            <div class="faq-item__body">
                                <div class="faq-item__inner">
                                    <p>{{ $faq['a'] }}</p>
                                </div>
                            </div>
                        </details>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    {{-- ==================== FINAL CTA ==================== --}}
    <section class="section final" id="contact">
        <div class="container">
            <x-site.eyebrow>Next step</x-site.eyebrow>
            <h2><strong>Thirty minutes. No obligation.</strong><br>Just clarity on what your app actually needs.</h2>
            <p class="lede">Tell us what you're trying to build. We'll tell you honestly what it would take, and whether Flutter or native is the right call.</p>

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

@push('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
        { "@type": "ListItem", "position": 2, "name": "Mobile App Development", "item": "{{ url('/services/mobile-app-development') }}" }
    ]
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "Service",
    "serviceType": "Mobile App Development",
    "name": "Mobile App Development",
    "description": "iOS and Android apps built with Flutter, backed by real infrastructure.",
    "provider": { "@type": "Organization", "name": "ShiftTech", "url": "{{ url('/') }}" },
    "areaServed": ["ZA", "ZW"],
    "url": "{{ url('/services/mobile-app-development') }}"
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        @foreach ($faqs as $i => $faq)
        {
            "@type": "Question",
            "name": {!! json_encode($faq['q']) !!},
            "acceptedAnswer": { "@type": "Answer", "text": {!! json_encode($faq['a']) !!} }
        }{{ $loop->last ? '' : ',' }}
        @endforeach
    ]
}
</script>
@endpush
