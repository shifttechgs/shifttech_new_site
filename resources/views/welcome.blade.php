@extends('layouts.site')

@section('title', 'ShiftTech: Software that runs your business')
@section('meta_description', 'Founder-led software engineering studio in Cape Town and Harare. Web platforms, mobile apps and operations systems, built by the person you actually talk to. Book a free discovery call.')
@section('body_class', 'has-dark-hero')

@php
    $contact = url('/contact');

    // --- Statistics (edit these to your verified numbers) ---
    $stats = [
        ['num' => '100%', 'label' => 'Founder-led, start to finish'],
        ['num' => '10+',  'label' => 'Systems shipped & still running'],
        ['num' => '90%+', 'label' => 'Repeat partnerships, built on sustained trust'],
    ];

    // --- Case studies (auto-advancing carousel) ---
    $caseStudies = [
        ['client' => 'BSL Auction',      'title' => 'The admin platform that runs the whole auction house.',      'tags' => 'Web · Admin platform · Dashboard',  'img' => 'assets/images/thumbs/work/bsl-auction',     'alt' => 'BSL Auction operations dashboard built by ShiftTech', 'w' => 1280, 'h' => 694],
        ['client' => 'Luminii',          'title' => 'The CRM this studio runs on, and our clients too.',          'tags' => 'SaaS · CRM · Invoicing',            'img' => 'assets/images/thumbs/work/luminii',         'alt' => 'Luminii CRM built by ShiftTech', 'w' => 1280, 'h' => 698],
        ['client' => 'SpringKleaners',   'title' => 'A website built to turn visitors into booked cleans.',        'tags' => 'Web · Lead generation · Cape Town', 'img' => 'assets/images/thumbs/work/springkleaners',  'alt' => 'SpringKleaners cleaning service website built by ShiftTech', 'w' => 1280, 'h' => 691],
        ['client' => 'Ribbon Plumbing',  'title' => 'A conversion-first site for a 24/7 plumbing & gas company.',  'tags' => 'Web · Lead generation · Booking',   'img' => 'assets/images/thumbs/work/ribbon-plumbing', 'alt' => 'Ribbon Plumbing website built by ShiftTech', 'w' => 1280, 'h' => 703],
        ['client' => 'Peekaboo Daycare', 'title' => 'The admissions dashboard that keeps enrolments on track.',     'tags' => 'Web · Admin platform · Enrolments', 'img' => 'assets/images/thumbs/work/peekaboo',        'alt' => 'Peekaboo Daycare admissions dashboard built by ShiftTech', 'w' => 1280, 'h' => 703],
    ];

    // --- Client logos for the dark hero bar (white silhouettes) ---
    $logos = [
        ['src' => 'assets/images/logo/clients/white/payhse.png',           'alt' => 'Payhouse Finance'],
        ['src' => 'assets/images/logo/clients/white/vpw.png',              'alt' => 'Vision Plus Wealth'],
        ['src' => 'assets/images/logo/clients/white/wcbs_header_logo.png', 'alt' => 'Western Cape Blood Service'],
        ['src' => 'assets/images/logo/clients/white/BSlwebbold.png',       'alt' => 'BSL Services'],
        ['src' => 'assets/images/logo/clients/white/trax_boats.png',       'alt' => 'Boats and Trailers'],
    ];

    // --- Services organised by outcome (each links to its real service page) ---
    $services = [
        ['title' => 'Automate Your Operations', 'action' => 'Custom Software',    'href' => url('/services/custom-software-development'), 'body' => 'Replace spreadsheets and manual admin with systems that do the work: quoting, invoicing, tracking, reporting.'],
        ['title' => 'AI Where It Earns Its Place', 'action' => 'AI Integrations', 'href' => url('/services/ai'), 'body' => 'Practical AI built into your systems, cutting busywork and surfacing what matters. Substance over hype.'],
        ['title' => 'Custom Web Platforms',     'action' => 'Web Applications',   'href' => url('/services/web-application-development'), 'body' => 'Client portals, booking systems and internal tools built around how your business actually works.'],
        ['title' => 'Mobile Apps',              'action' => 'Mobile Development', 'href' => url('/services/mobile-app-development'),      'body' => 'Apps your customers and field teams will actually use, from emergency response to laundry pickup.'],
        ['title' => 'Websites That Win Work',   'action' => 'Web Design',         'href' => url('/services/web-design'),                  'body' => 'Fast, credible marketing sites designed to turn visitors into enquiries, not just look pretty.'],
    ];

    // --- Development process (numbered: real sequence) ---
    $process = [
        [
            'n' => '01', 'title' => 'Discovery', 'body' => 'A 30-minute call about your business, not your tech stack.',
            'details' => [
                ['title' => 'Understand the Problem',  'body' => 'Before we think about tech, we need to understand your business. What\'s breaking, what\'s slowing you down, and what a good outcome actually looks like for you.'],
                ['title' => 'Look at the Context',     'body' => 'If it matters to the project, we look at it: how your users behave, what competitors are doing, where the gaps are. No assumptions.'],
                ['title' => 'Agree on the Goal',       'body' => 'By the end of discovery we\'ve agreed on what we\'re building, what success looks like, and what\'s out of scope. Everyone aligned before money changes hands.'],
            ],
        ],
        [
            'n' => '02', 'title' => 'Plan', 'body' => 'Scope, timeline and budget agreed before a line of code is written.',
            'details' => [
                ['title' => 'Scope and Milestones', 'body' => 'We turn discovery into a clear project plan: features, phases, and delivery dates you can hold us to. No surprises.'],
                ['title' => 'Tech Stack Decision',  'body' => 'We recommend the right tools for your specific needs, not the flavour of the month. Stability and long-term maintainability come first.'],
                ['title' => 'Budget and Contracts', 'body' => 'Fixed-price or time-and-materials contracts, written in plain English. You know exactly what you\'re getting and what it costs before we start.'],
            ],
        ],
        [
            'n' => '03', 'title' => 'Design', 'body' => 'Screens you can react to before a line of code is written.',
            'details' => [
                ['title' => 'Real Screens to Click',  'body' => 'We design how it will look and feel before writing a single line of code. You get working screens to review, not wireframes to squint at.'],
                ['title' => 'A Consistent System',    'body' => 'Components, colours, and typography are built as a system so the product stays consistent as it grows.'],
                ['title' => 'Prototype and Refine',   'body' => 'You click through a working prototype and tell us what feels off. Better to fix it now than after it\'s coded.'],
            ],
        ],
        [
            'n' => '04', 'title' => 'Build', 'body' => 'Short cycles, working software every week, direct access.',
            'details' => [
                ['title' => 'Working Software Weekly', 'body' => 'We write the code. You get working software every sprint, not a big reveal at the end.'],
                ['title' => 'Short Build Cycles',      'body' => 'We build in focused cycles. You see progress every week and can steer things if priorities shift.'],
                ['title' => 'Quality Checks',          'body' => 'Every feature is tested manually and with automated checks. Nothing ships until it works properly under real conditions.'],
            ],
        ],
        [
            'n' => '05', 'title' => 'Launch & Growth', 'body' => 'Deployment, training and a calm switchover.',
            'details' => [
                ['title' => 'A Calm Go-Live',      'body' => 'We plan the rollout so nothing catches your team off guard. Go-live is calm, not chaotic.'],
                ['title' => 'See What\'s Working', 'body' => 'After launch we look at how the system is actually being used and flag anything worth improving early.'],
                ['title' => 'Grow With You',        'body' => 'As your business grows, we make sure the system grows with it. No big rewrites, just steady progress.'],
            ],
        ],
        [
            'n' => '06', 'title' => 'Support & Partnership', 'body' => '30 days included; a retainer if you want us close after.',
            'details' => [
                ['title' => '30 Days Post-Launch',        'body' => 'Every project includes 30 days of post-launch support: bug fixes, monitoring, and quick responses so your team can run confidently from day one.'],
                ['title' => 'Still Here After Launch',    'body' => 'We stay close after go-live. Most clients keep us on retainer because having the person who built the system available makes all the difference.'],
                ['title' => 'Improvements When They Matter', 'body' => 'We track how your system performs in the real world and bring recommendations when something genuinely needs attention, not on a monthly clock.'],
            ],
        ],
    ];

    // --- Testimonials (real, verbatim) ---
    $testimonials = [
        ['logo' => 'assets/images/logo/clients/payhse.png',           'alt' => 'Payhouse Finance',           'name' => 'Allan Chidawarima', 'role' => 'Director, Payhouse Finance', 'highlight' => 'know how to build systems you can trust', 'quote' => 'ShiftTech built our website and helped us fully digitise and automate our loan application process. Security and compliance were critical for us, and the team handled everything with confidence from PCI-DSS requirements to real-time transaction monitoring. They truly understand fintech and know how to build systems you can trust.'],
        ['logo' => 'assets/images/logo/clients/BSlwebbold.png',       'alt' => 'BSL Services',               'name' => 'Conrad',            'role' => 'Operations Manager, BSL Services', 'highlight' => 'simplified operations and reduced manual work', 'quote' => 'ShiftTech built our auction website and admin platform exactly to our needs. They understood our business and delivered a system that simplified operations and reduced manual work. We\'re very happy with the result.'],
        ['logo' => 'assets/images/logo/clients/wcbs_header_logo.png', 'alt' => 'Western Cape Blood Service',  'name' => 'Ian',               'role' => 'Manager, Western Cape Blood Service', 'highlight' => 'delivered it 4× faster than our internal estimates', 'quote' => 'Prosper and the team introduced AI into our workflows and designed a monitoring system for all our background services. They delivered it 4× faster than our internal estimates, with a clean, powerful dashboard that finally gave us real-time visibility. Reliable, efficient, and genuinely easy to work with. We would truly recommend them.'],
        ['logo' => 'assets/images/logo/clients/trax_boats.png',       'alt' => 'Boats and Trailers',         'name' => 'Dirk Nel',          'role' => 'Owner, Boats and Trailers', 'highlight' => 'Sales are up 40% since launch', 'quote' => 'We were struggling with spreadsheets for inventory and sales tracking. ShiftTech built us a custom CRM and inventory system that integrated with our accounting software. Sales are up 40% since launch!'],
        ['logo' => 'assets/images/logo/clients/vpw.png',              'alt' => 'Vision Plus Wealth',         'name' => 'Tinashe Muchenje',  'role' => 'Director, Vision Plus Wealth', 'highlight' => 'fast, secure, and seamless', 'quote' => 'ShiftTech built our website and automated our previously manual loan application process. What used to take days is now fast, secure, and seamless for both our team and customers. The shift to digital has made a huge difference to how we operate.'],
        ['logo' => 'assets/images/logo/clients/logo.png',             'alt' => 'Ray and Sons Plumbing',      'name' => 'Ray',               'role' => 'Director, Ray & Sons Plumbers', 'highlight' => 'partners, not just service providers', 'quote' => 'ShiftTech helped us launch a professional website and is now supporting us with Useluminii to streamline our day-to-day operations. The team really understands our business and works with us as partners, not just service providers. Everything feels more organised and easier to manage.'],
    ];

    // --- Testimonial marquee columns — each column carries a distinct pair of
    // testimonials (not the full set) so the seamless-loop duplication needed
    // for the CSS animation doesn't multiply into every testimonial appearing
    // 5-6x in the raw HTML. All 6 real testimonials still show, split across
    // the 3 columns instead of repeated in each one. Durations scaled down to
    // match the shorter per-column track length.
    $testimonialColumnOrders = [
        [0, 3],
        [1, 4],
        [2, 5],
    ];
    $testimonialDurations = [18, 16, 20];
    $testimonialColumns = array_map(function ($order, $i) use ($testimonials, $testimonialDurations) {
        $items = array_map(fn ($idx) => $testimonials[$idx], $order);
        return ['items' => $items, 'duration' => $testimonialDurations[$i]];
    }, $testimonialColumnOrders, array_keys($testimonialColumnOrders));

    // --- FAQ (real) ---
    $faqs = [
        ['q' => 'How quickly can you start on my project?',    'a' => 'We typically begin discovery within 48 hours of signing. For MVPs we can have a working prototype in 1–2 weeks. Larger projects follow a structured timeline we\'ll establish together during our initial call.'],
        ['q' => 'What\'s included in your pricing?',           'a' => 'Our quotes include design, development, testing, deployment, and 30 days of post-launch support. Transparent pricing, no hidden fees. You\'ll know exactly what you\'re paying for before we start.'],
        ['q' => 'Do you offer ongoing support and maintenance?','a' => 'We offer flexible maintenance from basic monitoring to full managed services. Most clients move onto a monthly retainer for continuous improvements and priority support after launch.'],
        ['q' => 'What if I\'m not sure what I need?',          'a' => 'Our discovery calls are free and designed to help you figure that out. Bring the problem — we\'ll ask the right questions, map the solution, and give you an honest recommendation with no obligation.'],
    ];
@endphp

@section('content')
<main id="main">
    <div class="rails" aria-hidden="true"></div>


    {{-- ==================== HERO (dark, centered, type-led, framed — Glucode DNA) ==================== --}}
    <section class="hero hero--dark hero--framed">
        {{-- Blurred backdrop of real shipped screenshots — ambient evidence of
             craft behind the content, not competing with it. --}}
        <div class="hero-bg" aria-hidden="true">
            <div class="hero-bg__grid">
                @foreach (array_slice($caseStudies, 0, 5) as $cs)
                    <picture>
                        <source srcset="{{ asset($cs['img'] . '.webp') }}" type="image/webp">
                        <img src="{{ asset($cs['img'] . '.jpg') }}" alt="" width="{{ $cs['w'] }}" height="{{ $cs['h'] }}" loading="eager">
                    </picture>
                @endforeach
            </div>
        </div>
        <div class="hero-frame">
            <div class="hero-frame__body">
                <div class="hero-split">
                    <div class="hero-copy">
                        <x-site.eyebrow>Replace Manual Processes &middot; Build Internal Systems &middot; Scale Operations</x-site.eyebrow>

                        <h1 class="display-xl hero-headline"><span class="dim">Software isn't the goal.</span><br><span class="hl">Business value is.</span></h1>
                        <p class="lede hero-sub">We help founders, businesses, and enterprise teams<br>eliminate manual work, modernize operations, and drive measurable business value.</p>

                        <div class="hero-ctas">
                            <x-site.btn :href="$contact" variant="lime">Book a Free Discovery Call</x-site.btn>
                            <x-site.btn href="{{ url('/work') }}" :link="true" :arrow="true">See Proof of Work</x-site.btn>
                        </div>

                    </div>

                    {{-- Photo grid — one real photo of the founder (the "founder-led" claim
                         made visible) plus two slots that rotate through real shipped work.
                         Staggered collage of notched-squircle cards: each card has one stepped
                         corner bite facing a diagonal neighbour, floating badge chips label
                         each card (chips are siblings of the cards, not children, because the
                         cards are clip-pathed and would crop anything overhanging their edge),
                         and a dashed connector frame sits behind. Replaces the lead-capture form. --}}
                    <div class="hero-photogrid-wrap">
                        <div class="hero-photogrid">
                            <div class="hero-photogrid__frame" aria-hidden="true"></div>
                            <div class="hero-photogrid__founder">
                                <img src="{{ asset('assets/images/team/prosper.jpg') }}" alt="Prosper, founder of ShiftTech" width="900" height="900" loading="eager">
                            </div>
                            {{-- Two animated process cards — how we diagnose (audit) and how
                                 we build (delivery). Steps light up in sequence via pure CSS
                                 so the animation obeys prefers-reduced-motion for free. --}}
                            <div class="hero-photogrid__product hero-photogrid__product--0 hero-photogrid__panel hero-process hero-process--audit">
                                <span class="hero-photogrid__panel-tag">01 &middot; Systems Audit</span>
                                <ul class="hero-process__steps">
                                    <li><i></i>Map your current systems</li>
                                    <li><i></i>Find gaps &amp; quick wins</li>
                                    <li><i></i>Fixed-price roadmap</li>
                                </ul>
                            </div>
                            <div class="hero-photogrid__product hero-photogrid__product--1 hero-photogrid__panel hero-process">
                                <span class="hero-photogrid__panel-tag">02 &middot; End-to-End Delivery</span>
                                <div class="hero-pipeline">
                                    <div class="hero-pipeline__stages" aria-label="Design, build, launch, support: one continuous pipeline">
                                        <span><i></i>Design</span>
                                        <span><i></i>Build</span>
                                        <span><i></i>Launch</span>
                                        <span><i></i>Support</span>
                                    </div>
                                    <p class="hero-pipeline__note">One engineer, strategy to support.</p>
                                </div>
                            </div>
                            <div class="hero-photogrid__chip hero-photogrid__chip--founder">
                                <span class="hero-photogrid__chip-icon" aria-hidden="true"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17h18l-2-9-4 3-3-6-3 6-4-3z"/></svg></span>
                                <span class="hero-photogrid__chip-text"><b>Prosper</b><span>Founder &amp; Lead Engineer</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-bar">
                <p class="hero-bar__line">Trusted by regional leaders in fintech, healthcare and logistics.</p>
                <div class="hero-bar__logos-mask">
                    <ul class="hero-bar__logos" aria-label="Clients">
                        @for ($rep = 0; $rep < 2; $rep++)
                            @foreach ($logos as $logo)
                                <li @if ($rep === 1) aria-hidden="true" @endif><img src="{{ asset($logo['src']) }}" alt="{{ $logo['alt'] }}" loading="lazy"></li>
                            @endforeach
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Mobile-only sticky re-entry CTA — appears once the hero scrolls out of view --}}
    <div class="mobile-sticky-cta" id="mobileStickyCta">
        <a href="{{ $contact }}" class="btn btn-lime">Book a Free Discovery Call &rarr;</a>
    </div>

    {{-- ==================== WHAT WE BUILD (capabilities, stacked scroll) ==================== --}}
    <section class="section" id="services">
        <div class="container caps-layout">
            <div class="caps-head">
                <x-site.eyebrow>What we build</x-site.eyebrow>
                <h2 class="display-l">Organised around <strong>your outcome,</strong> not our tech stack.</h2>
                <p class="caps-note">Not sure which one fits? Book a discovery call, bring the problem, and we'll map the right solution together.</p>
                <x-site.btn :href="$contact" variant="primary">Book a Free Discovery Call</x-site.btn>
            </div>

            <div class="caps-list">
                @foreach ($services as $i => $s)
                    <a href="{{ $s['href'] }}" class="xitem">
                        <span class="xitem__num">{{ sprintf('%02d', $i + 1) }}</span>
                        <span class="xitem__body">
                            <span class="xitem__title-row">
                                <span class="xitem__title">{{ $s['title'] }}</span>
                                <span class="xitem__arrow" aria-hidden="true">&rarr;</span>
                            </span>
                            <span class="xitem__reveal"><span class="xitem__reveal-inner"><span class="xitem__desc">{{ $s['body'] }}</span></span></span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== STATISTICS ==================== --}}
    <section class="stats-band" id="stats">
        <div class="container">
            <div class="stats-grid">
                @foreach ($stats as $stat)
                    <div class="stat">
                        <span class="stat-num" data-count="{{ $stat['num'] }}">{{ $stat['num'] }}</span>
                        <span class="stat-label">{{ $stat['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== SELECTED WORK — Stack Scroll Reveal ==================== --}}
    <section class="section solutions" id="work">
        <div class="container">
            <div class="sol-head">
                <x-site.eyebrow>Selected work</x-site.eyebrow>
                <h2 class="sol-title"><span class="sol-title__lead">Real systems, running real businesses.</span> <span class="sol-title__sub">From fintech platforms to lead-generating websites. A look at what we built and what it changed.</span></h2>
            </div>
        </div>

        {{-- Sticky Card Stack: plain document flow, no JS — each card is
             position:sticky with an increasing top offset, so it catches
             near the nav and the next card slides up to stack on top of it. --}}
        <div class="container">
            <div class="cs-stack">
                @foreach ($caseStudies as $cs)
                <article class="cscard cs-stack__item" style="--i: {{ $loop->index }}">
                    <div class="cscard__media">
                        <picture>
                            <source srcset="{{ asset($cs['img'] . '.webp') }}" type="image/webp">
                            <img src="{{ asset($cs['img'] . '.jpg') }}" alt="{{ $cs['alt'] }}" width="{{ $cs['w'] }}" height="{{ $cs['h'] }}">
                        </picture>
                    </div>
                    <div class="cscard__body">
                        <span class="cscard__client">{{ $cs['client'] }}</span>
                        <h3 class="cscard__title">{{ $cs['title'] }}</h3>
                        <span class="cscard__tags">{{ $cs['tags'] }}</span>
                        <div class="cscard__foot">
                            <x-site.btn href="{{ url('/work') }}" variant="lime" class="cscard__cta">See More Work &rarr;</x-site.btn>
                            <span class="cscard__counter">{{ $loop->iteration }} / {{ $loop->count }}</span>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <div class="cases-more">
                <x-site.btn href="{{ url('/work') }}" :link="true" :arrow="true">See All Work</x-site.btn>
            </div>
        </div>
    </section>

    {{-- ==================== PROCESS ==================== --}}
    <section class="section section--flush-top" id="process">
        <div class="container">
            <x-site.section-head eyebrow="How a project runs">A calm, predictable path <strong>from idea to running system.</strong></x-site.section-head>

            {{-- Expandable drawers — hover to reveal, focus-within for keyboard --}}
            <div class="drawers reveal" id="processDrawers">
                @foreach ($process as $p)
                    <div class="drawer">
                        <div class="drawer__head">
                            <span class="drawer__num">{{ $p['n'] }}</span>
                            <span class="drawer__title">{{ $p['title'] }}</span>
                            <span class="drawer__toggle" aria-hidden="true">
                                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" focusable="false">
                                    <path d="M5.5 1v9M1 5.5h9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </span>
                        </div>
                        <div class="drawer__body">
                            <div class="drawer__inner">
                                @if (!empty($p['details']))
                                    <div class="drawer__details">
                                        @foreach ($p['details'] as $d)
                                            <div class="drawer-detail">
                                                <h4 class="drawer-detail__title">{{ $d['title'] }}</h4>
                                                <p class="drawer-detail__body">{{ $d['body'] }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="drawer__desc">{{ $p['body'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="section-cta">
                <p>Ready to see this in motion for your business?</p>
                <x-site.btn :href="$contact" variant="lime">Book a Free Discovery Call</x-site.btn>
            </div>
        </div>
    </section>

    {{-- ==================== FOUNDER ==================== --}}
    <section class="section founder" id="founder">
        <div class="container founder-grid">

            {{-- Portrait column --}}
            <div class="founder-portrait-col">
                <div class="portrait">
                    <picture>
                        <source srcset="{{ asset('assets/images/team/prosper.webp') }}" type="image/webp">
                        <img src="{{ asset('assets/images/team/prosper.jpg') }}" alt="Prosper, founder of ShiftTech" width="900" height="900" loading="lazy">
                    </picture>
                </div>
                <p class="portrait-caption">
                    <span>Est. 2025</span>
                    <span class="portrait-caption__sep">·</span>
                    <span>Cape Town &amp; Harare</span>
                </p>
            </div>

            {{-- Content column --}}
            <div class="founder-body">
                <x-site.eyebrow>The founder</x-site.eyebrow>
                <h2 class="display-l">You work with senior engineers. <strong>Not around them.</strong></h2>

                <ul class="founder-tags" aria-label="Credentials">
                    <li>10+ years full-stack</li>
                    <li>Fintech · Health · Operations</li>
                    <li>Senior-led delivery</li>
                </ul>

                <div class="founder-story">
                    <p>Most agencies have a trick: senior talent wins the pitch, junior teams do the work. At ShiftTech, whoever scopes your project leads the build and stays on it.</p>

                    <blockquote class="founder-pull">
                        "I've watched clients go weeks without speaking to anyone who actually touched their codebase. That doesn't happen here. You know who's working on your product, and you can reach them."
                    </blockquote>

                    <p>We keep the team small on purpose. Fewer clients at a time, more senior attention on each one. The trade-off works in your favour.</p>
                </div>

                <p class="founder-sign"><b>Prosper</b> · Founder &amp; Lead Engineer, ShiftTech</p>
                <div class="founder-cta">
                    <x-site.btn :href="$contact" variant="lime">Book a Free Discovery Call</x-site.btn>
                    <x-site.btn href="https://www.linkedin.com/company/shifttech-global-solutions/" variant="ghost-pine" target="_blank" rel="noopener noreferrer">LinkedIn</x-site.btn>
                </div>
            </div>

        </div>
    </section>

    {{-- ==================== TESTIMONIALS ==================== --}}
    <section class="section" id="testimonials">
        <div class="container">
            <div class="testimonials-head">
                <div class="testimonials-head__text">
                    <x-site.section-head eyebrow="What clients say">In their <strong>own words.</strong></x-site.section-head>
                </div>
                {{-- <button type="button" class="marquee__toggle" data-marquee-toggle aria-pressed="false" aria-label="Pause scrolling testimonials">
                    <span data-marquee-toggle-icon aria-hidden="true">&#10074;&#10074;</span>
                    <span data-marquee-toggle-label>Pause</span>
                </button> --}}
            </div>

            <div class="marquee" data-marquee>
                <span class="marquee__fade marquee__fade--top" aria-hidden="true"></span>
                <span class="marquee__fade marquee__fade--bottom" aria-hidden="true"></span>

                <div class="marquee__cols">
                    @foreach ($testimonialColumns as $col)
                        <div class="marquee__col">
                            <div class="marquee__track" style="--marquee-duration: {{ $col['duration'] }}s;">
                                @for ($rep = 0; $rep < 2; $rep++)
                                    @foreach ($col['items'] as $t)
                                        <x-site.testimonial
                                            :logo="asset($t['logo'])" :logo-alt="$t['alt']"
                                            :name="$t['name']" :role="$t['role']"
                                            :highlight="$t['highlight'] ?? null"
                                            :reveal="false"
                                            :aria-hidden="$rep === 1 ? 'true' : null"
                                        >{{ $t['quote'] }}</x-site.testimonial>
                                    @endforeach
                                @endfor
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="section-cta">
                <p>Want results like these for your business?</p>
                <x-site.btn :href="$contact" variant="lime">Book a Free Discovery Call</x-site.btn>
            </div>
        </div>
    </section>

    {{-- ==================== FAQ ==================== --}}
    <section class="section" id="faq">
        <div class="container">
            <div class="faq-panel">

                {{-- Left: heading + context + direct contact --}}
                <div class="faq-head">
                    <span class="faq-watermark" aria-hidden="true">FAQ</span>
                    <x-site.eyebrow>Questions</x-site.eyebrow>
                    <h2 class="display-l">Before you <strong>book.</strong></h2>
                    <p class="faq-sub">If something's still unclear after reading these, just ask — or reach us directly.</p>

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

                {{-- Right: numbered accordion cards --}}
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
            <h2><strong>Thirty minutes. No obligation.</strong><br>Just clarity on your next system.</h2>
            <p class="lede">Tell us what's slowing your business down. We'll tell you honestly whether software can fix it and what it would take.</p>

            {{-- Trust micro-commitments — address the 3 objections before the button --}}
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

@push('scripts')
<script>
(function () {
    'use strict';
    var stickyBar = document.getElementById('mobileStickyCta');
    var heroEl = document.querySelector('.hero--framed');
    if (!stickyBar || !heroEl) return;

    var onScroll = function () {
        var heroBottom = heroEl.getBoundingClientRect().bottom;
        stickyBar.classList.toggle('is-visible', heroBottom < 0);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
})();
</script>
@endpush
