<?php

/*
|--------------------------------------------------------------------------
| Case Studies
|--------------------------------------------------------------------------
|
| Single source for both the /work grid and the individual /work/{slug}
| pages. Keyed by slug, which is the URL segment, so changing a key changes
| a live URL and needs a redirect.
|
| `challenge` and `approach` are split out of the original one-paragraph
| summary so each page has real structure for search and AI extraction.
|
| `results` is intentionally empty. Case study pages rank and get cited on
| specific, verifiable outcomes ("cut quote turnaround by 40%"), and those
| numbers have to come from you, not be invented here. Each entry renders a
| Results section only once this array is filled. Same for `testimonial`.
|
*/

return [

    'luminii-crm' => [
        'title'            => 'Luminii CRM',
        'client_name'      => 'UseLuminii',
        'service_type'     => 'web-app',
        'service_label'    => 'Web Application',
        'industry'         => 'SaaS',
        'meta_description' => 'How we built the Luminii CRM: leads, client records and follow-ups in one place instead of scattered across spreadsheets.',
        'summary'          => 'The CRM module inside the Luminii platform: leads, client records, and follow-ups in one place instead of scattered across spreadsheets and someone\'s memory. Built first for ShiftTech\'s own operations, then opened up for other businesses to run their pipeline on.',
        'challenge'        => 'Leads, client records and follow-ups were scattered across spreadsheets and someone\'s memory. Nothing linked a first enquiry to the work that came out of it.',
        'approach'         => 'We built the CRM module inside the Luminii platform so leads, client records and follow-ups live in one place. It was built first for ShiftTech\'s own operations, then opened up for other businesses to run their pipeline on.',
        'results'          => [],
        'testimonial'      => null,
        'featured_image'   => 'luminii.png',
        'image_fit'        => 'cover',
        'technologies'     => ['Angular', 'C#', 'SQL'],
    ],

    'zimalert-emergency-response' => [
        'title'            => 'zimAlert Emergency Response',
        'client_name'      => 'zimAlert',
        'service_type'     => 'mobile-app',
        'service_label'    => 'Mobile Application',
        'industry'         => 'Healthcare',
        'meta_description' => 'A mobile emergency response app with live location sharing, so responders and the people waiting on them see the same picture in real time.',
        'summary'          => 'Emergency contacts previously had no way to see where help actually was. We built a mobile app with live location sharing, so responders and the people waiting on them are looking at the same picture in real time, not guessing over a phone call.',
        'challenge'        => 'Emergency contacts had no way to see where help actually was. Everyone involved was guessing over a phone call at the worst possible moment.',
        'approach'         => 'We built a mobile app with live location sharing, so responders and the people waiting on them are looking at the same picture in real time.',
        'results'          => [],
        'testimonial'      => null,
        'featured_image'   => 'zimAlert.png',
        'image_fit'        => 'cover',
        'technologies'     => ['Flutter', 'C#', 'Firebase', 'SQL'],
    ],

    'payhouse-finance-platform' => [
        'title'            => 'PayHouse Finance Platform',
        'client_name'      => 'PayHouse',
        'service_type'     => 'web-app',
        'service_label'    => 'Web Application',
        'industry'         => 'Fintech',
        'meta_description' => 'Digitising a manual loan application flow with PCI-DSS handling and real-time transaction monitoring built in from the start.',
        'summary'          => 'Loan applications were being processed by hand, with compliance checks slowing everything further. We digitised the full application flow and built in the security fintech actually requires, PCI-DSS handling and real-time transaction monitoring included, so approvals move faster without cutting corners on trust.',
        'challenge'        => 'Loan applications were being processed by hand, with compliance checks slowing everything further.',
        'approach'         => 'We digitised the full application flow and built in the security fintech actually requires, PCI-DSS handling and real-time transaction monitoring included, so approvals move faster without cutting corners on trust.',
        'results'          => [],
        'testimonial'      => null,
        'featured_image'   => 'pay.png',
        'image_fit'        => 'cover',
        'technologies'     => ['Laravel', 'PHP', 'MySQL'],
    ],

    'vision-plus-wealth-management' => [
        'title'            => 'Vision Plus Wealth Management',
        'client_name'      => 'Vision Plus Wealth',
        'service_type'     => 'website',
        'service_label'    => 'Website',
        'industry'         => 'Finance',
        'meta_description' => 'Rebuilding a wealth management site around a clear service story, and automating a loan application process that ran entirely by hand.',
        'summary'          => 'The old site buried what Vision Plus Wealth actually offered behind generic finance-site boilerplate, and their loan application process ran entirely by hand. We rebuilt the site around a clear service story and automated the application flow, so it\'s fast, secure, and seamless for the team and the client on both ends.',
        'challenge'        => 'The old site buried what Vision Plus Wealth actually offered behind generic finance-site boilerplate, and their loan application process ran entirely by hand.',
        'approach'         => 'We rebuilt the site around a clear service story and automated the application flow, so it is fast, secure, and seamless for the team and the client on both ends.',
        'results'          => [],
        'testimonial'      => null,
        'featured_image'   => 'vwp.png',
        'image_fit'        => 'cover',
        'technologies'     => ['Laravel', 'PHP', 'MySQL'],
    ],

    'bsl-auction-services' => [
        'title'            => 'BSL Auction Services',
        'client_name'      => 'BSL',
        'service_type'     => 'web-app',
        'service_label'    => 'Web Application',
        'industry'         => 'E-commerce',
        'meta_description' => 'Replacing paper trails and manual admin with a public auction site plus an admin platform for listings, bids and records.',
        'summary'          => 'BSL was running auctions on paper trails and manual admin, which meant every sale meant more filing. We built them a public auction website plus an admin platform to manage listings, bids, and records in one place, so operations run on the system instead of around it.',
        'challenge'        => 'BSL was running auctions on paper trails and manual admin, which meant every sale meant more filing.',
        'approach'         => 'We built them a public auction website plus an admin platform to manage listings, bids, and records in one place, so operations run on the system instead of around it.',
        'results'          => [],
        'testimonial'      => null,
        'featured_image'   => 'bsl-admin.png',
        'has_webp'         => true,
        'technologies'     => ['Laravel', 'PHP', 'MySQL'],
    ],

    'lifestyle-laundry' => [
        'title'            => 'Lifestyle Laundry',
        'client_name'      => 'Lifestyle Laundry',
        'service_type'     => 'mobile-app',
        'service_label'    => 'Mobile Application',
        'industry'         => 'Services',
        'meta_description' => 'A laundry booking app covering the whole loop: book a pickup, pay in-app, and track order status without chasing updates.',
        'summary'          => 'Booking a laundry pickup meant a phone call and hoping someone remembered. We built a mobile app covering the whole loop, book a pickup, pay in-app, and track the order status, so customers don\'t have to chase updates and the business isn\'t fielding "where\'s my order" calls all day.',
        'challenge'        => 'Booking a laundry pickup meant a phone call and hoping someone remembered.',
        'approach'         => 'We built a mobile app covering the whole loop, book a pickup, pay in-app, and track the order status, so customers do not have to chase updates and the business is not fielding "where is my order" calls all day.',
        'results'          => [],
        'testimonial'      => null,
        'featured_image'   => 'lifestyle.png',
        'image_fit'        => 'cover',
        'technologies'     => ['Flutter', 'Firebase', 'Stripe', 'C#', 'SQL'],
    ],

    'luminii-saas-platform' => [
        'title'            => 'Luminii SaaS Platform',
        'client_name'      => 'UseLuminii',
        'service_type'     => 'custom-software',
        'service_label'    => 'Custom Software',
        'industry'         => 'SaaS',
        'meta_description' => 'Building the Luminii CRM out into a multi-tenant SaaS platform: leads, quotes, invoicing and job scheduling in one system.',
        'summary'          => 'The full Luminii platform, built out from the CRM into a multi-tenant SaaS product other businesses can run their own operations on: leads, quotes, invoicing, and job scheduling in one system instead of five disconnected tools stitched together with copy-paste.',
        'challenge'        => 'Businesses were running operations across five disconnected tools stitched together with copy-paste, with no single place to follow a job from first enquiry to paid invoice.',
        'approach'         => 'We built the full Luminii platform out from the CRM into a multi-tenant SaaS product other businesses can run their own operations on: leads, quotes, invoicing, and job scheduling in one system.',
        'results'          => [],
        'testimonial'      => null,
        'featured_image'   => 'luminii-saas-site.png',
        'has_webp'         => true,
        'technologies'     => ['Angular', 'C#', 'SQL'],
    ],

    'peekaboo-daycare' => [
        'title'            => 'Peekaboo Daycare',
        'client_name'      => 'Peekaboo Daycare & Preschool',
        'service_type'     => 'web-app',
        'service_label'    => 'Web Application',
        'industry'         => 'Education',
        'meta_description' => 'Twenty years in business with almost no presence online. A site that shows up in search, plus an admissions dashboard replacing the paper trail.',
        'summary'          => 'Twenty years in business and almost no presence online, which meant parents searching for a daycare couldn\'t find them, and once a child was enrolled, admissions ran entirely on paper. We built a site that actually shows up in search and an admissions dashboard that replaced the paper trail with something the staff could run day to day.',
        'challenge'        => 'Twenty years in business and almost no presence online, which meant parents searching for a daycare could not find them. Once a child was enrolled, admissions ran entirely on paper.',
        'approach'         => 'We built a site that actually shows up in search and an admissions dashboard that replaced the paper trail with something the staff could run day to day.',
        'results'          => [],
        'testimonial'      => null,
        'featured_image'   => 'peekaboo-site.png',
        'has_webp'         => true,
        'technologies'     => ['Laravel', 'PHP', 'MySQL'],
    ],

    'springkleaners' => [
        'title'            => 'SpringKleaners',
        'client_name'      => 'SpringKleaners',
        'service_type'     => 'website',
        'service_label'    => 'Website',
        'industry'         => 'Home Services',
        'meta_description' => 'An instant quote tool and suburb-based booking flow, so a visitor goes from "how much" to "booked" without a phone call in between.',
        'summary'          => 'Visitors landing on the old site had no way to know what a clean would cost or whether SpringKleaners even served their suburb, so most left without booking. We built an instant quote tool and a suburb-based booking flow, so a visitor can go from "how much" to "booked" without a phone call in between.',
        'challenge'        => 'Visitors landing on the old site had no way to know what a clean would cost or whether SpringKleaners even served their suburb, so most left without booking.',
        'approach'         => 'We built an instant quote tool and a suburb-based booking flow, so a visitor can go from "how much" to "booked" without a phone call in between.',
        'results'          => [],
        'testimonial'      => null,
        'featured_image'   => 'springkleaners-site.png',
        'has_webp'         => true,
        'technologies'     => ['Laravel', 'PHP', 'MySQL'],
    ],

    'ribbon-plumbing' => [
        'title'            => 'Ribbon Plumbing',
        'client_name'      => 'Ribbon Plumbing',
        'service_type'     => 'website',
        'service_label'    => 'Website',
        'industry'         => 'Home Services',
        'meta_description' => 'An after-hours quote request flow for an emergency plumber, turning a midnight burst pipe into a submitted request instead of a missed enquiry.',
        'summary'          => 'A burst pipe at midnight doesn\'t wait for office hours, but the old site gave visitors nothing to do outside them except leave. We built an instant quote request flow that works any hour, so an emergency call becomes a submitted request in minutes instead of a missed enquiry until morning.',
        'challenge'        => 'A burst pipe at midnight does not wait for office hours, but the old site gave visitors nothing to do outside them except leave.',
        'approach'         => 'We built an instant quote request flow that works any hour, so an emergency call becomes a submitted request in minutes instead of a missed enquiry until morning.',
        'results'          => [],
        'testimonial'      => null,
        'featured_image'   => 'ribbon-plumbing-site.png',
        'has_webp'         => true,
        'technologies'     => ['Laravel', 'PHP', 'MySQL'],
    ],

];
