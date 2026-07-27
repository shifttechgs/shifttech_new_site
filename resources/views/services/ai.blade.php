@extends('layouts.site')

@section('title', 'AI Integrations & Automation in Cape Town | ShiftTech')
@section('meta_description', 'Practical AI built into the software we ship for Cape Town and Harare businesses: writing code, automating busywork, and updating old systems, with a senior engineer making every call. No hype, just substance.')
@section('body_class', 'has-dark-hero')

@php
    $contact = url('/contact');

    $capabilityAreas = [
        [
            'label' => 'Engineering',
            'items' => [
                'Writing code, and safely cleaning up code that already exists',
                'Automatic checks on every change before it even reaches a person',
                'Documentation that stays up to date with the code, automatically',
                'Updating old systems piece by piece, without a full rebuild',
            ],
        ],
        [
            'label' => 'Design',
            'items' => [
                'Fast mockups, so you react to real screens instead of sketches',
                'AI helps generate layout options; a human designer picks and refines the best one',
                'Mapping out how your team actually works, not how a template assumes they do',
                'Chat or voice interfaces, only where they genuinely help your users',
            ],
        ],
        [
            'label' => 'Quality & Testing',
            'items' => [
                'AI helps us test far more of the system than we could by hand',
                'Automatic checks before every release, so old bugs don\'t come back',
                'Reading system logs to catch and recreate bugs faster',
                'Fixing the actual cause of a problem, not just covering the symptom',
            ],
        ],
        [
            'label' => 'Choosing AI Tools',
            'items' => [
                'Picking the right AI tool for the job, not just the newest one',
                'Deciding upfront what data AI is and isn\'t allowed to see',
                'Testing on your real work, not published test scores',
                'Built to fit your existing systems, not bolted on top',
            ],
        ],
    ];

    $framework = [
        ['n' => '01', 'title' => 'Education', 'body' => 'We show your team what these tools can actually do, and where they fall apart. No hype, no fear — just a clear, honest picture.'],
        ['n' => '02', 'title' => 'Alignment', 'body' => "We agree on what AI is and isn't allowed to touch: what data it can see, what decisions it can't make on its own, and what \"good enough\" looks like for your business."],
        ['n' => '03', 'title' => 'Strategy', 'body' => 'We map exactly where AI earns its place in your systems — and where a person still has to make the call.'],
        ['n' => '04', 'title' => 'Solution', 'body' => 'We build it, test it against real cases from your business, and hand it over as a working part of your system, not a demo.'],
    ];

    $rules = [
        ['n' => '01', 'body' => 'AI writes the first draft. A senior engineer decides what ships.'],
        ['n' => '02', 'body' => "If we can't explain it in plain English, it doesn't ship."],
        ['n' => '03', 'body' => "We don't add AI to a product just because we can."],
    ];

    $tools = [
        ['name' => 'Anthropic', 'models' => 'Claude Code · Sonnet · Opus', 'icon' => 'M17.3041 3.541h-3.6718l6.696 16.918H24Zm-10.6082 0L0 20.459h3.7442l1.3693-3.5527h7.0052l1.3693 3.5528h3.7442L10.5363 3.5409Zm-.3712 10.2232 2.2914-5.9456 2.2914 5.9456Z', 'body' => 'AI that helps us write code, review it, and think through hard problems.'],
        ['name' => 'Google', 'models' => 'Gemini · AI Studio · Antigravity', 'icon' => 'M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z', 'body' => 'AI that understands text, images, and code together, across different tools.'],
        ['name' => 'GitHub Copilot', 'models' => null, 'icon' => 'M23.922 16.997C23.061 18.492 18.063 22.02 12 22.02 5.937 22.02.939 18.492.078 16.997A.641.641 0 0 1 0 16.741v-2.869a.883.883 0 0 1 .053-.22c.372-.935 1.347-2.292 2.605-2.656.167-.429.414-1.055.644-1.517a10.098 10.098 0 0 1-.052-1.086c0-1.331.282-2.499 1.132-3.368.397-.406.89-.717 1.474-.952C7.255 2.937 9.248 1.98 11.978 1.98c2.731 0 4.767.957 6.166 2.093.584.235 1.077.546 1.474.952.85.869 1.132 2.037 1.132 3.368 0 .368-.014.733-.052 1.086.23.462.477 1.088.644 1.517 1.258.364 2.233 1.721 2.605 2.656a.841.841 0 0 1 .053.22v2.869a.641.641 0 0 1-.078.256Zm-11.75-5.992h-.344a4.359 4.359 0 0 1-.355.508c-.77.947-1.918 1.492-3.508 1.492-1.725 0-2.989-.359-3.782-1.259a2.137 2.137 0 0 1-.085-.104L4 11.746v6.585c1.435.779 4.514 2.179 8 2.179 3.486 0 6.565-1.4 8-2.179v-6.585l-.098-.104s-.033.045-.085.104c-.793.9-2.057 1.259-3.782 1.259-1.59 0-2.738-.545-3.508-1.492a4.359 4.359 0 0 1-.355-.508Zm2.328 3.25c.549 0 1 .451 1 1v2c0 .549-.451 1-1 1-.549 0-1-.451-1-1v-2c0-.549.451-1 1-1Zm-5 0c.549 0 1 .451 1 1v2c0 .549-.451 1-1 1-.549 0-1-.451-1-1v-2c0-.549.451-1 1-1Zm3.313-6.185c.136 1.057.403 1.913.878 2.497.442.544 1.134.938 2.344.938 1.573 0 2.292-.337 2.657-.751.384-.435.558-1.15.558-2.361 0-1.14-.243-1.847-.705-2.319-.477-.488-1.319-.862-2.824-1.025-1.487-.161-2.192.138-2.533.529-.269.307-.437.808-.438 1.578v.021c0 .265.021.562.063.893Zm-1.626 0c.042-.331.063-.628.063-.894v-.02c-.001-.77-.169-1.271-.438-1.578-.341-.391-1.046-.69-2.533-.529-1.505.163-2.347.537-2.824 1.025-.462.472-.705 1.179-.705 2.319 0 1.211.175 1.926.558 2.361.365.414 1.084.751 2.657.751 1.21 0 1.902-.394 2.344-.938.475-.584.742-1.44.878-2.497Z', 'body' => 'AI that suggests code as we type, like a very fast assistant sitting next to you.'],
    ];

    $faqs = [
        ['q' => 'How fast can AI actually get me a working MVP?', 'a' => "We typically begin discovery within 48 hours of signing, and for MVPs we can have a working prototype in 1 to 2 weeks. AI is a real part of how we hit that timeline: it drafts repetitive code and expands test coverage fast, while a senior engineer still reviews and owns every line that ships."],
        ['q' => 'Will AI replace my dev team?', 'a' => "No. AI speeds up repetitive code, test coverage, and first drafts. Every decision, and every line that ships, is reviewed by a senior engineer. Think of it as a very fast junior developer: useful, but somebody still has to sign off on their work."],
        ['q' => 'Is my data safe if you use AI tools?', 'a' => "Yes. We use reputable providers under their standard data-handling terms, and we never send client credentials, secrets, or sensitive production data through a model unless you've explicitly approved that specific use case."],
        ['q' => 'Do you build AI features into what you ship, or just use AI to build faster?', 'a' => "Both, depending on what your business actually needs. Sometimes AI belongs in your product: a chatbot, a document processor, a smart search. Sometimes it just belongs in our workflow, so you get a better system faster for the same budget. We'll tell you honestly which one applies."],
        ['q' => "What if I don't want AI anywhere near my product?", 'a' => "Completely fine. Some clients want zero AI-facing features for their end users, and that's a legitimate choice we respect. We can still use AI internally to speed up our own delivery without it ever touching your product or your users."],
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
                    <x-site.eyebrow>AI Integrations</x-site.eyebrow>
                    <h1 class="display-xl hero-headline"><span class="dim">AI writes code faster.</span><br><span class="hl">We still read every line.</span></h1>
                    <p class="lede">Claude, Gemini, and Copilot generate the first draft. A senior engineer reviews every line before it ships.</p>

                    <div class="hero-ctas">
                        <x-site.btn :href="$contact" variant="lime">Book a Free Discovery Call</x-site.btn>
                        <x-site.btn href="#capabilities" :link="true" :arrow="true">See where it fits</x-site.btn>
                    </div>
                </div>

                {{-- Isometric tile floor + one raised, glowing block, standing
                     in for the line a senior engineer catches before it ships.
                     Recolored in-house to our lime-on-pine palette (hue/tone
                     remapped from the source render; composition unchanged). --}}
                <div class="hero-tilegrid" aria-hidden="true">
                    <picture>
                        <source srcset="{{ asset('assets/images/shapes/ai-hero-tilegrid.webp') }}" type="image/webp">
                        <img src="{{ asset('assets/images/shapes/ai-hero-tilegrid.png') }}" alt="" width="1024" height="985" loading="eager">
                    </picture>
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
                <h2 class="display-l">AI is only as good as <strong>the engineer reviewing it.</strong></h2>

                <div class="why-grid__body">
                    <p class="lede">Ask a model to build a feature and it will generate something that runs, looks plausible, and quietly breaks under real traffic — or exposes data it shouldn't. It doesn't know your compliance rules, the unusual situations your business runs into, or which shortcuts cost you in eighteen months.</p>
                    <p class="lede" style="margin-top: 1rem;">We do. Every piece of AI-generated code goes through the same review a human-written pull request would get, because the model doesn't carry the risk when something breaks in production. We do.</p>

                    <blockquote class="founder-pull" style="margin-top: 2rem;">
                        "If we can't explain why a piece of AI-generated code is safe to ship, it doesn't ship. That's not a policy on a slide — it's just how we work."
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== HOW AI AUGMENTS OUR WORK ==================== --}}
    <section class="section section--flush-top" id="capabilities">
        <div class="container">
            <x-site.section-head eyebrow="Where it fits">Four places AI actually shows up in our work.</x-site.section-head>

            <p class="lede" style="max-width: 42rem; margin-top: 1.5rem;">AI gives us more capacity to move faster. What actually gets built and shipped is still decided by a person on our team — not a model.</p>

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

    {{-- ==================== ADOPTION FRAMEWORK ==================== --}}
    <section class="section section--flush-top">
        <div class="container">
            <x-site.section-head eyebrow="How we bring it in">The ShiftTech AI Adoption Framework</x-site.section-head>

            <p class="lede" style="max-width: 42rem; margin-top: 1.5rem;">Four steps we run before AI touches anything you ship.</p>

            <div class="framework-grid">
                @foreach ($framework as $f)
                    <div class="framework-card">
                        <span class="rule-num">{{ $f['n'] }}</span>
                        <h3 class="framework-title">{{ $f['title'] }}</h3>
                        <p>{{ $f['body'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="framework-note">
                <span class="framework-note__label">Beyond the tooling</span>
                <p>Bringing in AI changes more than your stack — it changes who reviews what, and how decisions get made day to day. We walk your team through that shift as part of the engagement, not as an afterthought bolted on at the end.</p>
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
                <p>Want a result like this for your systems?</p>
                <x-site.btn :href="$contact" variant="lime">Book a Free Discovery Call</x-site.btn>
            </div>
        </div>
    </section>

    {{-- ==================== OUR RULE FOR AI ==================== --}}
    <section class="section section--flush-top">
        <div class="container">
            <x-site.section-head eyebrow="Our rule for AI">Three lines we <strong>don't cross.</strong></x-site.section-head>

            <div class="rules-grid">
                @foreach ($rules as $r)
                    <div class="rule-item">
                        <span class="rule-num">{{ $r['n'] }}</span>
                        <p>{{ $r['body'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== TOOLS WE ACTUALLY USE ==================== --}}
    <section class="section section--flush-top">
        <div class="container">
            <x-site.section-head eyebrow="What we build with">What we actually build with.</x-site.section-head>

            <p class="lede" style="max-width: 42rem; margin-top: 1.5rem;">Three tools, chosen for fit — not a logo wall of everything on the market.</p>

            <div class="tools-grid">
                @foreach ($tools as $t)
                    <div class="tool-item">
                        <span class="tool-logo" aria-hidden="true"><svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="{{ $t['icon'] }}"/></svg></span>
                        <div class="tool-item__head">
                            <h3>{{ $t['name'] }}</h3>
                            @if ($t['models'])
                                <span class="tool-item__models">{{ $t['models'] }}</span>
                            @endif
                        </div>
                        <p>{{ $t['body'] }}</p>
                    </div>
                @endforeach
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
            <h2><strong>Thirty minutes. No obligation.</strong><br>Just clarity on where AI actually helps.</h2>
            <p class="lede">Tell us what's slowing your business down. We'll tell you honestly whether AI is part of the fix — and what it would take.</p>

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
        { "@type": "ListItem", "position": 2, "name": "AI Integrations & Automation", "item": "{{ url('/services/ai') }}" }
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
