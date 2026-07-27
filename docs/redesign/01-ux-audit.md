# ShiftTech.com — UX Audit

Audit of the current public site (primarily `resources/views/welcome.blade.php`,
`partials/header.blade.php`, `partials/footer.blade.php`) against the goals in
`docs/redesign-master-plan.md`: premium, founder-led, handcrafted, converting
visitors into booked discovery calls.

Severity: 🔴 hurts trust/conversion directly · 🟠 dilutes the premium feel · 🟡 polish

---

## 1. Global findings

| # | Finding | Severity |
|---|---------|----------|
| G1 | **Template DNA is visible everywhere.** The site is a purchased Bootstrap theme (custom cursor dot, ScrollSmoother, SplitText headline animation, drag-rotate pills, radial progress rings, "brand slider" swiper). These are exactly the "AI/template website" tells the master plan bans. A buyer comparing against Stripe/Glucode-grade sites reads this instantly. | 🔴 |
| G2 | **Five separate CTA blocks on one page** (hero, "Who We Help" card, post-testimonials banner, post-stats banner, pre-footer band) with four different button styles and three different phrasings ("Book a Free Discovery Call", "Let's Discuss Your Project", "Let's Build Your Success Story", "Book Your Free Discovery Call"). Repetition without hierarchy reads as desperation, and inconsistent labels break the "same action, same name" rule. | 🔴 |
| G3 | **No founder anywhere.** The brand story is "direct access to the developer" (the hero even says "directly with the developer") but no person is ever shown or named on the homepage. One testimonial mentions "Prosper and the team" — that's the only trace. Clients buy people; the site sells an anonymous agency. | 🔴 |
| G4 | **Color soup.** Sections use deep green, lime, black, `bg-pink-dark`, `bg-pink-lighter`, `bg-purple-light`, `bg-paste-light`, navy `#0a1628`, plus gradients. No two adjacent sections share a surface logic. Premium sites run 2–3 surfaces total. | 🔴 |
| G5 | **Inline styles everywhere** (`style="font-size: 3.5rem"`, hardcoded `#74b812` ~40×, `#f8f9fa` accordions). There is no design-token system; every section invents its own spacing, radius, and shadow. | 🟠 |
| G6 | **Inflated/contradictory claims.** "150+ successful launches" vs "150+ Products launched", "98%" vs "99.8% satisfaction", "88% average revenue growth", "3× faster", "60% cost savings vs US/EU agencies". Unverifiable big numbers from a boutique studio *reduce* trust — the honest, checkable record (real clients, real systems) is far stronger and already exists on the page. | 🔴 |
| G7 | Dead code shipped to production: ~90 lines of commented-out Blade in the hero, a `toggleFAQ()` function with no matching markup, process-timeline JS (`#process-section`) with no matching section. | 🟡 |

## 2. Section-by-section

### Hero
- Fake `app.js` code block with `const shifttech = { mission: ... }` — a fake code prop is a known template cliché and communicates nothing a business buyer cares about. 🔴
- Headline "Reduce Admin. Save Time. Grow Confidently." is a decent outcome message, but three staccato fragments read like ad copy, not a studio's voice. 🟠
- Trust indicators ("No commitment required", "24hr response time") are good conversion practice — keep the substance, quiet the styling.

### Brand slider
- Real client logos exist (strong!) but one is literally `alt="Client"` with a duplicated logo to "fill the loop", and Vision Plus Wealth's alt is on the wrong logo. Sloppiness in the trust strip is where sloppiness costs most. 🟠

### "About" bento grid
- Draggable rotating pills ("AI-Powered Code Review", "Predictive Delivery Timelines") — decorative, unverifiable, and interactive for no reason. 🔴
- Radial progress ring shows "80%" while its `data-percentage` is 78. 🟡
- Floating "model.png" person cutout = stock-style imagery the plan bans. 🟠

### Services
- Outcome-oriented card titles are genuinely good copy ("Native Apps Users Actually Want to Use"). Keep the copy strategy.
- But: 5 cards use 5 different background colors, all descriptions are commented out (cards have no body text), and the **Web Application Development card links to the wrong page** (`/services/web-design`). 🔴
- Decorative `offer-img*.png` blobs behind each card = template graphics. 🟠

### Recent Work
- Real screenshots of real projects — the strongest asset on the page — but every card links generically to `/work`, shows no outcome, no client story, no metrics. This should be the #1 conversion tool and it's a decoration strip. 🔴

### Testimonials
- Six real, detailed, named testimonials with company logos — excellent raw material.
- Fabricated-looking "4.9 ★ / 5.0 ★" pill ratings undermine them (ratings from what platform?). Remove the pills, let the words carry it. 🟠
- `tw-text-xl` quote text at ~100 chars/line is hard to read. 🟡

### Stats section ("Real Impact. Proven Results")
- Six stat pills restating the same claims a third time, in pill-shaped containers with alternating green/white. Duplicates the hero and CTA-banner stats with *different numbers* (98% here, 99.8% earlier). 🔴

### FAQ
- Content is genuinely useful and answers real objections. Keep all four Q&As. Styling is default Bootstrap accordion on `#f8f9fa`. 🟡

### Header / Nav
- Nav is already minimal (Services, Work, Agency, Contact) — good.
- "Book Your Free Discovery Call" header button label is long enough to wrap on smaller laptops. 🟡
- Services submenu duplicates full mobile markup inline; `min-width: 380px` inline style. 🟡

### Footer
- Pre-footer CTA band (lime gradient) = sixth CTA. 🟠
- Footer service links all point to `#`. 🔴 (dead ends in the trust section)
- Two locations listed with the same map-pin icon; LinkedIn only social — fine, honest.

## 3. Accessibility snapshot (current site)

- Lime `#74b812` used as text on white in several places — fails WCAG AA (≈2.5:1).
- Custom cursor hides the native cursor for all users; no reduced-motion handling anywhere (ScrollSmoother, AOS, SplitText all run regardless of `prefers-reduced-motion`).
- Heading order jumps (h1 → h3 → h6); decorative images with `alt="Image"` or `alt="Shape"`; icon-only links without labels.
- Focus styles suppressed on accordion (`box-shadow: none`) with no replacement.

## 4. Conversion leaks (summary)

1. Six CTAs / four labels → no single clear action. **Fix: one primary action ("Book a discovery call"), one label, three placements (hero, founder, final).**
2. Strongest proof (real work + real testimonials) is buried mid-page and unlinked. **Fix: proof moves up; case studies get outcomes and destinations.**
3. Founder invisible while the pitch is founder-access. **Fix: founder section + founder voice throughout.**
4. Unverifiable stats compete with verifiable record. **Fix: the record (clients, systems, years) replaces invented percentages.**
5. Dead links (footer services, wrong service card link) = trust dead ends. **Fix in production pass.**

These findings drive the IA in `02-information-architecture.md` and the system in
`03-design-system.md`.
