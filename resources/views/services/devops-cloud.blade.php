@extends('layouts.site')

@section('title', 'DevOps & Cloud Infrastructure in Cape Town | ShiftTech')
@section('meta_description', 'Deployment pipelines, monitoring, and cloud infrastructure for Cape Town and Harare businesses that keep your systems running and let you ship without holding your breath.')
@section('body_class', 'has-dark-hero')

@php
    $contact = url('/contact');

    $capabilityAreas = [
        [
            'label' => 'Infrastructure',
            'items' => [
                'Cloud environments on AWS, Azure, or GCP, sized for what you actually need',
                'Infrastructure set up so it can be rebuilt from scratch, not clicked together by hand',
                'Staging environments that actually match production, not a rough approximation',
                'Cost reviewed regularly, so you\'re not quietly paying for capacity nobody uses',
            ],
        ],
        [
            'label' => 'Deployment',
            'items' => [
                'Automated pipelines, so shipping is a routine event, not a stressful one',
                'Every release gated by automated checks before it reaches production',
                'A rollback plan for every release, not just the risky ones',
                'Deployments that don\'t require taking the system down first',
            ],
        ],
        [
            'label' => 'Monitoring',
            'items' => [
                'Real-time visibility into uptime, errors, and performance',
                'Alerts that reach a person before your customers notice something\'s wrong',
                'Logs centralised and searchable, instead of scattered across servers',
                'Dashboards built for your team, not a generic tool nobody opens',
            ],
        ],
        [
            'label' => 'Security',
            'items' => [
                'Access locked down to the people who actually need it',
                'Secrets and credentials kept out of code and version control',
                'Dependencies and infrastructure patched on a schedule, not when something breaks',
                'A documented plan for what happens if something does go wrong',
            ],
        ],
    ];

    $pipeline = [
        ['n' => '01', 'title' => 'Audit', 'body' => 'We review your current infrastructure and deployment process to find what\'s fragile, manual, or quietly expensive.'],
        ['n' => '02', 'title' => 'Design', 'body' => 'A cloud architecture and pipeline sized for your actual traffic, not a generic best-practice template.'],
        ['n' => '03', 'title' => 'Automate', 'body' => 'Deployment pipelines and infrastructure-as-code, so environments are reproducible and releases are routine.'],
        ['n' => '04', 'title' => 'Monitor', 'body' => 'Uptime, error, and performance monitoring wired in from day one, with alerts that reach a real person.'],
        ['n' => '05', 'title' => 'Harden', 'body' => 'Access control, secrets management, and a patching schedule, so security isn\'t a one-time setup step.'],
        ['n' => '06', 'title' => 'Support', 'body' => 'Ongoing infrastructure support so your system keeps running as your traffic and team both grow.'],
    ];

    $faqs = [
        ['q' => 'Do we need to migrate everything to the cloud at once?', 'a' => "No. Most engagements start with the highest-risk or most expensive part of your infrastructure and move in phases. A full migration only happens if it's genuinely the right call for your business, not because it's the default answer."],
        ['q' => 'What happens if something goes down at 2am?', 'a' => "Monitoring and alerting are set up so the right person gets notified before your customers do, and every system we manage has a documented rollback plan. What happens next depends on the support arrangement we agree on, we'll walk you through the options honestly rather than assume you need the most expensive one."],
        ['q' => 'How much does this cost, and is it a fixed fee?', 'a' => "It depends on the size of your infrastructure and whether it's a one-time setup or ongoing management. Setup work is usually a fixed price once we've audited what you have. Ongoing monitoring and support runs as a retainer sized to your system, agreed upfront, not billed by surprise."],
        ['q' => 'Can you work with our existing cloud provider and setup?', 'a' => "In most cases, yes. We'd rather improve what's already working than force a switch to a different provider for the sake of it. If your current setup genuinely can't support what you need, we'll tell you plainly and explain why."],
        ['q' => 'Who actually manages our infrastructure day to day?', 'a' => "The engineer who set it up, directly. We're founder-led, so there's no account manager layer between you and the person who understands your system. If something needs attention, you reach the person who can actually fix it."],
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
                    <x-site.eyebrow>DevOps &amp; Cloud</x-site.eyebrow>
                    <h1 class="display-xl hero-headline"><span class="dim">Deploys shouldn't feel like a gamble.</span><br><span class="hl">We make shipping routine.</span></h1>
                    <p class="lede">Cloud infrastructure, deployment pipelines, and monitoring built so releases are boring, in the best possible way.</p>

                    <div class="hero-ctas">
                        <x-site.btn :href="$contact" variant="lime">Book a Free Discovery Call</x-site.btn>
                        <x-site.btn href="#capabilities" :link="true" :arrow="true">See how we build</x-site.btn>
                    </div>
                </div>

                {{-- A simple CI/CD pipeline: commit flowing through build,
                     test, and a highlighted deploy stage, with a cloud above
                     it and a live monitoring pulse. Original SVG, our own
                     palette. --}}
                <div class="hero-tilegrid" aria-hidden="true">
                    <svg viewBox="0 0 480 360" xmlns="http://www.w3.org/2000/svg">
                        {{-- cloud --}}
                        <path d="M255 70a30 30 0 00-4 59.6 26 26 0 0025.4 20.4h70a27 27 0 007-53 37 37 0 00-73-8 30 30 0 00-25.4-19z" fill="rgba(244,242,234,.05)" stroke="rgba(244,242,234,.14)"/>

                        {{-- connectors --}}
                        <g fill="none" stroke="rgba(244,242,234,.18)" stroke-width="2">
                            <path d="M100 220h40"/>
                            <path d="M200 220h40"/>
                            <path d="M340 220h40"/>
                        </g>

                        {{-- Commit --}}
                        <g>
                            <circle cx="70" cy="220" r="30" fill="rgba(244,242,234,.05)" stroke="rgba(244,242,234,.14)"/>
                            <circle cx="70" cy="220" r="7" fill="rgba(244,242,234,.35)"/>
                            <path d="M70 190v23M70 227v23" stroke="rgba(244,242,234,.2)" stroke-width="2"/>
                        </g>

                        {{-- Build --}}
                        <rect x="140" y="192" width="60" height="56" rx="10" fill="rgba(244,242,234,.05)" stroke="rgba(244,242,234,.14)"/>
                        <path d="M158 220l6 6 12-14" stroke="rgba(244,242,234,.4)" stroke-width="2.4" fill="none" stroke-linecap="round" stroke-linejoin="round"/>

                        {{-- Test --}}
                        <rect x="240" y="192" width="60" height="56" rx="10" fill="rgba(244,242,234,.05)" stroke="rgba(244,242,234,.14)"/>
                        <path d="M258 214h24M258 224h24M258 234h14" stroke="rgba(244,242,234,.3)" stroke-width="2.2" stroke-linecap="round"/>

                        {{-- Deploy (highlighted) --}}
                        <g style="filter: drop-shadow(0 0 18px rgba(116,184,18,.5));">
                            <rect x="340" y="184" width="80" height="72" rx="12" fill="#182B10" stroke="#74B812" stroke-width="1.5"/>
                            <path d="M380 202v28M380 202l-11 11M380 202l11 11" stroke="#74B812" stroke-width="2.6" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="358" y="234" width="44" height="6" rx="3" fill="rgba(244,242,234,.35)"/>
                        </g>

                        {{-- monitor pulse --}}
                        <circle cx="380" cy="290" r="4" fill="#74B812">
                            <animate attributeName="opacity" values="1;0.25;1" dur="2s" repeatCount="indefinite"/>
                        </circle>
                        <path d="M380 256v24" stroke="rgba(244,242,234,.18)" stroke-width="2"/>
                        <path d="M355 305h50" stroke="rgba(244,242,234,.14)" stroke-width="1.5"/>
                        <path d="M355 305l6-14 8 22 6-14 6 10 8-18" fill="none" stroke="rgba(244,242,234,.35)" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
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
                <h2 class="display-l">A deploy shouldn't need <strong>someone holding their breath.</strong></h2>

                <div class="why-grid__body">
                    <p class="lede">If shipping a change means one person manually running a checklist at 11pm, your infrastructure isn't supporting your business, it's a liability everyone's quietly working around. And if nobody finds out your system is down until a customer complains, that's not bad luck, that's a monitoring gap.</p>
                    <p class="lede" style="margin-top: 1rem;">Good infrastructure disappears into the background. You notice it when a release goes out without drama, and when an alert reaches someone before your customers do.</p>

                    <blockquote class="founder-pull" style="margin-top: 2rem;">
                        "If deploying your own software makes your team nervous, the problem isn't the team. It's the pipeline."
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== CAPABILITIES ==================== --}}
    <section class="section section--flush-top" id="capabilities">
        <div class="container">
            <x-site.section-head eyebrow="What we cover">Four areas behind reliable infrastructure.</x-site.section-head>

            <p class="lede" style="max-width: 42rem; margin-top: 1.5rem;">Whether we're setting up your infrastructure from scratch or taking over an existing one, every engagement covers these four areas.</p>

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

    {{-- ==================== PIPELINE ==================== --}}
    <section class="section section--flush-top" id="process">
        <div class="container">
            <x-site.section-head eyebrow="How we build it">Six stages, from audit to ongoing support.</x-site.section-head>

            <p class="lede" style="max-width: 42rem; margin-top: 1.5rem;">We start with what you already have. Nothing gets rebuilt from scratch just because it's not how we'd have done it.</p>

            <div class="framework-grid">
                @foreach ($pipeline as $p)
                    <div class="framework-card">
                        <span class="rule-num">{{ $p['n'] }}</span>
                        <h3 class="framework-title">{{ $p['title'] }}</h3>
                        <p>{{ $p['body'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="framework-note">
                <span class="framework-note__label">Beyond the pipeline</span>
                <p>Infrastructure only stays reliable if someone understands it. Everything we set up comes with documentation, so it's never a black box only one person can touch.</p>
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
                    :logo="asset('assets/images/logo/clients/wcbs_header_logo.png')" logo-alt="Western Cape Blood Service"
                    name="Ian" role="Manager, Western Cape Blood Service"
                    highlight="delivered it 4× faster than our internal estimates"
                    :reveal="false"
                >Prosper and the team introduced AI into our workflows and designed a monitoring system for all our background services. They delivered it 4× faster than our internal estimates, with a clean, powerful dashboard that finally gave us real-time visibility. Reliable, efficient, and genuinely easy to work with. We would truly recommend them.</x-site.testimonial>
            </div>

            <div class="section-cta">
                <p>Want infrastructure you don't have to worry about?</p>
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
            <h2><strong>Thirty minutes. No obligation.</strong><br>Just clarity on what your infrastructure actually needs.</h2>
            <p class="lede">Tell us what's breaking, or what you're worried will break next. We'll tell you honestly what it would take to fix it.</p>

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
        { "@type": "ListItem", "position": 2, "name": "DevOps & Cloud Infrastructure", "item": "{{ url('/services/devops-cloud') }}" }
    ]
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "Service",
    "serviceType": "DevOps and Cloud Infrastructure",
    "name": "DevOps & Cloud Infrastructure",
    "description": "Deployment pipelines, monitoring, and cloud infrastructure management.",
    "provider": { "@type": "Organization", "name": "ShiftTech", "url": "{{ url('/') }}" },
    "areaServed": ["ZA", "ZW"],
    "url": "{{ url('/services/devops-cloud') }}"
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
