# Blog SEO & AI Citation Plan

**Target market:** South Africa, Cape Town focus
**Cadence:** 4+ posts per month
**Service lines:** custom software / internal tools, AI integration, web & product design, mobile apps
**Written:** 3 August 2026

---

## 1. Where you actually stand

The blog is empty. `https://shifttechgs.com/blog` renders "Coming soon." Four drafts exist in the local dev database and were never deployed, so production has zero posts.

That is the whole gap. The technical foundation is already better than most agency sites:

| Foundation | Status |
|---|---|
| `BlogPosting` + `BreadcrumbList` JSON-LD on posts | Present, all 5 blocks parse as valid JSON |
| `Organization` + `ProfessionalService` (Cape Town and Harare) | Present, with address, phone, `areaServed: ZA` |
| Posts auto-added to `sitemap.xml` | Working (`SitemapController`) |
| Posts auto-added to `llms.txt` | Working (`LlmsTxtController`) |
| IndexNow ping on publish | Working (`PostObserver` → `IndexNowService`) |
| HTTPS canonicals | Fixed 3 Aug 2026 |

The `llms.txt` and IndexNow pieces are genuinely ahead of the field. Most agencies do not have either.

**So this is not a "build SEO infrastructure" project. It is a "ship content into infrastructure that already works" project.** That reframes the effort: the constraint is your writing time, not engineering time.

### One caveat on numbers

I have no live keyword data. The DataForSEO integration is not connected, so I have deliberately not put search volumes or difficulty scores in this plan. Any number I invented would be worse than none. Everything below is reasoned from your market position and buyer behaviour. **Validate the priority terms in Google Keyword Planner or Search Console before committing a quarter to them.** Section 9 covers how.

---

## 2. The strategic bet

A new blog on a young domain cannot win "software development company" or "custom software development". Those are owned by sites with a decade of links.

Two things you *can* win, and they compound:

**Bet 1: Cape Town and South African intent.** "custom software development Cape Town" style queries have low volume and low competition. A handful of local competitors, most with thin pages. Low volume is fine when a single won deal is worth six figures. This is where your revenue comes from first.

**Bet 2: AI citation on specific operational questions.** This is the bigger long-term play and it suits you unusually well.

AI engines cite content with specific, verifiable, first-hand detail. They struggle to cite generic advice because a hundred pages say the same thing. You have things almost nobody else publishing in this space has:

- Real numbers from real projects. Trax Boats 40%. WCBS 4x faster.
- A genuinely contrarian, defensible position (C# and Angular by default, not the trending framework).
- Founder-led delivery, meaning you can write "here is what happened on the actual project" rather than "here are 10 tips".

That combination is exactly what gets quoted in AI Overviews, ChatGPT, and Perplexity. Generic "10 tips for choosing a software developer" content will lose to everyone. Specific operational writing from someone who ships is defensible.

**The strategic point: do not write to rank. Write the thing only you could write, then make it structurally easy to extract.** Ranking follows; citation follows faster.

---

## 3. Architecture: your service pages are the hubs

Do not build new hub pages. You already have six service pages, and they are the money pages. The blog exists to push authority into them.

```
/services/custom-software-development   ← HUB
    ├── blog post (spoke) ──┐
    ├── blog post (spoke) ──┼── each links UP to the hub
    └── blog post (spoke) ──┘

/services/ai                            ← HUB
/services/web-design                    ← HUB
/services/mobile-app-development        ← HUB
```

**The rule: every post links to its hub service page in the first third of the body, using descriptive anchor text.** Not "click here". Use "custom internal tools we build" pointing at the service page. This is the single highest-leverage internal linking habit and it costs nothing per post.

Four clusters, matching the four service lines you picked. At 4 posts a month, one post per cluster per month keeps all four building evenly and gives each cluster 12 posts in a year. That is enough to be recognised as topically authoritative on all four.

---

## 4. What to publish: first quarter

Sixteen posts, four per cluster. Titles are working titles, phrased the way people actually search or ask.

### Cluster A: Custom software / internal tools
Buyer pain: spreadsheets that broke, manual processes, staff doing data entry.

1. What custom software actually costs in South Africa, and what drives the number
2. When a spreadsheet stops being enough: the five signs we see before clients call
3. Off-the-shelf vs custom: how we tell clients which one they actually need
4. What replacing a manual process actually looks like, start to finish

### Cluster B: AI integration & automation
Buyer pain: told to "use AI", no idea what is real.

5. Where AI actually earns its place in business systems (expand the existing draft)
6. The business processes we automate most often, and the ones we refuse to
7. What it costs to add AI to software you already run
8. Why we review every line of AI-written code before it ships

### Cluster C: Web & product design
Buyer pain: site looks dated, does not convert.

9. Why most business websites do not convert, and the fixes that actually move numbers
10. What a design system is, and when a business is too small to need one
11. How we validate a design with real users before building it
12. Website redesign: what changes, what breaks, and what to protect

### Cluster D: Mobile apps
Buyer pain: needs an app, does not know Flutter from native.

13. What building a mobile app costs in South Africa, and why quotes vary so much
14. Flutter vs native: how we choose, and when we would tell you not to build an app
15. What happens after launch: the app maintenance nobody quotes for
16. Getting an app through App Store and Play Store review without surprises

### Why these specific angles

Notice the pattern. Almost every title is a question a buyer asks on a discovery call, and several are ones most agencies dodge. Cost posts especially. Most agencies refuse to publish pricing guidance, which means the query is under-served and the person searching it is close to buying.

**Your fastest source of topics is your own inbox.** Every question a prospect asks twice is a post. That is a better topic generator than any keyword tool, and it guarantees search intent is real.

---

## 5. Post anatomy: built for both Google and AI citation

This is the part that determines whether you get cited. Apply it to every post.

**Open with a direct answer.** First H2 should be the question itself, and the 40 to 60 words under it should answer it completely, before any context or story. AI engines lift that block. Burying the answer under 400 words of preamble is the single most common reason good content never gets quoted.

**Use question-shaped H2s.** "What does custom software cost in South Africa?" not "Pricing considerations". Headings are how extraction engines segment a page.

**Be specific and datable.** "In a 2026 project for a boat manufacturer we cut quote turnaround by 40%" is citable. "We help clients improve efficiency" is not. Named tools, real numbers, actual dates. Every specific claim is a citation hook.

**Close with an FAQ block.** Three to five real questions with direct answers. This needs `FAQPage` schema, which you do not have yet. See section 6.

**Length: 1,200 to 1,800 words for most posts.** Your existing four drafts are 250 to 550 words, which is too thin to rank for anything competitive. Depth matters, but padding does not. Stop when the question is answered.

**Writing style.** Keep the voice you already have in the drafts. Plain, direct, no corporate filler, no em dashes. It reads as human, which matters more every year as the web fills with generated text. The stack post is a good model: opinionated, concrete, no hedging.

---

## 6. Technical work needed

Ordered by leverage. Most of this is small.

**P0, do first**

1. **Get the four existing drafts into production.** They are written and sitting in your local database. Production has nothing. This is the single fastest win available.
2. **Fill `meta_description` on all four.** All are currently `NULL`. The `BlogPosting` schema falls back to excerpt, so it degrades gracefully, but the SERP snippet is uncontrolled. Consider making it required at the model or Filament level so it cannot be missed again.

**P1, before volume publishing**

3. **Add `FAQPage` schema to posts.** Biggest single AI-citation lever you are missing. Needs a repeatable field on `Post` (a JSON `faqs` column) plus a schema block in `blog-show.blade.php`.
4. **Add `Person` + `ProfilePage` schema for the founder,** on `/agency#founder`. `BlogPosting.author` already points there but there is no Person entity at the target. This is how you become a recognised entity rather than an anonymous byline, and it is heavily weighted in E-E-A-T.
5. **Add `Blog` + `ItemList` schema to the blog index.** Currently zero JSON-LD on `/blog`.

**P2, high value but larger**

6. **Split `/work` into individual case study pages.** Right now eight-plus projects live on one page. Each deserves its own indexable URL with the problem, the approach, and hard numbers. This is probably the highest-value SEO work on the whole site outside the blog, because case studies are simultaneously your best ranking asset, your best AI-citation asset, and your best sales asset. Your `llms.txt` already names Luminii, BSL Auction Services, Payhouse Finance, Vision Plus Wealth, Peekaboo Daycare, SpringKleaners and Ribbon Plumbing.
7. **Consider `/industries/` pages** once the blog cluster is running. Vertical pages convert well for agencies but they are a bigger content commitment. Not before month 6.

---

## 7. Getting recommended by AI specifically

Beyond post structure, four things move the needle:

**Keep `llms.txt` rich.** It already auto-includes published posts. Once you have 20 posts it becomes a genuine map of your expertise for any model that reads it.

**Entity consistency.** Name, address and phone must match exactly across the site, Google Business Profile, LinkedIn, and any directory. AI systems resolve entities by cross-referencing. Inconsistency makes you ambiguous and ambiguity loses citations. Your schema currently says Cape Town, ZA, +27814303023. Make everything match that exactly.

**Google Business Profile.** For Cape Town intent this matters as much as the blog. If it is not claimed and fully filled in, do that before writing post five.

**Publish something nobody else has.** One piece of original data a year outbeats fifty opinion posts. You have the raw material: anonymised numbers across your projects. "What custom software actually costs in South Africa, based on N projects we quoted in 2026" is the kind of thing that gets cited for years and earns links you never asked for.

---

## 8. Cadence and workflow

Four a month is aggressive for a founder who also ships client work. Protect it with process:

- **Batch.** Draft a month of posts in one or two sittings rather than four separate context switches.
- **Rotate clusters.** One post per cluster per month. Keeps all four building and stops you writing four AI posts in a row.
- **Mine the inbox.** Prospect questions become posts. No blank page.
- **Publishing is already automated.** Ticking `is_published` fires IndexNow, updates `sitemap.xml` and updates `llms.txt`. You do not have to think about distribution.

If month two slips to two posts, that is fine. Consistency over twelve months beats a burst then silence. Google's freshness signals reward sustained publishing, not spikes.

---

## 9. Measuring it, and validating the bets

**Set up first, before publishing volume:**
- Google Search Console. Non-negotiable, and it is also your real keyword research tool. After six weeks of live posts, the Performance report shows the queries you actually surface for, which beats any volume estimate.
- Google Analytics 4, tracking `/contact` submissions from organic.
- Google Business Profile.

**Track monthly:**

| Metric | Why |
|---|---|
| Impressions and clicks per cluster | Which of the four is working |
| Queries you rank 5-20 for | Fastest wins: improve an existing post rather than write a new one |
| Blog → service page clicks | Whether the hub-and-spoke linking is doing its job |
| Contact submissions attributed to organic | The only metric that pays |

**Realistic expectations.** Months 1 to 3, almost nothing; you are building a corpus. Months 4 to 6, long-tail and Cape Town terms start showing. Months 6 to 12, cluster authority compounds and the service pages start ranking on the back of the spokes. Anyone promising faster on a young domain is selling something.

**Check AI citation manually each month.** Ask ChatGPT, Perplexity and Google AI Overviews things like "custom software development Cape Town" or "what does custom software cost in South Africa" and note whether you appear. It is crude but it is currently the only honest way to measure it.

---

## 10. Risks

**The cadence slips.** Most likely failure. Four a month is real work. Mitigation: batch, and accept two good posts over four rushed ones.

**Posts get written to rank instead of to help.** Generic content will not rank and will not get cited. If a post could have been written by any agency, it is not worth publishing.

**Cost posts feel uncomfortable.** Publishing pricing guidance feels like giving away leverage. It is the opposite: it filters out people who cannot afford you and builds trust with those who can. It is also the least served query set in your market.

**Case studies stay stuck on one page.** The `/work` split keeps getting deprioritised because it is not "new content". It is worth more than the next ten blog posts.

---

## Immediate next actions

1. Deploy the four existing drafts to production, with `meta_description` filled in.
2. Claim and complete Google Business Profile.
3. Connect Google Search Console.
4. Add `FAQPage` and `Person`/`ProfilePage` schema.
5. Write post one: "What custom software actually costs in South Africa".
6. Plan the `/work` split into individual case study pages.
