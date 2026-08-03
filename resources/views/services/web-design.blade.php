@extends('layouts.site')

@section('title', 'Web & Product Design in Cape Town | ShiftTech')
@section('meta_description', 'Interfaces designed to convert, not just look good, for businesses in Cape Town and Harare. Validated with real users, backed by a design system, delivered by a senior designer who owns the outcome.')
@section('body_class', 'has-dark-hero')

@php
    $contact = url('/contact');

    $standards = [
        ['n' => '01', 'title' => 'Evidence over opinion', 'body' => "Every layout decision is checked against real user behaviour or a comparable, not whoever has the loudest opinion in the room."],
        ['n' => '02', 'title' => 'One system, not one-off pages', 'body' => 'Every screen we design ties back to a documented design system, so new pages stay consistent without starting from zero.'],
        ['n' => '03', 'title' => 'A senior designer owns it', 'body' => 'One person is accountable for the outcome from first wireframe to shipped screen, not a rotating cast of contractors.'],
    ];

    $capabilityAreas = [
        [
            'label' => 'Research & Strategy',
            'items' => [
                'Talking to your team and your users before a single screen gets drawn',
                "Looking at what competitors do well, so we're not reinventing solved problems",
                'Page structure and navigation that matches how your users actually think',
                'A clear brief the whole team can build against',
            ],
        ],
        [
            'label' => 'Interface Design',
            'items' => [
                'Rough sketches you can react to, not abstract mood boards',
                'Polished, ready-to-build screens for web and mobile, in your brand',
                'Layouts tested against your real content, not placeholder text',
                "Small details, like hover effects and animations, that clarify what's happening, not just decorate",
            ],
        ],
        [
            'label' => 'Design Systems',
            'items' => [
                'Reusable building blocks your team can extend without us',
                'A documented set of rules for colour, type, and spacing, kept consistent',
                'Accessibility built in from the start, not bolted on before launch',
                'Clear specs so engineers can build it without guessing',
            ],
        ],
        [
            'label' => 'Conversion & Growth',
            'items' => [
                'Landing pages built around one goal per page',
                'Layouts we can test against each other, for the pages that matter most',
                'Reviewing where visitors currently drop off on existing pages, and why',
                'Copy and layout changes based on real numbers, not hunches',
            ],
        ],
    ];

    $process = [
        ['n' => '01', 'title' => 'Discover', 'body' => "We sit with your team and your data to understand what's actually broken before we open a design tool."],
        ['n' => '02', 'title' => 'Wireframe', 'body' => 'A rough structure you can react to fast, so we agree on the shape of the page before we polish anything.'],
        ['n' => '03', 'title' => 'Design', 'body' => "Polished screens in your brand, built from reusable pieces so engineering can build them exactly as designed."],
        ['n' => '04', 'title' => 'Validate', 'body' => "We test the design against real users or real data before it ships, not after."],
    ];

    $tools = [
        [
            'name' => 'Interface Design', 'models' => 'Figma',
            'body' => 'Where every screen gets designed, reviewed, and handed off, so there is one source of truth.',
            'icon' => 'frame',
        ],
        [
            'name' => 'Prototyping', 'models' => 'Framer',
            'body' => 'For prototypes that feel real enough to test with actual users before a line of code is written.',
            'icon' => 'cursor',
        ],
        [
            'name' => 'No-Code Build', 'models' => 'Webflow',
            'body' => 'For marketing sites and landing pages that need to ship fast without sacrificing design quality.',
            'icon' => 'layers',
        ],
        [
            'name' => 'Collaboration', 'models' => 'Notion · Miro',
            'body' => 'Where research, briefs, and workshops live, so nothing important gets lost in a chat thread.',
            'icon' => 'chat',
        ],
        [
            'name' => 'User Testing', 'models' => 'Maze',
            'body' => 'For validating a flow with real users before it goes anywhere near production.',
            'icon' => 'eye',
        ],
        [
            'name' => 'Handoff & QA', 'models' => 'Figma Dev Mode',
            'body' => 'So engineers implement what was actually designed, not their best guess at it.',
            'icon' => 'check',
        ],
    ];

    $icons = [
        'frame'  => '<rect x="3" y="4" width="18" height="14" rx="2"/><path d="M3 9h18" stroke="#0B1410" stroke-width="1.4"/>',
        'cursor' => '<path d="M5 3l6 16 2.5-6.5L20 10 5 3z"/>',
        'layers' => '<path d="M12 3l9 5-9 5-9-5 9-5z"/><path d="M3 13l9 5 9-5" stroke="#0B1410" stroke-width="1.6" fill="none" stroke-linecap="round" stroke-linejoin="round"/>',
        'chat'   => '<path d="M4 5h16a1 1 0 011 1v9a1 1 0 01-1 1H9l-5 4v-4H4a1 1 0 01-1-1V6a1 1 0 011-1z"/>',
        'eye'    => '<path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7z" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="12" r="3"/>',
        'check'  => '<circle cx="12" cy="12" r="10"/><path d="M8 12.5l2.5 2.5L16 9" stroke="#0B1410" stroke-width="1.8" fill="none" stroke-linecap="round" stroke-linejoin="round"/>',
    ];

    // This was the only service page with no FAQ block, and so the only one
    // emitting no FAQPage schema. Answers are drawn from what the page already
    // states: the four process stages, the three standards, and the four
    // places we plug into an existing product.
    $faqs = [
        ['q' => 'What does your design process actually involve?', 'a' => "Four stages: discover, wireframe, design, validate. Discovery establishes what the interface has to do and for whom. Wireframes settle structure before anyone argues about colour. Design applies the system. Validation puts it in front of real users before it gets built, so problems surface while they are still cheap."],
        ['q' => 'Do you validate designs with real users before we build?', 'a' => "Yes. Validation is a stage in its own right, not something we hope happens later. The whole approach is evidence over opinion: a design that tests well with the people who will actually use it beats one that wins an internal debate."],
        ['q' => 'Do we get a design system, or just page designs?', 'a' => "A documented design system. One system, not a set of one-off pages. It means the tenth screen looks like the first, a new developer knows which component to reach for, and you are not paying to redesign the same button every time you add a feature."],
        ['q' => 'Who actually does the design work?', 'a' => "A senior designer owns it end to end. This is a founder-led studio, so the person who scopes the work is the person who does it. Nothing gets sold by one person and quietly handed to a junior once the contract is signed."],
        ['q' => 'Can you come in partway through an existing product?', 'a' => "Yes. There are four points where we typically plug into a product that already exists, so you do not have to start over to get design help. We work with what is already shipped rather than insisting on a rebuild that serves us more than it serves you."],
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
                    <x-site.eyebrow>Web &amp; Product Design</x-site.eyebrow>
                    <h1 class="display-xl hero-headline"><span class="dim">Good design isn't decoration.</span><br><span class="hl">It's the shortest path to yes.</span></h1>
                    <p class="lede">We design interfaces your customers actually use, shaped by real behaviour, not internal opinions.</p>

                    <div class="hero-ctas">
                        <x-site.btn :href="$contact" variant="lime">Book a Free Discovery Call</x-site.btn>
                        <x-site.btn href="#process" :link="true" :arrow="true">See how we work</x-site.btn>
                    </div>
                </div>

                {{-- A browser frame with a hero block, three content cards, and a
                     highlighted CTA — the outcome we design toward. One card
                     carries a small "validated" check, echoing the AI page's
                     device. Original SVG, our own palette. --}}
                <div class="hero-tilegrid" aria-hidden="true">
                    <svg viewBox="0 0 480 360" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <clipPath id="winClipDesign">
                                <rect x="40" y="20" width="400" height="320" rx="14"/>
                            </clipPath>
                        </defs>

                        <g clip-path="url(#winClipDesign)">
                            <rect x="40" y="20" width="400" height="320" fill="rgba(244,242,234,.03)"/>
                            <rect x="40" y="20" width="400" height="40" fill="rgba(244,242,234,.06)"/>
                            <circle cx="62" cy="40" r="5" fill="rgba(244,242,234,.25)"/>
                            <circle cx="80" cy="40" r="5" fill="rgba(244,242,234,.25)"/>
                            <circle cx="98" cy="40" r="5" fill="rgba(244,242,234,.25)"/>

                            {{-- hero block --}}
                            <rect x="64" y="78" width="352" height="60" rx="8" fill="rgba(244,242,234,.05)"/>
                            <rect x="82" y="96" width="130" height="9" rx="4" fill="rgba(244,242,234,.4)"/>
                            <rect x="82" y="112" width="90" height="7" rx="3" fill="rgba(244,242,234,.18)"/>
                            <circle cx="372" cy="90" r="12" fill="#74B812"/>
                            <path d="M366 90l4 4 7-7" fill="none" stroke="#0B1410" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>

                            {{-- three content cards --}}
                            <g fill="rgba(244,242,234,.05)">
                                <rect x="64" y="154" width="104" height="76" rx="8"/>
                                <rect x="188" y="154" width="104" height="76" rx="8"/>
                                <rect x="312" y="154" width="104" height="76" rx="8"/>
                            </g>
                            <g fill="rgba(244,242,234,.22)">
                                <circle cx="84" cy="174" r="7"/>
                                <circle cx="208" cy="174" r="7"/>
                                <circle cx="332" cy="174" r="7"/>
                            </g>
                            <g fill="rgba(244,242,234,.16)">
                                <rect x="76" y="192" width="76" height="7" rx="3"/>
                                <rect x="76" y="206" width="52" height="6" rx="3"/>
                                <rect x="200" y="192" width="76" height="7" rx="3"/>
                                <rect x="200" y="206" width="52" height="6" rx="3"/>
                                <rect x="324" y="192" width="76" height="7" rx="3"/>
                                <rect x="324" y="206" width="52" height="6" rx="3"/>
                            </g>

                            {{-- highlighted CTA --}}
                            <g style="filter: drop-shadow(0 0 16px rgba(116,184,18,.5));">
                                <rect x="64" y="250" width="150" height="36" rx="18" fill="#74B812"/>
                                <rect x="84" y="264" width="80" height="8" rx="4" fill="#0B1410"/>
                                <path d="M154 264l6 4-6 4" fill="none" stroke="#0B1410" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>

                            {{-- cursor --}}
                            <path d="M232 268l6 17 2.6-7 7-2.6-15.6-7.4z" fill="rgba(244,242,234,.9)"/>
                        </g>

                        <rect x="40" y="20" width="400" height="320" rx="14" fill="none" stroke="rgba(244,242,234,.14)"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== DESIGN STANDARDS ==================== --}}
    <section class="section">
        <div class="container">
            <x-site.section-head eyebrow="How we work">Three standards we <strong>don't skip.</strong></x-site.section-head>

            <div class="rules-grid">
                @foreach ($standards as $s)
                    <div class="rule-item">
                        <span class="rule-num">{{ $s['n'] }}</span>
                        <h3 class="framework-title">{{ $s['title'] }}</h3>
                        <p>{{ $s['body'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== CAPABILITIES ==================== --}}
    <section class="section section--flush-top" id="capabilities">
        <div class="container">
            <x-site.section-head eyebrow="Where we help">Four places we plug into your product.</x-site.section-head>

            <p class="lede" style="max-width: 42rem; margin-top: 1.5rem;">Design isn't just the interface, it's the thinking that gets you there. Here's where we typically get involved.</p>

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
            <x-site.section-head eyebrow="How we bring it in">The ShiftTech Design Process</x-site.section-head>

            <p class="lede" style="max-width: 42rem; margin-top: 1.5rem;">Four stages, from first conversation to a shipped, tested interface.</p>

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
                <span class="framework-note__label">Beyond the pixels</span>
                <p>Good design outlives the person who made it. Everything we design ships with documentation your team can extend on their own, long after the engagement ends.</p>
            </div>
        </div>
    </section>

    {{-- ==================== TOOLS ==================== --}}
    <section class="section section--flush-top">
        <div class="container">
            <x-site.section-head eyebrow="What we design with">Six categories of tools, chosen for fit.</x-site.section-head>

            <p class="lede" style="max-width: 42rem; margin-top: 1.5rem;">Not a logo wall, just what we actually reach for.</p>

            <div class="tools-grid">
                @foreach ($tools as $t)
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
                <p>We use AI to speed up variations, first-draft copy, and repetitive layout work, never to replace the judgment of the person designing your product. See how we draw that line on our <a href="{{ url('/services/ai') }}">AI Integrations</a> page.</p>
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
                    :logo="asset('assets/images/logo/clients/vpw.png')" logo-alt="Vision Plus Wealth"
                    name="Tinashe Muchenje" role="Director, Vision Plus Wealth"
                    highlight="fast, secure, and seamless"
                    :reveal="false"
                >ShiftTech built our website and automated our previously manual loan application process. What used to take days is now fast, secure, and seamless for both our team and customers. The shift to digital has made a huge difference to how we operate.</x-site.testimonial>
            </div>

            <div class="section-cta">
                <p>Want an interface like this for your product?</p>
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
            <h2><strong>Thirty minutes. No obligation.</strong><br>Just clarity on what your interface should be doing for you.</h2>
            <p class="lede">Tell us what's not converting. We'll tell you honestly whether it's a design problem, and what it would take to fix it.</p>

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
        { "@type": "ListItem", "position": 2, "name": "Web & Product Design", "item": "{{ url('/services/web-design') }}" }
    ]
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "Service",
    "serviceType": "Web & Product Design",
    "name": "Web & Product Design",
    "description": "Interfaces designed to convert, validated with real users, backed by a documented design system.",
    "provider": { "@type": "Organization", "name": "ShiftTech", "url": "{{ url('/') }}" },
    "areaServed": ["ZA", "ZW"],
    "url": "{{ url('/services/web-design') }}"
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
