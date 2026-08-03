# Google Business Profile & Local SEO Audit

**Business:** ShiftTech Global Solutions (trading as ShiftTech)
**Profile:** https://maps.app.goo.gl/vLoUCExMHjXJRyXe9
**Written:** 3 August 2026

---

## 1. What was verified, and what was not

Google Maps renders its content client-side, so the profile's categories, description,
services, products, hours, attributes, photos, Q&A and reviews are **not readable from
outside**. Those sections are not scored below, and no scores for them should be invented
later either.

Four facts were extracted from the profile URL's redirect chain and are reliable:

| Signal | Value |
|---|---|
| GBP business name | **ShiftTech Global Solutions** |
| Coordinates | `-33.8031458, 18.5142094` (Milnerton / Summer Greens) |
| Google CID | `0x1dcc5b2e2b307eb3:0x215ae6584545c905` |
| Knowledge Graph ID | `/g/11k2jh7mvr` |

The Knowledge Graph ID confirms Google holds a resolved entity for the business. That is the
foundation AI citation builds on, and it already exists.

### Name discrepancy, resolved

The audit brief gave the business name as "ShiftTech". The profile says **ShiftTech Global
Solutions**, which matches the company registration and every external citation, so the
profile is correct. The site schema was updated the same day (`legalName` + `alternateName`)
so site and profile now agree.

### To complete the audit

Six items from the GBP dashboard, none of which are publicly visible:

1. Primary category, plus all secondary categories
2. Current business description text
3. Services list as currently entered
4. Review count and average rating
5. Photo count by type (logo / cover / interior / team)
6. Whether the listing is **verified**, and whether address-based or service-area

---

## 2. Scores with evidence behind them

| Dimension | Score | Basis |
|---|---|---|
| Entity / NAP consistency | 8/10 | Was ~4/10 before 3 Aug. Site now matches registered name, locality, region, postcode. Loses points for missing `streetAddress` and a founder `sameAs` pointing at the company LinkedIn page |
| Website quality | 8/10 | Measured: clean canonicals, 25/25 sitemap `lastmod`, valid JSON-LD on every page type, 0 missing image alt text, `Service` + `FAQPage` on all six service pages |
| GEO / AI citation readiness | 7/10 | ~50 Q&A pairs rendering, `llms.txt` live, answer-first post structure. Held back by zero published results data on case studies |
| GBP profile completeness | Not scored | Not publicly readable |
| Reviews | Not scored | Not publicly readable |
| Local pack readiness | Not scored | Requires geo-grid testing from multiple physical points |

### Numbers deliberately not produced

No "expected ranking improvement" or "expected increase in enquiries" figures appear in this
document. Search Console was only connected on 3 Aug 2026 and holds no data, there is no rank
tracking in place, and map pack position varies by the searcher's physical location. Any such
number would be invented. Revisit once GSC has 4+ weeks of query data.

---

## 3. Business description (ready to paste)

> ShiftTech Global Solutions is a founder-led software engineering studio in Milnerton, Cape
> Town, building custom software, business systems and AI automation for South African
> companies.
>
> We build the internal tools businesses actually run on: quoting, job tracking, invoicing,
> client records and the workflows that hold them together. Our default stack is C# and
> Angular, with Laravel, Flutter, Docker and AWS brought in when a project calls for them.
>
> You work directly with the engineer who builds and ships your system. No account managers,
> no handover to a junior after the contract is signed. Every project is quoted at a fixed
> price within 48 hours of the discovery call, so you know the number before any code is
> written.
>
> Serving Cape Town, the Western Cape and clients across South Africa.

Shaped this way on purpose: category-defining nouns in the first sentence, the two genuine
differentiators (founder-led delivery, fixed-price quoting) stated as verifiable facts rather
than adjectives, locality named without repetition. AI assistants extract specifics. "Fixed
price within 48 hours" is quotable; "world-class solutions" is not.

---

## 4. Categories

**Primary: `Software Company`** — the category most buyer queries resolve to.

**Secondary, in priority order:**

1. `Software Development Company` (if offered as distinct in ZA)
2. `Computer Consultant`
3. `Website Designer`
4. `Mobile Application Developer`
5. `Business Management Consultant`

**Never put keywords in the business name field.** "ShiftTech Global Solutions | Custom
Software Cape Town" violates Google's guidelines and is one of the most common suspension
triggers.

Category is the strongest single relevance lever in the local algorithm. If the primary is
currently something narrower such as "Website Designer", changing it is the highest-impact
edit available on the whole profile.

---

## 5. Services

| Service | Description |
|---|---|
| Custom Software Development | Bespoke internal tools and business systems built around how your company actually works. Replaces spreadsheets, manual processes and disconnected tools with one system your team runs on. |
| Business Process Automation | We map the process, find where hours are lost to manual work, and automate the parts that do not need a human. Quoting, job tracking, invoicing, approvals. |
| AI Integration & Automation | Practical AI inside the software we ship: surfacing anomalies, drafting first-pass responses, routing incoming requests. A senior engineer reviews every line before it ships. |
| Web Application Development | Architecture, implementation, testing and delivery for systems that have to hold up in production. C# and Angular by default. |
| Mobile App Development | iOS and Android from one Flutter codebase, backed by real infrastructure, from first screen to store launch. |
| CRM & ERP Development | Leads, clients, quotes, invoicing and scheduling in one system instead of scattered across spreadsheets and memory. |
| Technical Consulting | Architecture review and honest scoping. We will tell you if you do not need custom software. |

---

## 6. Reviews

Strategy only. Current count and rating are not visible, so this is not a diagnosis.

B2B review volume is lower than consumer, which means **each review carries more weight**, and
reviews that mention service terms feed relevance directly.

Respond to everything within 48 hours. Owner response rate is a visible trust signal and one
of the few review factors entirely within your control.

### Request template

Send after a milestone, not at project end. Response rates drop once the relationship cools.

> Hi [Name],
>
> Now that [specific system] is live and [specific outcome], would you be willing to leave a
> short Google review? It is the main way businesses in Cape Town find us.
>
> If it helps, the useful things to mention are what problem you came to us with and what
> changed after. Two or three sentences is plenty.
>
> [direct review link]
>
> Thanks,
> Prosper

Use the direct review link from the GBP dashboard. Never ask people to search for the business.

### Response templates

**Positive:**
> Thanks [Name]. [Specific detail from their review]. Glad [system] is doing what you needed.
> Good working with the [Company] team.

**Neutral (3 stars):**
> Thanks for the honest feedback, [Name]. [Acknowledge the specific gap]. I would like to
> understand where we fell short. I will call you this week, or reach me directly on
> +27 81 430 3023.

**Negative:**
> [Name], this is not the standard we hold ourselves to and I would rather fix it than defend
> it. [One factual clarification, no argument.] I am the founder and you can reach me directly
> on +27 81 430 3023.

---

## 7. Photos and media

Generic office stock imagery does nothing for a B2B software firm. What earns attention:

- **Logo and cover** — non-negotiable. The cover should carry positioning, not just the mark
- **Founder headshot** — founder-led delivery is the differentiator, and a real face supports
  the `Person` entity already in the site schema
- **Product screenshots** — Luminii CRM, dashboards, the Peekaboo admissions system. This is
  real work and almost no competitor posts it
- **Workspace, real rather than staged**
- **A 30-60 second founder video** answering "what do you build?" Video is rare on Cape Town
  GBPs and disproportionately effective

Target 15-20 images, then roughly two per month. Freshness is a ranking input.

---

## 8. Q&A to seed

Google explicitly permits owner-posted Q&A. Answer each in 40-60 words, lead with the direct
answer, and mirror the FAQ answers already live on the service pages so site and profile
reinforce each other.

1. What does custom software cost in Cape Town?
2. How long does a typical project take?
3. Do you work with businesses outside Cape Town?
4. What technologies do you build with?
5. Do you quote fixed price or hourly?
6. Can you work with the system we already have?
7. Who actually does the work?
8. Do you do AI automation, or just talk about it?
9. What happens after launch?
10. How do we start?

Ten answered properly beats thirty padded.

---

## 9. Google Posts

Weekly, rotating four types: **client outcome → engineering insight → AI/automation practical
→ founder view.** Each post 150-300 words, one specific claim, one CTA, one real image.

1. What custom software actually costs in South Africa
2. When a spreadsheet stops being enough: five signs
3. Why we quote fixed price, not hourly
4. Where AI earns its place in a business system, and where it does not
5. How Peekaboo Daycare replaced a paper admissions trail
6. Off-the-shelf vs custom: how we tell clients which they need
7. Our default stack, and why we rarely deviate
8. The processes we automate most often, and the ones we refuse to
9. What replacing a manual process looks like start to finish
10. Why we review every line of AI-written code
11. What happens after launch: the maintenance nobody quotes for
12. Flutter vs native: how we choose

Posts 1, 3, 4, 7 and 10 map to existing blog content. Cross-post rather than write twice.

---

## 10. Competitors

Directory-sourced, **not** map pack observed. Recurring names across
[TechBehemoths](https://techbehemoths.com/top-companies/custom-software-development/cape-town),
[Clutch](https://clutch.co/za/developers/cape-town),
[Sortlist](https://www.sortlist.com/s/software-development/cape-town-za) and
[GoodFirms](https://www.goodfirms.co/companies/web-development-agency/cape-town):

Elemental Web Solutions, Rocketsoft, BeingIT, Codenatics, AgileEngine, Simform.

**Read this list correctly.** These are directory rankings, which are pay-to-list and
editorially curated. They are not the businesses beating ShiftTech in the Cape Town map pack.
Establishing that requires geo-grid testing from multiple points around Milnerton, which has
not been done. Treat the list as a **citation gap checklist** — ShiftTech is absent from most
of these directories and each is a legitimate citation — not as a competitor set.

---

## 11. Roadmap

Priority and effort only. See section 2 for why no traffic or lead figures appear.

### Days 1-7

| Task | Difficulty | Time |
|---|---|---|
| Confirm the listing is verified | Low | 5 min |
| Fix primary category if wrong | Low | 5 min — **highest impact single edit** |
| Paste the description from section 3 | Low | 10 min |
| Add all seven services from section 5 | Low | 30 min |
| Confirm NAP matches the site exactly | Low | 10 min |
| Fix duplicate SPF records | Low | 15 min — mail deliverability, not GBP, but actively causing harm |

### Days 8-30

| Task | Difficulty | Time |
|---|---|---|
| Upload 15-20 photos including founder and product screenshots | Medium | 3 hrs |
| Seed and answer the 10 Q&As | Low | 1 hr |
| Request reviews from 5 past clients | Medium | 2 hrs |
| Begin weekly posts | Low | 30 min/wk |
| Fill in case study results on the 10 `/work` pages | High | highest-value item on any current list |

### Days 31-60

Citation building on the directories in section 10, founder video, second review wave, monthly
photo cadence.

### Days 61-90

First GSC query data becomes readable at roughly 4 weeks of collection. Review responses fully
current. First honest read on whether any of this moved.

---

## 12. KPIs

Track monthly from GBP Insights and Search Console:

- Profile views
- Search vs maps split
- Direction requests
- Calls
- Website clicks from GBP
- Review count and average rating
- **Contact form submissions attributed to organic** — the only one that pays

Baseline everything in month one. There is currently no baseline for any of these, so nothing
measured before that point is comparable.

---

## Related

- `docs/BLOG-SEO-PLAN.md` — content strategy, cluster architecture, publishing cadence
- Open items tracked outside this document: case study results, duplicate SPF records,
  founder `sameAs` and full name, `streetAddress` decision, server response time
