# ShiftTech Redesign — Implementation Roadmap

**Source of truth:** the approved prototype `public/redesign/homepage.html` and the
four design docs in this folder (`01`–`04`). Production code must match the
prototype pixel-for-pixel; where the prototype and old code disagree, the
prototype wins.

---

## 1. Current codebase analysis

**Stack:** Laravel 12 + Blade, a purchased Bootstrap marketing theme, Filament CRM
(separate, untouched by this work). Public site served from `public/`.

**Public marketing surface today:**

| Route | View | Notes |
|-------|------|-------|
| `/` | `welcome.blade.php` | Homepage — the rebuild target |
| `/contact` | `contact.blade.php` | Form → `Lead` model via `ContactFormObserver` |
| `/agency` | `agency.blade.php` | "About" content |
| `/work` | `work.blade.php` | Case-study index |
| `/services/{5}` | `services/*.blade.php` | Five service pages |

All extend `layouts/master.blade.php`, which loads: Bootstrap, AOS, Swiper,
Magnific, GSAP + **ScrollSmoother + SplitText**, a **custom cursor**, jQuery,
Phosphor. `partials/header.blade.php` + `partials/footer.blade.php` are shared.

### Technical debt (from the UX audit, confirmed in code)
- **Heavy JS the design drops:** ScrollSmoother (scroll-hijack), custom cursor,
  SplitText, AOS, jQuery, Swiper — none survive into the new design language.
  Loading them fights the "invisible motion" spec and tanks Lighthouse.
- **No design tokens:** ~40 hardcoded `#74b812`, per-section ad-hoc spacing,
  radius and `common-shadow-*`. Inline `style="font-size:…"` in hero/CTA.
- **Dead code:** commented hero block, `toggleFAQ()` with no markup,
  process-timeline JS with no section, duplicated mobile-nav markup.
- **Broken links / bugs:** Web Application service card → wrong page
  (`/services/web-design`); footer service links → `#`; radial ring shows 80%
  for `data-percentage=78`; logo `alt="Client"`.
- **Contrast failures:** lime text on white; suppressed focus styles.
- **SEO:** `layouts/master.blade.php` hardcodes one title/description for every
  page; no schema; no per-page canonical control.

### What is reusable / worth keeping
- **Real content assets** (the studio's actual equity): client logos in
  `public/assets/images/logo/clients/`, project screenshots in
  `.../thumbs/work/`, six genuine named testimonials, the four real FAQs — all
  already ported into the prototype.
- **Satoshi** font (`public/assets/css/satoshi.css`) — the prototype's display
  face; reuse (self-host as a later perf win — see §5).
- **CRM CSS-loading pattern** (`docs/design-system.md` §7): static stylesheet in
  `public/`, cache-busted with `filemtime`. Mirror it for `shifttech.css`.
- **Blade anonymous components** already used (`components/crm/*`) — same
  pattern for the new `components/site/*`.
- **Contact pipeline** (`ContactFormObserver` → `Lead`, `ThrottleContactForm`) —
  keep as the booking fallback behind Calendly.

---

## 2. Architecture decision

**Build a new, clean marketing layout instead of editing `master.blade.php`.**

- `layouts/site.blade.php` — no Bootstrap/AOS/GSAP/cursor/jQuery. Loads only
  `satoshi.css`, `shifttech.css`, and one small deferred `shifttech-site.js`.
  Per-page SEO via `@yield`; site-wide Organization/Person JSON-LD.
- Old pages keep `master.blade.php` until migrated → **zero regression** while
  the homepage goes fully premium. This is the incremental seam.

**Component-driven:** promote the prototype's repeated markup into
`components/site/*` and drive the homepage from data arrays, so every page built
next reuses the same primitives.

---

## 3. Component inventory to build

| Component | Prototype source | Reuse |
|-----------|------------------|-------|
| `x-site.btn` (primary / lime / ghost-pine / link-arrow) | `.btn*`, `.link-arrow` | every page + nav + forms |
| `x-site.eyebrow` | `.eyebrow` | every section |
| `x-site.section-head` (rule + eyebrow + heading) | section header device | every section |
| `x-site.service-card` | `.service-card` | home + services index |
| `x-site.case-study` (alternating, hover-zoom) | `.case` | home + `/work` |
| `x-site.testimonial` | `.quote-card` | home + about |
| `partials/site-header` (sticky nav + mobile menu) | `.nav` | site-wide |
| `partials/site-footer` | `.footer` | site-wide |
| `partials/home/*` sections (hero+ledger, logos, process, founder, faq, cta) | homepage sections | home |

The Studio Ledger and process timeline stay as data-driven loops (not generic
enough to be cross-page components yet).

---

## 4. Incremental phases (each phase is independently shippable)

- **Phase 0 — Foundation (this commit):** `shifttech.css` tokens + component
  CSS, `shifttech-site.js`, `layouts/site`, header, footer, `components/site/*`.
- **Phase 1 — Homepage:** rebuild `welcome.blade.php` on the foundation, real
  routes wired, FAQ schema. Verify desktop + mobile. **← primary deliverable now.**
- **Phase 2 — Contact:** migrate `/contact` onto `layouts/site`; accessible form
  per design-system §5; Calendly embed with the form as fallback.
- **Phase 3 — Work + case-study detail pages:** `/work` on the new system using
  `x-site.case-study` + the 5-field template (IA §3b); real screenshots.
- **Phase 4 — About + Services:** `/about` (founder story, replaces `/agency`,
  301); reframe the five service pages by outcome, fix the wrong service link.
- **Phase 5 — SEO + perf polish:** per-page metadata + JSON-LD across pages;
  self-host Satoshi woff2; WebP/AVIF screenshots; Lighthouse ≥95 pass.
- **Phase 6 — Insights:** only once ≥3 real articles exist (gates nav item +
  homepage row).

## 5. Cross-cutting opportunities (tracked against every phase)

- **SEO:** per-page title/description/canonical/OG; JSON-LD Organization +
  Person site-wide, FAQPage on home, Service on service pages, breadcrumbs.
- **Accessibility (AA):** one `h1`/page, no skipped headings, visible lime
  focus ring, native `details` FAQ, real `alt`, `prefers-reduced-motion`
  honored, ≥44px targets, skip-to-content link in the new layout.
- **Performance (95+):** drop the heavy JS stack; system-mono + one webfont;
  `loading="lazy"` + width/height on below-fold images; next-gen formats;
  static cache-busted CSS; LCP is hero H1 text (fast, no hero image).
- **Responsiveness:** fluid `clamp()` type/spacing already in the prototype;
  verified breakpoints 360 → 1920; no horizontal scroll.
- **Conversion:** one action/one label ("Book a discovery call") at hero,
  founder, final; proof-first order; the ledger's "+ yours"; no dead ends;
  persistent nav CTA as the sticky booking button.

## 6. Fidelity method

Port the prototype's CSS verbatim into `shifttech.css` (proven-correct
rendering), split its markup into layout + components + sections, then wire real
routes/SEO. After building, run `php artisan serve`, screenshot the Laravel
homepage at 1440 and 390, and diff against the prototype screenshots from the
critique loop — they must match.
