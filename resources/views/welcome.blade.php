@extends('layouts.site')

@section('title', 'ShiftTech: Software that runs your business')
@section('meta_description', 'Founder-led software engineering studio in Cape Town and Harare. Web platforms, mobile apps and operations systems, built by the person you actually talk to. Book a free discovery call.')
@section('body_class', 'has-dark-hero')

{{-- Display face (Plus Jakarta Sans) is loaded site-wide in layouts/site.blade.php --}}

@php
    $contact = url('/contact');

    // --- Statistics (edit these to your verified numbers) ---
    $stats = [
        ['num' => '100%', 'label' => 'Founder-led, start to finish'],
        ['num' => '10+',  'label' => 'Systems shipped & still running'],
        ['num' => '90%+', 'label' => 'Repeat partnerships'],
    ];

    // --- Case studies (auto-advancing carousel) ---
    $caseStudies = [
        ['client' => 'BSL Auction',      'title' => 'The admin platform that runs the whole auction house.',      'tags' => 'Web · Admin platform · Dashboard',  'img' => 'assets/images/thumbs/work/bsl-auction',     'alt' => 'BSL Auction operations dashboard built by ShiftTech', 'w' => 1280, 'h' => 694],
        ['client' => 'BSL Services',     'title' => 'The public auction site that opens bidding to all of South Africa.', 'tags' => 'Web · Auctions · Lead generation',  'img' => 'assets/images/thumbs/work/bsl-site',        'alt' => 'BSL Services public auction website built by ShiftTech', 'w' => 1280, 'h' => 697],
        ['client' => 'Luminii',          'title' => 'The CRM this studio runs on, and our clients too.',          'tags' => 'SaaS · CRM · Invoicing',            'img' => 'assets/images/thumbs/work/luminii',         'alt' => 'Luminii CRM built by ShiftTech', 'w' => 1280, 'h' => 698],
        ['client' => 'SpringKleaners',   'title' => 'A website built to turn visitors into booked cleans.',        'tags' => 'Web · Lead generation · Cape Town', 'img' => 'assets/images/thumbs/work/springkleaners',  'alt' => 'SpringKleaners cleaning service website built by ShiftTech', 'w' => 1280, 'h' => 691],
        ['client' => 'Ribbon Plumbing',  'title' => 'A conversion-first site for a 24/7 plumbing & gas company.',  'tags' => 'Web · Lead generation · Booking',   'img' => 'assets/images/thumbs/work/ribbon-plumbing', 'alt' => 'Ribbon Plumbing website built by ShiftTech', 'w' => 1280, 'h' => 703],
        ['client' => 'Peekaboo Daycare', 'title' => 'The admissions dashboard that keeps enrolments on track.',     'tags' => 'Web · Admin platform · Enrolments', 'img' => 'assets/images/thumbs/work/peekaboo',        'alt' => 'Peekaboo Daycare admissions dashboard built by ShiftTech', 'w' => 1280, 'h' => 703],
    ];

    // --- Client logos for the dark hero bar (white silhouettes) ---
    $logos = [
        ['src' => 'assets/images/logo/clients/white/payhse.png',           'alt' => 'Payhouse Finance'],
        ['src' => 'assets/images/logo/clients/white/vpw.png',              'alt' => 'Vision Plus Wealth'],
        ['src' => 'assets/images/logo/clients/white/nexa.png',             'alt' => 'Nexa Mining and Engineering Services'],
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

    // --- Our approach (3 phases — the "Think outside the box" grid; a
    //     condensed read of $process for the Phobos-style OUR APPROACH block) ---
    $approach = [
        ['n' => '01', 'title' => 'Understand the problem', 'body' => "We start with your business, not your tech stack: what's breaking, what's slowing you down, and what a good outcome looks like. Discovery ends with an agreed scope, timeline and budget before a line of code is written."],
        ['n' => '02', 'title' => 'Build the solution',     'body' => 'You react to real screens before anything is coded, then we build in short cycles with working software every week. Every feature is tested by hand and with automated checks before it ships.'],
        ['n' => '03', 'title' => 'Launch and support',     'body' => 'A calm go-live, your team trained, and 30 days of post-launch support included. Most clients keep us on a retainer afterwards, because the person who built the system is still the one you talk to.'],
    ];

    // Stroke-only line-art per phase (framed by CSS corner brackets).
    $approachFigures = [
        '<svg viewBox="0 0 120 120" fill="none" stroke="currentColor" stroke-width="1"><line x1="40" y1="18" x2="40" y2="102"/><line x1="40" y1="60" x2="106" y2="30"/><line x1="40" y1="60" x2="108" y2="46"/><line x1="40" y1="60" x2="108" y2="60"/><line x1="40" y1="60" x2="108" y2="74"/><line x1="40" y1="60" x2="106" y2="90"/><line x1="40" y1="60" x2="88" y2="18"/><line x1="40" y1="60" x2="88" y2="102"/><line x1="22" y1="102" x2="98" y2="102"/><circle cx="40" cy="60" r="3"/></svg>',
        '<svg viewBox="0 0 120 120" fill="none" stroke="currentColor" stroke-width="1"><rect x="22" y="22" width="76" height="76"/><line x1="60" y1="22" x2="60" y2="98"/><line x1="22" y1="60" x2="98" y2="60"/><rect x="64" y="26" width="32" height="32"/></svg>',
        '<svg viewBox="0 0 120 120" fill="none" stroke="currentColor" stroke-width="1"><line x1="20" y1="96" x2="100" y2="96"/><path d="M28 92 L92 28"/><path d="M74 28 L92 28 L92 46"/><circle cx="46" cy="74" r="2.5"/><circle cx="64" cy="56" r="2.5"/></svg>',
    ];

    // --- Case studies (Phobos "PROOF IS IN THE DOING." block). The BSL auction
    //     system as the featured study, with its three delivered pieces below. ---
    $studyFeatured = [
        'chip'  => 'Auction system',
        'title' => 'One platform for the whole auction house',
        'body'  => 'BSL ran auctions on paper trails and manual admin. We built the whole system: a public bidding site, an operations dashboard, and a field app, so every lot, bid and settlement lives in one place.',
        'href'  => url('/work/bsl-auction-services'),
        'img'   => 'assets/images/thumbs/work/bsl-yard',
        'alt'   => 'Bidders, machinery and vehicles at a B.S.L. auction',
    ];
    $studyGrid = [
        ['chip' => 'SaaS',    'title' => 'Five disconnected tools, replaced by one platform', 'tone' => 'mauve',    'href' => url('/work/luminii-saas-platform')],
        ['chip' => 'Education', 'title' => 'A paper admissions trail, replaced by one dashboard', 'tone' => 'charcoal', 'href' => url('/work/peekaboo-daycare')],
    ];

    // --- Insights (latest 2 blog posts, "Our latest thinking." block) ---
    $insights = \App\Models\Post::published()->take(2)->get();

    // Stroke-only line-art per insight card cover (currentColor = card text colour).
    $insightFigures = [
        '<svg viewBox="0 0 120 120" fill="none" stroke="currentColor" stroke-width="1"><circle cx="60" cy="60" r="14"/><circle cx="60" cy="60" r="30"/><circle cx="60" cy="60" r="46" stroke-dasharray="14 10"/><circle cx="60" cy="60" r="3" fill="currentColor" stroke="none"/><path d="M60 14v-6M60 112v-6M14 60H8M112 60h-6"/></svg>',
        '<svg viewBox="0 0 120 120" fill="none" stroke="currentColor" stroke-width="1"><path d="M10 10h100v100H10z" stroke-dasharray="6 6"/><path d="M60 22v76M22 60h76"/><path d="M52 52l16 16M68 52l-16 16"/></svg>',
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


    {{-- ==================== HERO (Phobos-style: type-led split headline, orbital
         rings, rotating badge, "+" text CTAs, monospace client bar. Charcoal
         ground + a single pink accent, both scoped to .hero--phobos.) ========= --}}
    <section class="hero hero--dark hero--phobos">
        <div class="hero-phobos__bg" aria-hidden="true">
            <span class="hero-phobos__bg-band hero-phobos__bg-band--1"></span>
            <span class="hero-phobos__bg-band hero-phobos__bg-band--2"></span>
            <span class="hero-phobos__bg-band hero-phobos__bg-band--3"></span>
            <span class="hero-phobos__bg-band hero-phobos__bg-band--4"></span>
            <span class="hero-phobos__bg-band hero-phobos__bg-band--5"></span>
        </div>
        <div class="hero-phobos__stage">
            <div class="hero-phobos__center rise">
                <div class="hero-phobos__hero-copy">
                    <span class="hero-phobos__kicker"><span class="c">//</span>Replace Manual Processes<span class="c">//</span>Build Internal Systems<span class="c">//</span>Scale Operations</span>
                    <h1 class="hero-phobos__center-title hero-phobos__center-title--display" aria-label="Software isn't the goal. Business value is.">
                        <span class="hero-phobos__ln">Software isn't the goal.</span>
                        <span class="hero-phobos__ln2">
                            <span class="hero-phobos__cycle" aria-hidden="true">
                                <span class="hero-phobos__cycle-track">
                                    <span>Business value</span>
                                    <span>Reliability</span>
                                    <span>Revenue</span>
                                    <span>Business value</span>
                                </span>
                            </span><span class="hero-phobos__is">is.</span>
                        </span>
                    </h1>
                    <p class="hero-phobos__center-sub">We replace the spreadsheets, paper trails and double capture your team works around every day with software built for how you actually operate.</p>
                    <div class="hero-phobos__hero-ctas">
                        <a class="hero-phobos__btn hero-phobos__btn--solid hero-phobos__center-cta" href="{{ $contact }}">Book a discovery call</a>
                        <a class="hero-phobos__seelink" href="{{ url('/work') }}">See our work</a>
                    </div>
                    <p class="cta-reassure cta-reassure--hero">Free &middot; 30 minutes &middot; reply within 24 hours &middot; no sales pressure</p>
                </div>

                <div class="hero-phobos__proof">
                    <div class="hero-phobos__proof-col">
                        <div class="hero-phobos__card hero-phobos__card--tall">
                            <div class="hero-phobos__card-body">
                                <span class="hero-phobos__card-num">100%</span>
                                <span class="hero-phobos__card-label">Tailored to how your business actually runs. Never a template.</span>
                            </div>
                            <svg class="hero-phobos__card-poly" viewBox="-130 -130 260 260" aria-hidden="true">
                                <g fill="none" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round">
                                    <path d="M100 0 L50 -86.6 L-50 -86.6 L-100 0 L-50 86.6 L50 86.6 Z"/>
                                    <path d="M0 -52 L45 26 L-45 26 Z"/>
                                    <path d="M0 52 L45 -26 L-45 -26 Z"/>
                                    <path d="M100 0 L45 -26 M100 0 L45 26
                                             M50 -86.6 L0 -52 M50 -86.6 L45 -26
                                             M-50 -86.6 L0 -52 M-50 -86.6 L-45 -26
                                             M-100 0 L-45 -26 M-100 0 L-45 26
                                             M-50 86.6 L-45 26 M-50 86.6 L0 52
                                             M50 86.6 L0 52 M50 86.6 L45 26"/>
                                </g>
                            </svg>
                        </div>
                        <div class="hero-phobos__card hero-phobos__card--wide">
                            <div class="hero-phobos__card-body">
                                <span class="hero-phobos__card-inline"><b>PCI-DSS</b> Compliant builds</span>
                            </div>
                        </div>
                    </div>

                    <div class="hero-phobos__proof-col">
                        <a class="hero-phobos__card hero-phobos__card--flow" href="#process">
                            <div class="hero-phobos__card-body">
                                <span class="hero-phobos__flow-eyebrow">How we work</span>
                                <ol class="hero-phobos__flowsteps">
                                    <li>
                                        <span class="n">01</span>
                                        <span class="t">Understand</span>
                                        <span class="d">What&rsquo;s breaking, and what a good outcome looks like.</span>
                                    </li>
                                    <li>
                                        <span class="n">02</span>
                                        <span class="t">Build</span>
                                        <span class="d">Real screens first, then working software every week.</span>
                                    </li>
                                    <li>
                                        <span class="n">03</span>
                                        <span class="t">Launch</span>
                                        <span class="d">A calm go-live, with your team trained on it.</span>
                                    </li>
                                </ol>
                            </div>
                        </a>
                        <div class="hero-phobos__card">
                            <div class="hero-phobos__card-body">
                                <span class="hero-phobos__card-num">30 days</span>
                                <span class="hero-phobos__card-label">Post-launch support included, then a retainer only if you want one.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-phobos__badge" aria-hidden="true">
                <svg viewBox="0 0 100 100">
                    <defs><path id="heroBadgeCirc" d="M50,50 m-36,0 a36,36 0 1,1 72,0 a36,36 0 1,1 -72,0"/></defs>
                    <text><textPath href="#heroBadgeCirc">SHIFTTECH + EST. 2025 + SENIOR-LED + </textPath></text>
                </svg>
            </div>
        </div>

        <div class="hero-phobos__bar rise">
            <p>Trusted by regional leaders in fintech, healthcare &amp; logistics</p>
            <ul class="hero-phobos__logos" aria-label="Clients">
                @foreach ($logos as $logo)
                    <li><img src="{{ asset($logo['src']) }}" alt="{{ $logo['alt'] }}" loading="lazy"></li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- Mobile-only sticky re-entry CTA — appears once the hero scrolls out of view --}}
    <div class="mobile-sticky-cta" id="mobileStickyCta">
        <a href="{{ $contact }}" class="btn btn-lime">Book a discovery call &rarr;</a>
    </div>

    {{-- ==================== WHAT WE BUILD — Phobos "EXPERTISE" style: a row of
         vertical colour-block panels, one per capability. Collapsed = a rotated
         monospace label; the first is open by default and any panel expands on
         hover while the rest compress (pure CSS). ============================= --}}
    <section class="section section--build" id="services">
        <div class="container">
            <div class="build-head reveal">
                <div class="build-head__text">
                    <span class="build-head__eyebrow">Expertise</span>
                    <h2 class="build-head__title">Complex problems.<br>Dependable outcomes.</h2>
                </div>
                <a class="build-head__cta" href="{{ $contact }}">Book a discovery call</a>
            </div>

            <div class="build-panels reveal">
                @foreach ($services as $i => $s)
                    <a href="{{ $s['href'] }}" class="build-panel build-panel--{{ $i }}">
                        <span class="build-panel__mark" aria-hidden="true">+</span>
                        <span class="build-panel__name">{{ $s['title'] }}</span>
                        <span class="build-panel__label">{{ $s['title'] }}</span>
                        <span class="build-panel__reveal">
                            <span class="build-panel__reveal-body">{{ $s['body'] }}</span>
                            <span class="build-panel__explore">Explore</span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== CASE STUDIES — Phobos "PROOF IS IN THE DOING.":
         a photo-led featured study with an overlapping tinted panel, then a
         row of flat colour-block child cards. ============================== --}}
    <section class="section section--studies" id="case-studies">
        <div class="container">
            <div class="studies-head reveal">
                <div class="studies-head__text">
                    <span class="studies-head__eyebrow">Case studies</span>
                    <h2 class="studies-head__title">Proof is in the doing.</h2>
                </div>
                <a class="studies-head__cta" href="{{ url('/work') }}">All studies</a>
            </div>

            <div class="studies-showcase reveal">
                <a href="{{ $studyFeatured['href'] }}" class="studies-featured">
                    <div class="studies-featured__media" aria-hidden="true">
                        <picture>
                            <source srcset="{{ asset($studyFeatured['img'] . '.webp') }}" type="image/webp">
                            <img src="{{ asset($studyFeatured['img'] . '.jpg') }}" alt="{{ $studyFeatured['alt'] }}" loading="lazy">
                        </picture>
                    </div>
                    <div class="studies-featured__panel">
                        <span class="studies-chip">{{ $studyFeatured['chip'] }}</span>
                        <h3 class="studies-featured__title">{{ $studyFeatured['title'] }}</h3>
                        <p class="studies-featured__body">{{ $studyFeatured['body'] }}</p>
                        <span class="studies-featured__more">Read more</span>
                    </div>
                </a>

                <div class="studies-grid">
                    @foreach ($studyGrid as $c)
                        <a href="{{ $c['href'] }}" class="study-card study-card--{{ $c['tone'] }}">
                            <span class="studies-chip">{{ $c['chip'] }}</span>
                            <h3 class="study-card__title">{{ $c['title'] }}</h3>
                            <span class="study-card__more">Read more</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== TESTIMONIALS — Phobos language: a bento mosaic of
         flat colour-block quote cards. One oversized hero quote (its highlight
         phrase set as a big Archivo pull-quote) + five smaller cards. Static. --}}
    <section class="section section--value" id="value">
        <div class="container">
            <div class="value-head reveal">
                <div class="value-head__text">
                    <span class="value-head__eyebrow">What changes</span>
                    <h2 class="value-head__title">What you actually get.</h2>
                </div>
                <a class="value-head__cta" href="{{ $contact }}">Book a discovery call</a>
            </div>

            @php
                // Each value is backed by a verbatim fragment from the real
                // client testimonial above, so the claim and the proof stay
                // attached to each other.
                $valueProps = [
                    [
                        'title' => 'Manual admin disappears',
                        'body'  => 'Paper trails, spreadsheets and double capture get replaced by one system your team actually uses.',
                        'proof' => 'simplified operations and reduced manual work',
                        'who'   => 1,
                    ],
                    [
                        'title' => 'Revenue you can see',
                        'body'  => 'Inventory, quotes and sales tracked in one place, so you know what is working long before month end.',
                        'proof' => 'Sales are up 40% since launch',
                        'who'   => 3,
                    ],
                    [
                        'title' => 'Shipped faster than in-house',
                        'body'  => 'Senior engineers and working software every week, instead of a silent build you only see at the end.',
                        'proof' => 'delivered it 4× faster than our internal estimates',
                        'who'   => 2,
                    ],
                    [
                        'title' => 'Compliance handled',
                        'body'  => 'Security and regulatory requirements designed in from the start, not bolted on once you are live.',
                        'proof' => 'from PCI-DSS requirements to real-time transaction monitoring',
                        'who'   => 0,
                    ],
                ];
            @endphp

            <div class="value-grid reveal">
                @foreach ($valueProps as $v)
                    @php $t = $testimonials[$v['who']]; @endphp
                    <article class="value-card">
                        <h3 class="value-card__title">{{ $v['title'] }}</h3>
                        <p class="value-card__body">{{ $v['body'] }}</p>
                        <figure class="value-card__proof">
                            <blockquote>&ldquo;{{ $v['proof'] }}&rdquo;</blockquote>
                            <figcaption>
                                <span class="value-card__who">{{ $t['name'] }}</span>
                                <span class="value-card__role">{{ $t['role'] }}</span>
                            </figcaption>
                        </figure>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== STATISTICS ==================== --}}
    <section class="section section--stats" id="stats">
        <div class="container">
            <div class="stats-row reveal">
                @foreach ($stats as $stat)
                    <div class="stat">
                        <span class="stat-num" data-count="{{ $stat['num'] }}">{{ $stat['num'] }}</span>
                        <span class="stat-label">{{ $stat['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== CTA BAND (Phobos "PARTNERING TO BUILD…" — flat
         pine block + "+" registration marks; no halftone). Mid-page ask, placed
         after the proof cluster (studies + testimonials + stats). =========== --}}
    <section class="section section--cta-band">
        <div class="cta-band__inner reveal">
            <span class="cta-band__marks" aria-hidden="true"></span>
            <h2 class="cta-band__title">Partnering to build systems that last</h2>
            <p class="cta-band__sub">Whether you're starting something new or fixing what exists, you work with the senior engineer who stays on it.</p>
            <a class="cta-band__cta" href="{{ $contact }}">Book a discovery call</a>
            <p class="cta-reassure cta-reassure--onpine">Free &middot; 30 minutes &middot; reply within 24 hours &middot; no sales pressure</p>
        </div>
    </section>

    {{-- ==================== OUR APPROACH — Phobos "THINK OUTSIDE THE BOX":
         a bordered 3-column grid, each cell a numbered phase with a stroke-only
         line-art diagram framed by corner brackets. ======================== --}}
    <section class="section section--approach" id="process">
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

    {{-- ==================== FOUNDER ==================== --}}
    {{-- Parked for now — keep the markup for a later pass (needs a Phobos-style
         restyle before it goes back on the page). Re-enable by removing the
         @if (false) / @endif wrapper below. --}}
    @if (false)
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

                <p class="founder-sign"><b>Prosper Tinarwo</b> · Founder &amp; Lead Engineer, ShiftTech</p>
                <div class="founder-cta">
                    <x-site.btn :href="$contact" variant="lime">Book a discovery call</x-site.btn>
                    {{-- Personal profile, not the company page. This button sits
                         under the founder's signature, so it reads as his. --}}
                    <x-site.btn href="https://www.linkedin.com/in/prosper-tinarwo-a540b0b0/" variant="ghost-pine" target="_blank" rel="noopener noreferrer">LinkedIn</x-site.btn>
                </div>
            </div>

        </div>
    </section>
    @endif

    {{-- ==================== FINAL CTA — Phobos "SAY HELLO." — pine block,
         oversized pink caps, framed by pink "+" registration marks. Scoped to
         .section--say-hello; the shared .final / .final-* rules are untouched. --}}
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
                <span>Cape Town · Harare</span>
            </div>
        </div>
    </section>

    {{-- ==================== FAQ — Phobos "CAREERS" treatment: a scroll-pinned
         stepper. The left heading stays put while the right panel's active card
         cycles through the questions as you scroll, with a progress readout.
         Degrades to a plain readable list without JS / with reduced motion. --}}
    <section class="section section--faq-stepper" id="faq" data-faq-stepper style="--faq-count: {{ count($faqs) }}; --faq-track: {{ (count($faqs) * 55) + 45 }}vh;">
        <div class="container faq-stepper__grid">
            <div class="faq-stepper__head reveal">
                <span class="faq-stepper__eyebrow">FAQ</span>
                <h2 class="faq-stepper__title">Questions,<br>straight answers.</h2>

                <figure class="faq-stepper__figure">
                    <picture>
                        <source srcset="{{ asset('assets/images/team/prosper.webp') }}" type="image/webp">
                        <img src="{{ asset('assets/images/team/prosper.jpg') }}" alt="Prosper, founder of ShiftTech" width="900" height="900" loading="lazy">
                    </picture>
                    <figcaption>You're talking to the engineer who builds it, not a call centre.</figcaption>
                </figure>
            </div>

            <div class="faq-stepper__panel">
                <ol class="faq-steps">
                    @foreach ($faqs as $i => $faq)
                        <li class="faq-step{{ $i === 0 ? ' is-active' : '' }}">
                            <div class="faq-step__head">
                                <span class="faq-step__num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="faq-step__q">{{ $faq['q'] }}</span>
                                <span class="faq-step__mark" aria-hidden="true">+</span>
                            </div>
                            <div class="faq-step__body"><p>{{ $faq['a'] }}</p></div>
                        </li>
                    @endforeach
                </ol>
                <div class="faq-steps__foot" aria-hidden="true">
                    <span class="faq-steps__pct" data-faq-pct>0%</span>
                    <span class="faq-steps__bar"><i></i></span>
                </div>
            </div>
        </div>
    </section>

    @if ($insights->isNotEmpty())
    {{-- ==================== INSIGHTS — Phobos "OUR LATEST THINKING.": a 2-up
         grid of the latest posts, each a flat colour-block cover (category +
         line-art) with the headline and "+ read more" below. Nurture/SEO tail —
         placed after the final CTA so it doesn't pull clicks mid-funnel. ==== --}}
    <section class="section section--insights" id="insights">
        <div class="container">
            <div class="insights-head reveal">
                <div class="insights-head__text">
                    <span class="insights-head__eyebrow">Insights</span>
                    <h2 class="insights-head__title">Our latest thinking.</h2>
                </div>
                <a class="insights-head__cta" href="{{ url('/blog') }}">More insights</a>
            </div>

            <div class="insights-grid reveal">
                @foreach ($insights as $post)
                    <a href="{{ route('blog.show', $post) }}" class="insight-card insight-card--{{ $loop->index % 2 }}">
                        <span class="insight-card__cover">
                            <span class="insight-card__cat">{{ $post->category }}</span>
                            <span class="insight-card__fig" aria-hidden="true">{!! $insightFigures[$loop->index % 2] !!}</span>
                        </span>
                        <span class="insight-card__title">{{ $post->title }}</span>
                        <span class="insight-card__more">Read more</span>
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
    // Match the hero by its base class, not a layout modifier — the modifier
    // changed with the Phobos restyle (.hero--framed -> .hero--phobos) and the
    // old selector silently disabled this bar on every mobile visit.
    var heroEl = document.querySelector('main .hero');
    if (!stickyBar || !heroEl) return;

    // The final CTA already puts a full-size button on screen, so hide the bar
    // once it's in view rather than covering it.
    var finalCta = document.getElementById('contact');

    var queued = false;
    var update = function () {
        queued = false;
        var pastHero = heroEl.getBoundingClientRect().bottom < 0;
        var atFinalCta = finalCta
            ? finalCta.getBoundingClientRect().top < window.innerHeight
            : false;
        stickyBar.classList.toggle('is-visible', pastHero && !atFinalCta);
    };
    var onScroll = function () {
        if (!queued) { queued = true; requestAnimationFrame(update); }
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
    update();
})();
</script>
@endpush
