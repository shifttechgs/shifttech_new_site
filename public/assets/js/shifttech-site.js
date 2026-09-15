/* ShiftTech public site — minimal, dependency-free interactions.
   Loaded deferred by layouts/site.blade.php. */
(function () {
    'use strict';

    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Nav hairline on scroll
    var nav = document.getElementById('nav');
    if (nav) {
        var onScroll = function () { nav.classList.toggle('scrolled', window.scrollY > 8); };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    // Mobile menu
    var toggle = document.getElementById('menuToggle');
    var panel = document.getElementById('mobilePanel');
    if (toggle && panel) {
        toggle.addEventListener('click', function () {
            var open = panel.classList.toggle('open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
        });
        panel.addEventListener('click', function (e) {
            if (e.target.tagName === 'A') {
                panel.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
                toggle.setAttribute('aria-label', 'Open menu');
            }
        });
    }

    // Reveal on entry — dynamic sibling stagger for organic cascading
    var reveals = document.querySelectorAll('.reveal');
    if (!reduced && 'IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                var el = entry.target;
                // Stagger based on sibling index within direct parent
                var siblings = Array.prototype.slice.call(el.parentElement.children);
                var revealSiblings = siblings.filter(function (s) { return s.classList.contains('reveal'); });
                var idx = revealSiblings.indexOf(el);
                if (idx > 0) el.style.transitionDelay = (idx * 65) + 'ms';
                el.classList.add('in');
                io.unobserve(entry.target);
            });
        }, { rootMargin: '0px 0px -8% 0px' });
        reveals.forEach(function (el) { io.observe(el); });
    } else {
        reveals.forEach(function (el) { el.classList.add('in'); });
    }

    // Drawers are hover-triggered via CSS (:hover + :focus-within).
    // No JS needed for the reveal — see .drawer:hover/.drawer:focus-within in shifttech.css

    // ── Stat count-up + entrance animation ───────────────────────────────────────
    var statNums = document.querySelectorAll('.stat-num[data-count]');
    if (statNums.length && 'IntersectionObserver' in window) {
        var statIO = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                statIO.unobserve(entry.target);
                var el = entry.target;
                el.classList.add('counted-in');
                if (reduced) return;

                var raw = el.getAttribute('data-count'); // e.g. "100%", "10+", "90%+"
                var num = parseFloat(raw);
                if (isNaN(num)) return;
                var suffix = raw.replace(/[\d.]/g, ''); // everything that isn't a digit
                var duration = 1600;
                var start = performance.now();

                function tick(now) {
                    var progress = Math.min((now - start) / duration, 1);
                    // ease-out cubic
                    var eased = 1 - Math.pow(1 - progress, 3);
                    el.textContent = Math.round(num * eased) + suffix;
                    if (progress < 1) requestAnimationFrame(tick);
                }
                requestAnimationFrame(tick);
            });
        }, { rootMargin: '0px 0px -12% 0px', threshold: 0.3 });
        statNums.forEach(function (el) { statIO.observe(el); });
    }

    // ── Auto-advancing carousels (legacy scroll-based, kept for other uses) ──
    document.querySelectorAll('[data-carousel]').forEach(function (car) {
        var track = car.querySelector('[data-carousel-track]');
        var dotsWrap = car.querySelector('[data-carousel-dots]');
        var prevBtn = car.querySelector('[data-carousel-prev]');
        var nextBtn = car.querySelector('[data-carousel-next]');
        if (!track) return;
        var slides = Array.prototype.slice.call(track.children);
        if (slides.length < 2) return;

        var GAP = 24, index = 0, timer = null, DELAY = 5500;

        var dots = slides.map(function (_, i) {
            var b = document.createElement('button');
            b.setAttribute('role', 'tab');
            b.setAttribute('aria-label', 'Case study ' + (i + 1));
            b.addEventListener('click', function () { goTo(i, true); });
            if (dotsWrap) dotsWrap.appendChild(b);
            return b;
        });

        function apply() {
            var w = slides[0].getBoundingClientRect().width;
            track.style.transform = 'translate3d(' + (-index * (w + GAP)) + 'px,0,0)';
            dots.forEach(function (d, i) { d.setAttribute('aria-current', i === index ? 'true' : 'false'); });
            if (prevBtn) prevBtn.disabled = false;
            if (nextBtn) nextBtn.disabled = false;
        }
        function goTo(n, user) { index = (n + slides.length) % slides.length; apply(); if (user) restart(); }
        function next() { goTo(index + 1); }
        function prev() { goTo(index - 1); }
        function start() { if (!reduced) { timer = setInterval(next, DELAY); } }
        function stop() { clearInterval(timer); }
        function restart() { stop(); start(); }

        if (nextBtn) nextBtn.addEventListener('click', function () { goTo(index + 1, true); });
        if (prevBtn) prevBtn.addEventListener('click', function () { goTo(index - 1, true); });

        car.addEventListener('mouseenter', stop);
        car.addEventListener('mouseleave', start);
        car.addEventListener('focusin', stop);
        car.addEventListener('focusout', start);
        window.addEventListener('resize', apply);

        // Touch swipe
        var startX = 0, dx = 0, swiping = false;
        track.addEventListener('touchstart', function (e) { startX = e.touches[0].clientX; dx = 0; swiping = true; stop(); }, { passive: true });
        track.addEventListener('touchmove', function (e) { if (swiping) dx = e.touches[0].clientX - startX; }, { passive: true });
        track.addEventListener('touchend', function () {
            if (!swiping) return;
            swiping = false;
            if (dx < -40) goTo(index + 1, true);
            else if (dx > 40) goTo(index - 1, true);
            else start();
        });

        apply();
        start();
    });

    // ── Testimonials marquee — pause on hover/focus (CSS) + explicit toggle button
    // for keyboard/screen-reader users, and a hard stop under reduced-motion.
    document.querySelectorAll('[data-marquee]').forEach(function (marquee) {
        var toggle = marquee.parentElement
            ? marquee.parentElement.querySelector('[data-marquee-toggle]')
            : document.querySelector('[data-marquee-toggle]');

        if (reduced) {
            marquee.classList.add('is-paused');
            if (toggle) { toggle.disabled = true; toggle.setAttribute('aria-pressed', 'true'); }
            return;
        }

        if (!toggle) return;
        var label = toggle.querySelector('[data-marquee-toggle-label]');
        var icon = toggle.querySelector('[data-marquee-toggle-icon]');
        toggle.addEventListener('click', function () {
            var paused = marquee.classList.toggle('is-paused');
            toggle.setAttribute('aria-pressed', paused ? 'true' : 'false');
            toggle.setAttribute('aria-label', paused ? 'Resume scrolling testimonials' : 'Pause scrolling testimonials');
            if (label) label.textContent = paused ? 'Play' : 'Pause';
            if (icon) icon.innerHTML = paused ? '&#9654;' : '&#10074;&#10074;';
        });
    });

    // FAQ scroll stepper (Phobos "Careers" treatment) — the section is made tall
    // and its panel sticky; as the section scrolls past, the active card cycles
    // through the questions and a progress readout climbs. No-JS / reduced-motion
    // leaves the plain stacked list (see .section--faq-stepper CSS, ungated).
    var faqStep = document.querySelector('[data-faq-stepper]');
    if (faqStep && !reduced && window.matchMedia('(min-width: 861px)').matches) {
        faqStep.classList.add('is-live');
        var faqSteps = faqStep.querySelectorAll('.faq-step');
        var faqPct = faqStep.querySelector('[data-faq-pct]');
        var faqCount = faqSteps.length;
        var faqQueued = false;
        var faqUpdate = function () {
            faqQueued = false;
            var r = faqStep.getBoundingClientRect();
            var scrollable = faqStep.offsetHeight - window.innerHeight;
            var p = scrollable > 0 ? Math.max(0, Math.min(1, -r.top / scrollable)) : 0;
            var active = Math.min(faqCount - 1, Math.floor(p * faqCount + 1e-4));
            faqStep.style.setProperty('--faq-p', p);
            if (faqPct) { faqPct.textContent = Math.round(p * 100) + '%'; }
            for (var i = 0; i < faqCount; i++) {
                faqSteps[i].classList.toggle('is-active', i === active);
            }
        };
        // rAF-throttled: faqUpdate reads layout and writes a custom property,
        // so running it raw on every scroll event forces layout repeatedly.
        var faqOnScroll = function () {
            if (!faqQueued) { faqQueued = true; requestAnimationFrame(faqUpdate); }
        };
        window.addEventListener('scroll', faqOnScroll, { passive: true });
        window.addEventListener('resize', faqOnScroll);
        faqUpdate();
    }

    // Hero artifact — the tilted "deploy log" card stack spreads apart as the
    // hero scrolls out of view. Sets --sp (0 -> 1) on the stack; the CSS card
    // transforms are functions of it. No-JS / reduced-motion leaves it static.
    var heroArt = document.querySelector('.hero--phobos .hero-phobos__artifact');
    if (heroArt && !reduced) {
        var heroSec = heroArt.closest('.hero--phobos');
        var artQueued = false;
        var artUpdate = function () {
            artQueued = false;
            var h = (heroSec && heroSec.offsetHeight) || window.innerHeight;
            var p = Math.max(0, Math.min(1, window.scrollY / h));
            heroArt.style.setProperty('--sp', p.toFixed(4));
        };
        window.addEventListener('scroll', function () {
            if (!artQueued) { artQueued = true; requestAnimationFrame(artUpdate); }
        }, { passive: true });
        window.addEventListener('resize', artUpdate);
        artUpdate();
    }

    // Hero 3D parallax — the hero layers sit on a perspective stage and lean
    // toward the pointer (headlines + badge shift, the card stack shifts +
    // tilts), then settle back to rest when it leaves. Approximates
    // phobos.com.au's cursor-parallax hero. JS only writes --px / --py (-1..1)
    // on the stage on pointer move; the eased follow and the return-to-rest are
    // CSS transitions on the layers (see shifttech.css) — no animation loop, so
    // the page idles at rest with nothing running. Wider than 860px and no
    // reduced-motion; a stray move on a touch device just eases back to rest.
    var heroStage = document.querySelector('.hero--phobos .hero-phobos__stage');
    if (heroStage && !reduced && window.matchMedia('(min-width: 861px)').matches) {
        var heroInView = function () {
            var r = heroStage.getBoundingClientRect();
            return r.bottom > 0 && r.top < window.innerHeight;
        };
        var setParallax = function (px, py) {
            heroStage.style.setProperty('--px', px.toFixed(3));
            heroStage.style.setProperty('--py', py.toFixed(3));
        };
        window.addEventListener('mousemove', function (e) {
            if (!heroInView()) return;
            var r = heroStage.getBoundingClientRect();
            setParallax(
                Math.max(-1, Math.min(1, ((e.clientX - r.left) / r.width - 0.5) * 2)),
                Math.max(-1, Math.min(1, ((e.clientY - r.top) / r.height - 0.5) * 2))
            );
        }, { passive: true });
        document.addEventListener('mouseleave', function () { setParallax(0, 0); });
    }

    // Hero headline word cycle — only the word rotates; the trailing "is."
    // never moves. The clip box is widened to the measured width of the active
    // word so the verb stays tight against it at any font size. The list ends
    // with a duplicate of the first word so the wrap is seamless: on reaching
    // it we snap back to index 0 with transitions off.
    var cyc = document.querySelector('.hero--phobos .hero-phobos__cycle');
    if (cyc) {
        var track = cyc.querySelector('.hero-phobos__cycle-track');
        var words = track ? Array.prototype.slice.call(track.children) : [];
        if (track && words.length > 1) {
            var idx = 0;
            var widths = [];
            var measure = function () {
                widths = words.map(function (w) { return w.getBoundingClientRect().width; });
                cyc.style.width = widths[idx] + 'px';
            };
            var step = function () {
                idx++;
                track.style.transform = 'translateY(-' + (idx * 1.12) + 'em)';
                cyc.style.width = widths[idx] + 'px';
                if (idx >= words.length - 1) {
                    window.setTimeout(function () {
                        track.style.transition = 'none';
                        cyc.style.transition = 'none';
                        idx = 0;
                        track.style.transform = 'translateY(0)';
                        cyc.style.width = widths[0] + 'px';
                        // force reflow, then restore the transitions
                        void track.offsetWidth;
                        track.style.transition = '';
                        cyc.style.transition = '';
                    }, 600);
                }
            };
            measure();
            window.addEventListener('resize', measure);
            // the display font loads with font-display:swap, so the first
            // measure can land on the fallback metrics and leave the clip box
            // too narrow — re-measure once the real face is ready.
            if (document.fonts && document.fonts.ready) {
                document.fonts.ready.then(measure);
            }
            window.addEventListener('load', measure);
            if (!reduced) { window.setInterval(step, 2600); }
        }
    }

    // Current year
    var y = document.getElementById('year');
    if (y) { y.textContent = new Date().getFullYear(); }
})();








