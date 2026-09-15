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
    <meta property="og:type" content="@yield('og_type', 'website')">
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

    {{-- Plus Jakarta Sans is the display face across every section, so it loads
         site-wide rather than on one page. --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/satoshi.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/shifttech.min.css') }}?v={{ filemtime(public_path('assets/css/shifttech.min.css')) }}">

    @stack('styles')

    {{-- Site-wide structured data --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "Organization",
        "name": "ShiftTech",
        {{-- Every external citation (LinkedIn, Dun & Bradstreet, ZoomInfo,
             Bark, RocketReach) and the company registration say "ShiftTech
             Global Solutions", while the site said only "ShiftTech". Entity
             resolution works by cross-referencing these, so declaring both the
             registered name and the trading name ties the two together instead
             of leaving them looking like separate organisations. --}}
        "legalName": "ShiftTech Global Solutions",
        "alternateName": "ShiftTech",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('assets/images/logo/shifttech.png') }}",
        "description": "Founder-led software engineering studio building web platforms, mobile apps and operations systems for growing businesses.",
        "email": "sales@shifttechgs.com",
        "telephone": "+27814303023",
        "areaServed": ["ZA", "ZW"],
        {{-- addressLocality is the postal locality, so Milnerton rather than
             the Cape Town metro. Cape Town intent is carried by page copy,
             titles and areaServed, which is where it belongs. --}}
        "address": [
            { "@type": "PostalAddress", "addressLocality": "Milnerton", "addressRegion": "Western Cape", "postalCode": "7441", "addressCountry": "ZA" },
            { "@type": "PostalAddress", "addressLocality": "Harare", "addressCountry": "ZW" }
        ],
        {{-- The Google Business Profile is listed here so the site and the
             listing resolve to one entity rather than two. The ?cid= form is
             the stable identifier; share links change. --}}
        "sameAs": [
            "https://www.linkedin.com/company/shifttech-global-solutions/",
            "https://maps.google.com/?cid=2403486617949292805"
        ],
        "founder": {
            "@type": "Person",
            "name": "Prosper Tinarwo",
            "jobTitle": "Founder & Lead Engineer",
            "url": "{{ url('/agency') }}#founder",
            "sameAs": ["https://www.linkedin.com/in/prosper-tinarwo-a540b0b0/"]
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
        "address": { "@type": "PostalAddress", "addressLocality": "Milnerton", "addressRegion": "Western Cape", "postalCode": "7441", "addressCountry": "ZA" },
        {{-- Coordinates and hasMap tie this location to the Google Business
             Profile. streetAddress is deliberately omitted, so these carry the
             location signal in its place. --}}
        "geo": { "@type": "GeoCoordinates", "latitude": -33.8031458, "longitude": 18.5142094 },
        "hasMap": "https://maps.google.com/?cid=2403486617949292805",
        "areaServed": "ZA",
        "parentOrganization": { "@type": "Organization", "name": "ShiftTech Global Solutions", "url": "{{ url('/') }}" }
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

<a class="wa-float"
   href="https://wa.me/27814303023?text=Hi%20ShiftTech!%20I%27m%20interested%20in%20your%20services%20and%20would%20like%20to%20discuss%20a%20project."
   target="_blank" rel="noopener noreferrer"
   aria-label="Chat with ShiftTech on WhatsApp">
    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
        <path fill="currentColor" d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>
    </svg>
    <span class="wa-float__label">Chat with us</span>
</a>

<script src="{{ asset('assets/js/shifttech-site.min.js') }}?v={{ filemtime(public_path('assets/js/shifttech-site.min.js')) }}" defer></script>
@stack('scripts')
</body>
</html>
