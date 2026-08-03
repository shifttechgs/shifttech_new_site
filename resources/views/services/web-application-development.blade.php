@extends('layouts.site')

@section('title', 'Software Engineering in Cape Town | ShiftTech')
@section('meta_description', 'Architecture, implementation, and delivery for systems that have to actually hold up in production, for businesses in Cape Town and Harare. Built and reviewed by senior engineers, not templated out.')
@section('body_class', 'has-dark-hero')

@php
    $contact = url('/contact');

    $capabilityAreas = [
        [
            'label' => 'Architecture',
            'items' => [
                'Understanding how your business actually works, before a single database table gets created',
                'Splitting the system into pieces that match how your business actually operates',
                "Data design that won't need a rewrite at 10× the scale",
                "Decisions documented, so the next engineer isn't guessing why",
            ],
        ],
        [
            'label' => 'Implementation',
            'items' => [
                "Clean, carefully checked code, not whatever ships fastest",
                'Automated tests written alongside the feature, not after',
                'Automatic checks that catch bugs before a human has to',
                'Working software delivered every week, not just at the end',
            ],
        ],
        [
            'label' => 'Quality & Delivery',
            'items' => [
                'A realistic test copy of your system, not a rough approximation',
                "Testing for heavy traffic and unusual situations before launch, not after something breaks",
                'A plan to undo every release if something goes wrong, not just the risky ones',
                'Monitoring and alerts wired in from day one',
            ],
        ],
        [
            'label' => 'Modernisation',
            'items' => [
                'An honest look at your old system before we touch a single line',
                "A step-by-step plan to move over, so the business doesn't stop to rebuild",
                'Outdated packages and security gaps fixed as we go',
                'Documentation left behind for the team that inherits it',
            ],
        ],
    ];

    $lifecycle = [
        ['n' => '01', 'title' => 'Plan', 'body' => 'AI helps us explore options fast. The architecture decision is made by a person who understands your business.'],
        ['n' => '02', 'title' => 'Architect', 'body' => 'AI tools help us stress-test our design against unusual situations before we commit to it.'],
        ['n' => '03', 'title' => 'Build', 'body' => 'AI drafts repetitive code. Every line that ships has been read and understood by an engineer.'],
        ['n' => '04', 'title' => 'Test', 'body' => 'AI expands test coverage across cases a human would take days to think of by hand.'],
        ['n' => '05', 'title' => 'Ship', 'body' => 'Automated checks gate every release. Nothing goes live without passing them.'],
        ['n' => '06', 'title' => 'Maintain', 'body' => "AI helps us track down and recreate bugs faster. The root cause and the fix are still a person's call."],
    ];

    $stack = [
        ['name' => 'Frontend', 'models' => 'React · Angular · Vue · Next.js', 'body' => 'Interfaces built from reusable pieces, for speed and easy long-term upkeep.', 'icon' => 'brackets'],
        ['name' => 'Backend & APIs', 'models' => 'Laravel · C# · Node.js · PostgreSQL', 'body' => 'Carefully built, tested services designed around your actual business, not a generic template.', 'icon' => 'server'],
        ['name' => 'Mobile', 'models' => 'React Native · Flutter', 'body' => 'Apps that work on both iPhone and Android where that fits, built specifically for one platform when performance demands it.', 'icon' => 'device'],
        ['name' => 'Infrastructure & Cloud', 'models' => 'AWS · Azure · Docker · CI/CD', 'body' => 'The setup that gets your product live, built to scale with you instead of holding you back.', 'icon' => 'cloud'],
        ['name' => 'Quality & Testing', 'models' => 'PHPUnit · Jest · Playwright', 'body' => 'Automatic tests covering the small details and the full picture, run on every release.', 'icon' => 'shield'],
        ['name' => 'Tooling & IDEs', 'models' => 'Claude Code · Rider · GitHub · Linear', 'body' => 'The day-to-day tools that keep delivery visible and moving, not buried in status meetings.', 'icon' => 'terminal'],
    ];

    $faqs = [
        ['q' => 'How fast can you actually start building?', 'a' => "We typically begin discovery within 48 hours of signing. For MVPs we can have a working prototype in 1 to 2 weeks. Larger systems follow a structured timeline we agree on together after the architecture is scoped, not a guess made before we understand the problem."],
        ['q' => "What if my system needs to scale later, not on day one?", 'a' => "That's the normal case, and it's what we design for. We build the data model and architecture so it doesn't need a rewrite at 10x the scale, without over-engineering for traffic you don't have yet."],
        ['q' => 'Do you work with an existing codebase, or only greenfield builds?', 'a' => "Both. Plenty of our work is modernising or extending a system someone else built. We start with an honest look at what's there before touching a line, then move it forward without stopping the business to rebuild."],
        ['q' => 'Who do I actually talk to during the build?', 'a' => "The engineer building your system, directly. We're founder-led, so there's no account manager layer between you and the person who understands your code. If something needs to change, you say it once."],
    ];

    $icons = [
        'brackets' => '<path d="M8 4L3 12l5 8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 4l5 8-5 8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
        'server'   => '<rect x="3" y="4" width="18" height="7" rx="2"/><rect x="3" y="13" width="18" height="7" rx="2" fill="rgba(244,242,234,.5)"/><circle cx="7" cy="7.5" r="1.2" fill="#0B1410"/><circle cx="7" cy="16.5" r="1.2" fill="#0B1410"/>',
        'device'   => '<rect x="7" y="2" width="10" height="20" rx="2.5"/><rect x="9.5" y="18" width="5" height="1.6" rx=".8" fill="#0B1410"/>',
        'cloud'    => '<path d="M7 18a4.5 4.5 0 01-.6-8.96A5.5 5.5 0 0117.2 8.1 4 4 0 0117 18H7z"/>',
        'shield'   => '<path d="M12 2l8 3v6c0 5-3.4 8.5-8 11-4.6-2.5-8-6-8-11V5l8-3z"/><path d="M8.5 12l2.3 2.3L15.5 9.5" stroke="#0B1410" stroke-width="1.8" fill="none" stroke-linecap="round" stroke-linejoin="round"/>',
        'terminal' => '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M7 9l3.5 3L7 15" stroke="#0B1410" stroke-width="1.8" fill="none" stroke-linecap="round" stroke-linejoin="round"/><path d="M13 15h4" stroke="#0B1410" stroke-width="1.8" stroke-linecap="round"/>',
    ];
@endphp

@section('content')
<main id="main">
    <div class="rails" aria-hidden="true"></div>

    {{-- ==================== HERO (dark) ==================== --}}
    <section class="hero hero--dark">
        <div class="container">
            <div class="hero-split">
                <div class="hero-copy" style="max-width: 29rem;">
                    <x-site.eyebrow>Engineering</x-site.eyebrow>
                    <h1 class="display-xl hero-headline"><span class="dim">Anyone can ship something that works.</span><br><span class="hl">We ship what keeps working.</span></h1>
                    <p class="lede">Architecture, testing, and delivery discipline for systems your business actually depends on.</p>

                    <div class="hero-ctas">
                        <x-site.btn :href="$contact" variant="lime">Book a Free Discovery Call</x-site.btn>
                        <x-site.btn href="#capabilities" :link="true" :arrow="true">See how we build</x-site.btn>
                    </div>
                </div>

                {{-- A small system diagram: client, core service, database and
                     worker, connected — with the core service highlighted and
                     verified. Original SVG, our own palette. --}}
                <div class="hero-tilegrid" aria-hidden="true">
                    <svg viewBox="0 0 480 360" xmlns="http://www.w3.org/2000/svg">
                        {{-- connectors --}}
                        <g fill="none" stroke="rgba(244,242,234,.18)" stroke-width="2">
                            <path d="M170 95h60v45"/>
                            <path d="M275 165h-20"/>
                            <path d="M275 195l55 60h-20"/>
                            <path d="M275 195l-90 60h20"/>
                        </g>
                        <circle cx="170" cy="95" r="3" fill="rgba(244,242,234,.4)"/>
                        <circle cx="230" cy="140" r="3" fill="rgba(244,242,234,.4)"/>

                        {{-- Client node --}}
                        <rect x="60" y="66" width="110" height="58" rx="10" fill="rgba(244,242,234,.05)" stroke="rgba(244,242,234,.14)"/>
                        <rect x="78" y="86" width="60" height="8" rx="4" fill="rgba(244,242,234,.35)"/>
                        <rect x="78" y="100" width="40" height="6" rx="3" fill="rgba(244,242,234,.16)"/>

                        {{-- Core service node (highlighted) --}}
                        <g style="filter: drop-shadow(0 0 18px rgba(116,184,18,.5));">
                            <rect x="205" y="146" width="140" height="70" rx="12" fill="#182B10" stroke="#74B812" stroke-width="1.5"/>
                            <rect x="226" y="168" width="70" height="9" rx="4" fill="#74B812"/>
                            <rect x="226" y="184" width="50" height="7" rx="3" fill="rgba(244,242,234,.35)"/>
                            <circle cx="322" cy="160" r="11" fill="#74B812"/>
                            <path d="M317 160l3.2 3.2L328 156" fill="none" stroke="#0B1410" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>

                        {{-- Database node --}}
                        <g fill="rgba(244,242,234,.05)" stroke="rgba(244,242,234,.14)">
                            <ellipse cx="365" cy="262" rx="55" ry="14"/>
                            <path d="M310 262v30c0 7.7 24.6 14 55 14s55-6.3 55-14v-30" fill="rgba(244,242,234,.05)"/>
                            <path d="M310 277c0 7.7 24.6 14 55 14s55-6.3 55-14" fill="none"/>
                        </g>

                        {{-- Worker node --}}
                        <rect x="60" y="248" width="110" height="58" rx="10" fill="rgba(244,242,234,.05)" stroke="rgba(244,242,234,.14)"/>
                        <rect x="78" y="268" width="60" height="8" rx="4" fill="rgba(244,242,234,.35)"/>
                        <rect x="78" y="282" width="40" height="6" rx="3" fill="rgba(244,242,234,.16)"/>
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
                <h2 class="display-l">Software is judged in production, <strong>not in the demo.</strong></h2>

                <div class="why-grid__body">
                    <p class="lede">It's easy to make something that works on launch day. It's much harder to make something that still works after six months of real traffic, edge cases, and feature requests nobody planned for.</p>
                    <p class="lede" style="margin-top: 1rem;">We design for that second version from day one: the one that has to handle the data you didn't expect, the load you didn't forecast, and the integration your business added eight months later.</p>

                    <blockquote class="founder-pull" style="margin-top: 2rem;">
                        "If a system only works under ideal conditions, it doesn't work. We build for the conditions you'll actually hit."
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== CAPABILITIES ==================== --}}
    <section class="section section--flush-top" id="capabilities">
        <div class="container">
            <x-site.section-head eyebrow="How we build">Four pillars behind everything we ship.</x-site.section-head>

            <p class="lede" style="max-width: 42rem; margin-top: 1.5rem;">Every engagement touches these four areas, whether it's a new build or work on an existing system.</p>

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

    {{-- ==================== LIFECYCLE ==================== --}}
    <section class="section section--flush-top" id="lifecycle">
        <div class="container">
            <x-site.section-head eyebrow="Where AI supports delivery">Six stages, and where AI actually helps.</x-site.section-head>

            <p class="lede" style="max-width: 42rem; margin-top: 1.5rem;">AI speeds up parts of this. A senior engineer still owns every decision that matters.</p>

            <div class="framework-grid">
                @foreach ($lifecycle as $l)
                    <div class="framework-card">
                        <span class="rule-num">{{ $l['n'] }}</span>
                        <h3 class="framework-title">{{ $l['title'] }}</h3>
                        <p>{{ $l['body'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="framework-note">
                <span class="framework-note__label">Beyond the code</span>
                <p>A system only the person who built it can maintain isn't finished. Everything we ship comes with documentation and a team that can actually take it over.</p>
            </div>
        </div>
    </section>

    {{-- ==================== TECH STACK ==================== --}}
    <section class="section section--flush-top">
        <div class="container">
            <x-site.section-head eyebrow="What we build with">A stack chosen for the job, not the resume.</x-site.section-head>

            <p class="lede" style="max-width: 42rem; margin-top: 1.5rem;">Six categories, and the tools we actually reach for in each one.</p>

            <div class="tools-grid">
                @foreach ($stack as $t)
                    <div class="tool-item">
                        <span class="tool-logo" aria-hidden="true"><svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">{!! $icons[$t['icon']] !!}</svg></span>
                        <div class="tool-item__head">
                            <h3>{{ $t['name'] }}</h3>
                            <span class="tool-item__models">{{ $t['models'] }}</span>
                        </div>
                        <p>{{ $t['body'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== AI CALLOUT ==================== --}}
    <section class="section section--flush-top">
        <div class="container">
            <div class="framework-note">
                <span class="framework-note__label">Where AI fits</span>
                <p>We use AI to move faster on the parts of engineering that don't need judgment: repetitive code, test coverage, first drafts. Every architectural decision and every line that ships is still owned by a senior engineer. See exactly how we draw that line on our <a href="{{ url('/services/ai') }}">AI Integrations</a> page.</p>
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
                    :logo="asset('assets/images/logo/clients/trax_boats.png')" logo-alt="Boats and Trailers"
                    name="Dirk Nel" role="Owner, Boats and Trailers"
                    highlight="Sales are up 40% since launch"
                    :reveal="false"
                >We were struggling with spreadsheets for inventory and sales tracking. ShiftTech built us a custom CRM and inventory system that integrated with our accounting software. Sales are up 40% since launch!</x-site.testimonial>
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
            <h2><strong>Thirty minutes. No obligation.</strong><br>Just clarity on what your system actually needs.</h2>
            <p class="lede">Tell us what's breaking, or what you're about to build. We'll tell you honestly what it would take to get it right.</p>

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
        { "@type": "ListItem", "position": 2, "name": "Software Engineering", "item": "{{ url('/services/web-application-development') }}" }
    ]
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

@push('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "Service",
    "serviceType": "Web Application Development",
    "name": "Software Engineering",
    "description": "Architecture, implementation, testing and delivery for systems that have to hold up in production.",
    "provider": { "@type": "Organization", "name": "ShiftTech", "url": "{{ url('/') }}" },
    "areaServed": ["ZA", "ZW"],
    "url": "{{ url('/services/web-application-development') }}"
}
</script>
@endpush
