<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'The Two Problems We Actually Solve for Clients',
                'category' => 'Company',
                'excerpt' => 'Most businesses do not need a website or a piece of software. They need to be findable, and they need to stop losing hours to manual work once people find them.',
                'published_at' => now(),
                'body' => <<<'HTML'
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
                'title' => 'Why We Quote Fixed Price, Not Hourly',
                'category' => 'Process',
                'excerpt' => 'Hourly billing puts the incentive in the wrong place. Here is how we scope a fixed number before a line of code gets written, and what happens when the scope changes.',
                'published_at' => now()->subDays(12),
                'body' => <<<'HTML'
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
                'title' => 'Our Default Stack, and Why We Rarely Deviate From It',
                'category' => 'Engineering',
                'excerpt' => 'C# and Angular, with other tools borrowed in when a project actually needs them. Not because they are trendy, but because we can debug them at 11pm without reading documentation.',
                'published_at' => now()->subDays(6),
                'body' => <<<'HTML'
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
                'title' => 'Where AI Actually Earns Its Place in the Systems We Build',
                'category' => 'AI',
                'excerpt' => 'AI writes code faster. We still read every line. Here is the line between AI as a tool and AI as a strategy, and why that distinction matters to what we ship.',
                'published_at' => now()->subDay(),
                'body' => <<<'HTML'
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
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($post['title'])],
                array_merge($post, [
                    'author_name' => 'Prosper',
                    'is_published' => true,
                ])
            );
        }
    }
}
