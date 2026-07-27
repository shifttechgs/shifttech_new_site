# ShiftTech

> Founder-led software engineering studio based in Cape Town, South Africa and Harare, Zimbabwe. We build web platforms, mobile apps, and internal operations systems for growing businesses. No account managers: you work directly with the engineer who builds and ships your system.

## Services

- [AI Integrations & Automation]({{ url('/services/ai') }}): Practical AI built into the software we ship, writing code, automating busywork, and updating old systems, with a senior engineer reviewing every line.
- [Web & Product Design]({{ url('/services/web-design') }}): Interfaces designed to convert, validated with real users, backed by a documented design system.
- [Software Engineering]({{ url('/services/web-application-development') }}): Architecture, implementation, testing, and delivery for systems that have to hold up in production.
- [Custom Software Development]({{ url('/services/custom-software-development') }}): Bespoke internal tools and business systems built around how a business actually works, replacing spreadsheets and manual processes.
- [DevOps & Cloud Infrastructure]({{ url('/services/devops-cloud') }}): Deployment pipelines, monitoring, and cloud infrastructure so releases are routine, not stressful.
- [Mobile App Development]({{ url('/services/mobile-app-development') }}): iOS and Android apps built with Flutter, backed by real infrastructure, from first screen to app store launch.

## Company

- [Our Work]({{ url('/work') }}): Case studies from real, live projects: Luminii, BSL Auction Services, Payhouse Finance, Vision Plus Wealth, Peekaboo Daycare, SpringKleaners, Ribbon Plumbing, and more.
- [About ShiftTech]({{ url('/agency') }}): Why the studio exists and why it's stayed founder-led. One person scopes, builds, and stays on every project.
- [Contact]({{ url('/contact') }}): Book a free discovery call.

## Blog

@foreach ($posts as $post)
- [{{ $post->title }}]({{ url('/blog/' . $post->slug) }}): {{ $post->excerpt }}
@endforeach
