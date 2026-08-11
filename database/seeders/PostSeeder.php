<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

/**
 * The four launch posts. Written locally and never deployed, which is why
 * /blog rendered "Coming soon." in production.
 *
 * Uses firstOrCreate on the slug, so running this twice is safe and it will
 * never clobber edits made through the admin. To force a refresh of a post,
 * delete it first.
 *
 * Run with: php artisan db:seed --class=PostSeeder --force
 */
class PostSeeder extends Seeder
{
    /**
     * Canonical copy for the launch posts. Exposed so `posts:refresh-content`
     * can push edits made here onto posts that already exist, which
     * firstOrCreate below will never do.
     */
    public static function posts(): array
    {
        return [
            [
                'title'            => 'Why We Quote Fixed Price, Not Hourly',
                'slug'             => 'why-we-quote-fixed-price-not-hourly',
                'category'         => 'Process',
                'author_name'      => 'Prosper Tinarwo',
                'excerpt'          => 'Hourly billing puts the incentive in the wrong place. Here is how we scope a fixed number before a line of code gets written, and what happens when the scope changes.',
                'meta_description' => 'Hourly billing puts the incentive in the wrong place. How we scope a fixed number before a line of code gets written, and what happens when scope changes.',
                'published_at'     => '2026-07-07 10:27:55',
                'is_published'     => true,
                'faqs'             => [
                    [
                        'question' => 'How long does it take to get a quote from ShiftTech?',
                        'answer'   => 'Within 48 hours of the discovery call. You get a fixed number and a timeline, not a ballpark or a range with an asterisk. The call itself covers what is broken, what a good outcome looks like, and what is out of scope.',
                    ],
                    [
                        'question' => 'What happens if the scope of my project changes mid-build?',
                        'answer'   => 'You get a new fixed number for the added scope before any work starts on it. We flag the change as soon as we see it coming rather than at invoicing time, and the original quote does not quietly grow to absorb it.',
                    ],
                    [
                        'question' => 'Who carries the risk if a fixed-price project takes longer than estimated?',
                        'answer'   => 'We do. If we underestimate the work, that is our problem to absorb, not something we bill you for. It forces us to understand a problem properly before quoting it instead of leaving room to bill our way out of a bad estimate.',
                    ],
                    [
                        'question' => 'Does ShiftTech turn down projects?',
                        'answer'   => 'Yes. We turn down work we cannot scope with confidence rather than take it on and figure it out on the clock. Losing a project costs less than losing a client\'s trust in every number we give them afterwards.',
                    ],
                ],
                'body'             => <<<'HTML'
<h2>Why does ShiftTech quote fixed price instead of hourly?</h2>
<p>Because hourly billing pays us more the longer a feature takes, and gives you no way to verify the number. We quote a fixed price and a timeline within 48 hours of the discovery call. If we underestimate the work, that cost is ours to absorb, not something we pass on to you.</p>

<p>Hourly billing sounds fair until you sit on the other side of it. The agency gets paid more the longer a feature takes, and you have no way to tell whether three days of work was actually three days of work. We don't run engagements that way.</p>

<h2>What happens before we quote?</h2>
<p>Every project starts with a discovery call, not a rate card. We ask what's actually broken, what a good outcome looks like, and what's out of scope. Within 48 hours of that call, you get a fixed quote and a timeline. Not a "ballpark." Not a range with an asterisk.</p>

<h2>What happens when scope changes?</h2>
<p>It happens on nearly every project, and it's not a problem as long as it's handled honestly:</p>
<ul>
<li>We flag the change as soon as we see it coming, not at invoicing time</li>
<li>You get a new fixed number for the added scope before we touch it</li>
<li>The original quote doesn't quietly balloon to cover it</li>
</ul>

<blockquote>If a client can't predict their bill, they stop trusting every other number you give them.</blockquote>

<h2>Why is fixed price harder for us, not easier?</h2>
<p>Fixed pricing means we carry the risk when we underestimate something, not you. That's the point. It forces us to actually understand a problem before quoting it, instead of leaving ourselves room to bill our way out of a bad estimate.</p>

<p>It also means we turn down projects we can't scope with confidence, rather than take the work and figure it out on the clock. We'd rather lose the project than lose the trust.</p>
HTML,
            ],
            [
                'title'            => 'Our Default Stack, and Why We Rarely Deviate From It',
                'slug'             => 'our-default-stack-and-why-we-rarely-deviate-from-it',
                'category'         => 'Engineering',
                'author_name'      => 'Prosper Tinarwo',
                'excerpt'          => 'C# and Angular, with other tools borrowed in when a project actually needs them. Not because they are trendy, but because we can debug them at 11pm without reading documentation.',
                'meta_description' => 'C# and Angular, with other tools borrowed in when a project needs them. Not because they are trendy, but because we can debug them at 11pm.',
                'published_at'     => '2026-07-13 10:27:55',
                'is_published'     => true,
                'faqs'             => [
                    [
                        'question' => 'What technology stack does ShiftTech build on?',
                        'answer'   => 'C# and Angular by default, for everything from client dashboards to admin platforms. Laravel and MySQL, PHP, Flutter, Docker and AWS get brought in when a project genuinely calls for them. The core stays consistent and the pieces around it change.',
                    ],
                    [
                        'question' => 'Why C# and Angular instead of a newer framework?',
                        'answer'   => 'Because the weird edge cases are already solved. C# holds up under real business logic instead of falling apart once a project gets complicated, and Angular forces structure on the frontend, which matters once a dashboard has more than a handful of screens.',
                    ],
                    [
                        'question' => 'Will ShiftTech work with a system we already have?',
                        'answer'   => 'Yes. When a client already runs something built in another stack, the right call is usually to extend what exists rather than force a rewrite. Consistency for its own sake is not the goal. Not creating unnecessary risk for you is.',
                    ],
                    [
                        'question' => 'Do you build apps for both iOS and Android?',
                        'answer'   => 'Yes, using Flutter when a client needs one app that runs on both. It is one of the tools we borrow in around the default stack rather than a separate practice, so the same team ships the app and the systems behind it.',
                    ],
                    [
                        'question' => 'Do small projects need microservices or Kubernetes?',
                        'answer'   => 'Usually not. Ten users do not need Kubernetes. We build for the load a system actually has today and architect for the growth that is genuinely coming, rather than paying complexity costs up front for scale that may never arrive.',
                    ],
                ],
                'body'             => <<<'HTML'
<h2>What technology stack does ShiftTech build on?</h2>
<p>C# and Angular by default, for everything from client dashboards to admin platforms. We bring in Laravel, PHP, Flutter, Docker and AWS when a project genuinely calls for them. The default is not about what is trending. It is about tools we can debug at 11pm without reading documentation.</p>

<p>We get asked at least once a quarter why we're not building on whatever framework is trending that month. The honest answer: boring, well-understood tools ship faster and break less than exciting new ones.</p>

<h2>What we actually reach for</h2>
<p>C# and Angular are our default. Most of what we build, from client dashboards to admin platforms, starts there. Strong typing catches mistakes before they reach production, and Angular gives the frontend a structure that holds up once a system has a lot of moving parts.</p>

<h3>Why C# and Angular specifically</h3>
<p>C# has been around long enough that the weird edge cases are already solved, and it holds up under real business logic instead of falling apart once a project gets complicated. Angular forces some structure on the frontend, which matters once a dashboard has more than a handful of screens and more than one person working on it.</p>

<h3>Why we borrow other tools when a project calls for it</h3>
<p>C# and Angular are the default, not a rule we follow blindly. We bring in Laravel and MySQL for projects where that fits better, PHP is fast to build with for smaller sites and lead generation work. Flutter when a client needs one app that runs on both iOS and Android. Docker and AWS to ship and run whatever we build. The core stays consistent. The pieces around it change based on what the project actually needs.</p>

<h3>Why we don't chase the new thing</h3>
<p>A framework that's two years old has known failure modes, a mature ecosystem, and a Stack Overflow answer for the weird edge case you'll hit in month four. A framework that's two months old has none of that. You're the one who inherits the risk, not us.</p>

<blockquote>Ten users don't need Kubernetes. We build for today and architect for the growth that's actually coming.</blockquote>

<h2>When we deviate from even that</h2>
<p>Occasionally a client already has a system built in something else entirely, and the right call is to extend what exists rather than force a rewrite onto our stack. Consistency for its own sake isn't the goal. Not creating unnecessary risk for you is.</p>

<p>The stack is a means, not a pitch. If a client's existing system runs on something else and rewriting it doesn't serve them, we work in what's already there.</p>
HTML,
            ],
            [
                'title'            => 'Where AI Actually Earns Its Place in the Systems We Build',
                'slug'             => 'where-ai-actually-earns-its-place-in-the-systems-we-build',
                'category'         => 'AI',
                'author_name'      => 'Prosper Tinarwo',
                'excerpt'          => 'AI writes code faster. We still read every line. Here is the line between AI as a tool and AI as a strategy, and why that distinction matters to what we ship.',
                'meta_description' => 'AI writes code faster. We still read every line. The line between AI as a tool and AI as a strategy, and why that distinction matters to what we ship.',
                'published_at'     => '2026-07-18 10:27:55',
                'is_published'     => true,
                'faqs'             => [
                    [
                        'question' => 'When is AI worth adding to a business system?',
                        'answer'   => 'When it removes real, repetitive human effort. Surfacing the one anomaly in a report instead of making someone scan a spreadsheet, drafting a first-pass response a person still reviews, or classifying and routing incoming requests so nothing sits in an inbox unseen.',
                    ],
                    [
                        'question' => 'Where should AI be left out of a business system?',
                        'answer'   => 'Any decision you could not explain to your own customer if asked. Compliance-sensitive judgment calls, and anything touching money movement without a human check. If "the model said so" is not an acceptable answer, it stays a human decision.',
                    ],
                    [
                        'question' => 'Does ShiftTech use AI to write client code?',
                        'answer'   => 'Yes, for first drafts. Claude, Gemini and Copilot generate boilerplate, migrations and repetitive scaffolding inside our workflow. A senior engineer reads and reviews every line before it ships, because the model does not know your compliance rules.',
                    ],
                    [
                        'question' => 'Should every business add AI to its software?',
                        'answer'   => 'No, and often the honest answer is that it is not needed yet. The question worth asking is whether AI solves a real problem in your system or is being added because it is expected. If it does not make the system better for the person using it, it does not go in.',
                    ],
                ],
                'body'             => <<<'HTML'
<h2>When is AI worth adding to a business system?</h2>
<p>When it removes real, repetitive human effort and a person still reviews the output. Surfacing an anomaly, drafting a first-pass response, routing incoming requests. We leave it out of any decision you could not explain to your own customer, including compliance judgment calls and anything touching money movement.</p>

<p>Every client conversation eventually gets to "should we add AI to this?" Sometimes the answer is yes. Often it isn't. The question we actually ask first is narrower: does AI solve a real problem here, or are we adding it because it's expected?</p>

<h2>Where does AI earn its place?</h2>
<p>The systems we build use AI where it removes real, repetitive human effort:</p>
<ul>
<li>Surfacing the one anomaly in a report instead of making someone scan a spreadsheet</li>
<li>Drafting a first-pass summary or response that a person still reviews before it goes out</li>
<li>Classifying and routing incoming requests so nothing sits in an inbox unseen</li>
</ul>
<p>In each case, AI is doing the boring first pass so a person can spend their attention on the part that actually needs judgment.</p>

<h2>Where should AI be left out?</h2>
<p>We don't wire AI into a decision a client can't explain to their own customer if asked. Compliance-sensitive judgment calls, anything touching money movement without a human check, anything where "the model said so" isn't an acceptable answer. That stays a human decision, full stop.</p>

<blockquote>AI is only as good as the engineer reviewing it.</blockquote>

<h2>How does ShiftTech use AI day to day?</h2>
<p>Claude, Gemini, and Copilot generate first drafts of code inside our own workflow: boilerplate, migrations, repetitive scaffolding. A senior engineer reads and reviews every line before it ships. The model doesn't know your compliance rules or which shortcuts cost you in eighteen months. That judgment stays with the person who's accountable for the result.</p>

<p>AI is a tool we reach for when it earns its place, not a feature we bolt on for the press release. If it doesn't make the system genuinely better for the person using it, it doesn't go in.</p>
HTML,
            ],
            [
                'title'            => 'The Two Problems We Actually Solve for Clients',
                'slug'             => 'the-two-problems-we-actually-solve-for-clients',
                'category'         => 'Company',
                'author_name'      => 'Prosper Tinarwo',
                'excerpt'          => 'Most businesses do not need a website or a piece of software. They need to be findable, and they need to stop losing hours to manual work once people find them.',
                'meta_description' => 'Most businesses do not need a website or software. They need to be findable, and to stop losing hours to manual work once people find them.',
                'published_at'     => '2026-07-19 10:27:55',
                'is_published'     => true,
                'faqs'             => [
                    [
                        'question' => 'What problems does ShiftTech actually solve?',
                        'answer'   => 'Two, and most clients have both. Being findable, so an enquiry is not lost before you ever hear about it. And holding onto the work after the enquiry lands, instead of losing it to a spreadsheet, a WhatsApp thread and whoever remembers to follow up.',
                    ],
                    [
                        'question' => 'What kind of internal systems do you build?',
                        'answer'   => 'Quoting, job tracking, invoicing, client records, and whatever else a business actually runs on day to day. The test is not whether the software is interesting. It is whether the business can see its own pipeline well enough to grow it.',
                    ],
                    [
                        'question' => 'What results have ShiftTech clients seen?',
                        'answer'   => 'Trax Boats and Trailers replaced their inventory spreadsheets with a proper CRM and sales went up 40% within months. Western Cape Blood Service needed a monitoring system for their background services, and we delivered it four times faster than their own team had estimated.',
                    ],
                    [
                        'question' => 'Can we hire you for just the website, or just the software?',
                        'answer'   => 'You can, and plenty of businesses split the two across different suppliers. The cost is coordination. Nobody owns the whole picture, so nobody notices when leads are generated and then quietly wasted. We build both because the return shows up when they work together.',
                    ],
                ],
                'body'             => <<<'HTML'
<h2>What problems does ShiftTech actually solve?</h2>
<p>Two, and most businesses have both. Being findable, so an enquiry is not lost before you ever hear about it. And holding onto the work after it lands, instead of losing it to a spreadsheet and whoever remembers to follow up. We build both because the return only shows when they work together.</p>

<p>When a new client calls us, they usually describe the symptom, not the cause. "We need a website." "We need a system." What they actually have is one of two problems, and most of the time it is both.</p>

<h2>Problem one: nobody can find you</h2>
<p>A business can be excellent and still be invisible. If someone searches for what you do and your business does not show up, or shows up on a slow, confusing site, you lose the enquiry before you ever hear about it. That is not an abstract marketing problem. It is lost revenue, every day it goes unfixed.</p>
<p>Fixing it is not complicated. It takes a fast, clear site that actually answers the question a visitor came with, built so search engines can read it properly, with a way to get in touch that does not make someone hunt for your phone number.</p>

<h2>Problem two: the work falls apart after the enquiry lands</h2>
<p>This is the part most agencies never touch. A lead comes in through the website. Then what? For a lot of businesses, the honest answer is a spreadsheet, a WhatsApp thread, and whoever remembers to follow up. Nothing gets lost on purpose. It just falls through a crack that was never built to hold it.</p>
<p>This is where we build internal systems: quoting, job tracking, invoicing, client records, whatever the business actually runs on. Not because software is exciting, but because a business that cannot see its own pipeline cannot grow it.</p>

<blockquote>A website that gets you found and a system that does not lose what it found are the same problem, solved in two parts.</blockquote>

<h2>What this looks like with real numbers</h2>
<p>Peekaboo Daycare had been open for twenty years and still had almost no presence online. Parents searching for a daycare had no way to find them. Once a child was enrolled, admissions ran entirely on paper and phone calls, and the staff were drowning in it. That is both problems sitting in one business: twenty years of being invisible online, and a team buried in manual work once someone finally did call. We built them a site that actually shows up in search, and an admissions dashboard that replaced the paper trail with something the staff could run day to day.</p>
<p>The same pattern shows up elsewhere. When Trax Boats and Trailers replaced their inventory spreadsheets with a proper CRM, their sales went up 40% within months. When Western Cape Blood Service needed a monitoring system for their background services, we delivered it four times faster than their own team had estimated. Different businesses, same shape of problem, solved with software that matched how the business actually worked.</p>
<p>Visibility follows the same logic, just earlier in the chain. A lead that never finds your site converts at exactly 0%, no matter how good your systems are once someone arrives.</p>

<ul>
<li>Visibility gets you the enquiry</li>
<li>Systems make sure it turns into revenue</li>
<li>Together, that is the return a client can actually point to</li>
</ul>

<h2>Why we do not sell these separately</h2>
<p>You can hire one company for the website and a different one for the software, and plenty of businesses do. The cost is coordination. Nobody owns the whole picture, so nobody notices when leads are being generated and then quietly wasted. We build both because the return only shows up when they work together.</p>
HTML,
            ],
            [
                'title'            => 'Claude Code Builds Ugly Websites Until You Do This',
                // Headline on the page, title tag in the result. The headline is
                // built to be clicked on social; the title tag has to say what
                // the page is about to someone scanning ten blue links.
                'meta_title'       => 'Why Claude Code Builds Generic Websites | ShiftTech',
                'slug'             => 'claude-code-builds-ugly-websites',
                'category'         => 'AI',
                'author_name'      => 'Prosper Tinarwo',
                'cover_image'      => 'assets/images/blog/covers/claude-code-builds-ugly-websites.svg',
                'excerpt'          => 'You can build a website with AI in an afternoon. That does not mean you have built the right one. What to decide before you hand anything to an AI tool, and what to check before you call it finished.',
                'meta_description' => 'Your AI-built website looks generic because the direction was generic. What to decide before handing a website to Claude Code, and what to check before calling it done.',
                'published_at'     => '2026-08-11 10:27:55',
                'is_published'     => true,
                'faqs'             => [
                    [
                        'question' => 'Can I just use AI to build my business website?',
                        'answer'   => 'Yes, and you probably should use AI somewhere in the process. The question is not whether AI can produce a working website. It is whether it produces the right one: aimed at the right customer, with the right positioning, an obvious next step and a technical foundation you can build on. AI makes the building cheap. It does not decide what should be built.',
                    ],
                    [
                        'question' => 'Why do AI-generated websites look generic?',
                        'answer'   => 'Because the brief was generic. An instruction like "build me a modern website" contains almost no decisions, so the model fills the gaps with the patterns it has seen most often: a big hero, an enormous headline, a gradient, three identical cards and a Get Started button. Specific direction produces a specific website.',
                    ],
                    [
                        'question' => 'What should I decide before asking AI to build my website?',
                        'answer'   => 'Who the customer is, what they have to understand in the first ten seconds, why they should trust you, what action they should take, and what the business is actually trying to achieve. That last one might be enquiries, bookings, quote requests, visibility in search or fewer hours lost to manual admin. Those answers are the brief.',
                    ],
                    [
                        'question' => 'Does ShiftTech use AI to build client websites?',
                        'answer'   => 'Yes, wherever it creates leverage: prototyping, building interfaces, writing and refactoring code, automating repetitive work. Strategy, positioning, user experience, architecture and final quality control stay with the engineer. AI makes good engineers faster. It does not replace the judgement the business outcome depends on.',
                    ],
                ],
                'body'             => <<<'HTML'
<h2>Can AI build my website?</h2>
<p>Yes. You can have a working website out of a tool like Claude Code in an afternoon, and it will probably look fine. What AI cannot do on its own is decide who the site is for, why someone should choose you over the business down the road, and what the site has to make happen. Those decisions are the difference between a website that looks finished and one that earns its keep.</p>

<p>That is worth sitting with, because it is genuinely new. Building the thing used to be the expensive part. It is not any more.</p>

<p>More businesses can build a website than ever before. That does not mean more businesses are building good ones. A website can be technically impressive, visually polished and completely wrong for the business it belongs to.</p>

<h2>Why do AI-built websites all look the same?</h2>

<p>You have seen the pattern even if you have never named it. Big hero image. Enormous headline. Gradient background. Three rounded cards in a row. A button that says Get Started.</p>

<p>People call this AI slop and blame the tool. Claude Code, Cursor, Lovable, v0, they all get the same accusation.</p>

<p>The tool is not what produced it. The brief did.</p>

<p>"Build me a modern website" contains almost no decisions, so the model makes them for you, and it makes them the way it has seen them made a million times before. Generic input, statistically average output.</p>

<blockquote>You asked for a modern website. You got the average of every modern website.</blockquote>

<h2>AI can build your website. That does not mean it knows your business.</h2>

<p>Claude Code is genuinely good at turning clear instructions into working software. It reads a real codebase, writes real code and moves quickly. That part is not in dispute.</p>

<p>Here is what it does not know when you open a blank chat:</p>

<ul>
<li>Who your customers actually are</li>
<li>Why they pick you instead of the cheaper option</li>
<li>Which objection stops them from enquiring</li>
<li>What they need to see in the first ten seconds</li>
<li>What makes you different in a way a stranger would notice</li>
<li>What you want them to do next</li>
<li>What should be cut</li>
<li>What your brand is supposed to feel like</li>
</ul>

<p>Handing AI a vague website brief is like telling a builder to put up a nice house and then being surprised when they ask where the rooms go. The builder is not the problem. Nobody has decided anything yet.</p>

<h2>The problem is not AI. It is generic direction.</h2>

<p>Compare the brief most people give:</p>

<blockquote>Build me a modern website for my business.</blockquote>

<p>with one that answers a handful of ordinary business questions:</p>

<ul>
<li>Who the customer is, specifically</li>
<li>What the business does, in plain terms</li>
<li>Why customers choose it over the alternatives</li>
<li>What problem this website has to solve</li>
<li>What action a visitor should take</li>
<li>What the brand should feel like</li>
<li>What competitors are already doing</li>
<li>What people type into Google when they need this</li>
<li>What it has to work alongside in the business</li>
</ul>

<p>Same model. Same tool. Completely different amount of information to work from.</p>

<p><strong>Context beats clever prompting.</strong> There is no secret sentence that makes AI produce a premium website, and you do not need to become a prompt engineer. You need to know your own business well enough to describe it clearly. Most founders already do. They have just never written it down.</p>

<h2>Start with the business, not with Claude</h2>

<p>Before anything gets built, these are the questions worth answering on paper.</p>

<h3>Who is this for?</h3>
<p>Not everyone. A site aimed at everyone persuades nobody. A daycare speaking to a parent choosing where to leave their child is a different website from a cleaning company speaking to someone who wants a price and a date.</p>

<h3>What has to land in the first ten seconds?</h3>
<p>What you do, who you do it for, and why you are worth another thirty seconds. If a visitor has to scroll to work out what the business is, the design has already failed no matter how good it looks.</p>

<h3>Why should they trust you?</h3>
<p>Real work, real names, real detail. Trust is the thing generic websites are worst at, because trust is specific and generic copy is not.</p>

<h3>What should they do next?</h3>
<p>One obvious action, not five competing ones.</p>

<h3>What is the business actually trying to achieve?</h3>
<p>This is the question that gets skipped, and it changes everything downstream:</p>
<ul>
<li>More enquiries</li>
<li>More bookings</li>
<li>More quote requests</li>
<li>More phone calls</li>
<li>Better visibility in search</li>
<li>Fewer hours lost to manual admin</li>
</ul>
<p>A site built for bookings does not look like a site built for search visibility, which does not look like a site built to take work off your desk. Decide first, or the tool decides for you.</p>

<h2>References matter more than another prompt</h2>

<p>Before writing a brief, look at what already works. Awwwards, Land-book, Godly, Mobbin and Dribbble are the obvious places, though strong agency sites and the best sites in your own industry are often more useful.</p>

<p>Not to copy them. To work out what they are doing:</p>

<ul>
<li>How they explain what the business is worth</li>
<li>How they build trust before asking for anything</li>
<li>How they guide someone through the page</li>
<li>How much they show, and how much they leave out</li>
<li>How obvious they make the next step</li>
<li>How they avoid looking like everyone else in their category</li>
</ul>

<p>"I want mine to look like this" is copying. "Why does this work?" is learning. Only the second one gives you something you can use on your own site.</p>

<p>It also gives AI something specific to learn from instead of forcing it to invent everything from nothing, which is exactly the situation where it reaches for the average.</p>

<h2>Do not accept the first website AI gives you</h2>

<p>The first version looks good, so people ship it. That is the mistake.</p>

<p>Version one is a draft. You critique it and get version two. Critique again, version three. Sometimes four. AI has not removed the design process. It has made each round of it far cheaper, and that only helps if you actually do the rounds.</p>

<p>The questions worth asking on every pass are business questions, not design ones:</p>

<ul>
<li>Would my customer understand this?</li>
<li>Is it obvious what we do and what it is worth?</li>
<li>Is the next step clear?</li>
<li>Does this build trust, or does it just look expensive?</li>
<li>Is there anything on this page that earns nothing?</li>
<li>Does it look like every competitor in my industry?</li>
<li>Does it feel like our business, or like a template?</li>
<li>Does it work properly on a phone, where most people will see it?</li>
<li>Can anyone find it in the first place?</li>
</ul>

<p><strong>AI makes iteration cheaper. It does not make judgement unnecessary.</strong></p>

<h2>A website is not good because it looks good</h2>

<p>A screenshot hides almost everything that matters.</p>

<ul>
<li>A beautiful website that generates no enquiries is an expensive brochure.</li>
<li>A fast website nobody can find is invisible.</li>
<li>Traffic that convinces nobody is just traffic.</li>
<li>A site that converts but is painful to use will lose those customers later.</li>
</ul>

<p>Getting this right means design, user experience, conversion, search visibility, performance, accessibility, mobile, security, whatever it has to integrate with, and whether anyone can still maintain it in two years. Those are not separate projects. They are the same project, and they trade against each other constantly.</p>

<p>That is the part a screenshot cannot tell you, and it is most of the actual work in <a href="/services/web-design">designing and building a website</a> or a piece of <a href="/services/custom-software-development">custom software</a>.</p>

<h2>Real work, real constraints</h2>

<p>Three examples from <a href="/work">work we have shipped</a> where the decision that mattered had nothing to do with the code.</p>

<h3>Peekaboo Day Care</h3>
<p>The brief was never "build a dashboard". Twenty years in business with almost no presence online meant parents searching for a daycare could not find them, and once a child was enrolled, admissions ran entirely on paper. The real constraint was that the people using the admin every day are not technical. If the workflow did not make immediate sense to the staff, it would be back on paper within a month. That shaped the interface far more than any visual decision did. <a href="/work/peekaboo-daycare">Read the Peekaboo Day Care case study</a>.</p>

<h3>SpringKleaners</h3>
<p>Also not simply "build a cleaning website". Visitors had no way to tell what a clean would cost or whether the business even served their suburb, so most of them left. The business also needed to be findable across several Cape Town service areas without ending up with a pile of near-identical pages that help nobody. Local search structure, page differentiation and an instant quote flow were one decision, not three. <a href="/work/springkleaners">Read the SpringKleaners case study</a>.</p>

<h3>useLuminii</h3>
<p>The goal was never "make the hero look premium". A client needed to receive a quote and act on it without friction, so a quote opens straight from a link: no forced account creation, no steps between the visitor and the number they came for. Every unnecessary step is somewhere a lead quietly disappears. <a href="/work/luminii-saas-platform">Read the Luminii platform case study</a>.</p>

<p>None of those came from typing "make it modern". They came from understanding the business first, then using AI to execute faster.</p>

<h2>So what should you actually use AI for?</h2>

<p>Use it, and use it hard. It is very good at:</p>

<ul>
<li>Prototyping an idea before committing money to it</li>
<li>Building interfaces and components</li>
<li>Writing and refactoring code</li>
<li>Producing variations worth comparing</li>
<li>Automating repetitive work</li>
<li>Testing quickly whether something is worth building at all</li>
</ul>

<p>Keep these human:</p>

<ul>
<li>Strategy and positioning</li>
<li>Understanding the customer</li>
<li>Product decisions</li>
<li>Brand direction</li>
<li>User experience judgement</li>
<li>How the site converts</li>
<li>Technical architecture</li>
<li>Final quality control</li>
</ul>

<p><strong>Let AI do more of the execution. Do not let it make the decisions your business outcome depends on.</strong></p>

<h2>AI did not make developers obsolete. It changed what the good ones do.</h2>

<p>The skill losing value is "can you write this component". The skill gaining value is knowing which component should exist, why it should exist, and how it fits everything around it.</p>

<p>That judgement is still where projects are won or lost: architecture, trade-offs, security, performance, how systems talk to each other, what happens to the data, and whether anyone can still work on it in three years. AI accelerates an engineer who understands those things. It quietly multiplies the mistakes of one who does not. It is the same reason we <a href="/blog/our-default-stack-and-why-we-rarely-deviate-from-it">keep to a boring default stack</a> instead of chasing whatever is trending.</p>

<h2>The ShiftTech approach</h2>

<p>We use AI because it makes good engineers faster. Not because it removes the need for them.</p>

<p>In practice that means giving it the context before asking it to build: what the brand is, who the customer is, what the technical constraints are and what the business is trying to achieve. Every project we run carries that in a project context file (<code>CLAUDE.md</code>, in our case) so nothing has to be rediscovered at the start of every session. It is unglamorous, and it is most of the difference between a good result and a generic one.</p>

<p>The goal is not to produce more code. It is to produce better software, faster. Strategy, design, user experience, engineering, search and performance all get a say, with AI running through the whole of it as a tool rather than sitting at the end of it as the product. We take the same view of <a href="/services/ai">AI inside the systems we build</a> for clients: it <a href="/blog/where-ai-actually-earns-its-place-in-the-systems-we-build">earns its place where it removes real work</a>, and nowhere else.</p>

<p>Software is not the goal. Business value is.</p>

<h2>Do not start with the prompt. Start with the problem.</h2>

<p>Your next AI-built website does not need a better prompt. It needs better decisions.</p>

<p>Understand your customer. Define what the business is trying to achieve. Decide what the website has to accomplish. Find references worth learning from. Give AI that context. Let it build. Critique it. Iterate. Then make sure the engineering, the search visibility, the performance and the conversion path actually hold up.</p>

<p>That is how you get from "AI built this website" to "this is a good website that happened to be built with AI".</p>

<p><strong>AI is not the problem. Using AI without knowing what you are trying to build is.</strong></p>

<div class="section-cta">
<h2>Building with AI?</h2>
<p>If you already have a website, an AI-generated prototype or a software idea, and you want an honest read on what needs to improve, we will assess it before you spend more time or money building the wrong thing.</p>
<a class="btn btn-lime" href="/contact">Get a Free Systems Audit <span aria-hidden="true">&rarr;</span></a>
</div>
HTML,
            ],
        ];
    }

    public function run(): void
    {
        foreach (static::posts() as $post) {
            $created = Post::firstOrCreate(['slug' => $post['slug']], $post);

            $state = $created->wasRecentlyCreated ? 'created  ' : 'exists   ';

            // The four launch posts shipped before the faqs column existed, so
            // they are already in production without any. Backfill them, but
            // only when empty, so FAQs edited through the admin still win.
            if (! $created->wasRecentlyCreated && empty($created->valid_faqs) && ! empty($post['faqs'])) {
                $created->update(['faqs' => $post['faqs']]);
                $state = 'faqs +   ';
            }

            $this->command->info($state . $post['slug']);
        }
    }
}
