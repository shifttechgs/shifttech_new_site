<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'ShiftTech — Software that runs your business')</title>
    <meta name="description" content="@yield('meta_description', 'ShiftTech is a founder-led software engineering studio in Cape Town and Harare. Web platforms, mobile apps and operations systems — built by the person you actually talk to.')">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    {{-- Open Graph / Twitter --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og_title', 'ShiftTech — Software that runs your business')">
    <meta property="og:description" content="@yield('meta_description', 'Founder-led software engineering studio. Web platforms, mobile apps and operations systems for growing businesses.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('assets/images/og/shifttech-og.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'ShiftTech — Software that runs your business')">
    <meta name="twitter:description" content="@yield('meta_description', 'Founder-led software engineering studio.')">
    <meta name="twitter:image" content="{{ asset('assets/images/og/shifttech-og.png') }}">

    <link rel="icon" type="image/png" href="{{ asset('assets/favicon.ico') }}">

    {{-- Google Analytics 4. Production only, so local and staging traffic does
         not pollute the reports the organic numbers will be read from. --}}
    @production
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google_analytics.id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ config('services.google_analytics.id') }}');
        </script>
    @endproduction

    <link rel="stylesheet" href="{{ asset('assets/css/satoshi.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/shifttech.min.css') }}?v={{ filemtime(public_path('assets/css/shifttech.min.css')) }}">

    @stack('styles')

    {{-- Site-wide structured data --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "Organization",
        "name": "ShiftTech",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('assets/images/logo/shifttech.png') }}",
        "description": "Founder-led software engineering studio building web platforms, mobile apps and operations systems for growing businesses.",
        "email": "sales@shifttechgs.com",
        "telephone": "+27814303023",
        "areaServed": ["ZA", "ZW"],
        "address": [
            { "@type": "PostalAddress", "addressLocality": "Cape Town", "addressCountry": "ZA" },
            { "@type": "PostalAddress", "addressLocality": "Harare", "addressCountry": "ZW" }
        ],
        "sameAs": ["https://www.linkedin.com/company/shifttech-global-solutions/"],
        "founder": {
            "@type": "Person",
            "name": "Prosper",
            "jobTitle": "Founder & Lead Engineer",
            "url": "{{ url('/agency') }}#founder"
        }
    }
    </script>
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "ProfessionalService",
        "name": "ShiftTech — Cape Town",
        "url": "{{ url('/') }}",
        "image": "{{ asset('assets/images/og/shifttech-og.png') }}",
        "email": "sales@shifttechgs.com",
        "telephone": "+27814303023",
        "address": { "@type": "PostalAddress", "addressLocality": "Cape Town", "addressCountry": "ZA" },
        "areaServed": "ZA",
        "parentOrganization": { "@type": "Organization", "name": "ShiftTech", "url": "{{ url('/') }}" }
    }
    </script>
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "ProfessionalService",
        "name": "ShiftTech — Harare",
        "url": "{{ url('/') }}",
        "image": "{{ asset('assets/images/og/shifttech-og.png') }}",
        "email": "sales@shifttechgs.com",
        "telephone": "+27814303023",
        "address": { "@type": "PostalAddress", "addressLocality": "Harare", "addressCountry": "ZW" },
        "areaServed": "ZW",
        "parentOrganization": { "@type": "Organization", "name": "ShiftTech", "url": "{{ url('/') }}" }
    }
    </script>
    @stack('schema')
</head>
<body class="st @yield('body_class')">

<a class="skip-link" href="#main">Skip to content</a>

@include('partials.site-header')

@yield('content')

@include('partials.site-footer')

<script src="{{ asset('assets/js/shifttech-site.min.js') }}?v={{ filemtime(public_path('assets/js/shifttech-site.min.js')) }}" defer></script>
@stack('scripts')
</body>
</html>
