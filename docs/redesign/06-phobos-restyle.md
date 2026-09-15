# 06 — Phobos-style restyle (home page)

Status as of 2026-09-09. Working locally only, nothing committed or deployed.

Reference site: <https://www.phobos.com.au/> — the look we are adapting toward on
the **home page** (`resources/views/welcome.blade.php`).

---

## Goal

Restyle the home page toward the Phobos aesthetic: **the style, the animations,
and the section layout** — not a pixel copy. Do it in tiers so we can stop at any
point and still have a coherent page.

The user explicitly wants the *structural* Phobos devices (flat colour blocking,
registration marks, oversized condensed caps, monospace labels, vertical
wordmark, 0px radius) but **NOT** the dot-matrix / halftone fields — those are the
dot-grid motif already ruled out in the project's anti-AI-slop design guidance.

---

## Phobos design language (what defines the look)

**Palette**
- charcoal base `#1c1a19`, raised dark `#232120`
- eggshell / cream `#e9e5d8` (also the text colour on dark)
- one accent: dusty pink / mauve `#d6a4c9`
- flat colour-block tints for cards only: pine `#26301f`, mauve `#c39bc0`,
  lilac `#e6dcec`, sage `#b8bda6`

**Type**
- one oversized condensed grotesk, ALL CAPS, tight tracking, for every headline
  (we're using **Archivo** 500/600/700 as the free stand-in)
- monospace for everything small: eyebrows, category chips, body copy inside dark
  panels, footer bar (site already has `--mono`)

**Structural devices**
- `+` registration marks and `⌐ ¬` corner crop-brackets framing sections
- technical line-art diagrams inside cards
- slow rotating circular-text badge
- giant vertical wordmark down the footer
- radius 0 everywhere

**Animations (restrained)**
- WebGL particle sphere in the hero (expensive — using stroke-only rings instead)
- headline words clip-reveal on load, staggered
- colour-block panels wipe / fade in on scroll
- one pinned/sticky scroll sequence in the Careers-style section with a `%`
  scroll-progress readout

---

## Tiers (cost estimate)

| Tier | Scope | Effort |
|------|-------|--------|
| **Cheap** | tokens + CSS: repalette, condensed caps headlines, radius 0, `+`/corner marks, `+ LABEL` buttons, mono chips, vertical footer wordmark | ~half a day, ~70% of the look |
| **Medium** | vertical hover-expand capability panels, pinned scroll-card sequence, rotating badge | + ~1 day |
| **Expensive** | WebGL hero particle sphere (three.js / OGL) | ~1–2 days |

---

## Section-by-section mapping (`welcome.blade.php`)

Section markers, current → Phobos treatment:

Current page order: Hero → What We Build → Our Approach → CTA band → Case Studies
→ Testimonials → Insights → Statistics → Founder → FAQ → Final CTA → Footer.
(Selected Work sticky-stack **removed** — Case Studies is now the only portfolio section.)

| Section (`id`) | Treatment |
|----------------|-----------|
| Hero | **DONE** — see below |
| What We Build (`#services`) | **DONE** — Phobos "EXPERTISE" vertical colour-block panels, see below |
| Our Approach (`#process`) | **DONE** — Phobos "THINK OUTSIDE THE BOX" 3-column grid, see below |
| CTA band (`.section--cta-band`) | **DONE** — Phobos "PARTNERING TO BUILD…" flat pine block + `+` marks, see below |
| Case Studies (`#case-studies`) | **DONE** — Phobos "PROOF IS IN THE DOING." featured study + 2-card grid, see below |
| Insights (`#insights`) | **DONE** — Phobos "OUR LATEST THINKING." 2-up post grid, see below |
| Statistics (`#stats`) | thin mono row, drop the band background |
| Founder (`#founder`) | oversized caps headline left, mono paragraph + `+ CONTACT US` centre, rotating badge |
| Testimonials (`#testimonials`) | ~420 | drop the marquee; two-up mono quotes on a tinted block |
| FAQ (`#faq`) | ~465 | flat list, hairline dividers, mono |
| Final CTA (`#contact`) | ~515 | pine-green section, big pink "SAY HELLO.", framed by pink `+` marks |
| Footer (`partials/site-footer`) | — | pink section-labels, white values, giant vertical wordmark, mono bottom bar |

---

## DONE — Hero (cheap tier)

**Files touched (not committed):**
- `resources/views/welcome.blade.php`
  - hero `<section>` markup replaced (was: blurred screenshot backdrop + founder
    photo-grid + animated audit/pipeline cards)
  - added `@push('styles')` loading Archivo from Google Fonts (home page only)
- `public/assets/css/shifttech.css`
  - appended `.hero--phobos` block right before `/* ---------- Record band ----`
  - all selectors prefixed `.hero--phobos ` so they beat the shared
    `.hero` / `.hero--dark` base rules by specificity + source order
  - local custom props `--h-charcoal / --h-cream / --h-pink / --h-display` so the
    palette does not leak past the hero
  - includes load-in animation, `<=860px` stacking, `prefers-reduced-motion`
- rebuilt `public/assets/css/shifttech.min.css` via `npm run build:site-assets`

**Hero structure now:**
- split headline: `SOFTWARE ISN'T THE GOAL.` (left) / `BUSINESS VALUE IS.` (right)
- centre: stroke-only concentric orbital rings (`<svg>`, slow spin) — stands in
  for the WebGL sphere, deliberately not a dot field
- rotating circular-text badge bottom-right: `SHIFTTECH · EST. 2025 · SENIOR-LED`
- `+` text CTAs: "Book a discovery call" (`$contact`), "See proof of work" (`/work`)
- mono eyebrow pinned top-left, `+` registration marks in the section corners
- monospace client bar along the bottom, existing white client logos at low opacity

**The old CSS** (`.hero--framed`, `.hero-frame`, `.hero-split` is SHARED — do not
touch; `.hero-photogrid*`, `.hero-bg`, `.hero-headline`, `.hero-sub`, `.hero-bar`
are home-only and now unused) was left in place. Optional later cleanup: delete
the home-only unused rules.

### Hero 3D cursor parallax (added 2026-09-10)

Approximates the phobos.com.au hero's depth/motion: the layers sit on a
`perspective: 1200px` stage and lean toward the cursor.

- **`shifttech-site.js`** — right after the `--sp` scroll block. Gate:
  `heroStage && !reduced && min-width 861px`. On `mousemove` it writes
  `--px` / `--py` (−1..1, pointer offset from stage centre) on
  `.hero-phobos__stage`; on `document` `mouseleave` it resets them to `0`.
  No animation loop — deliberately. (First cut used a rAF lerp + idle drift;
  it never idled and jammed the page under tab-throttle. Dropped.)
- **`shifttech.css`** `.hero--phobos` block — the eased follow + settle-back is
  a CSS `transition: transform` on each layer, driven by those two vars:
  - `.hero-phobos__lcol` / `__rcol` — opposite `translate3d`, ±12px x / ±7px y, `.5s`
  - `.hero-phobos__badge` — `translate3d` 18px x / 14px y, `.5s`
  - `.hero-phobos__artifact` — `translate3d` 30px x / 22px y **plus**
    `rotateX(var(--py)·−7deg) rotateY(var(--px)·10deg)` for the real 3D tilt,
    `.3s` (short so it doesn't visibly lag the scroll-driven `--sp` spread,
    which shares the same `transform`).
  - `prefers-reduced-motion` block also pins `transition: none; transform: none`
    on all four; `<=860px` already hides the artifact + badge.
- **Verify note:** the automated Chrome used for checks does not pump
  `requestAnimationFrame` / CSS-transition frames without a live compositor, so
  the *in-between* eased frames can't be screenshotted there. Verified instead
  by: JS writes the vars on real `mousemove` and zeroes them on `mouseleave`;
  with the transition disabled the `calc()` transforms compute exactly (e.g.
  `--px .85 / --py -.45` → `lcol translate(-10.2, 3.15)`, `artifact` a
  `matrix3d` with ~8.5°/3.15° rotation). Confirm the live feel at
  `http://localhost:8000/`.

---

## DONE — What We Build (`#services`) — Phobos "EXPERTISE" style

Modelled on the phobos.com.au section headed *EXPERTISE / COMPLEX PROBLEMS.
DEPENDABLE OUTCOMES.* — a row of vertical colour-block panels, one per
capability. First panel open by default; any panel expands on hover and the rest
compress. Pure CSS, no JS added.

**Files touched (not committed):**
- `resources/views/welcome.blade.php`
  - `#services` markup replaced: was `.caps-layout` / `.caps-head` /
    `.caps-list` + `.xitem` expand-on-hover list. Now `.section--build` with a
    `.build-head` and a `.build-panels` row of `.build-panel--0..4` (one per
    `$services` entry).
  - both `.build-head` and `.build-panels` carry the existing `reveal` class, so
    scroll-in is handled by the site's existing IntersectionObserver in
    `shifttech-site.js` — nothing added to the JS.
- `public/assets/css/shifttech.css`
  - the `CAPABILITIES` block (`.caps-*`, `.xitem*`) was **replaced** with the
    `WHAT WE BUILD — Phobos "EXPERTISE" style` block. `.caps-*` / `.xitem` were
    home-only (grep-verified), so they are gone rather than left dead.
  - palette scoped as local props on `.section--build`
    (`--b-cream #ece8db`, `--b-ink #1c1a19`, `--b-line`). Panel fills:
    `#232120` charcoal, `#26301f` pine, `#c39bc0` mauve, `#e6dcec` lilac,
    `#b8bda6` sage.
  - "first open by default, hover overrides" is done with flex-grow +
    `.build-panels:hover` rules; `@media (hover:none),(max-width:860px)` stacks
    the panels vertically and shows every detail block.
- rebuilt `shifttech.min.css` via `npm run build:site-assets`

**Structure:** `.build-head` is a flex row — left: mono eyebrow "WHAT WE BUILD"
+ Archivo caps headline "COMPLEX PROBLEMS. / DEPENDABLE OUTCOMES." (eyebrow
"EXPERTISE" — copy matches the Phobos section verbatim, at the user's request)

**Panel anatomy** (matches Phobos): collapsed = a `+` centred at the top +
the vertical mono label anchored to the panel foot. Open (first panel by
default, or on hover) = service name mono-uppercase top-left, description +
`+ EXPLORE` along the foot (`justify-content: space-between`). Panel min-height
`clamp(480px, 66vh, 700px)`. All four elements are absolutely positioned inside
`.build-panel`; opacity is toggled by the `--0` / `:hover` / `:not(:hover)`
state rules. Skipped the Phobos `NN%` scroll-progress readout.
(wrapped in `.build-head__text`, `max-width: 46rem`); right: `+ BOOK A FREE
DISCOVERY CALL`, top-aligned (mirrors Phobos's "+ EXPLORE OUR EXPERTISE"). Stacks
to a column `<=860px`. The explanatory note paragraph was removed. Then the panel
row: collapsed panel = number top-left +
rotated mono label anchored to the panel foot; expanded panel = Archivo caps
title + mono body (`$s['body']`) + `+ EXPLORE`, links to `$s['href']`.

Note: the page's `.rails` vertical lines still overlay this section (faint). Not
addressed — it is a site-wide device.

Verifying in-browser via the screenshot tool: the `.reveal` scroll-in can look
stuck at opacity 0 on fast scroll / throttled tab — false alarm, it renders fine
when scrolled into view normally (see memory: always-verify-ui).

---

## DONE — Our Approach (`#process`) — Phobos "THINK OUTSIDE THE BOX"

A bordered 3-column grid, each cell a numbered phase: Archivo caps title + mono
number top, mono body, stroke-only line-art figure framed by CSS corner brackets
at the card foot. Same cream `#ece8db` band as `.section--build` so EXPERTISE and
OUR APPROACH read as one zone split by a hairline (as on Phobos). Static — no
hover interaction; `reveal` class carries the scroll-in.

**Section order:** the `#process` section markup was moved to sit **directly
after `#services`** in `welcome.blade.php` (before `#stats`), so the two cream
Phobos sections are adjacent. New page order: Hero → What We Build → Our Approach
→ Statistics → Selected Work → Founder → …

**Files touched (not committed):**
- `resources/views/welcome.blade.php`
  - `@php`: added `$approach` (3 phases — a condensed read of `$process`:
    Understand the problem / Build the solution / Launch and support) and
    `$approachFigures` (3 inline SVG strings). `$process` (the old 6-step array)
    is left in place but is now **unused**.
  - `#process` markup replaced: was `<x-site.section-head>` + `.drawers` (6
    hover-expand drawers) + a `.section-cta`. Now `.section--approach` with
    `.approach-head` + `.approach-grid` of 3 `.approach-card`s. The trailing
    `.section-cta` ("Ready to see this in motion…" lime button) was **removed**
    to match Phobos (section just ends).
  - dropped `section--flush-top` from the section so it gets normal top padding.
- `public/assets/css/shifttech.css`
  - the `PROCESS — expandable drawers` block (`#process{}`, `.drawers`,
    `.drawer*`, `.drawer-detail*` — all home-only, grep-verified) was
    **replaced** with the `OUR APPROACH` block.
  - palette scoped as local props on `.section--approach`
    (`--a-cream #ece8db`, `--a-ink`, `--a-line`). Corner brackets are
    `::before`/`::after` on `.approach-card__figure`.
  - `@media (max-width: 860px)` → single column, cards divided by `border-bottom`.
- rebuilt `shifttech.min.css` via `npm run build:site-assets`

The 3 SVG figures are decorative line art (converging rays / subdivided square
with an offset cell / rising arrow through a baseline) — stroke-only, no dot
fields. Tweak them in the `$approachFigures` array.

---

## DONE — CTA band + Case Studies (new sections after Our Approach)

Both are new `<section>`s inserted between `#process` and `#stats` in
`welcome.blade.php`; CSS appended before the `FOUNDER` block in `shifttech.css`;
`shifttech.min.css` rebuilt.

**CTA band (`.section--cta-band`)** — Phobos "PARTNERING TO BUILD BETTER SYSTEMS".
Flat pine block `#26301f`, big pink Archivo caps statement + mono sub + `+` text
CTA, framed by four pink `+` registration marks (`.cta-band__inner::before/after`
+ `.cta-band__marks::before/after`). **No halftone field** — that is the dot-grid
motif we don't use; the flat block + `+` marks carry the Phobos layout instead.

**Case Studies (`#case-studies`, `.section--studies`)** — Phobos "PROOF IS IN THE
DOING." On white. `.studies-head` is the same flex row as `.build-head`
(eyebrow + Archivo caps title left, `+ ALL STUDIES` → `/work` right).
- **Featured study** (`$studyFeatured`): full-width photo (`bsl-site` image) with
  a lilac `#e6dcec` panel pulled up over it (`width: 62%; margin-left: auto;
  negative margin-top`). White `.studies-chip` pill + Archivo caps title + mono
  body + `+ READ MORE`. Whole card links to `/work/bsl-auction-services`.
- **Grid cards** (`$studyGrid`): a 2-col grid of **2** flat colour blocks
  (`--mauve` Luminii SaaS, `--charcoal` PayHouse Fintech), white chip + Archivo
  caps title + `+ READ MORE`, linking to `/work/{slug}`. **3 case studies total**
  (1 featured + 2), matching Phobos's layout. (Iterated: 3 BSL sub-projects →
  6 mixed projects → settled on 1 featured + 2.) Extra tones `--pine` / `--sage`
  / `--lilac` are still defined for easy swaps.
- **Layout (matches phobos.com.au "as is"):** `.studies-showcase` wraps
  `a.studies-featured` (which contains `.studies-featured__media` +
  `.studies-featured__panel`) then a sibling `.studies-grid`. The photo is
  `position:absolute; inset:0` **inside `.studies-featured` only**, so it shows
  as a full-width strip across the top plus a left column beside the 65% panel,
  and ends where the grid starts (white to the left of the grid). Panel and grid
  are both `width: 65%; margin-left: auto` → shared left edge.
- Title typography loosened to Archivo **500**, `letter-spacing: .005em` (not the
  condensed `-.01em`) to match Phobos. `.studies-chip` gets `border-radius: 5px`
  — a deliberate exception to the 0-radius rule, because the Phobos chip is
  rounded.
- `@media (max-width: 860px)` → photo back to a `16/10` banner, panel + grid
  full-width, grid single column.
- **Image:** featured photo is `bsl-yard.jpg` / `.webp`
  (`public/assets/images/thumbs/work/`, 1486×704) — B.S.L.'s **own hero photo**
  pulled from `bslservices.co.za/images/hero/home-hero-bg.jpg` (an auction scene:
  bidders with paddles, tractor, wheel loader, trucks). `.studies-featured__media
  img` gets `filter: saturate(.88) contrast(.97)` and a `::after`
  `rgba(28,26,25,.2)` scrim so it blends rather than shouts (mirrors how BSL
  themselves overlay it). Alt: "Bidders, machinery and vehicles at a B.S.L.
  auction". (Earlier tries: a screenshot of the site, then Unsplash machinery /
  car-lot photos — all rejected as too loud; client's own photo won.)
- **Margin-collapse note:** `.studies-featured` needs `overflow: hidden` (or
  `display: flow-root`) so the panel's `margin-top` creates the photo strip
  *inside* the featured box instead of collapsing through it.

**Site width:** `.container` widened `72rem → 88rem` (padding max `2.5rem → 3rem`)
so sections are not squashed in the centre — a site-wide change, checked OK on a
service page. Hero/rails still use their own `106rem`.

**Selected Work removed:** the old `#work` sticky-card-stack section (markup +
its `SOLUTIONS SLIDER` CSS block, ~145 lines: `.sol-*`, `.cs-stack*`,
`.card-stack*`, `.cscard*`, `.cases-carousel*`, `.carousel-btn` — all home-only)
is gone. `$caseStudies` (the array it iterated) is left in `welcome.blade.php`
but is now unused, alongside `$process`.

Content note: the field app has no screenshot yet — child cards are text-only
colour blocks (matches Phobos), so that's fine. If a field-app image appears,
it'd go on the featured photo or a future dedicated study.

---

## DONE — Insights (`#insights`) — Phobos "OUR LATEST THINKING."

New `<section class="section section--insights">` inserted after Case Studies,
before `#stats`, wrapped in `@if ($insights->isNotEmpty())`. CSS appended before
the `FOUNDER` block; `shifttech.min.css` rebuilt.

- `welcome.blade.php` `@php`: `$insights = \App\Models\Post::published()->take(2)->get()`
  + `$insightFigures` (2 inline stroke-only SVGs: concentric rings / dashed box +
  crosshair).
- `.insights-head` is the same flex row as `.build-head` / `.studies-head`
  (eyebrow "Insights" + Archivo caps "Our latest thinking." left,
  `+ MORE INSIGHTS` → `/blog` right).
- `.insights-grid` = 2 cols. Each `.insight-card` is an `<a>` to
  `route('blog.show', $post)`: a flat colour-block `.insight-card__cover`
  (alternating `--0` lilac `#e6dcec` / `--1` pine `#26301f`, `aspect-ratio: 3/2`)
  holding the category label top-left + a centred line-art figure + a `+` corner
  mark, then the post headline (Archivo 500 caps) + `+ READ MORE` below.
- `@media (max-width: 760px)` → single column, head stacks.
- Uses the real blog (`Post` model, `scopePublished`); the existing per-category
  SVG covers in `public/assets/images/blog/covers/` are **not** used (they're
  pine + lime — off-palette); the card covers are drawn in CSS instead.

---

## DONE — Testimonials (`#testimonials`) — Phobos language, bento mosaic

Phobos has no testimonials section, so this applies the *language* (mono label +
Archivo caps head + `+` CTA, flat colour blocks, 0 radius, pink accent). Layout
is a **bento mosaic** (user's pick over the marquee): one oversized hero quote +
five smaller cards, static, no scroll. Scoped to `.section--voices` so the shared
`.quote-card` used on every service page is untouched.

- `welcome.blade.php`: `<x-site.section-head>` → a `.voices-head` flex row
  (eyebrow + Archivo caps "In their own words." + `+ BOOK A CALL` → contact).
  `@php`: `$voiceHero = $testimonials[1]` (Conrad · BSL Services), `$voiceRest`
  = the other 5 (`array_diff_key` + `array_values`), tones
  `mauve / lilac / sage / charcoal / mauve`.
- Markup: a hand-written `figure.quote-card.voice.voice--pine.voice-hero` (big
  `.voice-hero__pull` = the highlight phrase in Archivo caps, then the full
  quote + attribution) + a `@foreach ($voiceRest)` of `<x-site.testimonial
  class="voice voice--{tone}">`.
- `shifttech.css` (`.section--voices` block): `.voices-grid` is
  `grid-template-columns: repeat(3,1fr)`, `grid-auto-rows: minmax(~230px, auto)`,
  `gap: 2px`; `.voice-hero` is `grid-column: span 2; grid-row: span 2`. Cards
  are flat colour blocks (`voice--pine/charcoal/mauve/lilac/sage`), mono `"`
  mark, bordered-circle avatar, `color: inherit` so each tone's text colour
  flows. `<mark>` highlight = pink underline that flips to a solid pink
  highlighter on card hover; card gets `inset 0 0 0 2px` pink outline on hover.
  Logos hidden on the dark cards (inconsistent client PNG backgrounds).
  Breakpoints: `<=960px` → 2 cols + hero full-width; `<=560px` → 1 col.
- The old marquee data (`$testimonialColumnOrders`, `$testimonialDurations`,
  `$testimonialColumns`) is now **unused**, alongside `$process` / `$caseStudies`.

---

## DONE — FAQ (`#faq`) — Phobos "CAREERS" scroll-pinned stepper

Modelled on the phobos.com.au CAREERS block: a sticky panel whose active card
cycles through the questions as the section scrolls past, with a progress
readout. **Needs JS** (added to `shifttech-site.js`).

- `welcome.blade.php`: replaced the `.faq-panel` accordion (`.faq-item` details
  — **left untouched**, still used on the service pages) with
  `.section--faq-stepper` — a 2-col grid: left `.faq-stepper__head` (eyebrow +
  Archivo caps "Questions, / straight answers." + `+ BOOK A CALL` + contacts),
  right `.faq-stepper__panel` (`<ol.faq-steps>` of `<li.faq-step>` = num +
  question + `+` mark + hidden answer, then `.faq-steps__foot` with
  `[data-faq-pct]` + a `.faq-steps__bar`). Inline
  `style="--faq-count: N; --faq-track: <(N+0.5)*100>vh;"`.
- `shifttech-site.js` (before "Current year"): `[data-faq-stepper]` +
  `!reduced` + `min-width:861px` → adds `.is-live`; a scroll handler computes
  `p = clamp(-rect.top / (offsetHeight - innerHeight), 0, 1)`, sets `--faq-p`,
  updates the `%` text, and toggles `.is-active` on
  `floor(p * count)`.
- `shifttech.css` (before the shared `FAQ` block): **default** (no JS /
  reduced-motion / `<=860px`) = a plain readable list, every answer shown, not
  sticky. **`.is-live` @media(min-width:861px)**: the *grid* gets
  `min-height: var(--faq-track)` (must be on the grid — the sticky items'
  containing block — not the section, or sticky releases early), head + panel
  are `position: sticky`, non-active `.faq-step__body` collapses via
  `grid-template-rows: 0fr`, active card turns pine + reveals its answer, and
  `.faq-steps__foot` shows the `%` + a pink fill bar (`width: calc(var(--faq-p)
  * 100%)`).
- Collapsed cards cycle `mauve / lilac / sage / mauve` (`:nth-child(4n+…)`).
- **Gotcha hit:** `calc((var(--faq-count) + .5) * 100vh)` computed to `0px`
  after minification — switched to a PHP-computed `--faq-track` var. Also the
  served HTML was browser-cached; `?nocache=1` (or a hard reload) was needed to
  see the new inline var.

---

## Open items / known rough edges

1. **Nav CTA clash** — `partials/site-header.blade.php` "Book a Discovery Call"
   button is still lime (`--lime`), now sitting against the pink hero. Header was
   out of scope for "apply the hero". Decide: retune the nav button to pink on the
   home page, or leave the site nav lime everywhere.
2. **Style break at the hero boundary** — everything below the hero is still the
   lime / pine / Satoshi system, so there is a hard visual cut where the hero
   ends. Expected until more sections are ported.
3. **Palette decision still open for the rest of the page** — do we take the
   charcoal + pink + Archivo system site-wide, or keep the existing pine/lime
   tokens and only borrow the Phobos *layout* devices for the other sections?
4. `$process` and `$caseStudies` (arrays in `welcome.blade.php`) are now dead
   data — delete, or repurpose (`$process` → a dedicated process page).
5. Featured study photo leaves a small white gap at the bottom-left (photo ends
   above where the tinted panel does). Minor; Phobos has a similar effect.
6. Grid card titles link to `/work/{slug}` pages that exist in
   `config/case-studies.php`, but several of those pages have `results` / images
   still thin. Worth a pass on the individual `/work` pages.

---

## Prototype

Standalone, self-contained, touches nothing in the live site:
- `public/redesign/phobos-hero.html` → served at
  `http://localhost:8000/redesign/phobos-hero.html`
- Covers **Hero + What We Build** at the cheap tier. Hero, What We Build and Our
  Approach are now ported into the live local site; the prototype stays as the
  reference / sandbox for the rest.

---

## How to continue

1. Next section: **Statistics (`#stats`)** then **Founder (`#founder`)** — work
   down the section table above, cheap tier first. Same approach each time: a
   scoped modifier class on the section, its CSS block in `shifttech.css` (put it
   near that section's existing rules, replace home-only rules / append when the
   rules are shared), reuse the existing `reveal` class for scroll-in,
   `npm run build:site-assets`, verify at `http://localhost:8000/`.
2. Resolve the three open items before going wide with the palette.

**Build command:** `npm run build:site-assets`
(csso → `shifttech.min.css`, terser → `shifttech-site.min.js`)
**Verify:** `http://localhost:8000/` (WAMP; Laravel docroot is `/public`)
