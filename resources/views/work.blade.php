@extends("layouts.master")
@section("content")

    <!-- ==================== Contact Hero Section ==================== -->
    <section class="contact-hero position-relative overflow-hidden" style="background: linear-gradient(135deg, #123d33 0%, #123d33 0%); padding: 100px 0 60px;">
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
                        Real Impact, Real Results
                    </h1>
                    <p class="text-white tw-text-lg" style="opacity: 0.8; max-width: 600px; margin: 0 auto;">
                        See how we help businesses turn ideas
                        into scalable digital products.
                        </p>
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
