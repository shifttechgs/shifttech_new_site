@extends("layouts.master")
@section("content")

<!-- ==================== Contact Hero Section ==================== -->
<section class="contact-hero position-relative overflow-hidden" style="background: linear-gradient(135deg, #123d33 0%, #123d33 100%); padding: 100px 0 60px;">
    <img src="assets/images/shapes/sqaure_shape.png"
         alt="Shape"
         class="position-absolute top-0 tw-end-0 tw-me-12-percent"
         style="filter: brightness(50%); opacity: 0.2;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <span class="d-inline-block tw-py-2 tw-px-4 rounded-pill text-white fw-medium tw-text-sm tw-mb-4" style="background: rgba(116, 184, 18, 0.2); border: 1px solid #74b812;">
                    Let's Build Something Great Together
                </span>
                <h1 class="text-white fw-bold tw-mb-4" style="font-size: 3rem; line-height: 1.2;">
                    Start Your Project Today
                </h1>
                <p class="text-white tw-text-lg" style="opacity: 0.8; max-width: 600px; margin: 0 auto;">
                    Tell us about your vision. We'll get back to you within 24 hours with a tailored approach and transparent pricing.
                </p>
            </div>
        </div>
    </div>
   </section>

<!-- ==================== Main Contact Section ==================== -->
<section class="py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="row g-5">
            <!-- Left Column - Form -->
            <div class="col-lg-7">
                <div class="bg-white rounded-4 p-4 p-lg-5 shadow-sm">
                    <form action="#" method="POST" class="contact-form" id="contactForm">
                        @csrf

                        <!-- Step 1: Services -->
                        <div class="form-section tw-mb-8">
                            <h5 class="fw-bold tw-mb-2" style="color: #0a1628;">What can we help you with?</h5>
                            <p class="text-muted tw-text-sm tw-mb-4">Select all that apply</p>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="service-checkbox d-flex align-items-center p-3 rounded-3 cursor-pointer" style="border: 2px solid #e9ecef; transition: all 0.3s ease;">
                                        <input type="checkbox" name="services[]" value="web_development" class="d-none">
                                        <span class="checkbox-custom me-3"></span>
                                        <span class="fw-medium">Web Development</span>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="service-checkbox d-flex align-items-center p-3 rounded-3 cursor-pointer" style="border: 2px solid #e9ecef; transition: all 0.3s ease;">
                                        <input type="checkbox" name="services[]" value="mobile_app" class="d-none">
                                        <span class="checkbox-custom me-3"></span>
                                        <span class="fw-medium">Mobile App</span>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="service-checkbox d-flex align-items-center p-3 rounded-3 cursor-pointer" style="border: 2px solid #e9ecef; transition: all 0.3s ease;">
                                        <input type="checkbox" name="services[]" value="custom_software" class="d-none">
                                        <span class="checkbox-custom me-3"></span>
                                        <span class="fw-medium">Custom Software</span>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="service-checkbox d-flex align-items-center p-3 rounded-3 cursor-pointer" style="border: 2px solid #e9ecef; transition: all 0.3s ease;">
                                        <input type="checkbox" name="services[]" value="mvp_development" class="d-none">
                                        <span class="checkbox-custom me-3"></span>
                                        <span class="fw-medium">MVP Development</span>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="service-checkbox d-flex align-items-center p-3 rounded-3 cursor-pointer" style="border: 2px solid #e9ecef; transition: all 0.3s ease;">
                                        <input type="checkbox" name="services[]" value="ui_ux_design" class="d-none">
                                        <span class="checkbox-custom me-3"></span>
                                        <span class="fw-medium">UI/UX Design</span>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="service-checkbox d-flex align-items-center p-3 rounded-3 cursor-pointer" style="border: 2px solid #e9ecef; transition: all 0.3s ease;">
                                        <input type="checkbox" name="services[]" value="ai_automation" class="d-none">
                                        <span class="checkbox-custom me-3"></span>
                                        <span class="fw-medium">AI & Automation</span>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="service-checkbox d-flex align-items-center p-3 rounded-3 cursor-pointer" style="border: 2px solid #e9ecef; transition: all 0.3s ease;">
                                        <input type="checkbox" name="services[]" value="cloud_devops" class="d-none">
                                        <span class="checkbox-custom me-3"></span>
                                        <span class="fw-medium">Cloud & DevOps</span>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="service-checkbox d-flex align-items-center p-3 rounded-3 cursor-pointer" style="border: 2px solid #e9ecef; transition: all 0.3s ease;">
                                        <input type="checkbox" name="services[]" value="consulting" class="d-none">
                                        <span class="checkbox-custom me-3"></span>
                                        <span class="fw-medium">Tech Consulting</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Project Details -->
                        <div class="form-section tw-mb-8">
                            <h5 class="fw-bold tw-mb-4" style="color: #0a1628;">Tell us about your project</h5>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-dark">Your Name *</label>
                                    <input type="text" name="name" class="form-control form-control-lg border-2" placeholder="John Doe" required style="border-color: #e9ecef; border-radius: 12px;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-dark">Email Address *</label>
                                    <input type="email" name="email" class="form-control form-control-lg border-2" placeholder="john@company.com" required style="border-color: #e9ecef; border-radius: 12px;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-dark">Phone Number</label>
                                    <input type="tel" name="phone" class="form-control form-control-lg border-2" placeholder="+27 81 234 5678" style="border-color: #e9ecef; border-radius: 12px;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-dark">Company Name</label>
                                    <input type="text" name="company" class="form-control form-control-lg border-2" placeholder="Your Company" style="border-color: #e9ecef; border-radius: 12px;">
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Company Stage & Budget -->
                        <div class="form-section tw-mb-8">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-dark">Company Stage</label>
                                    <select name="company_stage" class="form-select form-select-lg border-2" style="border-color: #e9ecef; border-radius: 12px;">
                                        <option value="">Select stage...</option>
                                        <option value="idea">Just an idea</option>
                                        <option value="startup">Early-stage Startup</option>
                                        <option value="growth">Growth Stage</option>
                                        <option value="sme">Established SME</option>
                                        <option value="enterprise">Enterprise</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium text-dark">How did you hear about us?</label>
                                    <select name="referral_source" class="form-select form-select-lg border-2" style="border-color: #e9ecef; border-radius: 12px;">
                                        <option value="">Select source...</option>
                                        <option value="google">Google Search</option>
                                        <option value="linkedin">LinkedIn</option>
                                        <option value="referral">Friend/Colleague</option>
                                        <option value="social">Social Media</option>
                                        <option value="portfolio">Saw our work</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Budget Slider -->
                        <div class="form-section tw-mb-8">
                            <label class="form-label fw-medium text-dark">Estimated Budget (USD)</label>
                            <div class="budget-slider-container p-4 rounded-3" style="background: #f8f9fa;">
                                <input type="range" name="budget" id="budgetSlider" class="form-range w-100" min="5000" max="150000" step="5000" value="25000">
                                <div class="d-flex justify-content-between mt-3">
                                    <span class="text-muted tw-text-sm">$5,000</span>
                                    <span class="fw-bold tw-text-lg" id="budgetValue" style="color: #74b812;">$25,000</span>
                                    <span class="text-muted tw-text-sm">$150,000+</span>
                                </div>
                            </div>
                        </div>

                        <!-- Project Description -->
                        <div class="form-section tw-mb-8">
                            <label class="form-label fw-medium text-dark">Project Description *</label>
                            <textarea name="message" class="form-control border-2" rows="5" placeholder="Tell us about your project goals, timeline, and any specific requirements..." required style="border-color: #e9ecef; border-radius: 12px;"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-lg w-100 text-white fw-bold py-3" style="background: linear-gradient(135deg, #74b812 0%, #5a9a0a 100%); border-radius: 50px; border: none; transition: all 0.3s ease;">
                            <span class="d-flex align-items-center justify-content-center gap-2">
                                <span>Start Your Project</span>
                                <i class="ph-bold ph-arrow-right"></i>
                            </span>
                        </button>



                        <p class="text-center text-muted tw-text-sm mt-3">
                            We'll respond within 24 hours. No spam, ever.
                        </p>
                    </form>
                </div>
            </div>

            <!-- Right Column - Info & Trust Elements -->
            <div class="col-lg-5">
                <!-- Quick Contact Card -->
                <div class="bg-white rounded-4 p-4 shadow-sm tw-mb-4">
                    <h5 class="fw-bold tw-mb-4" style="color: #0a1628;">Prefer to talk directly?</h5>

                    <div class="d-flex align-items-center tw-mb-4 p-3 rounded-3" style="background: #f8f9fa;">
                        <div class="me-3" style="width: 48px; height: 48px; background: linear-gradient(135deg, #74b812 0%, #5a9a0a 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="ph-bold ph-phone text-white tw-text-xl"></i>
                        </div>
                        <div>
                            <p class="tw-text-sm text-muted mb-1">Call us directly</p>
                            <a href="tel:+27814303023" class="fw-bold text-dark text-decoration-none">+27 81 430 3023</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center tw-mb-4 p-3 rounded-3" style="background: #f8f9fa;">
                        <div class="me-3" style="width: 48px; height: 48px; background: linear-gradient(135deg, #74b812 0%, #5a9a0a 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="ph-bold ph-envelope text-white tw-text-xl"></i>
                        </div>
                        <div>
                            <p class="tw-text-sm text-muted mb-1">Email us</p>
                            <a href="mailto:info@shifttechgs.com" class="fw-bold text-dark text-decoration-none">info@shifttechgs.com</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center p-3 rounded-3" style="background: #f8f9fa;">
                        <div class="me-3" style="width: 48px; height: 48px; background: linear-gradient(135deg, #74b812 0%, #5a9a0a 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="ph-bold ph-whatsapp-logo text-white tw-text-xl"></i>
                        </div>
                        <div>
                            <p class="tw-text-sm text-muted mb-1">WhatsApp</p>
                            <a href="https://wa.me/27814303023" class="fw-bold text-dark text-decoration-none" target="_blank">Chat with us</a>
                        </div>
                    </div>
                </div>

                <!-- Trust Stats -->
                <div class="bg-white rounded-4 p-4 shadow-sm tw-mb-4">
                    <h5 class="fw-bold tw-mb-4" style="color: #0a1628;">Why clients choose us</h5>

                    <div class="row g-3">
                        <div class="col-6">
                            <div class="text-center p-3 rounded-3" style="background: #f8f9fa;">
                                <h3 class="fw-bold mb-1" style="color: #74b812;">150+</h3>
                                <p class="tw-text-sm text-muted mb-0">Projects Delivered</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 rounded-3" style="background: #f8f9fa;">
                                <h3 class="fw-bold mb-1" style="color: #74b812;">98%</h3>
                                <p class="tw-text-sm text-muted mb-0">Client Satisfaction</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 rounded-3" style="background: #f8f9fa;">
                                <h3 class="fw-bold mb-1" style="color: #74b812;">60%</h3>
                                <p class="tw-text-sm text-muted mb-0">Cost Savings</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 rounded-3" style="background: #f8f9fa;">
                                <h3 class="fw-bold mb-1" style="color: #74b812;">24hr</h3>
                                <p class="tw-text-sm text-muted mb-0">Response Time</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial -->
                <div class="rounded-4 p-4 text-white" style="background: linear-gradient(135deg, #123d33 0%, #123d33 100%);">
                    <div class="d-flex align-items-center tw-mb-4">
                        <img src="assets/images/logo/clients/wcbs_header_logo.png" alt="WCBS" style="height: 40px; filter: brightness(0) invert(1);">
                    </div>
                    <p class="tw-text-base mb-4" style="line-height: 1.7;">
                        "Prosper and the team introduced AI into our workflows and designed a monitoring system for all our background services. They delivered it 4x faster than our internal estimates."
                    </p>
                    <div class="d-flex align-items-center">
                        <div class="me-3" style="width: 48px; height: 48px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="ph-bold ph-user text-white tw-text-xl"></i>
                        </div>
                        <div>
                            <p class="fw-bold mb-0">Ian</p>
                            <p class="tw-text-sm mb-0" style="opacity: 0.7;">Manager, WesternCape Blood Service</p>
                        </div>
                    </div>
                </div>

                <!-- Office Locations -->
                <div class="bg-white rounded-4 p-4 shadow-sm mt-4">
                    <h5 class="fw-bold tw-mb-4" style="color: #0a1628;">Our Offices</h5>

                    <div class="d-flex align-items-start tw-mb-3">
                        <i class="ph-bold ph-map-pin me-3 tw-text-xl" style="color: #74b812;"></i>
                        <div>
                            <p class="fw-medium mb-1">Cape Town, South Africa</p>
                            <p class="tw-text-sm text-muted mb-0">HQ - Western Cape</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start">
                        <i class="ph-bold ph-map-pin me-3 tw-text-xl" style="color: #74b812;"></i>
                        <div>
                            <p class="fw-medium mb-1">Harare, Zimbabwe</p>
                            <p class="tw-text-sm text-muted mb-0">Regional Office</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== FAQ Section ==================== -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center tw-mb-5">
                <h2 class="fw-bold" style="color: #0a1628;">Frequently Asked Questions</h2>
                <p class="text-muted">Everything you need to know about working with us</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item border-0 tw-mb-3 rounded-3 overflow-hidden" style="background: #f8f9fa;">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" style="background: #f8f9fa;">
                                How quickly can you start on my project?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                We typically begin discovery within 48 hours of signing. For MVPs, we can have a working prototype in 1-2 weeks. Larger projects follow a structured timeline we'll establish together during our initial consultation.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 tw-mb-3 rounded-3 overflow-hidden" style="background: #f8f9fa;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" style="background: #f8f9fa;">
                                What's included in your pricing?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Our quotes include design, development, testing, deployment, and 30 days of post-launch support. We provide transparent pricing with no hidden fees. You'll know exactly what you're paying for before we start.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 tw-mb-3 rounded-3 overflow-hidden" style="background: #f8f9fa;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" style="background: #f8f9fa;">
                                Do you offer ongoing support and maintenance?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Yes! We offer flexible maintenance packages starting from basic monitoring to full managed services. Most clients choose our monthly retainer for continuous improvements and priority support.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 rounded-3 overflow-hidden" style="background: #f8f9fa;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" style="background: #f8f9fa;">
                                What if I'm not sure what I need?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                That's completely fine! Our discovery calls are free and designed to help you clarify your needs. We'll ask the right questions, understand your business goals, and recommend the best approach - with no obligation.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== CTA Section ==================== -->
<section class="py-5" style="background: linear-gradient(135deg, #74b812 0%, #5a9a0a 100%);">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="text-white fw-bold tw-mb-3">Ready to transform your business?</h2>
                <p class="text-white tw-mb-4" style="opacity: 0.9;">Book a free 30-minute discovery call. No commitment, just clarity.</p>
                <a href="#contactForm" class="btn btn-lg text-dark fw-bold px-5 py-3" style="background: white; border-radius: 50px;">
                    Book Your Free Call <i class="ph-bold ph-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Custom Styles -->
<style>
    /* Service Checkbox Styling */
    .service-checkbox {
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .service-checkbox:hover {
        border-color: #74b812 !important;
        background: rgba(116, 184, 18, 0.05);
    }

    .service-checkbox input:checked + .checkbox-custom + span {
        color: #74b812;
    }

    .service-checkbox input:checked ~ .checkbox-custom,
    .service-checkbox:has(input:checked) {
        border-color: #74b812 !important;
        background: rgba(116, 184, 18, 0.1);
    }

    .checkbox-custom {
        width: 24px;
        height: 24px;
        border: 2px solid #e9ecef;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .service-checkbox input:checked + .checkbox-custom {
        background: #74b812;
        border-color: #74b812;
    }

    .service-checkbox input:checked + .checkbox-custom::after {
        content: '\2713';
        color: white;
        font-weight: bold;
        font-size: 14px;
    }

    /* Form Input Focus */
    .form-control:focus,
    .form-select:focus {
        border-color: #74b812 !important;
        box-shadow: 0 0 0 3px rgba(116, 184, 18, 0.15) !important;
    }

    /* Budget Slider */
    #budgetSlider {
        -webkit-appearance: none;
        height: 8px;
        border-radius: 4px;
        background: #e9ecef;
    }

    #budgetSlider::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: linear-gradient(135deg, #74b812 0%, #5a9a0a 100%);
        cursor: pointer;
        border: 3px solid white;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    #budgetSlider::-moz-range-thumb {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: linear-gradient(135deg, #74b812 0%, #5a9a0a 100%);
        cursor: pointer;
        border: 3px solid white;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    /* Submit Button Hover */
    .contact-form button[type="submit"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(116, 184, 18, 0.4);
    }

    /* Accordion Styling */
    .accordion-button:not(.collapsed) {
        color: #74b812;
        background: #f8f9fa;
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: transparent;
    }

    .accordion-button::after {
        background-size: 16px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .contact-hero h1 {
            font-size: 2rem !important;
        }
    }
</style>

<!-- Budget Slider Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('budgetSlider');
        const budgetValue = document.getElementById('budgetValue');

        if (slider && budgetValue) {
            slider.addEventListener('input', function() {
                const value = parseInt(this.value);
                if (value >= 150000) {
                    budgetValue.textContent = '$150,000+';
                } else {
                    budgetValue.textContent = '$' + value.toLocaleString();
                }
            });
        }

        // Service checkbox visual feedback
        document.querySelectorAll('.service-checkbox').forEach(label => {
            const checkbox = label.querySelector('input[type="checkbox"]');
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    label.style.borderColor = '#74b812';
                    label.style.background = 'rgba(116, 184, 18, 0.1)';
                } else {
                    label.style.borderColor = '#e9ecef';
                    label.style.background = 'transparent';
                }
            });
        });
    });
</script>

@endsection
