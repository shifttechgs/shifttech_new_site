# ShiftTech Redesign — Accessibility & Conversion Review

Reviewed against the finished prototype `public/redesign/homepage.html`,
verified in Chrome at 1440px (desktop), 752px (tablet), and 390px (mobile,
via constrained viewport).

Sources folded in: `docs/redesign-master-plan.md`,
`docs/ShiftTech_Design_Bible_v1.md`, `docs/ShiftTech_Website_Blueprint_v2.md`.

---

## 1. Accessibility review (WCAG 2.1 AA)

| Check | Status | Notes |
|-------|--------|-------|
| Text contrast | ✅ | Ink `#161D19` on Paper `#FAF7F1` ≈ 15:1; Stone `#5F6660` on Paper ≈ 5.5:1; On-pine `#F4F2EA` on Pine `#123D33` ≈ 10:1. Lime is never used as text on light surfaces (marks only, or text on pine). |
| Visible keyboard focus | ✅ Verified | `:focus-visible` = 2px lime outline, 3px offset — tested by tabbing; outline computed `rgb(116,184,18)` on links, buttons, and FAQ summaries. |
| Heading structure | ✅ | One `h1` (hero); sections use `h2`; cards/steps use `h3`. No skipped levels. |
| Reduced motion | ✅ | `@media (prefers-reduced-motion: reduce)` zeroes all transitions and renders `.reveal` elements in final state; JS also checks `matchMedia` before creating the IntersectionObserver. No parallax, no auto-playing motion, no custom cursor. |
| Semantic structure | ✅ | `header/nav/main/section/article/figure/blockquote/footer/address`; ledger is an `aside` with `aria-label`; FAQ uses native `details/summary` (keyboard + screen-reader support for free). |
| Images | ✅ | All client logos and screenshots carry real descriptive `alt`; decorative marks (checkmark SVGs, ledger dots, monogram) are `aria-hidden`. |
| Touch targets | ✅ | Buttons ≥44px; mobile nav keeps "Book a call" visible without opening the menu; menu toggle 42px with `aria-expanded`/`aria-controls`. |
| Motion durations | ✅ | Longest transition 320ms (process step state); everything else ≤280ms. |

Known items for the production pass (not reachable in a static prototype):
- Skip-to-content link should be added when real multi-page nav exists.
- Form labels/validation (contact page) per design-system §5 Forms.
- Satoshi is loaded from the fontshare CDN over `http://` (inherited from
  `public/assets/css/satoshi.css`) — self-host the woff2 files in production
  for both performance and mixed-content safety.

## 2. Conversion review

**One action, one label.** "Book a discovery call" appears at hero, founder
band, and final CTA — identical wording each time. Header carries the short
"Book a call". Secondary action ("See the work →") exists only in the hero and
after case studies. The six competing CTA blocks and four labels of the old
page are gone.

**Proof before pitch.** The visitor sees the shipped record (Studio Ledger)
inside the first viewport, client logos at the first scroll, and a real
client's words within two scrolls. Every claim on the page is checkable:
client names, systems, "since 2016", "30 days included" (matches FAQ),
"free 30-minute call". All invented percentages were removed.

**Founder as differentiator.** "You don't get an account manager. You get me."
— the founder band is the emotional peak, placed after the process section
answers "will this be chaos?" and immediately before third-party validation.
It carries the only lime-filled button on the page.

**Objection handling.** FAQ addresses the four real pre-sale objections
(speed, price transparency, support, uncertainty) directly above the final
CTA, so the last thing before the door is reassurance.

**No dead ends.** Every section ends in a path: ledger → "+ yours", services →
service links + "not sure" card, case studies → "See all work", founder →
book/LinkedIn, final CTA → email + phone. Footer links all resolve (no `#`
placeholders pointing nowhere in production mapping).

## 3. Iteration notes (what changed during the critique loop)

1. **Pass 1 (desktop 1440):** brand logo PNGs carry a baked-in white box that
   broke the paper background → added `mix-blend-mode: multiply` to nav,
   footer, and testimonial-card logos.
2. **Pass 1:** CSS-column testimonial wall stacked the two longest quotes in
   column one → reordered cards (long/short interleaved) for visual balance.
3. **Pass 2 (mobile 390):** eyebrow's lime square floated mid-height when the
   label wrapped to two lines → switched to `flex-start` alignment with an
   em-based offset so it locks to the first line.
4. Verified: mobile menu toggle, process-rail active state (lime tick), reveal
   stagger, ledger hover, FAQ accordion — all functioning.

## 4. Production implementation map (next phase)

| Prototype element | Production target |
|-------------------|-------------------|
| `#services` cards | `resources/views/welcome.blade.php` + real routes `/services/*` (fix the wrong web-design link on the Web Application card) |
| `#work` case studies | `/work` page + future case-study detail pages |
| `#founder` | New section + `/about` page (replace `/agency`) |
| `#contact` CTA | `/contact` route; later Calendly embed |
| Nav/footer | `partials/header.blade.php`, `partials/footer.blade.php` (site-wide pass) |
| Tokens | Promote the `:root` block to a shared public stylesheet |
| Founder portrait + story | Replace the two `PLACEHOLDER` comments in the founder band with Prosper's photo and own words |
| Booking | Calendly embed on `/contact` (Blueprint §12; styling spec in design-system §5 Booking) |
| SEO | JSON-LD schema + per-page metadata per design-system §9 |
| Insights | `/insights` section + homepage row — gated on ≥3 real articles (IA §2) |

## 5. Launch QA checklist (Blueprint §22)

Run before the production redesign goes live:

- [ ] Responsive sweep: 360 / 390 / 768 / 1024 / 1440 / 1920 — no horizontal
      scroll, no clipped ledger rows, nav intact at every width.
- [ ] Contact form: submits, validates, honeypot/rate-limit still active
      (`ThrottleContactForm`), lead lands in the CRM (`Lead` model +
      `ContactFormObserver`), notification email arrives.
- [ ] Calendly: booking completes end-to-end; confirmation email correct.
- [ ] All nav/footer links resolve (the audit's `#` dead links are gone);
      `/agency` 301s to `/about`.
- [ ] Lighthouse ≥95 performance / ≥95 accessibility / ≥95 SEO on Home,
      Services, Work, Contact (mobile emulation).
- [ ] Schema validates in Google Rich Results test (Organization, Person,
      FAQPage, Service).
- [ ] Analytics events: CTA clicks (hero / founder / final / nav), form
      submit, Calendly booking.
- [ ] Reduced-motion, keyboard-only pass, and 200% zoom re-checked on the
      production pages (not just the prototype).

## 6. 90-day roadmap (Blueprint §23)

| Weeks | Focus |
|-------|-------|
| 1–2 | Ship production homepage from the prototype; founder photo + story in |
| 3–4 | `/about` page; `/work` index with the 5-field case-study template; fix service-page titles to outcomes |
| 5–8 | Write the first 2–3 full case studies (Payhouse, Luminii/Ray & Sons, WCBS) with client-verified timelines and results; ask each for an updated quote while at it |
| 9–12 | First 3 insights articles (unlocks `/insights` + homepage row + nav item); review analytics: which CTA placement converts, where visitors drop; iterate |
| Ongoing | Collect testimonials at every project close; add each new shipped system to the Studio Ledger — the hero gets stronger every quarter |
