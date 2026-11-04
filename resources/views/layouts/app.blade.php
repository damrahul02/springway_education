<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Springway Education – Your Global Journey Begins Here')</title>
    <meta name="description" content="@yield('meta_description', 'Springway Education – Premier study abroad consultancy in Sylhet, Bangladesh. Expert guidance for UK, Canada, Australia, USA, Malaysia & Europe.')">
    <link rel="icon" href="/images/logo.jpg" type="image/jpeg">

    <!-- Google Fonts & Font Awesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --navy:       #0d2b8e;
            --navy-dark:  #071342;
            --blue:       #1a73e8;
            --sky:        #00aaff;
            --sky-light:  #e8f4ff;
            --white:      #ffffff;
            --gray-light: #f4f7fc;
            --gray:       #64748b;
            --dark:       #0a0f1e;
            --gradient:   linear-gradient(135deg, #0d2b8e 0%, #1a73e8 50%, #00aaff 100%);
            --gradient-rev: linear-gradient(135deg, #00aaff 0%, #1a73e8 50%, #0d2b8e 100%);
            --shadow-sm:  0 4px 16px rgba(13,43,142,.08);
            --shadow-md:  0 8px 32px rgba(13,43,142,.14);
            --shadow-lg:  0 20px 60px rgba(13,43,142,.2);
            --radius:     16px;
            --radius-sm:  10px;
            --transition: all .35s cubic-bezier(.4,0,.2,1);
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--white);
            color: var(--dark);
            overflow-x: hidden;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main { flex: 1; }
        img { max-width: 100%; display: block; }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }

        /* ===== TOP BAR ===== */
        .topbar {
            background: var(--navy-dark);
            color: rgba(255,255,255,.85);
            font-size: .8rem;
            padding: 9px 0;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .topbar-inner {
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }
        .topbar-left { display: flex; gap: 20px; align-items: center; }
        .topbar-left a { display: flex; align-items: center; gap: 7px; color: rgba(255,255,255,.8); transition: var(--transition); }
        .topbar-left a:hover { color: var(--sky); }
        .topbar-right { display: flex; gap: 10px; align-items: center; }
        .topbar-social {
            width: 28px; height: 28px; border-radius: 50%;
            background: rgba(255,255,255,.1);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: .75rem;
            transition: var(--transition);
        }
        .topbar-social:hover { background: var(--sky); transform: scale(1.12); }

        /* ===== NAVBAR ===== */
        header#navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: var(--white);
            box-shadow: 0 2px 20px rgba(13,43,142,.08);
            transition: var(--transition);
        }
        header#navbar.scrolled { box-shadow: 0 4px 30px rgba(13,43,142,.15); }
        nav {
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 76px;
            position: relative;
        }
        .nav-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .nav-logo img {
            width: 50px;
            height: 50px;
            object-fit: contain;
            border-radius: 8px;
        }
        .nav-logo-text .brand { font-family: 'Poppins', sans-serif; font-size: 1.35rem; font-weight: 800; line-height: 1.1; }
        .nav-logo-text .brand .spring { color: var(--navy); }
        .nav-logo-text .brand .way   { color: var(--sky); }
        .nav-logo-text .tagline { font-size: .65rem; color: var(--gray); letter-spacing: .5px; text-transform: uppercase; }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2px;
        }
        .nav-links a {
            padding: 7px 11px;
            font-size: .84rem;
            font-weight: 600;
            color: var(--navy);
            border-radius: var(--radius-sm);
            transition: var(--transition);
            position: relative;
            white-space: nowrap;
        }
        .nav-links a::after {
            content:''; position: absolute; bottom: 3px; left: 50%; transform: translateX(-50%);
            width: 0; height: 2px; background: var(--gradient); border-radius: 2px;
            transition: var(--transition);
        }
        .nav-links a:hover::after,
        .nav-links a.active::after { width: 60%; }
        .nav-links a:hover,
        .nav-links a.active { color: var(--blue); background: var(--sky-light); }

        .nav-cta {
            background: var(--gradient);
            color: #fff !important;
            padding: 10px 22px !important;
            border-radius: 50px !important;
            font-size: .88rem;
            font-weight: 700;
            box-shadow: 0 4px 16px rgba(26,115,232,.35);
            transition: var(--transition) !important;
            margin-left: 8px;
        }
        .nav-cta::after { display: none !important; }
        .nav-cta:hover { transform: translateY(-2px) !important; box-shadow: 0 8px 24px rgba(26,115,232,.45) !important; background: var(--gradient-rev) !important; }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            background: rgba(13, 43, 142, 0.05);
            transition: var(--transition);
        }
        .hamburger:hover { background: var(--sky-light); }
        .hamburger span { width: 24px; height: 2.5px; background: var(--navy); border-radius: 2px; transition: var(--transition); }
        .hamburger.open span:nth-child(1) { transform: translateY(7.5px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; }
        .hamburger.open span:nth-child(3) { transform: translateY(-7.5px) rotate(-45deg); }

        /* ===== COMMON PAGE HERO ===== */
        .page-hero {
            position: relative;
            background: linear-gradient(135deg, #071342 0%, #0d2b8e 45%, #1a73e8 85%, #00aaff 100%);
            color: #ffffff;
            padding: 80px 24px 60px;
            overflow: hidden;
            text-align: center;
        }
        .page-hero-grid {
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.05) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
        }
        .page-hero-content {
            position: relative;
            z-index: 2;
            max-width: 820px;
            margin: 0 auto;
        }
        .page-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,.14);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,.25);
            color: #fff;
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .6px;
            text-transform: uppercase;
            padding: 7px 18px;
            border-radius: 50px;
            margin-bottom: 20px;
        }
        .page-hero-title {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(2.2rem, 5vw, 3.4rem);
            font-weight: 900;
            color: #fff;
            line-height: 1.18;
            margin-bottom: 16px;
        }
        .page-hero-title .accent {
            background: linear-gradient(90deg, #7dd3fc 0%, #ffffff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .page-hero-sub {
            font-size: 1.05rem;
            color: rgba(255,255,255,.8);
            line-height: 1.7;
            max-width: 680px;
            margin: 0 auto;
        }
        .breadcrumb-trail {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 24px;
            font-size: .82rem;
            color: rgba(255,255,255,.65);
        }
        .breadcrumb-trail a { color: #fff; }
        .breadcrumb-trail a:hover { color: var(--sky); }

        /* Common Container & Section Layouts */
        .container { max-width: 1320px; margin: 0 auto; padding: 0 24px; }
        section:not(.hero):not(.page-hero) { padding: 90px 0; }
        .section-header { text-align: center; margin-bottom: 56px; }
        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--sky-light);
            color: var(--blue);
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .6px;
            text-transform: uppercase;
            padding: 7px 18px;
            border-radius: 50px;
            margin-bottom: 16px;
        }
        .section-title {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(1.9rem, 3.5vw, 2.7rem);
            font-weight: 800;
            color: var(--navy);
            line-height: 1.22;
            margin-bottom: 16px;
        }
        .section-title .accent { color: var(--sky); }
        .section-desc { font-size: 1rem; color: var(--gray); max-width: 620px; margin: 0 auto; line-height: 1.75; }

        /* ===== FOOTER ===== */
        footer {
            background: #060e2a;
            padding: 76px 0 0;
            color: #ffffff;
            margin-top: auto;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1.1fr 1.1fr 1.3fr;
            gap: 48px;
            padding-bottom: 60px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .footer-brand .footer-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }
        .footer-brand .footer-logo img {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background: #fff;
            padding: 6px;
        }
        .footer-brand .name { font-family: 'Poppins', sans-serif; font-size: 1.35rem; font-weight: 800; }
        .footer-brand .name .s { color: #fff; }
        .footer-brand .name .w { color: var(--sky); }
        .footer-brand .sub { font-size: .65rem; color: rgba(255,255,255,.45); text-transform: uppercase; letter-spacing: .5px; }
        .footer-brand p {
            color: rgba(255,255,255,.6);
            font-size: .88rem;
            line-height: 1.8;
            margin-bottom: 24px;
        }
        .footer-socials { display: flex; gap: 10px; }
        .fsoc {
            width: 38px; height: 38px; border-radius: 50%;
            background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.1);
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,.7); font-size: .85rem;
            transition: var(--transition);
        }
        .fsoc:hover { background: var(--gradient); color: #fff; border-color: transparent; transform: translateY(-3px); }

        .footer-col h4 {
            font-family: 'Poppins', sans-serif;
            font-size: .98rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 22px;
            position: relative;
            padding-bottom: 10px;
        }
        .footer-col h4::after {
            content: '';
            position: absolute;
            left: 0; bottom: 0;
            width: 30px; height: 2px;
            background: var(--sky);
        }
        .footer-col ul li { margin-bottom: 11px; }
        .footer-col ul li a {
            color: rgba(255,255,255,.6);
            font-size: .88rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .footer-col ul li a:hover { color: var(--sky); padding-left: 5px; }
        .footer-col ul li a i { font-size: .65rem; color: var(--sky); }

        .footer-contact-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 14px;
            color: rgba(255,255,255,.65);
            font-size: .86rem;
            line-height: 1.6;
        }
        .footer-contact-item i { color: var(--sky); margin-top: 4px; }
        .footer-contact-item a { color: rgba(255,255,255,.75); transition: var(--transition); }
        .footer-contact-item a:hover { color: var(--sky); }

        .footer-bottom {
            padding: 24px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }
        .footer-bottom p { color: rgba(255,255,255,.45); font-size: .82rem; }
        .footer-bottom a { color: var(--sky); }
        .footer-bottom a:hover { text-decoration: underline; }

        /* ===== FLOATING BUTTONS ===== */
        .wa-float {
            position: fixed; bottom: 28px; right: 28px; z-index: 500;
            width: 58px; height: 58px; border-radius: 50%;
            background: #25D366; color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.7rem; box-shadow: 0 6px 24px rgba(37,211,102,.45);
            transition: var(--transition);
        }
        .wa-float:hover { transform: scale(1.12); box-shadow: 0 10px 32px rgba(37,211,102,.6); }

        .scroll-top {
            position: fixed; bottom: 28px; left: 28px; z-index: 500;
            width: 46px; height: 46px; border-radius: 50%;
            background: var(--gradient); color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; box-shadow: var(--shadow-sm);
            transition: var(--transition); opacity: 0; pointer-events: none;
            cursor: pointer; border: none;
        }
        .scroll-top.visible { opacity: 1; pointer-events: all; }
        .scroll-top:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }

        /* ===== MOBILE RESPONSIVE NAVIGATION ===== */
        @media (max-width: 1200px) {
            .nav-links a { padding: 6px 8px; font-size: .8rem; }
            .nav-cta { padding: 8px 14px !important; font-size: .8rem !important; }
        }
        @media (max-width: 992px) {
            .hamburger { display: flex; }
            .nav-links {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                width: 100%;
                background: #ffffff;
                border-top: 1px solid #edf2f7;
                box-shadow: 0 20px 40px rgba(13, 43, 142, 0.16);
                display: flex;
                flex-direction: column;
                padding: 16px 20px 24px;
                gap: 6px;
                opacity: 0;
                visibility: hidden;
                pointer-events: none;
                transform: translateY(-8px);
                transition: opacity .25s ease, transform .25s ease, visibility .25s ease;
                z-index: 1000;
                max-height: 80vh;
                overflow-y: auto;
            }
            .nav-links.open {
                opacity: 1;
                visibility: visible;
                pointer-events: all;
                transform: translateY(0);
            }
            .nav-links li { width: 100%; }
            .nav-links li a {
                display: flex;
                align-items: center;
                padding: 12px 16px;
                font-size: .95rem;
                font-weight: 600;
                color: var(--navy);
                border-radius: 10px;
                width: 100%;
            }
            .nav-links li a::after { display: none; }
            .nav-links li a:hover,
            .nav-links li a.active {
                background: var(--sky-light);
                color: var(--blue);
            }
            .nav-links .nav-cta {
                display: flex !important;
                align-items: center;
                justify-content: center;
                text-align: center;
                padding: 13px !important;
                font-size: .95rem !important;
                border-radius: 50px !important;
                margin-top: 8px;
                width: 100%;
            }
            .topbar-addr { display: none !important; }
        }

        @media (max-width: 768px) {
            section:not(.hero):not(.page-hero) { padding: 60px 0; }
            .container { padding: 0 16px; }
            .footer-grid { grid-template-columns: 1fr; gap: 32px; }
            .footer-bottom { flex-direction: column; text-align: center; gap: 8px; }
            .topbar-inner { padding: 0 16px; }
            .topbar-left { gap: 12px; font-size: .75rem; }
            .wa-float { width: 50px; height: 50px; font-size: 1.5rem; right: 18px; bottom: 18px; }
            .scroll-top { width: 40px; height: 40px; font-size: .85rem; left: 18px; bottom: 18px; }
            .page-hero { padding: 60px 16px 45px; }
        }

        @yield('styles')
    </style>
    @stack('styles')
</head>
<body>

<!-- ===== TOP BAR ===== -->
<div class="topbar">
    <div class="topbar-inner">
        <div class="topbar-left">
            <a href="mailto:info@springwaybd.com">
                <i class="fas fa-envelope"></i> <span>info@springwaybd.com</span>
            </a>
            <a href="tel:+8801341558822">
                <i class="fas fa-phone"></i> <span>+880 1341 55 88 22</span>
            </a>
            <a href="{{ route('contact') }}" class="topbar-addr">
                <i class="fas fa-map-marker-alt"></i> <span>Kaniz Plaza (3rd Fl), Zindabazar, Sylhet</span>
            </a>
        </div>
        <div class="topbar-right">
            <a href="https://facebook.com" target="_blank" class="topbar-social" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://instagram.com" target="_blank" class="topbar-social" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="https://linkedin.com" target="_blank" class="topbar-social" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            <a href="https://youtube.com" target="_blank" class="topbar-social" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</div>

<!-- ===== NAVBAR ===== -->
<header id="navbar">
    <nav>
        <a href="{{ route('home') }}" class="nav-logo">
            <img src="/images/logo.jpg" alt="Springway Logo">
            <div class="nav-logo-text">
                <div class="brand"><span class="spring">SPRING</span><span class="way">WAY</span></div>
                <div class="tagline">Education</div>
            </div>
        </a>
        <ul class="nav-links" id="navLinks">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a></li>
            <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a></li>
            <li><a href="{{ route('destinations') }}" class="{{ request()->routeIs('destinations') ? 'active' : '' }}">Destinations</a></li>
            <li><a href="{{ route('study_in_bangladesh') }}" class="{{ request()->routeIs('study_in_bangladesh') ? 'active' : '' }}">Study in Bangladesh</a></li>
            <li><a href="{{ route('process') }}" class="{{ request()->routeIs('process') ? 'active' : '' }}">Process</a></li>
            <li><a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a></li>
            <li><a href="{{ route('news') }}" class="{{ request()->routeIs('news*') ? 'active' : '' }}">News</a></li>
            <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            <li><a href="{{ route('contact') }}" class="nav-cta"><i class="fas fa-paper-plane"></i> Free Consultation</a></li>
        </ul>
        <div class="hamburger" id="hamburger" aria-label="Toggle Navigation">
            <span></span><span></span><span></span>
        </div>
    </nav>
</header>

<main>
    @yield('content')
</main>

<!-- ===== FOOTER ===== -->
<footer>
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="footer-logo">
                    <img src="/images/logo.jpg" alt="Springway">
                    <div>
                        <div class="name"><span class="s">SPRING</span><span class="w">WAY</span></div>
                        <div class="sub">Education</div>
                    </div>
                </div>
                <p>Springway Education is a premier study-abroad consultancy headquartered in Sylhet, Bangladesh. Dedicated to transparent, ethical, and result-oriented guidance for ambitious scholars worldwide.</p>
                <div class="footer-socials">
                    <a href="https://facebook.com" target="_blank" class="fsoc" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com" target="_blank" class="fsoc" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://linkedin.com" target="_blank" class="fsoc" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://youtube.com" target="_blank" class="fsoc" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="https://wa.me/8801341558822" target="_blank" class="fsoc" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right"></i> Home</a></li>
                    <li><a href="{{ route('about') }}"><i class="fas fa-chevron-right"></i> About Us</a></li>
                    <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Our Services</a></li>
                    <li><a href="{{ route('destinations') }}"><i class="fas fa-chevron-right"></i> Destinations</a></li>
                    <li><a href="{{ route('study_in_bangladesh') }}"><i class="fas fa-chevron-right"></i> Study in Bangladesh (MBBS/BDS)</a></li>
                    <li><a href="{{ route('process') }}"><i class="fas fa-chevron-right"></i> 6-Step Process</a></li>
                    <li><a href="{{ route('gallery') }}"><i class="fas fa-chevron-right"></i> Photo & Video Gallery</a></li>
                    <li><a href="{{ route('news') }}"><i class="fas fa-chevron-right"></i> Latest News & Events</a></li>
                    <li><a href="{{ route('contact') }}"><i class="fas fa-chevron-right"></i> Contact Us</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Destinations</h4>
                <ul>
                    <li><a href="{{ route('destinations') }}"><i class="fas fa-chevron-right"></i> 🇬🇧 United Kingdom</a></li>
                    <li><a href="{{ route('destinations') }}"><i class="fas fa-chevron-right"></i> 🇨🇦 Canada</a></li>
                    <li><a href="{{ route('destinations') }}"><i class="fas fa-chevron-right"></i> 🇦🇺 Australia</a></li>
                    <li><a href="{{ route('destinations') }}"><i class="fas fa-chevron-right"></i> 🇺🇸 United States</a></li>
                    <li><a href="{{ route('destinations') }}"><i class="fas fa-chevron-right"></i> 🇲🇾 Malaysia</a></li>
                    <li><a href="{{ route('destinations') }}"><i class="fas fa-chevron-right"></i> 🇩🇪 Germany</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Head Office</h4>
                <div class="footer-contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>Kaniz Plaza (3rd Floor), Zindabazar, Sylhet-3100, Bangladesh</div>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-phone-alt"></i>
                    <div><a href="tel:+8801341558822">+880 1341 55 88 22</a></div>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-envelope"></i>
                    <div><a href="mailto:info@springwaybd.com">info@springwaybd.com</a></div>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-clock"></i>
                    <div>Sat – Thu: 10:00 AM – 6:30 PM</div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Springway Education. All Rights Reserved.</p>
            <p>Developed by <a href="https://pritomdam.site" target="_blank" rel="noopener noreferrer">Pritom Dam</a> for <a href="{{ route('home') }}">Springway Education</a></p>
        </div>
    </div>
</footer>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/8801341558822" target="_blank" class="wa-float" title="Chat on WhatsApp" aria-label="WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Scroll to Top Button -->
<button class="scroll-top" id="scrollTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Scroll to Top">
    <i class="fas fa-chevron-up"></i>
</button>

<script>
// Sticky Navbar & Scroll-to-Top
const navbar = document.getElementById('navbar');
const scrollTopBtn = document.getElementById('scrollTop');
window.addEventListener('scroll', () => {
    if (navbar) navbar.classList.toggle('scrolled', window.scrollY > 30);
    if (scrollTopBtn) scrollTopBtn.classList.toggle('visible', window.scrollY > 300);
});

// Mobile Navigation Dropdown
const hamburger = document.getElementById('hamburger');
const navLinks = document.getElementById('navLinks');

if (hamburger && navLinks) {
    hamburger.addEventListener('click', (e) => {
        e.stopPropagation();
        hamburger.classList.toggle('open');
        navLinks.classList.toggle('open');
    });

    navLinks.querySelectorAll('a').forEach(a => {
        a.addEventListener('click', () => {
            hamburger.classList.remove('open');
            navLinks.classList.remove('open');
        });
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('#navbar')) {
            hamburger.classList.remove('open');
            navLinks.classList.remove('open');
        }
    });
}
</script>

@yield('scripts')
</body>
</html>
