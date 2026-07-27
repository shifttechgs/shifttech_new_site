<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <img src="{{ asset('assets/images/logo/shifttech.png') }}" alt="ShiftTech" width="322" height="80">
                <p>A founder-led software engineering studio. Web platforms, mobile apps and operations systems for growing businesses, since 2025.</p>
            </div>

            <div>
                <h4>Studio</h4>
                <ul>
                    <li><a href="{{ url('/work') }}">Work</a></li>
                    <li><a href="{{ url('/blog') }}">Blog</a></li>
                    <li><a href="{{ url('/agency') }}">About</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                    <li><a href="https://www.linkedin.com/company/shifttech-global-solutions/" target="_blank" rel="noopener noreferrer">LinkedIn</a></li>
                </ul>
            </div>

            <div>
                <h4>Services</h4>
                <ul>
                    <li><a href="{{ url('/services/ai') }}">AI</a></li>
                    <li><a href="{{ url('/services/web-design') }}">Design</a></li>
                    <li><a href="{{ url('/services/web-application-development') }}">Engineering</a></li>
                </ul>
            </div>

            <div>
                <h4>Contact</h4>
                <address>
                    <a href="mailto:sales@shifttechgs.com">sales@shifttechgs.com</a>
                    <a href="tel:+27814303023">+27 81 430 3023</a>
                    <span>Cape Town, South Africa</span>
                    <span>Harare, Zimbabwe</span>
                </address>
            </div>
        </div>

        <div class="footer-bottom">
            <span>&copy; <span id="year">{{ date('Y') }}</span> ShiftTech. Built carefully.</span>
            <span class="footer-sign">designed &amp; engineered by the founder</span>
        </div>
    </div>
</footer>
