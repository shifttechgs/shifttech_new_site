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
    public function run(): void
    {
        $posts = [
            [
                'title'            => 'Why We Quote Fixed Price, Not Hourly',
                'slug'             => 'why-we-quote-fixed-price-not-hourly',
                'category'         => 'Process',
                'author_name'      => 'Prosper',
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
<p>Hourly billing sounds fair until you sit on the other side of it. The agency gets paid more the longer a feature takes, and you have no way to tell whether three days of work was actually three days of work. We don't run engagements that way.</p>

<h2>The number comes before the code</h2>
<p>Every project starts with a discovery call, not a rate card. We ask what's actually broken, what a good outcome looks like, and what's out of scope. Within 48 hours of that call, you get a fixed quote and a timeline. Not a "ballpark." Not a range with an asterisk.</p>

<h2>What happens when scope changes</h2>
<p>It happens on nearly every project, and it's not a problem as long as it's handled honestly:</p>
<ul>
<li>We flag the change as soon as we see it coming, not at invoicing time</li>
<li>You get a new fixed number for the added scope before we touch it</li>
<li>The original quote doesn't quietly balloon to cover it</li>
</ul>

<blockquote>If a client can't predict their bill, they stop trusting every other number you give them.</blockquote>

<h2>Why this is harder for us, not easier</h2>
<p>Fixed pricing means we carry the risk when we underestimate something, not you. That's the point. It forces us to actually understand a problem before quoting it, instead of leaving ourselves room to bill our way out of a bad estimate.</p>

<p>It also means we turn down projects we can't scope with confidence, rather than take the work and figure it out on the clock. We'd rather lose the project than lose the trust.</p>
HTML,
            ],
            [
                'title'            => 'Our Default Stack, and Why We Rarely Deviate From It',
                'slug'             => 'our-default-stack-and-why-we-rarely-deviate-from-it',
                'category'         => 'Engineering',
                'author_name'      => 'Prosper',
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
                'author_name'      => 'Prosper',
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
<p>Every client conversation eventually gets to "should we add AI to this?" Sometimes the answer is yes. Often it isn't. The question we actually ask first is narrower: does AI solve a real problem here, or are we adding it because it's expected?</p>

<h2>Where it earns its place</h2>
<p>The systems we build use AI where it removes real, repetitive human effort:</p>
<ul>
<li>Surfacing the one anomaly in a report instead of making someone scan a spreadsheet</li>
<li>Drafting a first-pass summary or response that a person still reviews before it goes out</li>
<li>Classifying and routing incoming requests so nothing sits in an inbox unseen</li>
</ul>
<p>In each case, AI is doing the boring first pass so a person can spend their attention on the part that actually needs judgment.</p>

<h2>Where we leave it out</h2>
<p>We don't wire AI into a decision a client can't explain to their own customer if asked. Compliance-sensitive judgment calls, anything touching money movement without a human check, anything where "the model said so" isn't an acceptable answer. That stays a human decision, full stop.</p>

<blockquote>AI is only as good as the engineer reviewing it.</blockquote>

<h2>How we actually use it day to day</h2>
<p>Claude, Gemini, and Copilot generate first drafts of code inside our own workflow: boilerplate, migrations, repetitive scaffolding. A senior engineer reads and reviews every line before it ships. The model doesn't know your compliance rules or which shortcuts cost you in eighteen months. That judgment stays with the person who's accountable for the result.</p>

<p>AI is a tool we reach for when it earns its place, not a feature we bolt on for the press release. If it doesn't make the system genuinely better for the person using it, it doesn't go in.</p>
HTML,
            ],
            [
                'title'            => 'The Two Problems We Actually Solve for Clients',
                'slug'             => 'the-two-problems-we-actually-solve-for-clients',
                'category'         => 'Company',
                'author_name'      => 'Prosper',
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
        ];

        foreach ($posts as $post) {
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
