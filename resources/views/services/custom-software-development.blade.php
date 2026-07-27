@extends('layouts.site')

@section('title', 'Custom Software Development in Cape Town | ShiftTech')
@section('meta_description', 'Bespoke internal tools and business systems for Cape Town and Harare businesses, built around how your business actually works, not the other way around. Founder-led, full code ownership, no lock-in.')
@section('body_class', 'has-dark-hero')

@php
    $contact = url('/contact');

    $capabilityAreas = [
        [
            'label' => 'Discovery',
            'items' => [
                'Sitting with the people who do the work, not just the person who signs off',
                'Mapping your actual process before a single screen gets designed',
                "Finding out which spreadsheets and manual steps are quietly running your business",
                'A clear scope you can sign off on, before any code gets written',
            ],
        ],
        [
            'label' => 'Build',
            'items' => [
                'Admin dashboards and internal tools shaped around your workflow, not a generic template',
                'Automation for the repetitive steps your team currently does by hand',
                'Role-based access, so the right people see the right things',
                'Working software delivered every sprint, so you see progress the whole way through',
            ],
        ],
        [
            'label' => 'Integration',
            'items' => [
                'Connecting to the accounting, payment, and comms tools you already use',
                "No forcing a switch away from software that's already working for you",
                'Data pulled from old spreadsheets and systems, cleaned up in the move',
                'APIs built so future tools can plug in without a rebuild',
            ],
        ],
        [
            'label' => 'Ownership',
            'items' => [
                'Full ownership of the source code and the data, from day one',
                'No licence fees, no seat limits, no vendor holding your data hostage',
                'Documentation handed over so your team can maintain it without us if needed',
                'A support plan after launch, on your terms, not a forced retainer',
            ],
        ],
    ];

    $process = [
        ['n' => '01', 'title' => 'Discovery workshop', 'body' => "We sit with your team and watch how work actually gets done today, spreadsheets, workarounds and all."],
        ['n' => '02', 'title' => 'Process map', 'body' => 'We turn what we learned into a clear map of the system, so you can see exactly what we\'re building before we build it.'],
        ['n' => '03', 'title' => 'Build in sprints', 'body' => 'Working software delivered every two weeks, reviewed and adjusted as we go instead of guessed at upfront.'],
        ['n' => '04', 'title' => 'Pilot', 'body' => 'A small group of real users tries the system on real work before the rest of the business switches over.'],
        ['n' => '05', 'title' => 'Launch', 'body' => 'A phased rollout, so your business keeps running while the new system takes over.'],
        ['n' => '06', 'title' => 'Refine', 'body' => "Real usage always surfaces things a workshop can't predict. We keep adjusting after launch, not just before it."],
    ];

    $faqs = [
        ['q' => 'How long does a custom system take to build?', 'a' => "We typically begin discovery within 48 hours of signing. If what you need is closer to an MVP, we can have a working prototype in 1 to 2 weeks. A full multi-module system that replaces several spreadsheets and manual processes usually takes a few months. We give you a realistic timeline after the discovery workshop, not before we understand what you actually need."],
        ['q' => 'How does pricing work?', 'a' => "It depends on how well-defined the project is. A clearly scoped build gets a fixed price. A larger or evolving system runs time-and-materials, so you're not paying for padding on work that isn't scoped yet. We agree on which model applies before any work starts, and you'll never be surprised by which one it turns out to be."],
        ['q' => 'Will I own the code and the data?', 'a' => "Yes, completely. You get full ownership of the source code, the database, and the documentation. There's no licence fee, no seat limit, and nothing holding your data hostage. If you ever want to take the system to another team, you can."],
        ['q' => 'Do you replace our whole system, or just parts of it?', 'a' => "Whichever makes sense for your business. Some clients replace one broken process at a time and keep everything else running. Others need a full platform from day one. We design for what you actually need, not what's easiest for us to build."],
        ['q' => "Who will I actually be working with?", 'a' => "The person building your system, directly. We're founder-led, so there's no account manager sitting between you and the engineer doing the work. If something needs to change, you say it once."],
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
                    <x-site.eyebrow>Custom Software</x-site.eyebrow>
                    <h1 class="display-xl hero-headline"><span class="dim">Off-the-shelf software makes you adapt.</span><br><span class="hl">We build software that adapts.</span></h1>
                    <p class="lede">Internal tools and business systems shaped around how your team actually works, not a template you have to work around.</p>

                    <div class="hero-ctas">
                        <x-site.btn :href="$contact" variant="lime">Book a Free Discovery Call</x-site.btn>
                        <x-site.btn href="#capabilities" :link="true" :arrow="true">See how we build</x-site.btn>
                    </div>
                </div>

                {{-- Three bespoke, differently-sized modules meeting at one
                     integrated core — standing in for a system built from
                     parts shaped to the business, not a uniform template.
                     Original SVG, our own palette. --}}
                <div class="hero-tilegrid" aria-hidden="true">
                    <svg viewBox="0 0 480 360" xmlns="http://www.w3.org/2000/svg">
                        <g fill="none" stroke="rgba(244,242,234,.18)" stroke-width="2">
                            <path d="M140 90h60v45"/>
                            <path d="M340 100h-60v40"/>
                            <path d="M175 260h50v-30"/>
                        </g>
                        <circle cx="140" cy="90" r="3" fill="rgba(244,242,234,.4)"/>
                        <circle cx="340" cy="100" r="3" fill="rgba(244,242,234,.4)"/>
                        <circle cx="200" cy="260" r="3" fill="rgba(244,242,234,.4)"/>

                        {{-- Module A: small --}}
                        <rect x="60" y="52" width="90" height="52" rx="10" fill="rgba(244,242,234,.05)" stroke="rgba(244,242,234,.14)"/>
                        <rect x="76" y="70" width="50" height="7" rx="3.5" fill="rgba(244,242,234,.3)"/>
                        <rect x="76" y="83" width="34" height="6" rx="3" fill="rgba(244,242,234,.14)"/>

                        {{-- Module B: tall --}}
                        <rect x="310" y="52" width="100" height="90" rx="10" fill="rgba(244,242,234,.05)" stroke="rgba(244,242,234,.14)"/>
                        <rect x="326" y="72" width="60" height="7" rx="3.5" fill="rgba(244,242,234,.3)"/>
                        <rect x="326" y="86" width="44" height="6" rx="3" fill="rgba(244,242,234,.14)"/>
                        <rect x="326" y="100" width="52" height="6" rx="3" fill="rgba(244,242,234,.14)"/>

                        {{-- Integrated core (highlighted) --}}
                        <g style="filter: drop-shadow(0 0 18px rgba(116,184,18,.5));">
                            <rect x="175" y="150" width="150" height="80" rx="12" fill="#182B10" stroke="#74B812" stroke-width="1.5"/>
                            <rect x="197" y="176" width="70" height="9" rx="4" fill="#74B812"/>
                            <rect x="197" y="194" width="90" height="7" rx="3.5" fill="rgba(244,242,234,.35)"/>
                            <circle cx="298" cy="168" r="11" fill="#74B812"/>
                            <path d="M293 168l3.2 3.2L304 164" fill="none" stroke="#0B1410" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>

                        {{-- Module C: wide, low --}}
                        <rect x="145" y="260" width="110" height="50" rx="10" fill="rgba(244,242,234,.05)" stroke="rgba(244,242,234,.14)"/>
                        <rect x="162" y="278" width="60" height="7" rx="3.5" fill="rgba(244,242,234,.3)"/>
                        <rect x="162" y="291" width="40" height="6" rx="3" fill="rgba(244,242,234,.14)"/>
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
                <h2 class="display-l">Generic software makes you <strong>work around it.</strong></h2>

                <div class="why-grid__body">
                    <p class="lede">Off-the-shelf tools are built for the average business, which means yours ends up bending to fit theirs. You end up with three spreadsheets bridging the gaps, a workaround everyone just knows about, and a process that only makes sense if you already worked there for two years.</p>
                    <p class="lede" style="margin-top: 1rem;">Custom software flips that. We build the system around how your business actually runs, so the workarounds disappear instead of getting documented.</p>

                    <blockquote class="founder-pull" style="margin-top: 2rem;">
                        "If your team built a spreadsheet to work around your own software, that's not a training problem. That's the software's fault."
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== CAPABILITIES ==================== --}}
    <section class="section section--flush-top" id="capabilities">
        <div class="container">
            <x-site.section-head eyebrow="How we build">Four stages behind every custom system.</x-site.section-head>

            <p class="lede" style="max-width: 42rem; margin-top: 1.5rem;">Whether it's one internal tool or a full platform, every engagement moves through these four stages.</p>

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
            <x-site.section-head eyebrow="What it looks like">Six steps, from spreadsheet to system.</x-site.section-head>

            <p class="lede" style="max-width: 42rem; margin-top: 1.5rem;">No step skipped, no guessing at what you need before we've actually watched how your team works.</p>

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
                <span class="framework-note__label">Beyond the build</span>
                <p>A system nobody can maintain after we leave isn't finished. Every project ends with documentation and a handover, whether or not you keep us on for support.</p>
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
                    :logo="asset('assets/images/logo/clients/payhse.png')" logo-alt="Payhouse Finance"
                    name="Allan Chidawarima" role="Director, Payhouse Finance"
                    highlight="know how to build systems you can trust"
                    :reveal="false"
                >ShiftTech built our website and helped us fully digitise and automate our loan application process. Security and compliance were critical for us, and the team handled everything with confidence from PCI-DSS requirements to real-time transaction monitoring. They truly understand fintech and know how to build systems you can trust.</x-site.testimonial>
            </div>

            <div class="section-cta">
                <p>Want a system like this behind your business?</p>
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
                        <details class="faq-item" {{ $i === 0 ? 'open' : '' }}>
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
            <h2><strong>Thirty minutes. No obligation.</strong><br>Just clarity on what we'd build for you.</h2>
            <p class="lede">Tell us what your team is working around right now. We'll tell you honestly what it would take to fix it.</p>

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
        { "@type": "ListItem", "position": 2, "name": "Custom Software Development", "item": "{{ url('/services/custom-software-development') }}" }
    ]
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "Service",
    "serviceType": "Custom Software Development",
    "name": "Custom Software Development",
    "description": "Bespoke internal tools and business systems built around how your business actually works.",
    "provider": { "@type": "Organization", "name": "ShiftTech", "url": "{{ url('/') }}" },
    "areaServed": ["ZA", "ZW"],
    "url": "{{ url('/services/custom-software-development') }}"
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
