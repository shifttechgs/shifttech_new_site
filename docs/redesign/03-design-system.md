# ShiftTech — Website Design System

The public-site counterpart to `docs/design-system.md` (which covers the Luminii
CRM). Same philosophy — calm, precise, premium — but a warmer, editorial voice
suitable for a founder-led studio.

Reference implementation: `public/redesign/homepage.html`.
Sources folded in: `docs/redesign-master-plan.md`,
`docs/ShiftTech_Design_Bible_v1.md`, `docs/ShiftTech_Website_Blueprint_v2.md`.

---

## 1. Principles

1. **The record over the pitch.** Verifiable facts (real clients, real systems,
   real years) always beat adjectives and invented percentages.
2. **One bold element per page.** On the homepage it's the Studio Ledger.
   Everything else stays quiet so it can speak.
3. **Warmth without noise.** Paper, ink, and pine. Lime is a mark, not a paint.
4. **Typography does the luxury.** Scale, weight contrast and spacing carry the
   premium feel — not gradients, glass, or blobs.
5. **Motion is invisible.** If a visitor notices an animation, it's too much.

## 2. Color palette

| Token | Hex | Usage |
|-------|-----|-------|
| `--paper` | `#FAF7F1` | Page background. Never `#FFFFFF` full-bleed. |
| `--paper-raised` | `#FFFFFF` | Cards/surfaces sitting on paper (subtle lift). |
| `--ink` | `#161D19` | Headings, primary text. Never `#000`. |
| `--stone` | `#5F6660` | Secondary text. AA on paper (≥4.5:1). |
| `--faint` | `#8B8E85` | Metadata/mono labels ≥14px only. |
| `--pine` | `#123D33` | Brand green. Dark bands, primary buttons, links. |
| `--pine-deep` | `#0C2B24` | Pine hover / band gradients (subtle only). |
| `--lime` | `#74B812` | Accent **marks only**: dots, active states, underline accents, ledger bullet. As text, ONLY on pine/dark. |
| `--lime-tint` | `#EDF4DF` | Soft fill behind accent chips on paper. |
| `--hairline` | `#E4DFD3` | Rules, card borders, dividers. |
| `--on-pine` | `#F4F2EA` | Text on pine bands. |
| `--on-pine-muted` | `rgba(244,242,234,.68)` | Secondary text on pine. |

**Rules**
- Lime on paper fails AA as text — never set copy in lime on light surfaces.
- Max two surface levels per section (paper + raised, or pine + nothing).
- Gradients: only a barely-visible radial warmth inside pine bands; nowhere else.

## 3. Typography

**Display & body: Satoshi** (self-hosted — `public/assets/css/satoshi.css`).
**Utility: mono stack** `"Cascadia Code", Consolas, ui-monospace, monospace` —
the studio's own material (software) used for the ledger, eyebrows, indices and
stats. Never for body copy.

| Role | Size | Weight | Tracking | Line height |
|------|------|--------|----------|-------------|
| Display XL (hero h1) | `clamp(2.6rem, 5.4vw, 4.35rem)` | 500, key words 700 | `-0.035em` | 1.04 |
| Display L (section h2) | `clamp(1.9rem, 3.2vw, 2.7rem)` | 600 | `-0.025em` | 1.12 |
| Heading M (h3/card) | `1.3125rem` | 600 | `-0.01em` | 1.3 |
| Lede | `clamp(1.05rem, 1.4vw, 1.1875rem)` | 400 | 0 | 1.65 |
| Body | `1rem` | 400 | 0 | 1.7 |
| Small | `.875rem` | 400–500 | 0 | 1.6 |
| Mono eyebrow | `.75rem` | 500 | `.14em`, uppercase | 1 |
| Mono data | `.8125rem` | 400–500 | `.02em` | 1.5 |

Mixed-weight headlines are the house style: the sentence at 500, the words that
matter at 700 (e.g. "built by **the person you actually talk to**").

Measure: body text never exceeds ~68ch. Ledes cap at 34rem width.

## 4. Spacing, radius, elevation

**Spacing** (rem): `0.5 · 0.75 · 1 · 1.5 · 2 · 3 · 4 · 6 · 8`. Section rhythm:
`--section-pad: clamp(4.5rem, 9vw, 8rem)` vertical.

**Container**: max-width `72rem` (1152px), side padding `clamp(1.25rem, 4vw, 2.5rem)`.

| Radius | Value | Usage |
|--------|-------|-------|
| `--r-sm` | `8px` | Buttons, chips |
| `--r-md` | `14px` | Cards |
| `--r-lg` | `22px` | Screenshots frames, large surfaces |

Rounded corners stay modest (anti-AI principle: no pill-cards, no 40px bubbles).
Pill radius is reserved for buttons only.

| Shadow | Value | Usage |
|--------|-------|-------|
| `--sh-1` | `0 1px 2px rgba(22,29,25,.05)` | Resting cards |
| `--sh-2` | `0 10px 30px rgba(22,29,25,.08)` | Hover lift, screenshots |
| `--sh-3` | `0 30px 60px rgba(12,43,36,.18)` | Pine-band inner cards only |

Most structure comes from **hairlines, not shadows**.

## 5. Components

### Buttons
- **Primary** — pine fill, `--on-pine` text, pill radius, `14px 28px` padding,
  600 weight. Hover: `--pine-deep` + translateY(-1px) + `--sh-2`. The label is
  always **"Book a discovery call"** for the conversion action.
- **Secondary (inline)** — text link, ink, 600, with a 2px lime underline offset
  4px that thickens on hover. Used for "See the work →".
- **Ghost on pine** — 1px `rgba(244,242,234,.3)` border, on-pine text; hover
  border brightens.
- Focus (all): `outline: 2px solid var(--lime); outline-offset: 3px` — visible
  on both paper and pine.

### Section header device (used by every paper section)
Hairline top rule → mono eyebrow (uppercase, `--faint`, with a 6px lime square
before it) → Display L heading → optional lede. Left-aligned; the rule spans the
container. This is the page's structural signature after the ledger.

### The Studio Ledger (signature component)
- Raised surface, `--r-md`, hairline border, `--sh-1`.
- Header row: mono "THE RECORD" + years span ("2016 — ONGOING").
- Rows: `grid: [client 600 ink] [system, stone] [year, mono faint]`, separated
  by hairlines, `14px` vertical padding. A 6px lime dot marks in-production
  rows. Hover: row background `--lime-tint` at 40%, no movement.
- Final row: "+ yours" in mono linking to /contact — the ledger itself converts.

### Logo strip
Single quiet row, grayscale 100% / opacity .55, hover restores. `max-height 30px`.
No marquee auto-scroll on desktop (motion rule); horizontal scroll on mobile.

### Case-study card
Screenshot in `--r-lg` frame with hairline + `--sh-2`, alternating left/right
with text column: mono client label → h3 outcome-first title → 2-sentence
challenge→result → pull-quote (real testimonial excerpt, 1px lime left rule) →
attribution.

### Process step
Mono index (`01`–`07`, faint) above heading + one sentence. Connected by a
hairline rail; the current-in-view step's index turns pine and its dot fills
lime (IntersectionObserver).

### Founder band
Full-bleed pine. Grid: portrait frame (aspect 4/5, `--r-lg`, placeholder slot
clearly marked) + first-person story. Ends with primary button (lime fill on
pine for maximum contrast at the emotional peak — the ONE place lime is a fill).

### Testimonial card
Raised surface, hairline, `--sh-1`. Quote at Body size (not XL), logo image
top (max-height 32px), name + role bottom after hairline. **No star ratings.**

### FAQ accordion
Native `<details>/<summary>` — zero JS. Hairline-separated rows on paper,
summary at Heading M weight 600, plus/minus indicator rotates 45°, 200ms.

### Forms (spec for contact page)
Paper inputs, hairline border, `--r-sm`, focus ring per buttons. Labels above,
never placeholder-as-label.

### Booking (Blueprint §12)
The conversion action resolves to a Calendly embed on `/contact` (with the
plain form as fallback for visitors who won't book a slot). Style the embed
container as a raised card (`--r-md`, hairline, `--sh-1`); Calendly's own theme
set to match Paper/Pine. The nav's persistent "Book a call" button is the
sticky-CTA requirement — no floating overlay buttons.

### Case-study fields
Component-level contract per Blueprint §10 — Challenge, Solution, Stack,
Timeline, Measurable results — structure and truth-rules defined in
`02-information-architecture.md` §3b.

## 6. Motion specification

| Event | Effect | Duration / easing |
|-------|--------|-------------------|
| Section entry | fade + 12px rise, once, staggered 60ms within a group | 280ms `cubic-bezier(.2,.7,.2,1)` |
| Button hover | translateY(-1px) + shadow | 160ms ease-out |
| Ledger row hover | background tint | 140ms ease |
| Accordion open | plus rotates 45° | 200ms ease |
| Nav on scroll | hairline + slight paper opacity | 200ms ease |
| Case screenshot hover | scale 1.015 | 260ms `cubic-bezier(.2,.7,.2,1)` |

Rules: nothing exceeds 300ms; no parallax on content; no auto-playing motion;
`@media (prefers-reduced-motion: reduce)` disables all transforms/reveals
(elements render in final state). No scroll-hijacking (the current site's
ScrollSmoother is dropped in the production pass).

## 7. Iconography

Phosphor (already loaded site-wide), **regular weight only**, one size per
context (20px inline, 24px feature). Icons only where they disambiguate
(check marks in trust rows, arrow in links). No decorative icon grids.

## 8. Accessibility standards

- WCAG 2.1 AA contrast for all text (see palette rules — lime never text-on-light).
- One `h1` per page; heading levels never skip.
- All interactive elements keyboard-reachable, with the visible lime focus ring.
- `alt` text: real descriptions for screenshots/logos; `alt=""` + `aria-hidden`
  for decorative marks.
- Reduced-motion fully honored (see §6). No custom cursors.
- Touch targets ≥44px on mobile; nav button visible without opening the menu.

## 9. SEO & metadata (Blueprint §19, production pass)

- **Schema.org (JSON-LD):** `Organization` + `Person` (Prosper, founder) on
  every page; `Service` on each `/services/*` page; `FAQPage` on the homepage
  FAQ (the markup is already semantic `details/summary`); `Article` on
  insights; `Review`/`quotation` treatment for testimonials only if the
  ratings platform question is resolved — never emit star ratings schema
  without a real rating source.
- **Metadata:** unique title + description per page, outcome-phrased (the
  existing `layouts/master.blade.php` head block is a good base — make
  title/description/canonical per-page variables instead of hardcoded).
  OG/Twitter images per page; keep the existing canonical + robots setup.
- **Performance budget (Design Bible/Blueprint §18):** 95+ Lighthouse. The
  design keeps this reachable: system-stack mono, one webfont family
  (self-host Satoshi woff2s — see review doc), no JS frameworks on the public
  page, real images sized + `loading="lazy"` below the fold, next-gen formats
  (convert the work screenshots to WebP/AVIF at build time).
- **Insights = the SEO engine:** service pages and case studies carry
  commercial intent; articles carry topical authority. Per the 90-day roadmap
  (Blueprint §23), publish case studies first — they convert and rank.

## 10. What NOT to do (anti-AI checklist)

- No gradient blobs, glassmorphism, floating shapes, particle effects.
- No fake dashboards, fake code, fake team photos, stock office people.
- No star-rating pills on testimonials.
- No invented statistics; every number must be checkable.
- No more than one CTA label; no CTA band stacking.
- No radius > 22px except button pills; no shadow not in the token set.
- No animation a visitor would describe afterwards.
