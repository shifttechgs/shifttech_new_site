@extends('layouts.site')

@section('title', 'Insights | ShiftTech')
@section('meta_description', 'Real breakdowns from projects we\'ve shipped: engineering decisions, AI integrations, and what building software for real businesses actually looks like.')
@section('body_class', 'has-dark-hero')

@php
    $contact = url('/contact');
@endphp

@section('content')
<main id="main">
    <div class="rails" aria-hidden="true"></div>

    {{-- ==================== HERO (dark) ==================== --}}
    <section class="hero hero--dark">
        <div class="container">
            <div style="max-width: 40rem;">
                <x-site.eyebrow>Insights</x-site.eyebrow>
                <h1 class="display-xl hero-headline"><span class="dim">Notes from actually shipping</span><br><span class="hl">software, not just writing about it.</span></h1>
                <p class="lede">Real breakdowns from projects we've shipped: engineering decisions, AI integrations, and what building software for real businesses actually looks like.</p>
            </div>
        </div>
    </section>

    {{-- ==================== POST LIST / EMPTY STATE ==================== --}}
    <section class="section section--flush-top" style="padding-bottom: calc(var(--section-pad) + 6rem);">
        <div class="container">
            @if ($posts->isEmpty())
                <div style="max-width: 34rem; text-align: center; margin-inline: auto; padding: 2rem 0;">
                    <h2 class="display-l" style="margin-inline: auto;">Coming soon.</h2>
                    <p class="lede" style="margin-inline: auto;">We're writing up how we build: real project breakdowns, lessons from shipping, and notes on custom software and AI automation. Nothing here yet, but it's on the way.</p>
                    <div style="margin-top: 2rem;">
                        <x-site.btn :href="$contact" variant="lime">Book a Free Discovery Call</x-site.btn>
                    </div>
                </div>
            @else
                @php
                    $featured = $posts->onFirstPage() ? $posts->first() : null;
                    $rest = $featured ? $posts->slice(1) : $posts->getCollection();
                @endphp

                @if ($featured)
                    <article class="post-feature reveal">
                        <a href="{{ route('blog.show', $featured) }}" class="post-feature__media">
                            <img src="{{ $featured->cover_url }}" alt="{{ $featured->title }}" loading="eager">
                        </a>
                        <div>
                            <span class="post-feature__category">{{ $featured->category }}</span>
                            <h2 class="post-feature__title"><a href="{{ route('blog.show', $featured) }}">{{ $featured->title }}</a></h2>
                            @if ($featured->excerpt)
                                <p class="post-feature__excerpt">{{ $featured->excerpt }}</p>
                            @endif
                            <span class="post-feature__cta"><x-site.btn href="{{ route('blog.show', $featured) }}" :link="true" :arrow="true">Read more</x-site.btn></span>
                        </div>
                    </article>
                @endif

                <div class="post-grid">
                    @foreach ($rest as $post)
                        <a href="{{ route('blog.show', $post) }}" class="post-card reveal">
                            <span class="post-card__media">
                                <img src="{{ $post->cover_url }}" alt="{{ $post->title }}" loading="lazy">
                            </span>
                            <span class="post-card__category">{{ $post->category }}</span>
                            <h2 class="post-card__title">{{ $post->title }}</h2>
                        </a>
                    @endforeach
                </div>

                @if ($posts->hasPages())
                    <div style="display: flex; justify-content: space-between; margin-top: 3rem;">
                        @if ($posts->onFirstPage())
                            <span></span>
                        @else
                            <x-site.btn href="{{ $posts->previousPageUrl() }}" :link="true">&larr; Newer posts</x-site.btn>
                        @endif

                        @if ($posts->hasMorePages())
                            <x-site.btn href="{{ $posts->nextPageUrl() }}" :link="true" :arrow="true">Older posts</x-site.btn>
                        @endif
                    </div>
                @endif
            @endif
        </div>
    </section>

    {{-- ==================== FINAL CTA ==================== --}}
    <section class="section final" id="contact">
        <div class="container">
            <x-site.eyebrow>Next step</x-site.eyebrow>
            <h2><strong>Thirty minutes. No obligation.</strong><br>Just clarity on your next system.</h2>
            <p class="lede">Tell us what's slowing your business down. We'll tell you honestly whether software can fix it and what it would take.</p>

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
                <span>Cape Town &middot; Harare</span>
            </div>
        </div>
    </section>

</main>
@endsection
