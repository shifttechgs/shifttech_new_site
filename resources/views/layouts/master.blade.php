<!DOCTYPE html>
<html lang="en" class="home-one">

<head>
    <!-- Basic Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary SEO -->
    <title>ShiftTech | Custom Software Development & Digital Transformation Partner</title>
    <meta name="description" content="ShiftTech helps SMEs, enterprises, and startups design and build secure, scalable software — from MVPs to full digital transformation.">
    <meta name="keywords" content="custom software development, digital transformation, MVP development, enterprise software, startup software, web and mobile app development, Africa software company">
    <meta name="robots" content="index, follow">

    <!-- Canonical -->
    <link rel="canonical" href="https://www.shifttechgs.com/">

    <!-- Open Graph (Facebook, LinkedIn) -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="ShiftTech | Custom Software Development & Digital Transformation">
    <meta property="og:description" content="We help SMEs, enterprises, and startups build secure, scalable software from MVPs to enterprise-grade platforms.">
    <meta property="og:url" content="https://www.shifttechgs.com/">
    <meta property="og:image" content="https://www.shifttechgs.com/assets/images/og/shifttech-og.png">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="ShiftTech | Software Development & Digital Transformation">
    <meta name="twitter:description" content="Building secure, scalable software solutions for startups, SMEs, and enterprises.">
    <meta name="twitter:image" content="https://www.shifttechgs.com/assets/images/og/shifttech-og.png">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/images/logo/favicon.png">

    <!-- Performance Optimizations -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/aos.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/satoshi.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>


<!--==================== Overlay Start ====================-->
<div class="overlay"></div>
<!--==================== Overlay End ====================-->

<!--==================== Sidebar Overlay End ====================-->
<div class="side-overlay"></div>
<!--==================== Sidebar Overlay End ====================-->

<!-- Custom Toast Message start -->
<div id="toast-container"></div>
<!-- Custom Toast Message End -->

<!-- ==================== Scroll to Top End Here ==================== -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<!-- ==================== Scroll to Top End Here ==================== -->

<!-- Custom Cursor Start -->
<div class="cursor"></div>
<span class="dot"></span>
<!-- Custom Cursor End -->



@include("partials.header")

<div id="smooth-wrapper">
    <div id="smooth-content">
        @yield('content')
        @include("partials.footer")
    </div>
</div>

<!-- Jquery js -->
<script src="assets/js/jquery-3.7.1.min.js"></script>
<!-- phosphor Js -->
<script src="assets/js/phosphor-icon.js"></script>
<!-- Bootstrap Bundle Js -->
<script src="assets/js/boostrap.bundle.min.js"></script>

<!-- GSAP js -->
<script src="assets/js/gsap.min.js"></script>
<!-- Scroll Trigger -->
<script src="assets/js/ScrollTrigger.min.js"></script>
<!-- ScrollSmoother -->
<script src="assets/js/ScrollSmoother.min.js"></script>
<!-- SplitText -->
<script src="assets/js/SplitText.min.js"></script>
<!-- custom GSAP -->
<script src="assets/js/custom-gsap.js"></script>

<!-- aos Js -->
<script src="assets/js/aos.js"></script>
<!-- counter up Js -->
<script src="assets/js/counterup.min.js"></script>
<!-- swiper Js -->
<script src="assets/js/swiper-bundle.min.js"></script>
<!-- Marquee js -->
<script src="assets/js/jquery.marquee.min.js"></script>
<!-- magnific js -->
<script src="assets/js/magnific-popup.min.js"></script>

<!-- main js -->
<script src="assets/js/main.js"></script>


</body>

</html>
