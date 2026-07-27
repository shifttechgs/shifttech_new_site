@extends('layouts.site')

@section('title', 'Our Work | ShiftTech')
@section('meta_description', 'Real projects for real businesses — web apps, mobile apps, and custom software still running in production today.')
@section('body_class', 'has-dark-hero')

@php
    $contact = url('/contact');

    $projects = [
        [
            'title' => 'Luminii CRM',
            'client_name' => 'UseLuminii',
            'service_type' => 'web-app',
            'service_label' => 'Web Application',
            'industry' => 'SaaS',
            'value_proposition' => 'The CRM module inside the Luminii platform: leads, client records, and follow-ups in one place instead of scattered across spreadsheets and someone\'s memory. Built first for ShiftTech\'s own operations, then opened up for other businesses to run their pipeline on.',
            'featured_image' => 'luminii.png',
            'image_fit' => 'cover',
            'technologies' => ['Angular', 'C#', 'SQL'],
        ],
        [
            'title' => 'zimAlert Emergency Response',
            'client_name' => 'zimAlert',
            'service_type' => 'mobile-app',
            'service_label' => 'Mobile Application',
            'industry' => 'Healthcare',
            'value_proposition' => 'Emergency contacts previously had no way to see where help actually was. We built a mobile app with live location sharing, so responders and the people waiting on them are looking at the same picture in real time, not guessing over a phone call.',
            'featured_image' => 'zimAlert.png',
            'image_fit' => 'cover',
            'technologies' => ['Flutter', 'C#', 'Firebase', 'SQL'],
        ],
        [
            'title' => 'PayHouse Finance Platform',
            'client_name' => 'PayHouse',
            'service_type' => 'web-app',
            'service_label' => 'Web Application',
            'industry' => 'Fintech',
            'value_proposition' => 'Loan applications were being processed by hand, with compliance checks slowing everything further. We digitised the full application flow and built in the security fintech actually requires, PCI-DSS handling and real-time transaction monitoring included, so approvals move faster without cutting corners on trust.',
            'featured_image' => 'pay.png',
            'image_fit' => 'cover',
            'technologies' => ['Laravel', 'PHP', 'MySQL'],
        ],
        [
            'title' => 'Vision Plus Wealth Management',
            'client_name' => 'Vision Plus Wealth',
            'service_type' => 'website',
            'service_label' => 'Website',
            'industry' => 'Finance',
            'value_proposition' => 'The old site buried what Vision Plus Wealth actually offered behind generic finance-site boilerplate, and their loan application process ran entirely by hand. We rebuilt the site around a clear service story and automated the application flow, so it\'s fast, secure, and seamless for the team and the client on both ends.',
            'featured_image' => 'vwp.png',
            'image_fit' => 'cover',
            'technologies' => ['Laravel', 'PHP', 'MySQL'],
        ],
        [
            'title' => 'BSL Auction Services',
            'client_name' => 'BSL',
            'service_type' => 'web-app',
            'service_label' => 'Web Application',
            'industry' => 'E-commerce',
            'value_proposition' => 'BSL was running auctions on paper trails and manual admin, which meant every sale meant more filing. We built them a public auction website plus an admin platform to manage listings, bids, and records in one place, so operations run on the system instead of around it.',
            'featured_image' => 'bsl-admin.png',
            'has_webp' => true,
            'technologies' => ['Laravel', 'PHP', 'MySQL'],
        ],
        [
            'title' => 'Lifestyle Laundry',
            'client_name' => 'Lifestyle Laundry',
            'service_type' => 'mobile-app',
            'service_label' => 'Mobile Application',
            'industry' => 'Services',
            'value_proposition' => 'Booking a laundry pickup meant a phone call and hoping someone remembered. We built a mobile app covering the whole loop, book a pickup, pay in-app, and track the order status, so customers don\'t have to chase updates and the business isn\'t fielding "where\'s my order" calls all day.',
            'featured_image' => 'lifestyle.png',
            'image_fit' => 'cover',
            'technologies' => ['Flutter', 'Firebase', 'Stripe', 'C#', 'SQL'],
        ],
        [
            'title' => 'Luminii SaaS Platform',
            'client_name' => 'UseLuminii',
            'service_type' => 'custom-software',
            'service_label' => 'Custom Software',
            'industry' => 'SaaS',
            'value_proposition' => 'The full Luminii platform, built out from the CRM into a multi-tenant SaaS product other businesses can run their own operations on: leads, quotes, invoicing, and job scheduling in one system instead of five disconnected tools stitched together with copy-paste.',
            'featured_image' => 'luminii-saas-site.png',
            'has_webp' => true,
            'technologies' => ['Angular', 'C#', 'SQL'],
        ],
        [
            'title' => 'Peekaboo Daycare',
            'client_name' => 'Peekaboo Daycare & Preschool',
            'service_type' => 'web-app',
            'service_label' => 'Web Application',
            'industry' => 'Education',
            'value_proposition' => 'Twenty years in business and almost no presence online, which meant parents searching for a daycare couldn\'t find them, and once a child was enrolled, admissions ran entirely on paper. We built a site that actually shows up in search and an admissions dashboard that replaced the paper trail with something the staff could run day to day.',
            'featured_image' => 'peekaboo-site.png',
            'has_webp' => true,
            'technologies' => ['Laravel', 'PHP', 'MySQL'],
        ],
        [
            'title' => 'SpringKleaners',
            'client_name' => 'SpringKleaners',
            'service_type' => 'website',
            'service_label' => 'Website',
            'industry' => 'Home Services',
            'value_proposition' => 'Visitors landing on the old site had no way to know what a clean would cost or whether SpringKleaners even served their suburb, so most left without booking. We built an instant quote tool and a suburb-based booking flow, so a visitor can go from "how much" to "booked" without a phone call in between.',
            'featured_image' => 'springkleaners-site.png',
            'has_webp' => true,
            'technologies' => ['Laravel', 'PHP', 'MySQL'],
        ],
        [
            'title' => 'Ribbon Plumbing',
            'client_name' => 'Ribbon Plumbing',
            'service_type' => 'website',
            'service_label' => 'Website',
            'industry' => 'Home Services',
            'value_proposition' => 'A burst pipe at midnight doesn\'t wait for office hours, but the old site gave visitors nothing to do outside them except leave. We built an instant quote request flow that works any hour, so an emergency call becomes a submitted request in minutes instead of a missed enquiry until morning.',
            'featured_image' => 'ribbon-plumbing-site.png',
            'has_webp' => true,
            'technologies' => ['Laravel', 'PHP', 'MySQL'],
        ],
    ];
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
                                <h3 class="project-card__title">{{ $project['title'] }}</h3>
                                <p class="project-card__client">{{ $project['client_name'] }}</p>
                                <p class="project-card__value">{{ $project['value_proposition'] }}</p>
                                <div class="project-card__tech">
                                    @foreach ($project['technologies'] as $tech)
                                        <span class="tech-badge">{{ $tech }}</span>
                                    @endforeach
                                </div>
                                <div class="project-card__cta">
                                    <x-site.btn :href="$contact" :link="true" :arrow="true">Start a project like this</x-site.btn>
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
