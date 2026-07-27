# ShiftTech — Information Architecture & Homepage Wireframe

Sources folded in: `docs/redesign-master-plan.md`,
`docs/ShiftTech_Design_Bible_v1.md`, `docs/ShiftTech_Website_Blueprint_v2.md`.

## 1. Positioning statement (drives every IA decision)

> ShiftTech is a founder-led software engineering studio. You work directly with
> Prosper — a senior engineer who has shipped fintech, CRM, and operations
> systems for businesses across South Africa and Zimbabwe. Small by design,
> senior by default.

The site's single job: **book discovery calls**. Every page ends at that door.

## 2. Sitemap

```
/                       Home — the pitch, the record, the founder, the door
/services               Outcome-organized index (not tech-organized)
  /services/*           5 existing service pages (later phase: reframe titles
                        by outcome, keep URLs for SEO)
/work                   Case-study index → individual case studies (new detail
                        pages, later phase)
/insights               Articles, guides, engineering content (Blueprint §7/§19;
                        SEO-first). PHASE 2: enters the nav only once ≥3 real
                        articles exist — an empty blog hurts more than none.
/about                  The founder story (replaces "Agency" — nobody buys an
                        "agency" from a founder-led studio; keep /agency as
                        redirect). Content per Blueprint §11: Prosper's story,
                        philosophy, process, values.
/contact                Discovery-call booking (form + Calendly embed — the
                        Blueprint §12 conversion requirement)
```

Nav (desktop): `Services · Work · About · Contact` + primary button `Book a call`
(add `Insights` when it launches). Sticky, paper background with hairline bottom
rule after scroll — the persistent nav button IS the Blueprint's "sticky booking
button": always reachable, never a floating overlay (anti-AI restraint). No
mega-menu — four links and a button.

Footer: brand line, the same four links, services list (real links), contact
details, LinkedIn, locations. One quiet closing line from the founder. No CTA
band (the final CTA section immediately precedes it).

## 3. Homepage — section order and each section's single job

| # | Section | Job | Proof type |
|---|---------|-----|-----------|
| 1 | Nav | Orient + persistent door | — |
| 2 | Hero + Studio Ledger | State the offer; prove it instantly with the shipped record | Real record |
| 3 | Client logo strip | Recognition — "others trusted them" | Real logos |
| 4 | Services as outcomes | "They do the thing I need" | Clarity |
| 5 | Case studies (×2 deep) | "Here's what happens when you hire them" | Real screenshots + client words |
| 6 | Process | Reduce fear of chaos — show the path | Sequence (numbered — real order) |
| 7 | Founder | The actual differentiator — meet Prosper | Human |
| 8 | Testimonials (×6, verbatim) | Third-party voice | Real quotes |
| 9 | FAQ | Kill last objections (start, price, support, uncertainty) | Answers |
| 10 | Final CTA | The door | — |
| 11 | Footer | Trust close, no dead ends | — |

CTA discipline: **one action, one label — "Book a discovery call"** — placed at
hero, founder section, and final CTA. Secondary action "See the work" appears
only in the hero. Nothing else competes.

**Deliberate divergence from the briefs:** Design Bible (Homepage) and
Blueprint §8 order the sections Founder → Process. This IA runs Process →
Founder instead: the process section answers the rational objection ("will this
be chaos?") first, so the founder section lands as the emotional peak
immediately before third-party validation and carries the page's only
lime-filled CTA. If the brief order is preferred, the two sections swap with no
other changes.

**Insights on the homepage** (Design Bible homepage list): enters between
Testimonials and FAQ as a 3-card "Latest insights" row — PHASE 2, gated on the
same ≥3-articles rule as the nav item. Do not ship an empty shelf.

## 3b. Case-study detail template (Blueprint §10)

Every case study — the two homepage features and each `/work` detail page —
carries the same five fields, in order:

1. **Challenge** — the business problem in the client's terms (1–2 sentences).
2. **Solution** — what was built and how it changed the workflow.
3. **Stack** — the mono tech line (already in the prototype: `Laravel · MySQL ·
   Payment integration…`).
4. **Timeline** — real elapsed time from discovery to launch. Only checkable
   numbers; if the real figure isn't recorded, omit the field rather than
   estimate.
5. **Measurable results** — client-verified outcomes only (e.g. Boats &
   Trailers' "sales up 40%" comes from Dirk Nel's own testimonial). Never
   invent a metric to fill the slot.

The homepage cards show Challenge→Solution compressed to two sentences + Stack
+ pull-quote; Timeline and Results live on the detail pages where there is room
to substantiate them.

## 4. Homepage wireframe (desktop)

```
┌────────────────────────────────────────────────────────────────┐
│ ShiftTech        Services  Work  About  Contact   [Book a call]│  nav
├────────────────────────────────────────────────────────────────┤
│                                                                │
│  FOUNDER-LED SOFTWARE STUDIO · CAPE TOWN & HARARE      (mono)  │
│                                                                │
│  Software that runs                 ┌───────────────────────┐  │
│  your business,                     │ THE RECORD      (mono)│  │
│  built by the person                │ ───────────────────── │  │
│  you actually talk to.              │ Payhouse Finance      │  │
│                                     │  Loan automation ─ ●  │  │
│  Web platforms, mobile apps and     │ Vision Plus Wealth    │  │
│  operations systems for growing     │  Applications portal  │  │
│  businesses — designed, built and   │ Western Cape Blood    │  │
│  supported by a senior engineer,    │  Service monitoring   │  │
│  not handed to a junior team.       │ BSL Services          │  │
│                                     │  Auction platform     │  │
│  [Book a discovery call]            │ zimAlert              │  │
│  See the work →                     │  Response app         │  │
│                                     │ Luminii               │  │
│  ✓ Free 30-min call                 │  CRM & invoicing      │  │
│  ✓ Reply within 24 hours            │ ───────────────────── │  │
│                                     │ + yours    [rule]     │  │
│                                     └───────────────────────┘  │
├────────────────────────────────────────────────────────────────┤
│   logo · logo · logo · logo · logo · logo         (quiet strip)│
├────────────────────────────────────────────────────────────────┤
│ ── WHAT WE BUILD ───────────────────────────────── (rule+mono) │
│                                                                │
│  Big heading: outcomes not stacks                              │
│  ┌──────────────┐ ┌──────────────┐ ┌──────────────┐            │
│  │ Automate     │ │ Custom web   │ │ Mobile apps  │            │
│  │ operations   │ │ platforms    │ │              │            │
│  └──────────────┘ └──────────────┘ └──────────────┘            │
│  ┌──────────────┐ ┌──────────────┐                             │
│  │ Modernize    │ │ Cloud &      │   Not sure? → book a call   │
│  │ legacy       │ │ DevOps       │                             │
│  └──────────────┘ └──────────────┘                             │
├────────────────────────────────────────────────────────────────┤
│ ── SELECTED WORK ──────────────────────────────────            │
│  ┌───────────────────────────┐  Payhouse Finance               │
│  │   real screenshot         │  Days-long manual loan process  │
│  │                           │  → digital, secure, PCI-aware   │
│  └───────────────────────────┘  "…they truly understand        │
│                                  fintech" — Allan, Director    │
│  Luminii CRM                    ┌───────────────────────────┐  │
│  Agency ops: leads→quotes→      │   real screenshot         │  │
│  invoices in one system         │                           │  │
│  (built + run by ShiftTech)     └───────────────────────────┘  │
│                                          See all work →        │
├────────────────────────────────────────────────────────────────┤
│ ── HOW A PROJECT RUNS ─────────────────────────────            │
│  01 Discovery → 02 Strategy → 03 Design → 04 Build             │
│  → 05 Test → 06 Launch → 07 Support     (numbered: real seq.)  │
├────────────────────────────────────────────────────────────────┤
│ ███ PINE BAND ████████████████████████████████████████████████ │
│   [portrait]   "I started ShiftTech because…"                  │
│   Prosper —    story · philosophy · direct access promise      │
│   Founder      [Book a discovery call]                         │
├────────────────────────────────────────────────────────────────┤
│ ── WHAT CLIENTS SAY ───────────────────────────────            │
│  6 real testimonials, verbatim, quiet cards, no star pills     │
├────────────────────────────────────────────────────────────────┤
│ ── QUESTIONS ──────────────────────────────────────            │
│  4 existing FAQs, quiet accordion                              │
├────────────────────────────────────────────────────────────────┤
│ ███ PINE BAND ████████████████████████████████████████████████ │
│   Ready when you are.  30 minutes, no obligation.              │
│   [Book a discovery call]     sales@… · +27…                   │
├────────────────────────────────────────────────────────────────┤
│  footer: brand · links · services · contact · LinkedIn         │
└────────────────────────────────────────────────────────────────┘
```

## 5. Mobile adaptations

- Nav collapses to logo + `Book a call` (kept visible — it's the whole point) +
  menu toggle.
- Hero stacks: eyebrow → headline → copy → CTA pair → ledger (ledger keeps its
  full row treatment; rows are naturally mobile-friendly).
- Services grid → single column; case studies stack screenshot-over-text;
- Process becomes a vertical rail (same numbering).
- Founder band: portrait above text.
- Testimonials: single column (all six retained — social proof is worth the
  scroll on a founder-led pitch).

## 6. Copy voice rules

- First person plural sparingly; founder speaks in first person in his section.
- Every headline answers "why should I care?"; every paragraph answers "what's
  in it for me?" (master plan).
- No invented percentages. Numbers that appear must be checkable: years active
  (since 2016), number of shipped systems in the ledger, response time promise.
- "Book a discovery call" — sentence case, identical everywhere.
