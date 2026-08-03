@extends('layouts.site')

@section('title', 'Contact | ShiftTech')
@section('meta_description', 'Tell us what you are building. Free 30-minute discovery call, response within 24 hours, no sales pressure.')
@section('body_class', 'has-dark-hero')

@php
    $faqs = [
        ['q' => 'How quickly can you start on my project?', 'a' => 'We typically begin discovery within 48 hours of signing. For MVPs we can have a working prototype in 1 to 2 weeks. Larger projects follow a structured timeline we will establish together during our initial call.'],
        ['q' => "What's included in your pricing?", 'a' => 'Our quotes include design, development, testing, deployment, and 30 days of post-launch support. Transparent pricing, no hidden fees. You will know exactly what you are paying for before we start.'],
        ['q' => 'Do you offer ongoing support and maintenance?', 'a' => 'We offer flexible maintenance from basic monitoring to full managed services. Most clients move onto a monthly retainer for continuous improvements and priority support after launch.'],
        ['q' => "What if I'm not sure what I need?", 'a' => 'Our discovery calls are free and designed to help you figure that out. Bring the problem, we will ask the right questions, map the solution, and give you an honest recommendation with no obligation.'],
    ];
@endphp

@section('content')
<main id="main">
    <div class="rails" aria-hidden="true"></div>

    {{-- ==================== HERO (dark) ==================== --}}
    <section class="hero hero--dark" style="padding-bottom: 1rem;">
        <div class="container">
            <div style="max-width: 40rem;">
                <x-site.eyebrow>Contact</x-site.eyebrow>
                <h1 class="display-xl hero-headline"><span class="dim">Thirty minutes.</span><br><span class="hl">Then you'll know.</span></h1>
                <p class="lede">Tell us what you're building. We'll tell you honestly whether it's a fit and what it would take, no obligation.</p>

                <ul class="final-trust" style="justify-content: flex-start; margin-top: 2.5rem;">
                    <li><svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M13.5 4.5 6.5 11.5 3 8" stroke="#74B812" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>Free 30-minute call</li>
                    <li><svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M13.5 4.5 6.5 11.5 3 8" stroke="#74B812" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>Response within 24 hours</li>
                    <li><svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M13.5 4.5 6.5 11.5 3 8" stroke="#74B812" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>No sales pressure</li>
                </ul>
            </div>
        </div>
    </section>

    {{-- ==================== FORM + SIDEBAR ==================== --}}
    <section class="section section--flush-top" style="padding-top: 2.5rem;">
        <div class="container">
            <div class="contact-grid">

                {{-- Form --}}
                <div class="form-panel">
                    <form action="#" method="POST" id="contactForm">
                        @csrf

                        <div class="form-section">
                            <h3>What can we help you with?</h3>
                            <p class="form-section__hint">Select all that apply</p>
                            <div class="service-chips">
                                @foreach ($services as $service)
                                    <label class="service-chip">
                                        <input type="checkbox" name="services[]" value="{{ $service->name }}">
                                        <span>{{ $service->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-section">
                            <h3>Tell us about your project</h3>
                            <div class="field-grid">
                                <div class="field">
                                    <label for="cf-name">Your name *</label>
                                    <input type="text" id="cf-name" name="name" placeholder="Peter Harris" required>
                                </div>
                                <div class="field">
                                    <label for="cf-email">Email address *</label>
                                    <input type="email" id="cf-email" name="email" placeholder="peter@company.com" required>
                                </div>
                                <div class="field">
                                    <label for="cf-phone">Phone number</label>
                                    <input type="tel" id="cf-phone" name="phone" placeholder="+27 81 234 5678">
                                </div>
                                <div class="field">
                                    <label for="cf-company">Company name</label>
                                    <input type="text" id="cf-company" name="company" placeholder="Your company">
                                </div>
                            </div>
                        </div>

                        <div class="form-section budget-field">
                            <label for="budgetSlider">Estimated budget (ZAR)</label>
                            <input type="range" name="budget" id="budgetSlider" min="8000" max="550000" step="5000" value="25000">
                            <div class="budget-field__scale">
                                <span>R8,000</span>
                                <span class="budget-field__value" id="budgetValue">R25,000</span>
                                <span>R550,000+</span>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="field">
                                <label for="cf-message">Project description *</label>
                                <textarea id="cf-message" name="message" rows="5" placeholder="Tell us about your project goals, timeline, and any specific requirements..." required></textarea>
                            </div>
                        </div>

                        {{-- Anti-spam fields --}}
                        <input type="text" name="honeypot" id="honeypot" style="position:absolute; left:-9999px; width:1px; height:1px;" tabindex="-1" autocomplete="off">
                        <input type="hidden" name="form_start_time" id="formStartTime" value="">
                        <input type="hidden" name="recaptcha_token" id="recaptchaToken" value="">

                        <button type="submit" id="submitBtn" class="btn btn-lime form-submit">
                            <span id="submitBtnText">Start Your Project</span>
                            <span id="submitBtnIcon" aria-hidden="true">&rarr;</span>
                        </button>

                        <p class="field-hint">We'll respond within 24 hours. No spam, ever.</p>
                    </form>
                </div>

                {{-- Sidebar --}}
                <div class="contact-side">
                    <div class="contact-card">
                        <h3>Prefer to talk directly?</h3>

                        <div class="contact-row">
                            <span class="contact-row__icon" aria-hidden="true">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </span>
                            <div>
                                <p class="contact-row__label">Call us directly</p>
                                <a class="contact-row__value" href="tel:+27814303023">+27 81 430 3023</a>
                            </div>
                        </div>

                        <div class="contact-row">
                            <span class="contact-row__icon" aria-hidden="true">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 6l-10 7L2 6"/></svg>
                            </span>
                            <div>
                                <p class="contact-row__label">Email us</p>
                                <a class="contact-row__value" href="mailto:sales@shifttechgs.com">sales@shifttechgs.com</a>
                            </div>
                        </div>

                        <x-site.btn href="https://wa.me/27814303023?text=Hi%20ShiftTech!%20I%27m%20interested%20in%20your%20services%20and%20would%20like%20to%20discuss%20a%20project." variant="primary" target="_blank" rel="noopener noreferrer" style="width: 100%; justify-content: center; margin-top: .5rem;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-right: .5rem;"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 0 0 4.74 1.21h.01c5.46 0 9.9-4.45 9.9-9.91C21.96 6.45 17.5 2 12.04 2zm0 18.15h-.01a8.23 8.23 0 0 1-4.2-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.22 8.22 0 0 1-1.26-4.38c0-4.54 3.7-8.23 8.25-8.23 2.2 0 4.27.86 5.83 2.42a8.18 8.18 0 0 1 2.41 5.82c0 4.55-3.7 8.23-8.24 8.23z"/></svg>
                            Chat on WhatsApp
                        </x-site.btn>
                    </div>

                    <x-site.testimonial
                        :logo="asset('assets/images/logo/clients/peekaboo_daycare.png')" logo-alt="Peekaboo Daycare"
                        name="Peekaboo Daycare" role=""
                        highlight="an admissions dashboard that replaced the paperwork"
                        :reveal="false"
                    >For twenty years we ran on paper and phone calls, with almost no way for parents to find us online. ShiftTech built us a website that actually gets found and an admissions dashboard that replaced the paperwork. Our team can finally keep up.</x-site.testimonial>

                    <div class="contact-card">
                        <h3>Our offices</h3>
                        <div class="locations-list">
                            <div class="location-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0; margin-top:.15rem; color: var(--lime);" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <div>
                                    <span class="location-item__name">Cape Town, South Africa</span>
                                    <span class="location-item__meta">HQ, Western Cape</span>
                                </div>
                            </div>
                            <div class="location-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0; margin-top:.15rem; color: var(--lime);" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <div>
                                    <span class="location-item__name">Harare, Zimbabwe</span>
                                    <span class="location-item__meta">Regional office</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== FAQ ==================== --}}
    <section class="section section--flush-top" id="faq">
        <div class="container">
            <div class="faq-panel">
                <div class="faq-head">
                    <span class="faq-watermark" aria-hidden="true">FAQ</span>
                    <x-site.eyebrow>Questions</x-site.eyebrow>
                    <h2 class="display-l">Before you <strong>send it.</strong></h2>
                    <p class="faq-sub">If something's still unclear after reading these, just ask, or reach us directly.</p>

                    <div class="faq-contacts">
                        <a class="faq-contact" href="tel:+27814303023">
                            <span class="faq-contact__icon" aria-hidden="true">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </span>
                            <span>+27 81 430 3023</span>
                        </a>
                        <a class="faq-contact" href="mailto:sales@shifttechgs.com">
                            <span class="faq-contact__icon" aria-hidden="true">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 6l-10 7L2 6"/></svg>
                            </span>
                            <span>sales@shifttechgs.com</span>
                        </a>
                    </div>
                </div>

                <div class="faq-list">
                    @foreach ($faqs as $i => $faq)
                        <details class="faq-item" {{ $i === 0 ? 'open' : '' }}>
                            <summary class="faq-item__head">
                                <span class="faq-item__num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="faq-item__q">{{ $faq['q'] }}</span>
                                <span class="faq-item__toggle" aria-hidden="true">
                                    <svg width="12" height="8" viewBox="0 0 12 8" fill="none"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                            </summary>
                            <div class="faq-item__body">
                                <div class="faq-item__inner">
                                    <p>{{ $faq['a'] }}</p>
                                </div>
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== FORM STATE UI ==================== --}}
    <div id="formLoadingOverlay" class="form-loading-overlay">
        <div class="form-loading-overlay__box">
            <div class="form-loading-overlay__spin" aria-hidden="true"></div>
            <h3>Submitting your request...</h3>
            <p>Please wait while we process your information</p>
        </div>
    </div>

    <div id="toast-container" aria-live="polite"></div>

</main>
@endsection

@if (config('services.recaptcha.enabled'))
@push('scripts')
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
@endpush
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    var slider = document.getElementById('budgetSlider');
    var budgetValue = document.getElementById('budgetValue');
    var contactForm = document.getElementById('contactForm');
    var submitButton = document.getElementById('submitBtn');
    var submitButtonText = document.getElementById('submitBtnText');
    var submitButtonIcon = document.getElementById('submitBtnIcon');
    var loadingOverlay = document.getElementById('formLoadingOverlay');

    document.getElementById('formStartTime').value = Math.floor(Date.now() / 1000);

    if (slider && budgetValue) {
        slider.addEventListener('input', function () {
            var value = parseInt(this.value, 10);
            budgetValue.textContent = value >= 550000 ? 'R550,000+' : 'R' + value.toLocaleString();
        });
    }

    contactForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        var selectedServices = Array.from(document.querySelectorAll('input[name="services[]"]:checked')).map(function (cb) { return cb.value; });

        if (selectedServices.length === 0) {
            showToast('error', 'Please select at least one service');
            return;
        }

        loadingOverlay.style.display = 'flex';
        submitButton.disabled = true;
        submitButtonText.textContent = 'Verifying...';

        var recaptchaToken = '';
        @if (config('services.recaptcha.enabled'))
        try {
            recaptchaToken = await grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', { action: 'contact_form' });
            document.getElementById('recaptchaToken').value = recaptchaToken;
        } catch (error) {
            console.error('reCAPTCHA error:', error);
        }
        @endif

        submitButtonText.textContent = 'Submitting...';

        var formData = {
            name: contactForm.querySelector('input[name="name"]').value,
            email: contactForm.querySelector('input[name="email"]').value,
            phone: contactForm.querySelector('input[name="phone"]').value,
            company: contactForm.querySelector('input[name="company"]').value,
            budget: parseFloat(contactForm.querySelector('input[name="budget"]').value),
            message: contactForm.querySelector('textarea[name="message"]').value,
            services: selectedServices,
            honeypot: document.getElementById('honeypot').value,
            form_start_time: document.getElementById('formStartTime').value,
            recaptcha_token: recaptchaToken
        };

        try {
            var response = await fetch('{{ route('contact.submit') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                body: JSON.stringify(formData)
            });

            var result = await response.json();

            if (response.ok && result.success) {
                loadingOverlay.style.display = 'none';
                showSuccessModal();
                showToast('success', result.message || "Thank you! We'll respond within 24 hours.");

                setTimeout(function () {
                    contactForm.reset();
                    if (slider) { slider.value = 25000; budgetValue.textContent = 'R25,000'; }
                    document.getElementById('formStartTime').value = Math.floor(Date.now() / 1000);
                }, 1000);

                window.scrollTo({ top: 0, behavior: 'smooth' });
            } else {
                loadingOverlay.style.display = 'none';
                showToast('error', result.message || 'An error occurred. Please try again.');
                if (result.errors) { console.error('Form errors:', result.errors); }
            }
        } catch (error) {
            console.error('Submission error:', error);
            loadingOverlay.style.display = 'none';
            showToast('error', 'Network error. Please check your connection and try again.');
        } finally {
            submitButton.disabled = false;
            submitButtonText.textContent = 'Start Your Project';
        }
    });

    function showSuccessModal() {
        var modal = document.createElement('div');
        modal.className = 'success-modal';
        modal.innerHTML =
            '<div class="success-modal__box">' +
                '<div class="success-modal__icon" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg></div>' +
                '<h3>Thank you</h3>' +
                "<p>We've received your request and will get back to you within 24 hours with a tailored approach.</p>" +
                '<button type="button" class="btn btn-lime">Got it</button>' +
            '</div>';

        document.body.appendChild(modal);
        modal.querySelector('button').addEventListener('click', function () { modal.remove(); });
        modal.addEventListener('click', function (e) { if (e.target === modal) { modal.remove(); } });

        setTimeout(function () { if (modal.isConnected) { modal.remove(); } }, 8000);
    }

    function showToast(type, message) {
        var toastContainer = document.getElementById('toast-container');
        if (!toastContainer) return;

        var toast = document.createElement('div');
        toast.className = 'toast-message toast-' + type;
        var icon = type === 'success'
            ? '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9 12l2 2 4-4"/></svg>'
            : '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>';

        toast.innerHTML =
            '<span class="toast-icon" aria-hidden="true">' + icon + '</span>' +
            '<span class="toast-content"><span class="toast-title">' + (type === 'success' ? 'Success' : 'Error') + '</span><span class="toast-message-text">' + message + '</span></span>' +
            '<button type="button" class="toast-close" aria-label="Dismiss">&times;</button>';

        toastContainer.appendChild(toast);
        toast.querySelector('.toast-close').addEventListener('click', function () { toast.remove(); });

        setTimeout(function () { if (toast.isConnected) { toast.remove(); } }, 5000);
    }
});
</script>
@endpush

@push('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        @foreach ($faqs as $faq)
        {
            "@type": "Question",
            "name": {!! json_encode($faq['q']) !!},
            "acceptedAnswer": { "@type": "Answer", "text": {!! json_encode($faq['a']) !!} }
        }@if (! $loop->last),@endif
        @endforeach
    ]
}
</script>
@endpush
