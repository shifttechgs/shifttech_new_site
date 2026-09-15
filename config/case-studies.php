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
| `challenge` and `approach` are the short form, used by the /work grid and
| kept as the fallback for any study that has not been written up long-form.
|
| The long-form fields drive the case study page itself:
|
|   client_descriptor  one sentence on who the client is (set in caps by CSS)
|   challenge_title    + challenge_body[]    the problem, as prose
|   solution_title     + solution_points[]   what we built, title/body pairs
|   value_title        + value_intro
|                      + value_points[]      what changed, title/body pairs
|   hero_image         OPT-IN, and only for a study with real photography —
|                      a UI screenshot behind the headline competes with it,
|                      so everything else gets the flat pine hero
|
| `results` is intentionally empty everywhere. Case study pages rank and get
| cited on specific, verifiable outcomes ("cut quote turnaround by 40%"), and
| those numbers have to come from you, not be invented here. Fill it and the
| figures render alongside the qualitative value points.
|
| `testimonial` is only ever a real, verbatim quote from that client. Three
| are filled (Payhouse, Vision Plus Wealth, BSL, Peekaboo); the rest stay null until
| there is a genuine quote from that specific client to use.
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

        // --- Long-form case study (Synergy-style layout). ---
        'client_descriptor' => 'Luminii is the platform ShiftTech runs its own studio on, and the CRM is the module every enquiry passes through first.',

        'challenge_title' => 'A pipeline held together by memory',
        'challenge_body'  => [
            'Leads arrived through a contact form, a phone call, a referral or a conversation, and each one landed somewhere different. A spreadsheet for some, an inbox for others, and the rest with whoever happened to take the call.',
            'Nothing connected a first enquiry to the work that came out of it. By the time a job was running, the context that won it had already been lost, and following up on anything that had gone quiet meant reconstructing it from scratch.',
        ],

        'solution_title'  => 'One record per prospect, from first contact to closed',
        'solution_points' => [
            ['title' => 'Every lead in one place', 'body' => 'Website enquiries, calls, referrals and manual entries all become the same kind of record, so there is no split between leads that arrived online and leads that arrived any other way.'],
            ['title' => 'A funnel with a next action', 'body' => 'Each lead carries a status, and the list computes what to do next from that status and how long it has been sitting, so the most at-risk record is the one at the top rather than the newest.'],
            ['title' => 'Client records that persist', 'body' => 'A lead that converts keeps its history, so the enquiry, the quote and the work that followed stay attached to the same client.'],
            ['title' => 'Built on our own operations first', 'body' => 'We ran the studio on it before offering it to anyone else, which meant the gaps showed up in our own week rather than in a client\'s.'],
        ],

        'value_title' => 'Nothing goes quiet without someone noticing',
        'value_intro' => 'The pipeline stopped depending on anyone remembering to check it.',
        'value_points' => [
            ['title' => 'Follow-ups surface themselves', 'body' => 'Stale leads are visible in the list rather than something you discover once it is too late to recover them.'],
            ['title' => 'Context survives the handover', 'body' => 'The reason a client came to us is still readable months later, attached to the work it turned into.'],
            ['title' => 'One system instead of several', 'body' => 'Leads, clients and follow-ups stopped being three separate habits kept in three separate places.'],
        ],
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

        // --- Long-form case study (Synergy-style layout). ---
        'client_descriptor' => 'zimAlert is an emergency response service, where the gap between calling for help and knowing it is coming is measured in the worst minutes of someone\'s life.',

        'challenge_title' => 'Nobody could see where help was',
        'challenge_body'  => [
            'When someone raised an alert, the only channel back was a phone call. The person waiting had no way to know whether a responder had been dispatched, where they were, or how long was left.',
            'Responders were working with the same blind spot in reverse. Locating the person who needed help meant talking them through landmarks over the phone, at the exact moment they were least able to describe where they were.',
        ],

        'solution_title'  => 'One live picture, shared both ways',
        'solution_points' => [
            ['title' => 'Live location sharing', 'body' => 'Responders and the people waiting on them see the same map in real time, so nobody is describing a location over the phone at the worst possible moment.'],
            ['title' => 'Alerts that carry context', 'body' => 'An alert arrives with position attached rather than as a call somebody has to interpret and relay onward.'],
            ['title' => 'Built for the phone in a pocket', 'body' => 'Delivered as a native mobile app, because the device someone already has in their hand is the only one guaranteed to be there when it matters.'],
            ['title' => 'A backend that holds up', 'body' => 'Location updates and alert state run through a service built for the moments when everyone opens the app at once.'],
        ],

        'value_title' => 'The wait stopped being a blind one',
        'value_intro' => 'The uncertainty that made the wait worse was the part software could actually remove.',
        'value_points' => [
            ['title' => 'No more guessing over a phone call', 'body' => 'Both sides are looking at the same information instead of assembling it verbally under pressure.'],
            ['title' => 'Responders arrive at the right place', 'body' => 'Position comes from the device rather than from a description given by someone in distress.'],
            ['title' => 'Status is visible, not requested', 'body' => 'The person waiting can see help moving without having to call and ask.'],
        ],
    ],

    'payhouse-finance-platform' => [
        'title'            => 'Payhouse Finance Platform',
        'client_name'      => 'Payhouse Finance',
        'service_type'     => 'web-app',
        'service_label'    => 'Web Application',
        'industry'         => 'Fintech',
        'meta_description' => 'Digitising a manual loan application flow with PCI-DSS handling and real-time transaction monitoring built in from the start.',
        'summary'          => 'Loan applications were being processed by hand, with compliance checks slowing everything further. We digitised the full application flow and built in the security fintech actually requires, PCI-DSS handling and real-time transaction monitoring included, so approvals move faster without cutting corners on trust.',
        'challenge'        => 'Loan applications were being processed by hand, with compliance checks slowing everything further.',
        'approach'         => 'We digitised the full application flow and built in the security fintech actually requires, PCI-DSS handling and real-time transaction monitoring included, so approvals move faster without cutting corners on trust.',
        'results'          => [],
        'testimonial'      => [
            'quote'  => 'ShiftTech built our website and helped us fully digitise and automate our loan application process. Security and compliance were critical for us, and the team handled everything with confidence from PCI-DSS requirements to real-time transaction monitoring. They truly understand fintech and know how to build systems you can trust.',
            'author' => 'Allan Chidawarima',
            'role'   => 'Director, Payhouse Finance',
        ],
        'featured_image'   => 'pay.png',
        'has_webp'         => true,
        'image_fit'        => 'cover',
        'technologies'     => ['Laravel', 'PHP', 'MySQL'],

        // --- Long-form case study (Synergy-style layout). Any study that fills
        //     these renders the full narrative; the rest fall back to the plain
        //     challenge / approach prose above. ---
        'client_descriptor' => 'Payhouse Finance is a Zimbabwean lender providing short-term personal and business loans, where every application moves real money and carries real regulatory weight.',
        'hero_image_alt'    => 'The Payhouse Finance loan application site built by ShiftTech',

        'challenge_title' => 'A loan process run by hand',
        'challenge_body'  => [
            'Payhouse was processing loan applications manually. Every application had to be collected, checked and walked through approval by a person, which put a hard ceiling on how many the team could handle in a day.',
            'Compliance made it slower still. Handling applicant and payment data properly is not optional for a lender, and those checks were running through the same manual process that was already the bottleneck. Moving faster and staying compliant looked like a trade-off.',
        ],

        'solution_title'  => 'The application flow, end to end',
        'solution_points' => [
            ['title' => 'Digitised application flow', 'body' => 'The full loan application was rebuilt as an online journey, from first enquiry through to a decision, so applications arrive structured instead of as paperwork somebody has to re-enter.'],
            ['title' => 'PCI-DSS compliant handling', 'body' => 'Payment and cardholder data is handled to PCI-DSS requirements, designed into the architecture from the start rather than retrofitted once the platform was already live.'],
            ['title' => 'Real-time transaction monitoring', 'body' => 'Transactions are monitored as they happen, so anything unusual surfaces immediately instead of at the end of a reporting cycle.'],
            ['title' => 'A public site that feeds it', 'body' => 'The marketing site and the application flow are one system, so an enquiry becomes an application without anyone rekeying it in between.'],
        ],

        'value_title' => 'Speed without loosening control',
        'value_intro' => 'The manual bottleneck is gone, and the compliance posture came out of it stronger rather than weaker.',
        'value_points' => [
            ['title' => 'Applications move on their own', 'body' => 'Approval no longer waits on someone carrying each application to the next stage by hand.'],
            ['title' => 'Compliance built in, not bolted on', 'body' => 'PCI-DSS handling and transaction monitoring are part of the platform, so they hold as volume grows.'],
            ['title' => 'A process the team can see', 'body' => 'Every application lives in one system, so status is something you look up rather than something you ask around for.'],
        ],
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
        'testimonial'      => [
            'quote'  => 'ShiftTech built our website and automated our previously manual loan application process. What used to take days is now fast, secure, and seamless for both our team and customers. The shift to digital has made a huge difference to how we operate.',
            'author' => 'Tinashe Muchenje',
            'role'   => 'Director, Vision Plus Wealth',
        ],
        'featured_image'   => 'vwp.png',
        'image_fit'        => 'cover',
        'technologies'     => ['Laravel', 'PHP', 'MySQL'],

        // --- Long-form case study (Synergy-style layout). ---
        'client_descriptor' => 'Vision Plus Wealth is a financial services firm whose clients arrive wanting to know two things: what is on offer, and how to start.',

        'challenge_title' => 'A site that hid the offer, and a process that ran by hand',
        'challenge_body'  => [
            'The old site read like every other finance site. Generic language about wealth and partnership sat where the actual services should have been, so a visitor could read the whole page and still not know what Vision Plus Wealth would do for them.',
            'Behind it, the loan application process ran entirely on manual work. Applications were collected, checked and moved along by people, which made starting slow for the client and repetitive for the team.',
        ],

        'solution_title'  => 'A clear service story, and an application flow that runs itself',
        'solution_points' => [
            ['title' => 'The offer stated plainly', 'body' => 'The site was rebuilt around what the firm actually does, in the language a client would use, rather than the finance-sector boilerplate it replaced.'],
            ['title' => 'An automated application flow', 'body' => 'The loan application was digitised end to end, so what used to take days of back and forth now moves without anyone rekeying it.'],
            ['title' => 'Secure by design', 'body' => 'Client financial information is handled properly from the first form onward, not secured as an afterthought once the flow was already live.'],
            ['title' => 'One journey, not two', 'body' => 'Reading about a service and starting it are the same path, so a convinced visitor does not have to go looking for how to begin.'],
        ],

        'value_title' => 'Days became minutes, on both sides of the desk',
        'value_intro' => 'The change landed for the team and the customer at the same time, which is how the client describes it themselves.',
        'value_points' => [
            ['title' => 'Visitors understand the offer', 'body' => 'The service story is the page, so the question a visitor came with is answered before they leave.'],
            ['title' => 'Applications move without chasing', 'body' => 'The manual steps that used to set the pace are gone from the front of the process.'],
            ['title' => 'Less repetitive work for the team', 'body' => 'Staff time moved off data entry and onto the applications that actually need judgement.'],
        ],
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
        'testimonial'      => [
            'quote'  => 'ShiftTech built our auction website and admin platform exactly to our needs. They understood our business and delivered a system that simplified operations and reduced manual work. We\'re very happy with the result.',
            'author' => 'Conrad',
            'role'   => 'Operations Manager, BSL Services',
        ],
        'featured_image'   => 'bsl-admin.png',
        'has_webp'         => true,
        'technologies'     => ['C#', 'Angular', 'PostgreSQL'],

        // --- Long-form case study (Synergy-style layout). ---
        'client_descriptor' => 'BSL runs vehicle and machinery auctions, where a single sale day generates more records than most businesses produce in a month.',

        'challenge_title' => 'Every sale created more filing',
        'challenge_body'  => [
            'Auctions ran on paper trails and manual admin. Lots, bidders, bids and settlements were recorded by hand, and the record only became complete once somebody had gone back afterwards and assembled it.',
            'The work scaled the wrong way. A bigger sale day did not just mean more revenue, it meant proportionally more filing, and the admin arrived after the auction rather than during it.',
        ],

        'solution_title'  => 'The auction house, on one platform',
        'solution_points' => [
            ['title' => 'A public auction site', 'body' => 'Bidding opened up beyond whoever could be in the room, with lots listed and browsable ahead of the sale.'],
            ['title' => 'An operations dashboard', 'body' => 'Listings, bids and records live in one admin platform, so the state of an auction is something staff read rather than reconstruct.'],
            ['title' => 'Records captured as they happen', 'body' => 'Each lot and bid is recorded at the moment it occurs instead of being written up once the day is over.'],
            ['title' => 'One system across the sale', 'body' => 'The public side and the admin side are the same platform, so a bid placed by a customer is already in the record the team works from.'],
        ],

        'value_title' => 'Operations run on the system, not around it',
        'value_intro' => 'This is the client\'s own assessment of it, and it is the one that counts.',
        'value_points' => [
            ['title' => 'Manual work reduced', 'body' => 'The filing that used to follow every sale is now largely produced by the system as the sale happens.'],
            ['title' => 'A wider bidding pool', 'body' => 'Auctions are no longer limited to the people who can attend in person.'],
            ['title' => 'One place to look', 'body' => 'Lots, bids and settlements stopped living in separate paper records.'],
        ],
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

        // --- Long-form case study (Synergy-style layout). ---
        'client_descriptor' => 'Lifestyle Laundry collects, cleans and returns laundry, a service where the customer\'s main anxiety is simply not knowing where their clothes are.',

        'challenge_title' => 'A phone call, and then hoping',
        'challenge_body'  => [
            'Booking a pickup meant calling and describing what was needed to whoever answered. Whether it was written down correctly, and whether it was written down at all, was outside the customer\'s view.',
            'After that, the only way to find out what was happening was to call again. The business spent its day answering the same question, and customers spent theirs asking it.',
        ],

        'solution_title'  => 'The whole loop, in one app',
        'solution_points' => [
            ['title' => 'Book a pickup', 'body' => 'Requesting a collection is a few taps with the details captured correctly, rather than a description relayed over a phone call.'],
            ['title' => 'Pay in-app', 'body' => 'Payment happens inside the same flow, so settling up is not a separate errand at the door.'],
            ['title' => 'Track order status', 'body' => 'The customer can see where their order actually is, which removes the reason to call and ask.'],
            ['title' => 'One record per order', 'body' => 'Booking, payment and status are the same object, so the business and the customer are always reading the same thing.'],
        ],

        'value_title' => 'The \'where is my order\' call stopped being the job',
        'value_intro' => 'Removing the uncertainty removed the phone traffic that uncertainty was generating.',
        'value_points' => [
            ['title' => 'Customers stop chasing', 'body' => 'Status is something to look up, so the update no longer has to be requested.'],
            ['title' => 'Staff time goes back to the work', 'body' => 'The day is not spent fielding the same question from different people.'],
            ['title' => 'Bookings arrive correct', 'body' => 'Details come from the customer directly rather than through a transcription step.'],
        ],
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

        // --- Long-form case study (Synergy-style layout). ---
        'client_descriptor' => 'Luminii is a multi-tenant operations platform that businesses run their whole job lifecycle on, from first enquiry through to the paid invoice.',

        'challenge_title' => 'Five tools, and copy-paste in between',
        'challenge_body'  => [
            'A typical operation ran on a separate tool for each stage. One for leads, another for quotes, a third for invoices, a calendar for scheduling, and a spreadsheet holding whatever the others could not.',
            'The joins were manual. The same customer details were retyped at every handover, and because no tool held the whole job, following one from first enquiry to paid invoice meant opening all of them and assembling the answer by hand.',
        ],

        'solution_title'  => 'One system for the whole job lifecycle',
        'solution_points' => [
            ['title' => 'Leads through to invoices', 'body' => 'Enquiry, quote, scheduled job and invoice are stages of one record instead of four records in four products.'],
            ['title' => 'Quoting and invoicing together', 'body' => 'A quote that is accepted becomes the invoice it was always going to be, without anyone retyping the line items.'],
            ['title' => 'Job scheduling in the same place', 'body' => 'Work is scheduled against the job it belongs to, so the calendar and the commercial record cannot drift apart.'],
            ['title' => 'Multi-tenant from the start', 'body' => 'Built so each business runs on its own isolated data inside one platform, rather than as a separate copy deployed per customer.'],
        ],

        'value_title' => 'One record per job, end to end',
        'value_intro' => 'The copy-paste between tools was never a workflow, it was a tax on every job.',
        'value_points' => [
            ['title' => 'Details are entered once', 'body' => 'Customer information stops being retyped at every handover between stages.'],
            ['title' => 'The whole job is visible', 'body' => 'Following an enquiry to its invoice means reading one record rather than reconciling several.'],
            ['title' => 'Fewer tools to pay for and learn', 'body' => 'The stack a business needs to run its operations came down to one.'],
        ],
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
        'testimonial'      => [
            'quote'  => 'For twenty years we ran on paper and phone calls, with almost no way for parents to find us online. ShiftTech built us a website that actually gets found and an admissions dashboard that replaced the paperwork. Our team can finally keep up.',
            'author' => 'Peekaboo Daycare & Preschool',
            'role'   => '',
        ],
        'featured_image'   => 'peekaboo-site.png',
        'has_webp'         => true,
        'technologies'     => ['Laravel', 'PHP', 'MySQL'],

        // --- Long-form case study (Synergy-style layout). ---
        'client_descriptor' => 'Peekaboo Daycare & Preschool has been caring for children for twenty years, in a market where parents now start their search online.',

        'challenge_title' => 'Twenty years of reputation, invisible online',
        'challenge_body'  => [
            'The reputation was real and local, built over two decades. But parents looking for daycare start by searching, and Peekaboo effectively did not appear, so the shortlist was formed without them on it.',
            'Enrolment had its own problem. Once a family did find them, admissions ran entirely on paper. Forms, records and enrolment status lived in folders, and the state of an intake was whatever the person holding the file happened to know.',
        ],

        'solution_title'  => 'Found first, then enrolled properly',
        'solution_points' => [
            ['title' => 'A site built to be found', 'body' => 'Structured and written so a parent searching for daycare in the area actually reaches them, rather than a brochure that only works once you already know the name.'],
            ['title' => 'An admissions dashboard', 'body' => 'Enrolments moved off paper into a system staff can run day to day, with each application\'s status visible rather than filed.'],
            ['title' => 'Records that stay together', 'body' => 'A child\'s enrolment information lives in one place instead of spread across forms in different folders.'],
            ['title' => 'Built for the people using it', 'body' => 'Designed around how the staff actually work, on the basis that a system nobody opens is worse than the paper it replaced.'],
        ],

        'value_title' => 'Visible to parents, manageable for staff',
        'value_intro' => 'These were two different problems, so they needed two answers rather than one new website.',
        'value_points' => [
            ['title' => 'Parents can find them', 'body' => 'Twenty years of reputation is now reachable by the search that starts most enrolment decisions.'],
            ['title' => 'Admissions off paper', 'body' => 'Intake status is something to look up rather than something to ask the person holding the folder.'],
            ['title' => 'Less administrative drag', 'body' => 'Staff time moved from managing paperwork back towards the children.'],
        ],
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

        // --- Long-form case study (Synergy-style layout). ---
        'client_descriptor' => 'SpringKleaners is a Cape Town cleaning service, where the visitor arrives with two questions and leaves if neither gets answered.',

        'challenge_title' => 'Two unanswered questions, one lost booking',
        'challenge_body'  => [
            'Every visitor arrived wanting to know what a clean would cost and whether SpringKleaners covered their suburb. The old site answered neither, so the only way forward was to phone and ask.',
            'Most did not. A visitor who has to make a call to find out a price is a visitor who compares you against whoever published theirs, and the enquiry was lost before anyone knew it had existed.',
        ],

        'solution_title'  => 'Price and coverage, answered on the page',
        'solution_points' => [
            ['title' => 'An instant quote tool', 'body' => 'A visitor gets a price from the details of their own job, on the page, without a phone call standing between them and the number.'],
            ['title' => 'Suburb-based booking', 'body' => 'Coverage is answered by selecting a suburb, so nobody works through a booking only to find out they are outside the service area.'],
            ['title' => 'Quote straight into booking', 'body' => 'The price and the booking are one flow, so a visitor who likes the number does not have to start again in order to act on it.'],
            ['title' => 'Built for the phone', 'body' => 'The flow works properly on the device most of this traffic arrives on, since a cleaning quote is rarely researched at a desk.'],
        ],

        'value_title' => 'From \'how much\' to \'booked\' without a call',
        'value_intro' => 'The booking that used to depend on a phone call now completes on the page.',
        'value_points' => [
            ['title' => 'Price objections handled up front', 'body' => 'The cost question is answered while the visitor is still interested, rather than after they have left to find out elsewhere.'],
            ['title' => 'No wasted journeys', 'body' => 'Coverage is established before someone invests time in a booking they cannot complete.'],
            ['title' => 'Enquiries arrive ready', 'body' => 'A booking comes in with the job details already captured, instead of needing a call to establish them.'],
        ],
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

        // --- Long-form case study (Synergy-style layout). ---
        'client_descriptor' => 'Ribbon Plumbing handles plumbing and gas work around the clock, in a trade where the most valuable enquiries arrive at the least convenient hours.',

        'challenge_title' => 'The emergency arrives after hours',
        'challenge_body'  => [
            'Plumbing emergencies do not keep office hours. A burst pipe at midnight is the most urgent, highest-intent enquiry a plumber can receive, and it was exactly the one the old site could not take.',
            'Outside opening times the site offered a phone number nobody was answering. The visitor\'s only options were to wait until morning or to keep searching, and at midnight almost nobody waits.',
        ],

        'solution_title'  => 'A request flow that works at any hour',
        'solution_points' => [
            ['title' => 'Instant quote requests', 'body' => 'A visitor describes the job and submits a request in minutes, at whatever hour they are standing in the water.'],
            ['title' => 'Built for the emergency case', 'body' => 'The flow assumes somebody stressed, on a phone, in the dark, rather than somebody comparing options at leisure.'],
            ['title' => 'Requests land ready to action', 'body' => 'Each submission arrives with the detail needed to respond, rather than as a missed call to return.'],
            ['title' => 'Conversion-first structure', 'body' => 'The page is built around getting an urgent visitor to a submitted request, not around describing the company first.'],
        ],

        'value_title' => 'The midnight enquiry stopped going to someone else',
        'value_intro' => 'The enquiries that were quietly leaking away after hours are the ones this recovers.',
        'value_points' => [
            ['title' => 'After-hours enquiries are captured', 'body' => 'A request submitted at 2am is waiting in the morning instead of having gone to whoever answered first.'],
            ['title' => 'Urgency is met with an action', 'body' => 'The visitor has something to do at the moment they most need to do it.'],
            ['title' => 'Better information on arrival', 'body' => 'Jobs come in already described, so the response can be prepared rather than improvised.'],
        ],
    ],

];
