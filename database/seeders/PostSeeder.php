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
            [
                'title'            => 'Software Projects Fail Before the First Line of Code',
                'meta_title'       => 'Questions to Ask Before Building Software | ShiftTech',
                'slug'             => 'questions-to-ask-before-building-software',
                'category'         => 'Process',
                'author_name'      => 'Prosper Tinarwo',
                'cover_image'      => 'assets/images/blog/covers/questions-to-ask-before-building-software.svg',
                'excerpt'          => 'The engineering is usually fine. The problem was never defined properly. Here are the questions we ask on every discovery call, before a number exists, and why quoting fixed price forces us to ask them.',
                'meta_description' => 'The questions to ask before building software: what breaks today, who uses it, what the process looks like now, and what has to be true on day one.',
                'published_at'     => '2026-08-19 23:01:47',
                'is_published'     => true,
                'faqs'             => [
                    [
                        'question' => 'Why do software projects fail?',
                        'answer'   => 'Most fail before anyone writes code. The engineering is usually competent. The problem the software was built to solve was never defined properly, so the finished system answers a slightly different question. It surfaces later as bugs, slipped deadlines or a system nobody uses, but the decision that caused it was made in the first week.',
                    ],
                    [
                        'question' => 'What questions should I ask before building software?',
                        'answer'   => 'Five, in this order. What breaks today and who feels it, in something countable. Who uses this, and on what kind of day. What the process looks like right now, including the odd steps. What the smallest version worth having is. And what has to be true on day one: integrations, data, permissions, regulation, and who maintains it in two years.',
                    ],
                    [
                        'question' => 'How long should discovery take before a software quote?',
                        'answer'   => 'At ShiftTech, about an hour on a call, then a fixed price and a timeline within 48 hours. Discovery is not a separately billed phase here and it is not weeks of workshops. It is the conversation that has to happen before a number means anything.',
                    ],
                    [
                        'question' => 'How do I tell whether a development agency understands my problem?',
                        'answer'   => 'Listen to what they ask before they quote. An agency that gives you a number without asking what the problem costs you today, who uses the system, and what it has to fit into is pricing your sentence rather than your problem. The questions are the audition.',
                    ],
                ],
                'body'             => <<<'HTML'
<h2>Why do software projects fail?</h2>
<p>Most of them fail before anyone writes a line of code. The engineering is usually fine. The problem the software was built to solve was never defined properly, so the finished system answers a slightly different question, and everybody finds that out after the money is gone. The fix is not better developers. It is a harder conversation at the start.</p>

<p>It rarely announces itself that way. It shows up as bugs, slipped deadlines, a redesign eight weeks after launch, or a system the staff quietly stop using. Those are symptoms of a decision made too early on too little information, and everything built afterwards inherits it.</p>

<h2>Most briefs arrive as a solution</h2>

<p>"We need an app." "We need a booking system." "We need a dashboard." Each of those is an answer, and none of them is a problem. That is not a criticism, it is how people describe what they want. But if nobody separates the two, the agency builds the sentence instead of the outcome behind it, and both sides stay happy until launch.</p>

<p>So the first question is never about features. It is this: if we build nothing, what does that cost you over the next year? A specific answer means the project is real. A vague one means it is not ready to be quoted, and scoping detail will not hide that later.</p>

<h2>The questions we ask before we quote</h2>

<p>These come up on the discovery call, before any number exists. About an hour, and <strong>the cheapest hour in the project</strong>.</p>

<img src="/assets/images/blog/inline/questions-workflow.svg" alt="Five short questions, asked on the discovery call, converging into one outcome: a fixed price and timeline within 48 hours." loading="lazy">

<div class="qa-steps">

<h3>What breaks today, and who feels it?</h3>
<p>Hours lost, enquiries missed, invoices sent late, one person holding the whole process in their head. Put it in something countable. "It is inefficient" is not a target. <strong>"We lose about ten hours a week capturing the same order twice" is</strong>, and you can measure whether the software moved it.</p>

<h3>Who uses this, and on what kind of day?</h3>
<p>Software gets used by real people under real pressure, not by a persona on a slide. A parent choosing a daycare on their phone at ten at night. A plumber with wet hands standing in someone's kitchen. An admin clerk with forty of these to get through before lunch. Each of those produces a different product, and only one of them is right.</p>

<h3>What does the process look like right now?</h3>
<p>Whatever a business does today works well enough to keep it running, and the odd steps usually have good reasons behind them. Walk it end to end before replacing it. <strong>Half of what looks like waste is a control someone added after being burnt once</strong>, and stripping it out is how a better system becomes the one nobody trusts.</p>

<h3>What is the smallest version worth having?</h3>
<p>Not the cheapest version. <strong>The smallest one that changes something in the business the week it goes live.</strong> Everything else follows once real people have used it. The order in which capability arrives is a decision, not a byproduct of what was easiest to build first.</p>

<h3>What has to be true on day one?</h3>
<p>The unglamorous constraints. What it has to talk to, what data cannot move, who must not see what, which regulation applies, what happens when the connection drops, who maintains it in two years. Cheap to design around at the start, expensive to retrofit. Most of the painful rebuilds we get called into started right here, which is also why we <a href="/blog/our-default-stack-and-why-we-rarely-deviate-from-it">keep to a boring default stack</a>.</p>

</div>

<blockquote>An hourly agency can afford a vague brief. A fixed-price one cannot.</blockquote>

<h2>Three projects where the answer changed the build</h2>

<div class="mini-cases">

<div class="mini-case">
<span class="mini-case__tag">Peekaboo Day Care</span>
<p><strong>The constraint that mattered was that the staff running admissions are not technical</strong>, so anything that did not make immediate sense would be back on paper within a month. That shaped the admin more than any visual decision did.</p>
<a href="/work/peekaboo-daycare">Read the case study &rarr;</a>
</div>

<div class="mini-case">
<span class="mini-case__tag">SpringKleaners</span>
<p>Visitors were leaving because they could not tell what a clean would cost or whether the business covered their suburb. <strong>Pricing and service areas were the product, not the design.</strong></p>
<a href="/work/springkleaners">Read the case study &rarr;</a>
</div>

<div class="mini-case">
<span class="mini-case__tag">Ribbon Plumbing</span>
<p>The question worth asking was when their customers have the problem, which is at midnight with water coming through a ceiling. <strong>That answer decided the entire flow.</strong></p>
<a href="/work/ribbon-plumbing">Read the case study &rarr;</a>
</div>

</div>

<h2>Why we ask more than most</h2>

<p>Partly because it produces better software. Mostly because <a href="/blog/why-we-quote-fixed-price-not-hourly">we quote a fixed price</a>. If we misunderstand the problem, we absorb the cost of putting it right, not you. The incentive sits where it belongs: understand it now, or pay for it later out of our own margin.</p>

<p>It is also why we turn work down. A project nobody can describe clearly is not a project yet, and it rarely lands on either of the <a href="/blog/the-two-problems-we-actually-solve-for-clients">two problems worth paying to solve</a>.</p>

<h2>What to do with this before you hire anyone</h2>

<p>Write your answers down first, in your own words, on one page. It costs an evening and changes what you get back from every agency you speak to.</p>

<p>Then use the questions as your filter. Anyone who hands you a number without asking what this costs you today, who uses it, and what it has to fit into is pricing your sentence rather than your problem. What an agency asks before quoting tells you more than a portfolio does.</p>

<p>Good <a href="/services/custom-software-development">custom software</a> is not mainly a technical achievement. The technical part is what we can promise. The valuable part is arriving at the right thing to build, and that gets decided long before anyone opens an editor.</p>

<p>This piece started with <a href="https://businesstech.co.za/news/industry-news/865915/building-successful-software-starts-with-asking-the-right-questions/" rel="noopener" target="_blank">an article in BusinessTech</a> making the same argument. That it still needs saying is the point.</p>

<div class="section-cta">
<h2>Not sure the brief is right yet?</h2>
<p>Bring us the problem rather than the spec. Within 48 hours of the call you get what we would build, what we would leave out, and what it costs.</p>
<a class="btn btn-lime" href="/contact">Book a Discovery Call <span aria-hidden="true">&rarr;</span></a>
</div>
HTML,
            ],
            [
                'title'            => 'Off-the-Shelf vs Custom Software: How We Tell Clients Which One They Actually Need',
                'meta_title'       => 'Off-the-Shelf vs Custom Software: Which Do You Need? | ShiftTech',
                'slug'             => 'off-the-shelf-vs-custom-software-which-one-do-you-need',
                'category'         => 'Process',
                'author_name'      => 'Prosper Tinarwo',
                'excerpt'          => 'Buying a subscription is not automatically the cheap option, and building custom is not automatically the expensive one. Here is the actual test we use, and what it looked like for an auction house that outgrew paper and generic tools in the same year.',
                'meta_description' => 'Off-the-shelf or custom software? The real test we use with clients, the hidden cost of forcing a business into someone else\'s workflow, and how it played out for BSL Auction Services.',
                'published_at'     => '2026-09-17 09:15:00',
                'is_published'     => true,
                'faqs'             => [
                    [
                        'question' => 'How do I know if my business needs custom software instead of an off-the-shelf tool?',
                        'answer'   => 'Ask whether the process you are trying to fix is the same as everyone else\'s, or specific to how your business actually runs. If a generic tool covers 90% of it and the other 10% does not matter, buy it. If that last 10% is the part your business is actually built on, an off-the-shelf tool will fight you on it forever.',
                    ],
                    [
                        'question' => 'Is custom software always more expensive than buying a subscription?',
                        'answer'   => 'Not once you count total cost, only upfront cost. A subscription is cheaper to start and compounds monthly, forever, per seat, while a custom build is a larger number once that you then own outright. Over two or three years, the businesses paying the most are often the ones who thought they chose the cheap option.',
                    ],
                    [
                        'question' => 'What happens when off-the-shelf software does not fit how a business actually works?',
                        'answer'   => 'The business bends to the tool instead of the other way around. Staff build workarounds, keep a parallel spreadsheet for the part the software cannot do, or manually re-enter data between two systems that were never going to talk to each other. That workaround is a real, ongoing cost, it just never appears on an invoice.',
                    ],
                    [
                        'question' => 'How long does custom software take compared to setting up an off-the-shelf tool?',
                        'answer'   => 'An off-the-shelf tool can be live in days. Custom software takes longer to build because it is being shaped around your process rather than the other way around. The honest comparison is not the setup time, it is the setup time plus every month of workaround the off-the-shelf tool will need for as long as you run it.',
                    ],
                    [
                        'question' => 'Does ShiftTech ever tell a client to buy something instead of building it?',
                        'answer'   => 'Regularly. If a client\'s problem is well served by an existing tool, we say so on the discovery call and they save the build cost. We quote fixed price, so recommending a cheaper off-the-shelf option earns us nothing extra. The recommendation is worth trusting precisely because it costs us to make it.',
                    ],
                ],
                'body'             => <<<'HTML'
<h2>Should you buy off-the-shelf software or build something custom?</h2>
<p>Buy when a generic tool covers what your business actually needs, and the small percentage it does not cover genuinely does not matter. Build custom when that uncovered part is the part your business runs on, because a subscription that does not fit will cost you in workarounds every month for as long as you keep paying for it.</p>

<p>Most businesses treat this as a budget decision. It is really a fit decision, and the two get confused constantly because the price tags are so far apart at the start. A subscription is cheap on day one. Custom software is not. That difference is real and it matters, but it is only half the sum.</p>

<h2>When off-the-shelf is the right call</h2>
<p>We say this to clients often enough that it is worth being upfront about it: plenty of problems do not need <a href="/services/custom-software-development">custom software</a> at all. Buy an existing tool when:</p>
<ul>
<li>Your process is close to how most businesses in your industry already work</li>
<li>The tool's defaults cover the workflow, and the gaps are minor enough to live with</li>
<li>You need something running this week, not this quarter</li>
<li>The category is genuinely commoditised: accounting, email, basic scheduling</li>
</ul>
<p>Accounting software, email, generic scheduling tools. Buying is usually right there, and we tell clients so. Where it stops being right is the moment your business is winning on the part that tool cannot do.</p>

<h2>When custom software earns back what it costs</h2>
<p>The businesses that come to us for <a href="/services/custom-software-development">custom internal tools and business systems</a> have usually already tried the off-the-shelf route. Not because they skipped a step, but because the fit only breaks once a business has actually grown into the part that does not match the shape of the tool.</p>
<p>The tell is consistent: staff keeping a second spreadsheet for the thing the software cannot do, manually re-typing data between two systems that were never going to talk to each other, or a process getting quietly simplified to fit what the tool allows rather than what the business needs. Each of those looks like a minor annoyance in isolation. Together, they are a business paying, in time, for software that was supposed to save it time.</p>

<h2>The cost comparison nobody puts in the sales deck</h2>
<p>A subscription's sticker price is the cheapest number in the conversation, and it is also the least complete one. It compounds monthly, scales per seat, and rarely covers what the workaround costs in staff time. Custom software is the opposite shape: a larger number once, then a system you own outright that does not charge you more as you add people or grow the process it was built for.</p>
<p>Neither shape is automatically cheaper. A five-person business with a simple process usually loses on total cost by building custom for something a R500-a-month tool already does well. A business whose whole operation runs on the part no off-the-shelf tool handles usually loses, for years, by not building. The honest question is not "what does this cost to start", it is "what does this cost to run for three years, including everything it doesn't fix."</p>

<h2>What this looked like for BSL Auction Services</h2>
<p>BSL runs vehicle and machinery auctions, where a single sale day generates more records than most businesses produce in a month. Lots, bidders, bids and settlements were being recorded by hand, and the record only became complete once someone had gone back afterwards and pieced it together. A bigger sale day did not just mean more revenue. It meant proportionally more filing, arriving after the auction instead of during it.</p>
<p>Generic auction or e-commerce platforms exist, and they can list items and take bids. What they do not do is run bidding, listings, and settlements as one operational record that a small admin team can read in real time on a sale day, rather than reconstruct afterwards. Bending BSL's operation to fit a generic tool would have meant giving up the parts of the business that make it BSL, in exchange for software that was never built for an auction house's sale day.</p>
<p>So we built one platform instead of buying one: a public auction site where bidding opens up beyond whoever can be in the room, and an operations dashboard where listings, bids and records live together, captured the moment they happen rather than written up once the day is over. A bid placed by a customer on the public site is already in the record the team works from. That is the part no off-the-shelf tool was going to give them, because it is specific to how an auction actually runs.</p>
<blockquote>ShiftTech built our auction website and admin platform exactly to our needs. They understood our business and delivered a system that simplified operations and reduced manual work. We're very happy with the result.<br>&mdash; Conrad, Operations Manager, BSL Services</blockquote>
<p>The result, in BSL's own terms: the filing that used to follow every sale is now largely produced by the system as the sale happens, the bidding pool is no longer limited to people who can attend in person, and lots, bids and settlements stopped living in separate paper records. Read the <a href="/work/bsl-auction-services">full BSL Auction Services case study</a> for the detail on how the platform is built.</p>

<h2>The questions that actually decide it</h2>
<p>We do not start a discovery call by pitching custom software. We start by trying to talk a client out of needing it, because we quote fixed price and a wrong recommendation costs us, not them. The questions that settle it:</p>
<ul>
<li>Is the process you are fixing the same as everyone else's, or specific to your business?</li>
<li>What is the workaround costing you today, in hours, not just in frustration?</li>
<li>Would a bigger version of your business still fit inside this tool, or would you outgrow it the way BSL outgrew paper?</li>
<li>Does the category genuinely have a mature, well-fitting product already, or are you comparing against a tool built for a slightly different problem?</li>
</ul>
<p>These are the same <a href="/blog/questions-to-ask-before-building-software">questions we ask before quoting any custom build</a>, because "should we buy or build" is really the same question as "what does this business actually need", asked one step earlier.</p>

<h2>The honest version of our advice</h2>
<p>If an off-the-shelf tool genuinely fits, we will tell you that in the first call and save you the build cost. We turn that recommendation into revenue for us exactly zero times, which is precisely why it is worth trusting. When the fit genuinely is not there, custom software stops being the expensive option and becomes the one that stops charging you every month for a workaround.</p>

<div class="section-cta">
<h2>Not sure which one you need?</h2>
<p>Tell us what you are trying to fix. If a tool you can buy today already solves it, we will say so. If it does not, you will get a fixed price and a timeline within 48 hours.</p>
<a class="btn btn-lime" href="/contact">Book a Discovery Call <span aria-hidden="true">&rarr;</span></a>
</div>
HTML,
            ],
            [
                'title'            => 'What Replacing a Manual Process Actually Looks Like, Start to Finish',
                'meta_title'       => 'Replacing a Manual Process With Software: The Real Steps | ShiftTech',
                'slug'             => 'replacing-a-manual-process-with-software-start-to-finish',
                'category'         => 'Process',
                'author_name'      => 'Prosper Tinarwo',
                'excerpt'          => 'The build is rarely what goes wrong. Migrating the old records, running two systems side by side, and getting staff to actually stop using the spreadsheet are where a manual process replacement is won or lost. Here is the sequence we run, with Peekaboo Daycare\'s twenty years of paper admissions as the example.',
                'meta_description' => 'What actually happens when you replace a manual process with software: mapping it, migrating the data, running old and new side by side, and getting staff to adopt it.',
                'published_at'     => '2026-09-24 09:15:00',
                'is_published'     => true,
                'faqs'             => [
                    [
                        'question' => 'How long does it take to replace a manual process with software, start to finish?',
                        'answer'   => 'It depends far less on the build than people expect. A focused process, like one form of admissions or one type of job tracking, can go from discovery call to live system in a matter of weeks. What extends the timeline is usually migration and adoption, not code: how much old data needs cleaning up, and how long the parallel run needs to last before anyone trusts the new system alone.',
                    ],
                    [
                        'question' => 'Do we have to stop using our spreadsheet or paper system the day the new software launches?',
                        'answer'   => 'No, and we would tell you not to. We run the old and new process side by side for a period before anyone deletes the paper trail or the spreadsheet, so if the new system misses something, the business has not lost the record while it gets fixed. Cutting over on day one is how businesses lose data, not how they gain confidence.',
                    ],
                    [
                        'question' => 'What happens to our old records when we move off spreadsheets or paper?',
                        'answer'   => 'They get migrated, but not always all of them, and not always automatically. Part of the discovery process is deciding what history actually needs to live in the new system versus what can stay archived. Moving ten years of paper files into a database nobody will ever query again is effort spent on the wrong thing.',
                    ],
                    [
                        'question' => 'What is the biggest risk when replacing a manual process, other than the build itself?',
                        'answer'   => 'Staff quietly going back to the old way because the new system did not fit how they actually work. A system nobody opens is worse than the process it replaced, because now the business has paid for software and still has no reliable record. This is why we design around the person doing the task daily, not the person who signed off on the project.',
                    ],
                    [
                        'question' => 'How do you get staff to actually use new software instead of falling back to old habits?',
                        'answer'   => 'By building it around their actual day rather than an idealised workflow, and by launching the smallest version that changes something for them in week one. A system that immediately removes a task someone hated doing gets adopted. A system that adds steps before it removes any gets quietly abandoned within a month.',
                    ],
                ],
                'body'             => <<<'HTML'
<h2>What does replacing a manual process with software actually involve?</h2>
<p>Five stages, in order: map the process as it is actually run, decide what data genuinely needs to move, build the smallest version that changes something in week one, run the old and new process side by side before anyone deletes the paper trail, then support the system once real people are depending on it. Most of what goes wrong happens in the middle three, not in the code.</p>

<p>Ask someone what it takes to "replace the spreadsheet" and they will usually describe the finished software. What actually determines whether the project works is everything around the build: whether the old records survive the move, whether the cutover has a safety net, and whether the people doing the work every day actually pick the new system up.</p>

<h2>Step one: map the process as it is actually run</h2>
<p>Not the process on the org chart. The one with the odd manual step someone added after being burnt once, the exception that happens every second Tuesday, the workaround nobody wrote down because everyone already knows it. This is the same discovery work behind every <a href="/services/custom-software-development">custom system we build</a>, and skipping it is the single most common reason a "replacement" ships and still does not match how the business runs.</p>
<p>Half of what looks like waste in a manual process is a control someone added for a reason. Strip it out before understanding why it is there, and the new system quietly reintroduces the mistake it was meant to prevent.</p>

<h2>Step two: decide what data actually needs to move</h2>
<p>Migration is where timelines actually stretch, not the interface. Old spreadsheets have inconsistent formatting, paper records have gaps, and years of history sitting in a filing cabinet is rarely worth digitising in full. Part of this stage is blunt triage: what has to be searchable in the new system on day one, what can stay archived as a scanned reference, and what is genuinely fine to leave behind. Moving everything because deleting anything feels risky is how a two-week migration becomes a two-month one.</p>

<h2>Step three: build the smallest version that changes something in week one</h2>
<p>Not the cheapest version, the smallest one that removes a real task the first week it is live. Everything else gets added once real people have used it and told you what actually matters, rather than what seemed important in a planning meeting. The order capability arrives in is a decision, not a side effect of what was easiest to build first.</p>

<h2>Step four: run old and new side by side before anyone deletes anything</h2>
<p>This is the step that gets skipped under time pressure, and it is the one that actually protects the business. For a defined period, the manual process keeps running alongside the new system. If the software misses an edge case, the paper trail or the spreadsheet is still there to catch it. Only once the new system has proven itself on real days, not a demo, does the old process actually get retired.</p>
<p>Cutting over in one move, all at once, on a Friday, is how businesses lose a week of records they cannot get back. A parallel run costs a bit of double entry for a short period. It is cheap insurance against the alternative.</p>

<h2>Step five: go-live is a training problem, not a technical one</h2>
<p>The software can be finished and the project can still fail here. A system nobody opens is worse than the manual process it replaced, because the business has now paid for software and still has no reliable record of what happened. Staff adopt a new system when it removes something they hated doing in week one. They quietly fall back to the old way when it adds steps before it removes any.</p>

<h2>What this looked like for Peekaboo Daycare</h2>
<p>Peekaboo Daycare & Preschool had twenty years of reputation and admissions that ran entirely on paper. Forms, records and enrolment status lived in folders, and the actual state of an intake was whatever the person holding the file happened to remember. A bigger enrolment season did not just mean more children. It meant more folders, more forms, and more chances for a record to go missing between two staff members.</p>
<p>The process mapping mattered before anything else here, because the risk was not technical. Anything that did not make immediate sense to non-technical staff running admissions day to day would be back on paper within a month, no matter how well it was built. So the dashboard was shaped around how intake actually happens: a status you look up, not one you ask the person holding the folder about. Existing enrolment records moved into the new system deliberately, not wholesale, so what the staff needed on day one was there and nothing else added noise.</p>
<blockquote>For twenty years we ran on paper and phone calls, with almost no way for parents to find us online. ShiftTech built us a website that actually gets found and an admissions dashboard that replaced the paperwork. Our team can finally keep up.<br>&mdash; Peekaboo Daycare &amp; Preschool</blockquote>
<p>Intake status became something staff could look up instead of something they had to ask about, records stopped being spread across folders, and administrative time moved back toward the children instead of the paperwork. Read the <a href="/work/peekaboo-daycare">full Peekaboo Daycare case study</a> for how the admissions dashboard and the site that finally gets found were built.</p>

<h2>What happens after go-live</h2>
<p>The manual process is retired, not the relationship. The first weeks after cutover surface the edge cases discovery could not predict, because real days are messier than the mapped-out process. That is expected, not a sign something was missed. What matters is whether whoever built the system is still around to fix it quickly, which is <a href="/blog/why-we-quote-fixed-price-not-hourly">part of why we quote fixed price and stay accountable for the estimate</a> rather than billing every hour spent smoothing out week two.</p>

<h2>Why this sequence, and not straight to the build</h2>
<p>Replacing a manual process is not a coding problem wearing a business disguise. The code is usually the fastest part. What takes care is making sure the old records survive the move, the cutover has a safety net, and the person actually doing the work every day is the one the system was built around. Skip any of those and you get a technically correct system that the business quietly stops trusting.</p>

<div class="section-cta">
<h2>Still running on a spreadsheet or a filing cabinet?</h2>
<p>Tell us what the manual process actually looks like today, exceptions included. Within 48 hours you get a fixed price, a timeline, and what the migration and cutover would involve.</p>
<a class="btn btn-lime" href="/contact">Book a Discovery Call <span aria-hidden="true">&rarr;</span></a>
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
