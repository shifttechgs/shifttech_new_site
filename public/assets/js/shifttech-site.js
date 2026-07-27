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

    // Current year
    var y = document.getElementById('year');
    if (y) { y.textContent = new Date().getFullYear(); }
})();








