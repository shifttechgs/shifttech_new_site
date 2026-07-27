<header class="nav" id="nav">
    <div class="container nav-inner">
        <a class="nav-logo" href="{{ url('/') }}" aria-label="ShiftTech — home">
            <img class="logo-on-light" src="{{ asset('assets/images/logo/shifttech.png') }}" alt="ShiftTech" width="322" height="80">
            <img class="logo-on-dark" src="{{ asset('assets/images/logo/shifttech-white.png') }}" alt="ShiftTech" aria-hidden="true" width="780" height="186">
        </a>

        <nav aria-label="Primary">
            <ul class="nav-links">
                <li><a href="{{ url('/services/ai') }}">AI</a></li>
                <li><a href="{{ url('/services/web-design') }}">Design</a></li>
                <li><a href="{{ url('/services/web-application-development') }}">Engineering</a></li>
                <li><a href="{{ url('/work') }}">Work</a></li>
                <li><a href="{{ url('/blog') }}">Blog</a></li>
                <li><a href="{{ url('/agency') }}">About</a></li>
            </ul>
        </nav>

        <div class="nav-right">
            <a class="btn btn-primary btn-sm" href="{{ url('/contact') }}">Book a Discovery Call</a>
            <button class="menu-toggle" id="menuToggle" aria-expanded="false" aria-controls="mobilePanel" aria-label="Open menu">&#9776;</button>
        </div>
    </div>

    <div class="mobile-panel" id="mobilePanel">
        <a href="{{ url('/services/ai') }}">AI</a>
        <a href="{{ url('/services/web-design') }}">Design</a>
        <a href="{{ url('/services/web-application-development') }}">Engineering</a>
        <a href="{{ url('/work') }}">Work</a>
        <a href="{{ url('/blog') }}">Blog</a>
        <a href="{{ url('/agency') }}">About</a>
    </div>
</header>
