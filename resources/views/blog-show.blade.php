@extends('layouts.site')

{{-- meta_title, when a post sets one, is the complete title tag: the headline
     a post wants on the page is not always the title it wants in a result. --}}
@section('title', $post->meta_title ?: $post->title . ' | ShiftTech Insights')
@section('meta_description', $post->meta_description ?: $post->excerpt)
{{-- Without these the layout falls back to its site-wide defaults, so every
     post was sharing as "ShiftTech, Software that runs your business" with
     og:type "website". The headline, not meta_title, is the better social
     card: a share does not need the site name appended to it twice. --}}
@section('og_title', $post->title)
@section('og_type', 'article')
@section('body_class', 'is-blog')

@php
    $contact = url('/contact');
    $faqs    = $post->valid_faqs;
@endphp

@section('content')
<main id="main">
    <div class="rails" aria-hidden="true"></div>

    <section class="section" style="padding-top: calc(72px + clamp(2.5rem, 5vw, 4rem));">
        <div class="container">
            <div style="max-width: 42rem; margin-inline: auto; margin-bottom: 2.5rem;">
                <x-site.btn href="{{ url('/blog') }}" :link="true">&larr; All Insights</x-site.btn>
            </div>

            <div class="post-header">
                <x-site.eyebrow>{{ $post->category }}</x-site.eyebrow>
                <h1 class="display-l" style="margin-inline: auto; max-width: 100%;">{{ $post->title }}</h1>
                <div class="post-header__meta">
                    <a href="{{ url('/agency') }}#founder" class="post-author">
                        <img src="{{ asset('assets/images/team/prosper.jpg') }}" alt="" class="post-author__avatar" width="22" height="22">
                        <span>{{ $post->author_name }}</span>
                    </a>
                    <span class="dot" aria-hidden="true"></span>
                    <time datetime="{{ $post->published_at->toAtomString() }}">{{ $post->published_at->format('M j, Y') }}</time>
                    <span class="dot" aria-hidden="true"></span>
                    <span>{{ $post->reading_time }} min read</span>
                </div>
            </div>

            <div class="post-cover">
                <img src="{{ $post->cover_url }}" alt="{{ $post->title }}" loading="eager">
            </div>

            <div class="post-body">
                {!! $post->body !!}
            </div>

            @if ($faqs)
                {{-- Question-shaped headings with short, self-contained answers.
                     This is the block AI engines lift when citing the page. --}}
                <section class="post-faq" aria-labelledby="post-faq-heading">
                    <h2 id="post-faq-heading">Frequently asked questions</h2>
                    {{-- Deliberately not the .faq-item accordion used on the
                         services pages: that collapse is currently broken (an
                         open item never expands), and an answer a reader cannot
                         see is no use to them. Always-visible H3 + paragraph is
                         also the cleanest shape for AI extraction. --}}
                    @foreach ($faqs as $faq)
                        <div class="post-faq__item">
                            <h3 class="post-faq__q">{{ $faq['question'] }}</h3>
                            <p class="post-faq__a">{{ $faq['answer'] }}</p>
                        </div>
                    @endforeach
                </section>
            @endif

            <div class="post-footer">
                @if ($related)
                    <p class="post-footer__related">
                        More on {{ $post->category }}:
                        <a href="{{ route('blog.show', $related) }}">{{ $related->title }} &rarr;</a>
                    </p>
                @endif

                <div class="section-cta" style="margin-top: 2.25rem;">
                    <p>Want something like this built for your business?</p>
                    <x-site.btn :href="$contact" variant="lime">Book a discovery call</x-site.btn>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== FINAL CTA ==================== --}}
    {{-- ==================== FINAL CTA — same pine bookend used across the
         site. --}}
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
                <span>Cape Town &middot; Harare</span>
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
        { "@type": "ListItem", "position": 2, "name": "Blog", "item": "{{ url('/blog') }}" },
        { "@type": "ListItem", "position": 3, "name": {!! json_encode($post->title) !!}, "item": {!! json_encode(url()->current()) !!} }
    ]
}
</script>
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "BlogPosting",
    "headline": {!! json_encode($post->title) !!},
    "description": {!! json_encode($post->meta_description ?: $post->excerpt) !!},
    "image": {!! json_encode($post->cover_url) !!},
    "datePublished": "{{ $post->published_at->toAtomString() }}",
    "dateModified": "{{ $post->updated_at->toAtomString() }}",
    "mainEntityOfPage": { "@type": "WebPage", "@id": {!! json_encode(url()->current()) !!} },
    "author": {
        "@type": "Person",
        "@id": {!! json_encode(url('/agency') . '#founder') !!},
        "name": {!! json_encode($post->author_name) !!},
        "url": {!! json_encode(url('/agency') . '#founder') !!}
    },
    "publisher": {
        "@type": "Organization",
        "name": "ShiftTech",
        "logo": { "@type": "ImageObject", "url": {!! json_encode(asset('assets/images/logo/shifttech.png')) !!} }
    }
}
</script>
@if ($faqs)
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        @foreach ($faqs as $faq)
        {
            "@type": "Question",
            "name": {!! json_encode($faq['question']) !!},
            "acceptedAnswer": { "@type": "Answer", "text": {!! json_encode($faq['answer']) !!} }
        }@if (! $loop->last),@endif
        @endforeach
    ]
}
</script>
@endif
@endpush
