<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Springway Education – Your Global Journey Begins Here</title>
    <meta name="description" content="Springway Education – Premier study abroad consultancy in Sylhet, Bangladesh. Expert guidance for UK, Canada, Australia, USA, Malaysia & more.">
    <link rel="icon" href="/images/logo.jpg" type="image/jpeg">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ===== CSS Variables ===== */
        :root {
            --navy:       #0d2b8e;
            --navy-dark:  #091f6b;
            --blue:       #1a73e8;
            --sky:        #00aaff;
            --sky-light:  #e8f4ff;
            --white:      #ffffff;
            --gray-light: #f4f7fc;
            --gray:       #6b7280;
            --dark:       #0a0f1e;
            --gradient:   linear-gradient(135deg, #0d2b8e 0%, #1a73e8 50%, #00aaff 100%);
            --gradient-rev: linear-gradient(135deg, #00aaff 0%, #1a73e8 50%, #0d2b8e 100%);
            --shadow-sm:  0 4px 16px rgba(13,43,142,.12);
            --shadow-md:  0 8px 32px rgba(13,43,142,.18);
            --shadow-lg:  0 20px 60px rgba(13,43,142,.24);
            --radius:     16px;
            --radius-sm:  10px;
            --transition: all .35s cubic-bezier(.4,0,.2,1);
        }

        /* ===== Reset & Base ===== */
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', 'Poppins', sans-serif;
            background: var(--white);
            color: var(--dark);
            overflow-x: hidden;
            line-height: 1.6;
        }
        img { max-width:100%; display:block; }
        a  { text-decoration:none; color:inherit; }
        ul { list-style:none; }

        /* ===== LOADING SCREEN ===== */
        #loader {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: #04091f;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: opacity .8s cubic-bezier(.4,0,.2,1), visibility .8s ease;
        }
        #loader.hidden { opacity:0; visibility:hidden; pointer-events:none; }

        /* Loader BG grid lines */
        .loader-grid {
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(0,170,255,.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,170,255,.06) 1px, transparent 1px);
            background-size: 48px 48px;
            animation: gridDrift 6s linear infinite;
        }
        @keyframes gridDrift { to { background-position: 48px 48px; } }

        /* Glow orbs */
        .loader-orb {
            position:absolute; border-radius:50%;
            filter:blur(80px); pointer-events:none;
        }
        .loader-orb-1 { width:400px;height:400px;background:rgba(13,43,142,.6);top:-100px;left:-100px; animation:orbFloat 5s ease-in-out infinite; }
        .loader-orb-2 { width:300px;height:300px;background:rgba(0,170,255,.35);bottom:-80px;right:-80px; animation:orbFloat 7s ease-in-out infinite reverse; }
        .loader-orb-3 { width:200px;height:200px;background:rgba(26,115,232,.3);top:50%;left:50%;transform:translate(-50%,-50%); animation:orbFloat 4s ease-in-out infinite 1s; }
        @keyframes orbFloat { 0%,100%{transform:translate(0,0);} 50%{transform:translate(20px,-20px);} }
        .loader-orb-3 { animation: orbFloat3 4s ease-in-out infinite 1s; }
        @keyframes orbFloat3 { 0%,100%{transform:translate(-50%,-50%);} 50%{transform:translate(calc(-50% + 20px),calc(-50% - 20px));} }

        /* Logo ring system */
        .loader-logo-wrap {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 180px; height: 180px;
            margin-bottom: 10px;
            z-index: 2;
        }
        .loader-ring {
            position: absolute;
            border-radius: 50%;
            border: 1.5px solid transparent;
        }
        .loader-ring-1 {
            inset: 0;
            border-color: rgba(0,170,255,.5) rgba(0,170,255,.1) rgba(0,170,255,.1) rgba(0,170,255,.1);
            animation: spin1 2s linear infinite;
        }
        .loader-ring-2 {
            inset: 10px;
            border-color: rgba(26,115,232,.7) rgba(26,115,232,.15) rgba(26,115,232,.15) rgba(26,115,232,.15);
            animation: spin1 3s linear infinite reverse;
        }
        .loader-ring-3 {
            inset: 22px;
            border-color: rgba(255,255,255,.4) transparent transparent transparent;
            animation: spin1 1.5s linear infinite;
        }
        @keyframes spin1 { to { transform: rotate(360deg); } }

        .loader-logo-img {
            width: 110px; height: 110px;
            object-fit: contain;
            background: #fff;
            border-radius: 50%;
            padding: 14px;
            position: relative; z-index: 1;
            box-shadow: 0 0 40px rgba(0,170,255,.4), 0 0 80px rgba(13,43,142,.3);
            animation: logoBreathe 2.5s ease-in-out infinite;
        }
        @keyframes logoBreathe {
            0%,100% { box-shadow: 0 0 40px rgba(0,170,255,.4), 0 0 80px rgba(13,43,142,.3); transform: scale(1); }
            50%      { box-shadow: 0 0 60px rgba(0,170,255,.7), 0 0 120px rgba(0,170,255,.25); transform: scale(1.04); }
        }

        /* Loader text */
        .loader-brand {
            position: relative; z-index: 2;
            font-family: 'Poppins', sans-serif;
            font-size: 2rem;
            font-weight: 900;
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }
        .loader-brand .lb-s { color: #fff; }
        .loader-brand .lb-w {
            background: linear-gradient(90deg, #00aaff, #1a73e8);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .loader-sub {
            position: relative; z-index: 2;
            font-size: .72rem;
            color: rgba(255,255,255,.45);
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 32px;
        }

        /* Progress */
        .loader-progress-wrap {
            position: relative; z-index: 2;
            width: 260px;
        }
        .loader-progress-track {
            height: 3px;
            background: rgba(255,255,255,.08);
            border-radius: 99px;
            overflow: hidden;
            margin-bottom: 10px;
        }
        .loader-progress-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #0d2b8e, #1a73e8, #00aaff);
            border-radius: 99px;
            animation: fillProgress 2.6s cubic-bezier(.4,0,.2,1) forwards;
            position: relative;
        }
        .loader-progress-fill::after {
            content: '';
            position: absolute; right: 0; top: 50%;
            transform: translateY(-50%);
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #00aaff;
            box-shadow: 0 0 10px #00aaff;
        }
        @keyframes fillProgress { to { width: 100%; } }
        .loader-pct {
            font-size: .72rem;
            color: rgba(255,255,255,.4);
            letter-spacing: 1px;
            text-align: right;
        }

        /* Dots */
        .loader-dots {
            position: relative; z-index: 2;
            display: flex; gap: 8px; margin-top: 16px;
        }
        .loader-dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: rgba(255,255,255,.2);
            animation: dotPop .8s ease-in-out infinite;
        }
        .loader-dot:nth-child(2) { animation-delay: .15s; }
        .loader-dot:nth-child(3) { animation-delay: .3s; }
        @keyframes dotPop {
            0%,100%{ background:rgba(255,255,255,.2); transform:scale(1); }
            50%    { background:#00aaff; transform:scale(1.5); }
        }

        /* ===== TOP BAR ===== */
        .topbar {
            background: var(--navy-dark);
            color: rgba(255,255,255,.85);
            font-size: .8rem;
            padding: 8px 0;
        }
        .topbar-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }
        .topbar-left { display:flex; gap:20px; align-items:center; }
        .topbar-left a { display:flex; align-items:center; gap:6px; color:rgba(255,255,255,.8); transition:var(--transition); }
        .topbar-left a:hover { color:var(--sky); }
        .topbar-right { display:flex; gap:12px; align-items:center; }
        .topbar-social {
            width:28px; height:28px; border-radius:50%;
            background:rgba(255,255,255,.1);
            display:flex; align-items:center; justify-content:center;
            color:#fff; font-size:.75rem;
            transition:var(--transition);
        }
        .topbar-social:hover { background:var(--sky); transform:scale(1.15); }

        /* ===== NAVBAR ===== */
        header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: var(--white);
            box-shadow: 0 2px 20px rgba(13,43,142,.1);
            transition: var(--transition);
        }
        header.scrolled { box-shadow: 0 4px 30px rgba(13,43,142,.2); }
        nav {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 74px;
        }
        .nav-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .nav-logo img {
            width: 52px;
            height: 52px;
            object-fit: contain;
            border-radius: 8px;
        }
        .nav-logo-text .brand { font-family:'Poppins',sans-serif; font-size:1.4rem; font-weight:800; }
        .nav-logo-text .brand .spring { color:var(--navy); }
        .nav-logo-text .brand .way   { color:var(--sky); }
        .nav-logo-text .tagline { font-size:.65rem; color:var(--gray); letter-spacing:.5px; text-transform:uppercase; margin-top:-2px; }
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
        }
        .nav-links a::after {
            content:''; position:absolute; bottom:4px; left:50%; transform:translateX(-50%);
            width:0; height:2px; background:var(--gradient); border-radius:2px;
            transition:var(--transition);
        }
        .nav-links a:hover::after { width:60%; }
        .nav-links a:hover { color:var(--blue); background:var(--sky-light); }
        .nav-cta {
            background: var(--gradient);
            color: #fff !important;
            padding: 10px 22px !important;
            border-radius: 50px !important;
            font-size: .88rem;
            font-weight: 700;
            box-shadow: 0 4px 16px rgba(26,115,232,.35);
            transition: var(--transition) !important;
        }
        .nav-cta::after { display:none !important; }
        .nav-cta:hover { transform:translateY(-2px) !important; box-shadow:0 8px 24px rgba(26,115,232,.45) !important; background:var(--gradient-rev) !important; }
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
        .hamburger:hover {
            background: var(--sky-light);
        }
        .hamburger span { width:24px; height:2.5px; background:var(--navy); border-radius:2px; transition:var(--transition); }
        .hamburger.open span:nth-child(1) { transform:translateY(7.5px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity:0; }
        .hamburger.open span:nth-child(3) { transform:translateY(-7.5px) rotate(-45deg); }


        /* ===== HERO SLIDER ===== */
        .hero {
            position: relative;
            height: calc(100vh - 110px);
            min-height: 640px;
            overflow: hidden;
            padding: 0 !important;
            margin: 0 !important;
            background: #04091f;
        }

        /* Slider track */
        .slider-track {
            display: flex;
            height: 100%;
            width: 100%;
            transition: transform 1.1s cubic-bezier(.77,0,.18,1);
        }
        .slide {
            flex: 0 0 100%;
            width: 100%;
            min-width: 100%;
            max-width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
        }
        .slide-bg {
            position: absolute; inset: 0;
            background-size: cover;
            background-position: center;
            transform: scale(1.08);
            transition: transform 7s ease;
        }
        .slide.active .slide-bg { transform: scale(1); }
        /* Overlay */
        .slide-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(
                105deg,
                rgba(4,9,31,.88) 0%,
                rgba(13,43,142,.72) 40%,
                rgba(0,170,255,.18) 100%
            );
        }
        /* Each slide has a slightly different tint */
        .slide:nth-child(2) .slide-overlay { background: linear-gradient(105deg,rgba(4,9,31,.85) 0%,rgba(9,31,107,.7) 40%,rgba(26,115,232,.2) 100%); }
        .slide:nth-child(3) .slide-overlay { background: linear-gradient(105deg,rgba(4,9,31,.82) 0%,rgba(13,43,142,.65) 40%,rgba(0,170,255,.22) 100%); }
        .slide:nth-child(4) .slide-overlay { background: linear-gradient(105deg,rgba(4,9,31,.87) 0%,rgba(9,31,107,.72) 40%,rgba(0,140,255,.18) 100%); }

        /* Animated grid overlay */
        .slide-grid {
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(0,170,255,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,170,255,.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* Slide content */
        .slide-content {
            position: relative; z-index: 3;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            height: 100%;
            display: flex;
            align-items: center;
        }
        .slide-body {
            max-width: 720px;
        }
        .slide-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,.1);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,.22);
            color: #fff;
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .6px;
            text-transform: uppercase;
            padding: 8px 20px;
            border-radius: 50px;
            margin-bottom: 28px;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity .7s ease .2s, transform .7s ease .2s;
        }
        .slide.active .slide-badge { opacity:1; transform:translateY(0); }
        .slide-badge .dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: var(--sky);
            box-shadow: 0 0 8px var(--sky);
            animation: blink 1.4s ease-in-out infinite;
        }
        @keyframes blink { 0%,100%{opacity:1;} 50%{opacity:.25;} }

        .slide-title {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(2.4rem, 5.5vw, 4.2rem);
            font-weight: 900;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 22px;
            opacity: 0;
            transform: translateY(30px);
            transition: opacity .8s ease .35s, transform .8s ease .35s;
        }
        .slide.active .slide-title { opacity:1; transform:translateY(0); }
        .slide-title .highlight {
            display: inline-block;
            background: linear-gradient(90deg, #7dd3fc 0%, #00aaff 50%, #fff 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .slide-sub {
            font-size: 1.05rem;
            color: rgba(255,255,255,.78);
            max-width: 580px;
            line-height: 1.8;
            margin-bottom: 38px;
            opacity: 0;
            transform: translateY(30px);
            transition: opacity .8s ease .5s, transform .8s ease .5s;
        }
        .slide.active .slide-sub { opacity:1; transform:translateY(0); }

        .slide-ctas {
            display: flex; gap: 14px; flex-wrap: wrap;
            margin-bottom: 52px;
            opacity: 0;
            transform: translateY(30px);
            transition: opacity .8s ease .65s, transform .8s ease .65s;
        }
        .slide.active .slide-ctas { opacity:1; transform:translateY(0); }

        .btn-primary {
            background: #fff;
            color: var(--navy);
            font-weight: 800;
            font-size: .95rem;
            padding: 15px 34px;
            border-radius: 50px;
            box-shadow: 0 8px 28px rgba(0,0,0,.25);
            transition: var(--transition);
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-primary:hover { transform:translateY(-3px); box-shadow:0 16px 40px rgba(0,0,0,.32); background:var(--sky-light); }
        .btn-secondary {
            background: rgba(255,255,255,.12);
            backdrop-filter: blur(12px);
            color: #fff;
            font-weight: 700; font-size: .95rem;
            padding: 14px 30px;
            border-radius: 50px;
            border: 1.5px solid rgba(255,255,255,.35);
            transition: var(--transition);
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-secondary:hover { background:rgba(255,255,255,.22); transform:translateY(-3px); }

        /* Stats bar inside hero */
        .hero-stats-bar {
            display: flex; gap: 0;
            opacity: 0;
            transform: translateY(30px);
            transition: opacity .8s ease .8s, transform .8s ease .8s;
        }
        .slide.active .hero-stats-bar { opacity:1; transform:translateY(0); }
        .stat {
            padding: 0 32px 0 0;
            margin-right: 32px;
            border-right: 1px solid rgba(255,255,255,.18);
        }
        .stat:last-child { border-right:none; }
        .stat-num {
            font-family: 'Poppins', sans-serif;
            font-size: 2rem; font-weight: 900;
            color: #fff; line-height: 1;
        }
        .stat-num .accent { color: #7dd3fc; }
        .stat-label { font-size: .73rem; color: rgba(255,255,255,.55); margin-top: 5px; letter-spacing: .3px; }

        /* Slider right visual panel */
        .slide-right-panel {
            position: absolute;
            right: 40px; top: 50%;
            transform: translateY(-50%);
            z-index: 4;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .mini-card {
            background: rgba(255,255,255,.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: var(--radius);
            padding: 16px 20px;
            display: flex; align-items: center; gap: 14px;
            min-width: 220px;
            opacity: 0;
            transform: translateX(40px);
            transition: opacity .7s ease, transform .7s ease;
        }
        .slide.active .mini-card:nth-child(1) { opacity:1; transform:translateX(0); transition-delay: .5s; }
        .slide.active .mini-card:nth-child(2) { opacity:1; transform:translateX(0); transition-delay: .65s; }
        .slide.active .mini-card:nth-child(3) { opacity:1; transform:translateX(0); transition-delay: .8s; }
        .mini-card-icon {
            width: 42px; height: 42px; border-radius: 50%;
            background: var(--gradient);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 1.1rem; flex-shrink: 0;
        }
        .mini-card-text .mc-label { font-size: .68rem; color: rgba(255,255,255,.55); letter-spacing: .3px; }
        .mini-card-text .mc-value { font-weight: 700; color: #fff; font-size: .92rem; margin-top: 2px; }

        /* Slider Navigation */
        .slider-nav {
            position: absolute;
            bottom: 36px; left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .slider-dots {
            display: flex; gap: 8px;
        }
        .slider-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: rgba(255,255,255,.35);
            border: none; cursor: pointer;
            transition: var(--transition); padding:0;
        }
        .slider-dot.active {
            width: 28px; border-radius: 4px;
            background: #fff;
        }
        .slider-arrow {
            width: 44px; height: 44px;
            border-radius: 50%;
            background: rgba(255,255,255,.12);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,.25);
            color: #fff; font-size: .9rem;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: var(--transition);
        }
        .slider-arrow:hover { background: rgba(255,255,255,.25); transform: scale(1.1); }

        /* Progress line */
        .slider-progress {
            position: absolute;
            top: 0; left: 0; right: 0; height: 3px;
            z-index: 10;
            background: rgba(255,255,255,.1);
        }
        .slider-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--sky), #fff);
            width: 0%;
            animation: slideProgress 6s linear;
        }
        @keyframes slideProgress { from{width:0%} to{width:100%} }

        /* Slide counter */
        .slide-counter {
            position: absolute;
            top: 50%; right: 24px;
            transform: translateY(-50%);
            z-index: 10;
            display: flex;
            flex-direction: column;
            gap: 6px;
            align-items: center;
        }
        .slide-counter .current {
            font-family: 'Poppins',sans-serif;
            font-size: 2rem; font-weight: 900; color: #fff; line-height: 1;
        }
        .slide-counter .sep { width: 1px; height: 40px; background: rgba(255,255,255,.25); }
        .slide-counter .total { font-size: .85rem; color: rgba(255,255,255,.4); }

        /* Scroll indicator */
        .scroll-hint {
            position: absolute; bottom: 36px; left: 36px; z-index: 10;
            display: flex; align-items: center; gap: 10px;
            color: rgba(255,255,255,.5); font-size: .75rem; letter-spacing: 1px;
        }
        .scroll-hint-line { width: 40px; height: 1px; background: rgba(255,255,255,.3); }
        .scroll-hint-mouse {
            width: 20px; height: 32px;
            border: 1.5px solid rgba(255,255,255,.3);
            border-radius: 10px;
            display: flex; justify-content: center; padding-top: 5px;
        }
        .scroll-hint-mouse::before {
            content: '';
            width: 3px; height: 6px;
            background: rgba(255,255,255,.6);
            border-radius: 2px;
            animation: scrollDot 1.5s ease-in-out infinite;
        }
        @keyframes scrollDot { 0%,100%{opacity:1;transform:translateY(0);} 50%{opacity:0;transform:translateY(6px);} }
        .cb-flag { font-size:1.1rem; }

        /* ===== SECTION COMMONS ===== */
        section:not(.hero) { padding: 96px 24px; }
        .container { max-width:1280px; margin:0 auto; }
        .section-header { text-align:center; margin-bottom:60px; }
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
            font-size: clamp(1.9rem, 3.5vw, 2.8rem);
            font-weight: 800;
            color: var(--navy);
            line-height: 1.2;
            margin-bottom: 16px;
        }
        .section-title .accent { color:var(--sky); }
        .section-desc { font-size:1rem; color:var(--gray); max-width:600px; margin:0 auto; line-height:1.75; }

        /* ===== TRUST STRIP ===== */
        .trust-strip {
            padding: 0;
            background: var(--gray-light);
            border-top: 1px solid #e5e9f0;
            border-bottom: 1px solid #e5e9f0;
        }
        .trust-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 22px 24px;
            display: flex;
            justify-content: center;
            gap: 48px;
            flex-wrap: wrap;
            align-items: center;
        }
        .trust-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: .88rem;
            font-weight: 600;
            color: var(--navy);
        }
        .trust-item i { color:var(--blue); font-size:1.1rem; }

        /* ===== SERVICES ===== */
        .services { background:var(--white); }
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 28px;
        }
        .service-card {
            background: var(--white);
            border: 1.5px solid #e8edf8;
            border-radius: var(--radius);
            padding: 36px 30px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            cursor: default;
        }
        .service-card::before {
            content:'';
            position:absolute; top:0; left:0; right:0; height:3px;
            background: var(--gradient);
            transform:scaleX(0); transform-origin:left;
            transition: var(--transition);
        }
        .service-card:hover { transform:translateY(-8px); box-shadow:var(--shadow-md); border-color:transparent; }
        .service-card:hover::before { transform:scaleX(1); }
        .service-icon {
            width: 62px; height: 62px;
            border-radius: var(--radius-sm);
            background: var(--sky-light);
            display: flex; align-items:center; justify-content:center;
            font-size: 1.6rem;
            color: var(--blue);
            margin-bottom: 22px;
            transition: var(--transition);
        }
        .service-card:hover .service-icon { background:var(--gradient); color:#fff; transform:scale(1.1); }
        .service-card h3 { font-family:'Poppins',sans-serif; font-size:1.1rem; font-weight:700; color:var(--navy); margin-bottom:10px; }
        .service-card p  { font-size:.9rem; color:var(--gray); line-height:1.7; }
        .service-link {
            display:inline-flex; align-items:center; gap:6px;
            margin-top:18px; color:var(--blue); font-size:.85rem; font-weight:600;
            transition:var(--transition);
        }
        .service-link:hover { gap:10px; }

        /* ===== DESTINATIONS ===== */
        .destinations { background:var(--gray-light); }
        .destinations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 22px;
        }
        .dest-card {
            background: var(--white);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            cursor: pointer;
        }
        .dest-card:hover { transform:translateY(-8px); box-shadow:var(--shadow-md); }
        .dest-banner {
            height: 130px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            position: relative;
            overflow: hidden;
        }
        .dest-banner::after {
            content:''; position:absolute; inset:0;
            background:inherit; opacity:.15;
        }
        .dest-body { padding:20px; }
        .dest-country { font-family:'Poppins',sans-serif; font-size:1.05rem; font-weight:700; color:var(--navy); margin-bottom:4px; }
        .dest-detail { font-size:.82rem; color:var(--gray); }
        .dest-badge {
            display:inline-block; margin-top:10px;
            background:var(--sky-light); color:var(--blue);
            font-size:.72rem; font-weight:700;
            padding:4px 12px; border-radius:50px;
        }

        /* ===== WHY US ===== */
        .whyus { background: var(--white); }
        .whyus-inner {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }
        .whyus-visual { position:relative; }
        .whyus-img-wrap {
            position: relative;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }
        .whyus-img-wrap img {
            width: 100%;
            height: 440px;
            object-fit: cover;
            object-position: top;
        }
        .whyus-badge-card {
            position:absolute; bottom:-20px; right:-20px;
            background:#fff; border-radius:var(--radius);
            padding:18px 22px; box-shadow:var(--shadow-md);
            display:flex; align-items:center; gap:14px;
        }
        .whyus-badge-icon { font-size:2rem; }
        .whyus-badge-text .num { font-family:'Poppins',sans-serif; font-size:1.5rem; font-weight:900; color:var(--navy); }
        .whyus-badge-text .lbl { font-size:.72rem; color:var(--gray); }
        .whyus-exp-card {
            position:absolute; top:-20px; left:-20px;
            background: var(--gradient);
            border-radius: var(--radius);
            padding:16px 22px; color:#fff;
            box-shadow: var(--shadow-md);
        }
        .whyus-exp-card .big { font-family:'Poppins',sans-serif; font-size:2rem; font-weight:900; }
        .whyus-exp-card .lbl { font-size:.72rem; opacity:.85; }

        .whyus-content {}
        .reasons { display:flex; flex-direction:column; gap:20px; margin-top:36px; }
        .reason {
            display: flex;
            gap: 16px;
            align-items: flex-start;
            padding: 20px;
            border-radius: var(--radius-sm);
            transition: var(--transition);
        }
        .reason:hover { background:var(--sky-light); }
        .reason-icon {
            flex-shrink:0; width:46px; height:46px;
            border-radius: 50%;
            background: var(--gradient);
            display:flex; align-items:center; justify-content:center;
            color:#fff; font-size:1.1rem;
        }
        .reason-body h4 { font-weight:700; color:var(--navy); margin-bottom:4px; }
        .reason-body p  { font-size:.88rem; color:var(--gray); line-height:1.65; }

        /* ===== PROCESS ===== */
        .process { background: linear-gradient(135deg, #0d2b8e 0%, #1a73e8 100%); }
        .process .section-title { color:#fff; }
        .process .section-tag { background:rgba(255,255,255,.15); color:#fff; }
        .process .section-desc { color:rgba(255,255,255,.75); }
        .process-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 0;
            position: relative;
        }
        .process-steps::before {
            content:''; position:absolute;
            top:44px; left:10%; right:10%; height:2px;
            background:rgba(255,255,255,.2);
        }
        .step {
            text-align:center;
            padding: 0 20px;
            position: relative;
        }
        .step-num {
            width: 88px; height: 88px;
            border-radius: 50%;
            background: rgba(255,255,255,.15);
            backdrop-filter:blur(10px);
            border: 2px solid rgba(255,255,255,.3);
            display: flex; align-items:center; justify-content:center;
            font-family:'Poppins',sans-serif; font-size:1.8rem; font-weight:900;
            color:#fff; margin:0 auto 24px;
            position:relative; z-index:1;
            transition:var(--transition);
        }
        .step:hover .step-num { background:var(--sky); border-color:var(--sky); transform:scale(1.1); }
        .step h4 { font-family:'Poppins',sans-serif; font-weight:700; color:#fff; margin-bottom:8px; }
        .step p  { font-size:.85rem; color:rgba(255,255,255,.7); line-height:1.65; }

        /* ===== CEO SECTION ===== */
        .ceo-section { background:var(--gray-light); }
        .ceo-inner {
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 72px;
            align-items: center;
        }
        .ceo-img-wrap {
            position: relative;
        }
        .ceo-img-frame {
            position: relative;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }
        .ceo-img-frame img {
            width: 100%;
            height: 480px;
            object-fit: cover;
            object-position: top center;
        }
        .ceo-img-frame::before {
            content:''; position:absolute; inset:0;
            background: linear-gradient(to top, rgba(13,43,142,.55) 0%, transparent 50%);
        }
        .ceo-name-overlay {
            position:absolute; bottom:20px; left:20px; right:20px;
            background:rgba(255,255,255,.12); backdrop-filter:blur(12px);
            border:1px solid rgba(255,255,255,.25); border-radius:var(--radius-sm);
            padding:14px 18px; color:#fff;
        }
        .ceo-name-overlay .name { font-family:'Poppins',sans-serif; font-weight:800; font-size:1.1rem; }
        .ceo-name-overlay .role { font-size:.78rem; opacity:.8; letter-spacing:.3px; }
        .ceo-deco {
            position:absolute;
            width:100px; height:100px;
            background:var(--gradient);
            border-radius:50%;
            top:-18px; right:-18px;
            z-index:-1;
            opacity:.6;
        }
        .ceo-content {}
        .quote-mark { font-size:5rem; line-height:.8; color:var(--sky); font-family:Georgia,serif; margin-bottom:8px; opacity:.4; }
        .ceo-quote {
            font-family:'Poppins',sans-serif;
            font-size:1.25rem; font-weight:600;
            color:var(--navy); line-height:1.65;
            margin-bottom:24px;
            font-style:italic;
        }
        .ceo-bio { font-size:.95rem; color:var(--gray); line-height:1.8; margin-bottom:28px; }
        .ceo-signature {
            font-family:'Poppins',sans-serif;
            font-size:1.5rem; font-weight:700;
            background:var(--gradient);
            -webkit-background-clip:text; -webkit-text-fill-color:transparent;
            background-clip:text;
        }
        .ceo-role { font-size:.82rem; color:var(--gray); margin-top:4px; }

        /* ===== CONTACT / CTA ===== */
        .cta-section {
            background: var(--navy-dark);
            position:relative;
            overflow:hidden;
            padding:96px 24px;
        }
        .cta-section::before {
            content:''; position:absolute; inset:0;
            background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .cta-inner { position:relative; z-index:1; max-width:1280px; margin:0 auto; }
        .cta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: start;
        }
        .cta-left h2 {
            font-family:'Poppins',sans-serif; font-size:clamp(1.8rem,3vw,2.6rem);
            font-weight:900; color:#fff; line-height:1.2; margin-bottom:16px;
        }
        .cta-left h2 span { color:var(--sky); }
        .cta-left p { color:rgba(255,255,255,.7); line-height:1.75; margin-bottom:32px; }
        .contact-items { display:flex; flex-direction:column; gap:18px; }
        .contact-item {
            display:flex; align-items:center; gap:16px;
            background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.1);
            border-radius:var(--radius-sm); padding:16px 20px;
            transition:var(--transition);
        }
        .contact-item:hover { background:rgba(255,255,255,.1); }
        .contact-icon {
            width:44px; height:44px; border-radius:50%;
            background:var(--gradient);
            display:flex; align-items:center; justify-content:center;
            color:#fff; font-size:1.05rem; flex-shrink:0;
        }
        .contact-text .label { font-size:.72rem; color:rgba(255,255,255,.5); letter-spacing:.3px; text-transform:uppercase; }
        .contact-text .value { color:#fff; font-weight:600; font-size:.95rem; margin-top:2px; }
        .contact-text .value a { color:#fff; }
        .contact-text .value a:hover { color:var(--sky); }

        /* Form */
        .cta-form {
            background: rgba(255,255,255,.05);
            backdrop-filter:blur(20px);
            border:1px solid rgba(255,255,255,.12);
            border-radius: var(--radius);
            padding: 40px;
        }
        .cta-form h3 { font-family:'Poppins',sans-serif; font-size:1.4rem; font-weight:700; color:#fff; margin-bottom:8px; }
        .cta-form p  { color:rgba(255,255,255,.6); font-size:.88rem; margin-bottom:28px; }
        .form-row { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
        .form-group { margin-bottom:14px; }
        .form-group label { display:block; color:rgba(255,255,255,.7); font-size:.82rem; font-weight:500; margin-bottom:6px; }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width:100%; background:rgba(255,255,255,.08);
            border:1.5px solid rgba(255,255,255,.15);
            color:#fff; font-family:'Inter',sans-serif; font-size:.9rem;
            padding:13px 16px; border-radius:var(--radius-sm);
            outline:none; transition:var(--transition);
        }
        .form-group input::placeholder,
        .form-group textarea::placeholder { color:rgba(255,255,255,.35); }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color:var(--sky); background:rgba(0,170,255,.1);
        }
        .form-group select option { background:var(--navy); color:#fff; }
        .form-group textarea { resize:vertical; min-height:100px; }
        .btn-submit {
            width:100%; padding:15px;
            background:var(--gradient); color:#fff;
            font-family:'Poppins',sans-serif; font-weight:700; font-size:1rem;
            border:none; border-radius:50px;
            cursor:pointer; transition:var(--transition);
            display:flex; align-items:center; justify-content:center; gap:8px;
        }
        .btn-submit:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(0,170,255,.35); }

        /* ===== FOOTER ===== */
        footer {
            background: #060e2a;
            padding: 72px 24px 0;
        }
        .footer-inner {
            max-width:1280px; margin:0 auto;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px;
            padding-bottom: 60px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .footer-brand { }
        .footer-logo { display:flex; align-items:center; gap:10px; margin-bottom:16px; }
        .footer-logo img { width:48px; height:48px; object-fit:contain; background:#fff; border-radius:8px; padding:6px; }
        .footer-logo-text .name { font-family:'Poppins',sans-serif; font-size:1.3rem; font-weight:800; }
        .footer-logo-text .name .s { color:#fff; }
        .footer-logo-text .name .w { color:var(--sky); }
        .footer-logo-text .sub { font-size:.65rem; color:rgba(255,255,255,.4); letter-spacing:.5px; text-transform:uppercase; }
        .footer-brand p { color:rgba(255,255,255,.5); font-size:.88rem; line-height:1.75; margin-bottom:24px; }
        .footer-socials { display:flex; gap:10px; }
        .fsoc {
            width:38px; height:38px; border-radius:50%;
            background:rgba(255,255,255,.07); border:1px solid rgba(255,255,255,.1);
            display:flex; align-items:center; justify-content:center;
            color:rgba(255,255,255,.6); font-size:.85rem;
            transition:var(--transition);
        }
        .fsoc:hover { background:var(--gradient); color:#fff; border-color:transparent; transform:translateY(-3px); }

        .footer-col h4 { font-family:'Poppins',sans-serif; font-size:.95rem; font-weight:700; color:#fff; margin-bottom:20px; }
        .footer-col ul li { margin-bottom:10px; }
        .footer-col ul li a { color:rgba(255,255,255,.5); font-size:.88rem; transition:var(--transition); display:flex; align-items:center; gap:7px; }
        .footer-col ul li a:hover { color:var(--sky); padding-left:4px; }
        .footer-col ul li a i { font-size:.7rem; }

        .footer-bottom {
            padding: 22px 0;
            display:flex; justify-content:space-between; align-items:center;
            flex-wrap:wrap; gap:12px;
        }
        .footer-bottom p { color:rgba(255,255,255,.35); font-size:.82rem; }
        .footer-bottom a { color:var(--sky); }

        /* ===== WHATSAPP FLOAT ===== */
        .wa-float {
            position:fixed; bottom:28px; right:28px; z-index:500;
            width:58px; height:58px; border-radius:50%;
            background:#25D366; color:#fff;
            display:flex; align-items:center; justify-content:center;
            font-size:1.7rem; box-shadow:0 6px 24px rgba(37,211,102,.4);
            transition:var(--transition); animation:waPulse 2s ease-in-out infinite;
        }
        .wa-float:hover { transform:scale(1.12); box-shadow:0 10px 32px rgba(37,211,102,.55); animation:none; }
        @keyframes waPulse {
            0%,100%{ box-shadow:0 6px 24px rgba(37,211,102,.4); }
            50%    { box-shadow:0 6px 36px rgba(37,211,102,.7); }
        }

        /* ===== SCROLL TO TOP ===== */
        .scroll-top {
            position:fixed; bottom:28px; left:28px; z-index:500;
            width:46px; height:46px; border-radius:50%;
            background:var(--gradient); color:#fff;
            display:flex; align-items:center; justify-content:center;
            font-size:1rem; box-shadow:var(--shadow-sm);
            transition:var(--transition); opacity:0; pointer-events:none;
            cursor:pointer; border:none;
        }
        .scroll-top.visible { opacity:1; pointer-events:all; }
        .scroll-top:hover { transform:translateY(-3px); box-shadow:var(--shadow-md); }

        /* ===== ANIMATIONS ===== */
        .reveal { opacity:0; transform:translateY(40px); transition:opacity .7s ease, transform .7s ease; }
        .reveal.visible { opacity:1; transform:translateY(0); }
        .reveal-left { opacity:0; transform:translateX(-50px); transition:opacity .7s ease, transform .7s ease; }
        .reveal-left.visible { opacity:1; transform:translateX(0); }
        .reveal-right { opacity:0; transform:translateX(50px); transition:opacity .7s ease, transform .7s ease; }
        .reveal-right.visible { opacity:1; transform:translateX(0); }

        /* ===== RESPONSIVE MASTER STYLES ===== */
        body.nav-open {
            overflow: hidden !important;
            touch-action: none;
        }

        /* Large Laptops / Desktops */
        @media (max-width: 1200px) {
            .slide-right-panel { display: none; }
            .slide-counter { display: none; }
            .hero-inner { gap: 40px; }
        }

        /* Tablets & Medium Screens */
        @media (max-width: 992px) {
            .hero {
                height: auto;
                min-height: calc(100svh - 100px);
                max-height: 850px;
            }
            .whyus-inner {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .whyus-visual {
                max-width: 550px;
                margin: 0 auto;
                width: 100%;
            }
            .ceo-inner {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .ceo-img-wrap {
                max-width: 400px;
                margin: 0 auto;
                width: 100%;
            }
            .cta-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .footer-grid {
                grid-template-columns: 1fr 1fr;
                gap: 36px;
            }
        }

        @media (max-width: 1200px) {
            .nav-links a { padding: 6px 8px; font-size: .8rem; }
            .nav-cta { padding: 8px 14px !important; font-size: .8rem !important; }
        }

        /* Mobile Navigation Dropdown (<= 992px) */
        @media (max-width: 992px) {
            .hamburger {
                display: flex;
            }
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
            .nav-links li {
                width: 100%;
            }
            .nav-links li a {
                display: flex;
                align-items: center;
                padding: 12px 16px;
                font-size: .95rem;
                font-weight: 600;
                color: var(--navy);
                border-radius: 10px;
                transition: var(--transition);
                width: 100%;
            }
            .nav-links li a::after { display: none; }
            .nav-links li a:hover,
            .nav-links li a:active {
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

        /* Mobile Screens (<= 768px) */
        @media (max-width: 768px) {
            section:not(.hero) {
                padding: 60px 16px;
            }
            .container {
                padding: 0 4px;
            }
            .section-header {
                margin-bottom: 36px;
            }
            .section-tag {
                font-size: .72rem;
                padding: 6px 14px;
                margin-bottom: 12px;
            }
            .section-title {
                font-size: clamp(1.65rem, 6vw, 2.2rem);
                margin-bottom: 12px;
            }
            .section-desc {
                font-size: .9rem;
                line-height: 1.65;
            }

            /* Top Bar */
            .topbar-inner {
                padding: 0 16px;
                justify-content: space-between;
            }
            .topbar-left {
                gap: 12px;
                font-size: .75rem;
            }
            .topbar-social {
                width: 26px;
                height: 26px;
                font-size: .7rem;
            }

            /* Navbar */
            nav {
                height: 64px;
                padding: 0 16px;
            }
            .nav-logo img {
                width: 44px;
                height: 44px;
            }
            .nav-logo-text .brand {
                font-size: 1.2rem;
            }

            /* Hero Slider */
            .hero {
                height: calc(100svh - 96px);
                min-height: 580px;
                max-height: 800px;
                padding: 0 !important;
            }
            .slide-content {
                padding: 24px 16px 74px 16px;
                align-items: center;
            }
            .slide-body {
                width: 100%;
                max-width: 100%;
            }
            .slide-badge {
                font-size: .7rem;
                padding: 6px 14px;
                margin-bottom: 16px;
                letter-spacing: .4px;
            }
            .slide-title {
                font-size: clamp(1.75rem, 7vw, 2.35rem);
                line-height: 1.15;
                margin-bottom: 14px;
            }
            .slide-sub {
                font-size: .88rem;
                line-height: 1.6;
                margin-bottom: 22px;
            }
            .slide-ctas {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 10px;
                margin-bottom: 24px;
                width: 100%;
            }
            .btn-primary, .btn-secondary {
                padding: 12px 14px;
                font-size: .82rem;
                justify-content: center;
                text-align: center;
                white-space: nowrap;
            }
            .hero-stats-bar {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
                width: 100%;
            }
            .stat {
                padding: 10px 12px;
                margin: 0;
                border: 1px solid rgba(255, 255, 255, .15);
                border-radius: 10px;
                background: rgba(255, 255, 255, .08);
                backdrop-filter: blur(8px);
            }
            .stat-num {
                font-size: 1.35rem;
            }
            .stat-label {
                font-size: .66rem;
                margin-top: 2px;
            }
            .scroll-hint { display: none; }
            .slider-nav {
                bottom: 18px;
                gap: 12px;
            }
            .slider-arrow {
                width: 36px;
                height: 36px;
                font-size: .78rem;
            }
            .slider-dot {
                width: 7px;
                height: 7px;
            }
            .slider-dot.active {
                width: 22px;
            }

            /* Trust Strip */
            .trust-inner {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
                padding: 16px;
            }
            .trust-item {
                font-size: .78rem;
                gap: 8px;
            }

            /* Services */
            .services-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            .service-card {
                padding: 24px 20px;
            }
            .service-icon {
                width: 50px;
                height: 50px;
                font-size: 1.3rem;
                margin-bottom: 16px;
            }

            /* Destinations */
            .destinations-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }
            .dest-banner {
                height: 90px;
                font-size: 2.6rem;
            }
            .dest-body {
                padding: 12px;
            }
            .dest-country {
                font-size: .92rem;
            }
            .dest-detail {
                font-size: .72rem;
            }
            .dest-badge {
                font-size: .62rem;
                padding: 3px 8px;
                margin-top: 6px;
            }

            /* Why Us */
            .whyus-img-wrap img {
                height: 290px;
                border-radius: 14px;
            }
            .whyus-exp-card {
                top: 10px;
                left: 10px;
                padding: 8px 14px;
                border-radius: 10px;
            }
            .whyus-exp-card .big {
                font-size: 1.4rem;
            }
            .whyus-badge-card {
                bottom: 10px;
                right: 10px;
                padding: 8px 14px;
                border-radius: 10px;
                gap: 10px;
            }
            .whyus-badge-icon {
                font-size: 1.4rem;
            }
            .whyus-badge-text .num {
                font-size: 1.2rem;
            }
            .reasons {
                gap: 12px;
                margin-top: 20px;
            }
            .reason {
                padding: 14px;
                gap: 12px;
            }
            .reason-icon {
                width: 40px;
                height: 40px;
                font-size: .95rem;
            }

            /* Process */
            .process-steps {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px 12px;
            }
            .process-steps::before {
                display: none;
            }
            .step {
                padding: 0 6px;
            }
            .step-num {
                width: 62px;
                height: 62px;
                font-size: 1.3rem;
                margin-bottom: 12px;
            }
            .step h4 {
                font-size: .92rem;
                margin-bottom: 4px;
            }
            .step p {
                font-size: .78rem;
                line-height: 1.5;
            }

            /* CEO Section */
            .ceo-img-frame img {
                height: 320px;
            }
            .ceo-deco {
                display: none;
            }
            .quote-mark {
                font-size: 3rem;
                margin-bottom: 0;
            }
            .ceo-quote {
                font-size: 1.05rem;
                line-height: 1.6;
                margin-bottom: 14px;
            }
            .ceo-bio {
                font-size: .88rem;
                line-height: 1.7;
                margin-bottom: 18px;
            }
            .ceo-signature {
                font-size: 1.25rem;
            }

            /* CTA & Form */
            .cta-section {
                padding: 56px 16px;
            }
            .cta-left h2 {
                font-size: 1.7rem;
            }
            .contact-items {
                gap: 10px;
            }
            .contact-item {
                padding: 12px 14px;
                gap: 12px;
            }
            .contact-icon {
                width: 38px;
                height: 38px;
                font-size: .95rem;
            }
            .contact-text .value {
                font-size: .88rem;
                word-break: break-word;
            }
            .cta-form {
                padding: 24px 18px;
                border-radius: 14px;
            }
            .cta-form h3 {
                font-size: 1.2rem;
            }
            .form-row {
                grid-template-columns: 1fr;
                gap: 10px;
            }
            .form-group input,
            .form-group select,
            .form-group textarea {
                padding: 11px 14px;
                font-size: .85rem;
            }

            /* Footer */
            footer {
                padding: 48px 16px 0;
            }
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 28px;
                padding-bottom: 36px;
            }
            .footer-bottom {
                flex-direction: column;
                text-align: center;
                gap: 8px;
                padding: 18px 0;
            }

            /* Floating Buttons */
            .wa-float {
                bottom: 18px;
                right: 18px;
                width: 48px;
                height: 48px;
                font-size: 1.45rem;
            }
            .scroll-top {
                bottom: 18px;
                left: 18px;
                width: 40px;
                height: 40px;
                font-size: .85rem;
            }
        }

        /* Small Phones (<= 480px) */
        @media (max-width: 480px) {
            .slide-title {
                font-size: 1.7rem;
            }
            .slide-ctas {
                grid-template-columns: 1fr;
            }
            .slide-ctas a {
                width: 100%;
            }
            .loader-brand {
                font-size: 1.5rem;
                letter-spacing: 2px;
            }
            .loader-logo-wrap {
                width: 130px;
                height: 130px;
            }
            .loader-logo-img {
                width: 80px;
                height: 80px;
            }
            .loader-progress-wrap {
                max-width: 80vw;
            }
            .whyus-badge-card {
                padding: 6px 10px;
            }
            .whyus-badge-text .num {
                font-size: 1rem;
            }
            .whyus-badge-text .lbl {
                font-size: .65rem;
            }
            .whyus-exp-card {
                padding: 6px 10px;
            }
            .whyus-exp-card .big {
                font-size: 1.2rem;
            }
            .trust-inner {
                grid-template-columns: 1fr;
            }
        }

        /* Micro Screens (<= 360px) */
        @media (max-width: 360px) {
            .destinations-grid {
                grid-template-columns: 1fr;
            }
            .process-steps {
                grid-template-columns: 1fr;
            }
            .hero-stats-bar {
                grid-template-columns: 1fr;
            }
        }

        /* ===== HOME GALLERY PREVIEW ===== */
        .home-gallery { padding: 90px 24px; background: #ffffff; }
        .home-gallery-inner { max-width: 1240px; margin: 0 auto; }
        .home-gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
            margin-top: 40px;
        }
        .home-gallery-card {
            border-radius: var(--radius);
            overflow: hidden;
            position: relative;
            height: 250px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            display: block;
            text-decoration: none;
            background: #0d2b8e;
        }
        .home-gallery-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-md);
        }
        .home-gallery-card img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform .6s ease;
        }
        .home-gallery-card:hover img { transform: scale(1.08); }
        .home-gallery-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(180deg, rgba(7,13,36,0.1) 0%, rgba(7,13,36,0.85) 100%);
            display: flex; flex-direction: column; justify-content: flex-end;
            padding: 20px;
            color: #ffffff;
        }
        .home-gallery-tag {
            align-self: flex-start;
            padding: 4px 10px; border-radius: 99px;
            background: rgba(255,255,255,0.95); color: #0d2b8e;
            font-size: 0.72rem; font-weight: 800; text-transform: uppercase;
            letter-spacing: 0.5px; margin-bottom: 8px;
        }
        .home-gallery-title {
            font-size: 0.95rem; font-weight: 700; color: #ffffff;
            line-height: 1.35; margin: 0;
            text-shadow: 0 1px 3px rgba(0,0,0,0.4);
        }

        /* ===== HOME NEWS PREVIEW ===== */
        .home-news { padding: 90px 24px; background: var(--gray-light); }
        .home-news-inner { max-width: 1240px; margin: 0 auto; }
        .home-news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 28px;
            margin-top: 40px;
        }
        .home-news-card {
            background: #ffffff;
            border-radius: var(--radius);
            overflow: hidden;
            border: 1.5px solid #e8edf8;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            display: flex; flex-direction: column;
        }
        .home-news-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-md);
            border-color: var(--blue);
        }
        .home-news-img {
            height: 200px; width: 100%; overflow: hidden; position: relative;
        }
        .home-news-img img {
            width: 100%; height: 100%; object-fit: cover; transition: transform .6s ease;
        }
        .home-news-card:hover .home-news-img img { transform: scale(1.06); }
        .home-news-body { padding: 24px; display: flex; flex-direction: column; flex: 1; }
        .home-news-meta {
            display: flex; align-items: center; justify-content: space-between;
            font-size: 0.75rem; color: var(--gray); margin-bottom: 12px;
        }
        .home-news-cat {
            background: var(--sky-light); color: var(--blue);
            padding: 3px 10px; border-radius: 99px; font-weight: 700; font-size: 0.72rem;
        }
        .home-news-title {
            font-size: 1.08rem; font-weight: 800; color: var(--dark);
            line-height: 1.4; margin-bottom: 10px; transition: color .2s;
        }
        .home-news-card:hover .home-news-title { color: var(--blue); }
        .home-news-excerpt {
            font-size: 0.85rem; color: var(--gray); line-height: 1.6;
            margin-bottom: 18px; flex: 1;
        }
        .home-news-link {
            font-size: 0.84rem; font-weight: 700; color: var(--navy);
            display: inline-flex; align-items: center; gap: 6px;
            transition: gap .2s, color .2s;
        }
        .home-news-link:hover { color: var(--blue); gap: 10px; }

        .center-btn-wrap {
            text-align: center; margin-top: 45px;
        }
    </style>
</head>
<body>

<!-- ===== LOADING SCREEN ===== -->
<div id="loader">
    <div class="loader-grid"></div>
    <div class="loader-orb loader-orb-1"></div>
    <div class="loader-orb loader-orb-2"></div>
    <div class="loader-orb loader-orb-3"></div>
    <div class="loader-logo-wrap">
        <div class="loader-ring loader-ring-1"></div>
        <div class="loader-ring loader-ring-2"></div>
        <div class="loader-ring loader-ring-3"></div>
        <img src="/images/logo.jpg" alt="Springway Logo" class="loader-logo-img">
    </div>
    <div class="loader-brand"><span class="lb-s">SPRING</span><span class="lb-w">WAY</span></div>
    <div class="loader-sub">EDUCATION &bull; YOUR GLOBAL JOURNEY BEGINS HERE</div>
    <div class="loader-progress-wrap">
        <div class="loader-progress-track">
            <div class="loader-progress-fill" id="loaderFill"></div>
        </div>
        <div class="loader-pct" id="loaderPct">0%</div>
    </div>
    <div class="loader-dots">
        <div class="loader-dot"></div>
        <div class="loader-dot"></div>
        <div class="loader-dot"></div>
    </div>
</div>

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
            <a href="#contact" class="topbar-addr">
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
        <a href="/" class="nav-logo">
            <img src="/images/logo.jpg" alt="Springway Logo">
            <div class="nav-logo-text">
                <div class="brand"><span class="spring">SPRING</span><span class="way">WAY</span></div>
                <div class="tagline">Education</div>
            </div>
        </a>
        <ul class="nav-links" id="navLinks">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="{{ route('services') }}">Services</a></li>
            <li><a href="{{ route('destinations') }}">Destinations</a></li>
            <li><a href="{{ route('study_in_bangladesh') }}">Study in Bangladesh</a></li>
            <li><a href="{{ route('process') }}">Process</a></li>
            <li><a href="{{ route('gallery') }}">Gallery</a></li>
            <li><a href="{{ route('news') }}">News</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
            <li><a href="{{ route('contact') }}" class="nav-cta"><i class="fas fa-paper-plane"></i> Free Consultation</a></li>
        </ul>
        <div class="hamburger" id="hamburger" aria-label="Toggle Navigation">
            <span></span><span></span><span></span>
        </div>
    </nav>
</header>

<!-- ===== HERO SLIDER ===== -->
<section class="hero" id="home">
    <div class="slider-progress">
        <div class="slider-progress-fill" id="sliderProgressFill"></div>
    </div>

    <!-- Slider Track -->
    <div class="slider-track" id="sliderTrack">
        <!-- Slide 1 -->
        <div class="slide active">
            <div class="slide-bg" style="background-image: url('/images/hero/slide1.jpg');"></div>
            <div class="slide-overlay"></div>
            <div class="slide-grid"></div>
            <div class="slide-content">
                <div class="slide-body">
                    <div class="slide-badge">
                        <span class="dot"></span>
                        Premier Study Abroad Partner in Bangladesh
                    </div>
                    <h1 class="slide-title">
                        Your <span class="highlight">Global Journey</span><br>
                        Begins Here
                    </h1>
                    <p class="slide-sub">
                        {{ $homeContent['hero_subtitle']->content ?? 'Springway Education connects ambitious Bangladeshi students with world-class universities across the UK, Canada, Australia, USA, and beyond. Expert guidance with real results.' }}
                    </p>
                    <div class="slide-ctas">
                        <a href="#contact" class="btn-primary">
                            <i class="fas fa-rocket"></i> Start Your Journey
                        </a>
                        <a href="#destinations" class="btn-secondary">
                            <i class="fas fa-globe"></i> Explore Destinations
                        </a>
                    </div>
                    <div class="hero-stats-bar">
                        <div class="stat">
                            <div class="stat-num"><span id="c1">1500</span><span class="accent">+</span></div>
                            <div class="stat-label">Students Guided</div>
                        </div>
                        <div class="stat">
                            <div class="stat-num"><span id="c2">200</span><span class="accent">+</span></div>
                            <div class="stat-label">Partner Universities</div>
                        </div>
                        <div class="stat">
                            <div class="stat-num"><span id="c3">98</span><span class="accent">%</span></div>
                            <div class="stat-label">Visa Success Rate</div>
                        </div>
                        <div class="stat">
                            <div class="stat-num"><span id="c4">10</span><span class="accent">+</span></div>
                            <div class="stat-label">Countries Covered</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide-right-panel">
                <div class="mini-card">
                    <div class="mini-card-icon"><i class="fas fa-passport"></i></div>
                    <div class="mini-card-text">
                        <div class="mc-label">VISA SUCCESS</div>
                        <div class="mc-value">98% Approval Track</div>
                    </div>
                </div>
                <div class="mini-card">
                    <div class="mini-card-icon"><i class="fas fa-university"></i></div>
                    <div class="mini-card-text">
                        <div class="mc-label">GLOBAL NETWORK</div>
                        <div class="mc-value">200+ Top Institutions</div>
                    </div>
                </div>
                <div class="mini-card">
                    <div class="mini-card-icon"><i class="fas fa-handshake"></i></div>
                    <div class="mini-card-text">
                        <div class="mc-label">DIRECT ADMISSIONS</div>
                        <div class="mc-value">Fast-Track Processing</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="slide">
            <div class="slide-bg" style="background-image: url('/images/hero/slide2.jpg');"></div>
            <div class="slide-overlay"></div>
            <div class="slide-grid"></div>
            <div class="slide-content">
                <div class="slide-body">
                    <div class="slide-badge">
                        <span class="dot"></span>
                        UK · Canada · Australia · USA · Malaysia
                    </div>
                    <h1 class="slide-title">
                        Unlock <span class="highlight">Scholarships</span> &<br>
                        Top Admissions
                    </h1>
                    <p class="slide-sub">
                        Secure prestigious university grants, merit-based tuition discounts up to 50%, and post-study work permits with comprehensive guidance on every application requirement.
                    </p>
                    <div class="slide-ctas">
                        <a href="#contact" class="btn-primary">
                            <i class="fas fa-gift"></i> Check Scholarships
                        </a>
                        <a href="#services" class="btn-secondary">
                            <i class="fas fa-clipboard-check"></i> Free Assessment
                        </a>
                    </div>
                    <div class="hero-stats-bar">
                        <div class="stat">
                            <div class="stat-num">50<span class="accent">%</span></div>
                            <div class="stat-label">Max Scholarship</div>
                        </div>
                        <div class="stat">
                            <div class="stat-num">2-4<span class="accent"> Yrs</span></div>
                            <div class="stat-label">Post-Study Work Visa</div>
                        </div>
                        <div class="stat">
                            <div class="stat-num">100<span class="accent">%</span></div>
                            <div class="stat-label">Admission Support</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide-right-panel">
                <div class="mini-card">
                    <div class="mini-card-icon"><i class="fas fa-award"></i></div>
                    <div class="mini-card-text">
                        <div class="mc-label">SCHOLARSHIP AID</div>
                        <div class="mc-value">Up to 50% Tuition Waiver</div>
                    </div>
                </div>
                <div class="mini-card">
                    <div class="mini-card-icon"><i class="fas fa-briefcase"></i></div>
                    <div class="mini-card-text">
                        <div class="mc-label">WORK RIGHTS</div>
                        <div class="mc-value">Post-Study Work Permits</div>
                    </div>
                </div>
                <div class="mini-card">
                    <div class="mini-card-icon"><i class="fas fa-certificate"></i></div>
                    <div class="mini-card-text">
                        <div class="mc-label">IELTS AGENT</div>
                        <div class="mc-value">Official Test Booking</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="slide">
            <div class="slide-bg" style="background-image: url('/images/hero/slide3.jpg');"></div>
            <div class="slide-overlay"></div>
            <div class="slide-grid"></div>
            <div class="slide-content">
                <div class="slide-body">
                    <div class="slide-badge">
                        <span class="dot"></span>
                        End-to-End Overseas Guidance
                    </div>
                    <h1 class="slide-title">
                        From Application to <span class="highlight">Departure</span>,<br>
                        We Walk With You
                    </h1>
                    <p class="slide-sub">
                        SOP crafting, mock visa interviews, financial documentation verification, flight booking support, pre-departure briefings, and airport housing arrangements.
                    </p>
                    <div class="slide-ctas">
                        <a href="#process" class="btn-primary">
                            <i class="fas fa-route"></i> See Our 6-Step Process
                        </a>
                        <a href="#about" class="btn-secondary">
                            <i class="fas fa-shield-alt"></i> Why Springway
                        </a>
                    </div>
                    <div class="hero-stats-bar">
                        <div class="stat">
                            <div class="stat-num">1-on-1<span class="accent"></span></div>
                            <div class="stat-label">Personal Mentorship</div>
                        </div>
                        <div class="stat">
                            <div class="stat-num">0<span class="accent"> BDT</span></div>
                            <div class="stat-label">No Hidden Charges</div>
                        </div>
                        <div class="stat">
                            <div class="stat-num">24/7<span class="accent"></span></div>
                            <div class="stat-label">Student Counseling</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide-right-panel">
                <div class="mini-card">
                    <div class="mini-card-icon"><i class="fas fa-file-signature"></i></div>
                    <div class="mini-card-text">
                        <div class="mc-label">SOP & ESSAY</div>
                        <div class="mc-value">Expert Editorial Review</div>
                    </div>
                </div>
                <div class="mini-card">
                    <div class="mini-card-icon"><i class="fas fa-home"></i></div>
                    <div class="mini-card-text">
                        <div class="mc-label">ACCOMMODATION</div>
                        <div class="mc-value">Verified Student Housing</div>
                    </div>
                </div>
                <div class="mini-card">
                    <div class="mini-card-icon"><i class="fas fa-plane"></i></div>
                    <div class="mini-card-text">
                        <div class="mc-label">PRE-DEPARTURE</div>
                        <div class="mc-value">Complete Transit Briefing</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 4 -->
        <div class="slide">
            <div class="slide-bg" style="background-image: url('/images/hero/slide4.jpg');"></div>
            <div class="slide-overlay"></div>
            <div class="slide-grid"></div>
            <div class="slide-content">
                <div class="slide-body">
                    <div class="slide-badge">
                        <span class="dot"></span>
                        Sylhet's Leading Education Consultancy
                    </div>
                    <h1 class="slide-title">
                        Global Education,<br>
                        <span class="highlight">Brighter Future</span>
                    </h1>
                    <p class="slide-sub">
                        Led by Founder & CEO Midhat Abduzzahir (Mishu). Located at Kaniz Plaza, Zindabazar. Visit our modern office or reach out online to kick-start your dream career.
                    </p>
                    <div class="slide-ctas">
                        <a href="https://wa.me/8801341558822" target="_blank" class="btn-primary" style="background:#25D366;color:#fff;">
                            <i class="fab fa-whatsapp"></i> Chat on WhatsApp
                        </a>
                        <a href="#contact" class="btn-secondary">
                            <i class="fas fa-map-marker-alt"></i> Visit Our Office
                        </a>
                    </div>
                    <div class="hero-stats-bar">
                        <div class="stat">
                            <div class="stat-num">Sylhet<span class="accent"></span></div>
                            <div class="stat-label">Kaniz Plaza, 3rd Floor</div>
                        </div>
                        <div class="stat">
                            <div class="stat-num">CEO<span class="accent"></span></div>
                            <div class="stat-label">Direct Leadership</div>
                        </div>
                        <div class="stat">
                            <div class="stat-num">100%<span class="accent"></span></div>
                            <div class="stat-label">Transparency First</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide-right-panel">
                <div class="mini-card">
                    <div class="mini-card-icon"><i class="fas fa-map-pin"></i></div>
                    <div class="mini-card-text">
                        <div class="mc-label">LOCATION</div>
                        <div class="mc-value">Zindabazar, Sylhet</div>
                    </div>
                </div>
                <div class="mini-card">
                    <div class="mini-card-icon"><i class="fas fa-user-check"></i></div>
                    <div class="mini-card-text">
                        <div class="mc-label">LEADERSHIP</div>
                        <div class="mc-value">Midhat Abduzzahir (Mishu)</div>
                    </div>
                </div>
                <div class="mini-card">
                    <div class="mini-card-icon"><i class="fas fa-phone-volume"></i></div>
                    <div class="mini-card-text">
                        <div class="mc-label">DIRECT HELPLINE</div>
                        <div class="mc-value">+880 1341 55 88 22</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Slider Navigation Controls -->
    <div class="slider-nav">
        <button class="slider-arrow" id="slidePrev" aria-label="Previous Slide">
            <i class="fas fa-chevron-left"></i>
        </button>
        <div class="slider-dots" id="sliderDots">
            <button class="slider-dot active" data-index="0" aria-label="Slide 1"></button>
            <button class="slider-dot" data-index="1" aria-label="Slide 2"></button>
            <button class="slider-dot" data-index="2" aria-label="Slide 3"></button>
            <button class="slider-dot" data-index="3" aria-label="Slide 4"></button>
        </div>
        <button class="slider-arrow" id="slideNext" aria-label="Next Slide">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>

    <!-- Slide Counter -->
    <div class="slide-counter">
        <div class="current" id="slideCurrent">01</div>
        <div class="sep"></div>
        <div class="total">04</div>
    </div>

    <!-- Scroll Down Hint -->
    <div class="scroll-hint">
        <div class="scroll-hint-mouse"></div>
        <span>EXPLORE</span>
        <div class="scroll-hint-line"></div>
    </div>
</section>

<!-- ===== TRUST STRIP ===== -->
<div class="trust-strip">
    <div class="trust-inner">
        <div class="trust-item"><i class="fas fa-shield-alt"></i> Licensed Education Consultancy</div>
        <div class="trust-item"><i class="fas fa-award"></i> Certified IELTS Registration Agent</div>
        <div class="trust-item"><i class="fas fa-users"></i> 1000+ Happy Students</div>
        <div class="trust-item"><i class="fas fa-globe"></i> 10+ Study Destinations</div>
        <div class="trust-item"><i class="fas fa-handshake"></i> Direct University Partnerships</div>
    </div>
</div>

<!-- ===== SERVICES ===== -->
<section class="services" id="services">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-tag"><i class="fas fa-star"></i> What We Offer</div>
            <h2 class="section-title">Comprehensive Study Abroad <span class="accent">Services</span></h2>
            <p class="section-desc">From initial counseling to post-arrival support — we are with you every step of your global education journey.</p>
        </div>
        <div class="services-grid">
            @if(isset($serviceItems) && $serviceItems->count() > 0)
                @foreach($serviceItems as $service)
                <div class="service-card reveal" style="position:relative;">
                    @if($service->badge)
                    <div style="position:absolute; top:18px; right:18px; background:var(--sky-light); color:var(--blue); font-size:0.7rem; font-weight:800; padding:3px 10px; border-radius:50px; text-transform:uppercase;">
                        {{ $service->badge }}
                    </div>
                    @endif
                    <div class="service-icon"><i class="{{ $service->icon }}"></i></div>
                    <h3>{{ $service->title }}</h3>
                    <p>{{ $service->description }}</p>
                    <a href="{{ $service->link_url ?: route('services') }}" class="service-link">
                        {{ $service->link_text ?: 'Learn More' }} <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                @endforeach
            @else
                <div class="service-card reveal">
                    <div class="service-icon"><i class="fas fa-comments"></i></div>
                    <h3>Free Counseling</h3>
                    <p>Personalized one-on-one sessions to map your academic profile, career goals, and best-fit universities worldwide.</p>
                    <a href="{{ route('contact') }}" class="service-link">Get Started <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="service-card reveal">
                    <div class="service-icon"><i class="fas fa-university"></i></div>
                    <h3>University Admission</h3>
                    <p>Expert preparation of applications, SOPs, recommendation letters, and direct liaison with over 200+ partner institutions.</p>
                    <a href="{{ route('services') }}" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="service-card reveal">
                    <div class="service-icon"><i class="fas fa-passport"></i></div>
                    <h3>Visa Processing</h3>
                    <p>Comprehensive visa documentation review, mock interviews, and embassy guidance with an industry-leading success rate.</p>
                    <a href="{{ route('services') }}" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- ===== DESTINATIONS ===== -->
<section class="destinations" id="destinations">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-tag"><i class="fas fa-globe-americas"></i> Study Destinations</div>
            <h2 class="section-title">Your Dream Country <span class="accent">Awaits</span></h2>
            <p class="section-desc">We provide expert guidance for admissions in the most sought-after study destinations around the world.</p>
        </div>
        <div class="destinations-grid">
            @if(isset($destinationItems) && $destinationItems->isNotEmpty())
                @foreach($destinationItems as $dest)
                <div class="dest-card reveal">
                    <div class="dest-banner" style="background:{{ $dest->gradient ?: 'linear-gradient(135deg,#012169,#C8102E)' }};">{{ $dest->flag }}</div>
                    <div class="dest-body">
                        <div class="dest-country">{{ $dest->country }}</div>
                        <div class="dest-detail">{{ $dest->short_detail ?: ($dest->intakes ?: 'World-Class Universities') }}</div>
                        @if($dest->badge)
                        <span class="dest-badge">{{ $dest->badge }}</span>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
                <div class="dest-card reveal">
                    <div class="dest-banner" style="background:linear-gradient(135deg,#012169,#C8102E);">🇬🇧</div>
                    <div class="dest-body">
                        <div class="dest-country">United Kingdom</div>
                        <div class="dest-detail">150+ Universities · 3-Year Degree</div>
                        <span class="dest-badge">🔥 Most Popular</span>
                    </div>
                </div>
                <div class="dest-card reveal">
                    <div class="dest-banner" style="background:linear-gradient(135deg,#FF0000,#FF8C00);">🇨🇦</div>
                    <div class="dest-body">
                        <div class="dest-country">Canada</div>
                        <div class="dest-detail">100+ Colleges · Post-Study Work</div>
                        <span class="dest-badge">⭐ High Demand</span>
                    </div>
                </div>
                <div class="dest-card reveal">
                    <div class="dest-banner" style="background:linear-gradient(135deg,#00008B,#FFD700);">🇦🇺</div>
                    <div class="dest-body">
                        <div class="dest-country">Australia</div>
                        <div class="dest-detail">40+ Universities · 2–4 Yr Work Visa</div>
                        <span class="dest-badge">⭐ Top Choice</span>
                    </div>
                </div>
                <div class="dest-card reveal">
                    <div class="dest-banner" style="background:linear-gradient(135deg,#3C3B6E,#B22234);">🇺🇸</div>
                    <div class="dest-body">
                        <div class="dest-country">United States</div>
                        <div class="dest-detail">200+ Institutions · CPT/OPT Available</div>
                        <span class="dest-badge">🌟 Premium</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- ===== WHY US ===== -->
<section class="whyus" id="about">
    <div class="container">
        <div class="whyus-inner">
            <div class="whyus-visual reveal-left">
                <div class="whyus-exp-card">
                    <div class="big">5+</div>
                    <div class="lbl">Years of Experience</div>
                </div>
                <div class="whyus-img-wrap">
                    <img src="/images/ceo.jpg" alt="Our Team">
                </div>
                <div class="whyus-badge-card">
                    <div class="whyus-badge-icon">🏆</div>
                    <div class="whyus-badge-text">
                        <div class="num">98%</div>
                        <div class="lbl">Client Satisfaction</div>
                    </div>
                </div>
            </div>
            <div class="whyus-content reveal-right">
                <div class="section-tag"><i class="fas fa-info-circle"></i> Why Choose Us</div>
                <h2 class="section-title" style="text-align:left;">Why Students Choose <span class="accent">Springway</span></h2>
                <p style="color:var(--gray); line-height:1.8; margin-bottom:8px;">We are not just a consultancy — we are your partners in building a brighter global future. Based in Sylhet, we serve students across Bangladesh with honesty, transparency, and expertise.</p>
                <div class="reasons">
                    <div class="reason">
                        <div class="reason-icon"><i class="fas fa-check-double"></i></div>
                        <div class="reason-body">
                            <h4>100% Honest & Transparent</h4>
                            <p>No hidden fees, no false promises. We set realistic expectations and deliver on every commitment.</p>
                        </div>
                    </div>
                    <div class="reason">
                        <div class="reason-icon"><i class="fas fa-user-tie"></i></div>
                        <div class="reason-body">
                            <h4>Expert Certified Counselors</h4>
                            <p>Our team comprises certified professionals with deep knowledge of international admissions processes.</p>
                        </div>
                    </div>
                    <div class="reason">
                        <div class="reason-icon"><i class="fas fa-network-wired"></i></div>
                        <div class="reason-body">
                            <h4>Direct University Partnerships</h4>
                            <p>We work directly with 200+ universities globally, ensuring faster admissions and exclusive scholarships.</p>
                        </div>
                    </div>
                    <div class="reason">
                        <div class="reason-icon"><i class="fas fa-headset"></i></div>
                        <div class="reason-body">
                            <h4>End-to-End Support</h4>
                            <p>From your first consultation to settling in your new country — we are with you every step of the way.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== PROCESS ===== -->
<section class="process" id="process">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-tag"><i class="fas fa-route"></i> How It Works</div>
            <h2 class="section-title">Your Journey in <span style="color:var(--sky)">6 Simple Steps</span></h2>
            <p class="section-desc">Our streamlined process makes studying abroad simple, stress-free, and successful.</p>
        </div>
        <div class="process-steps">
            @if(isset($processSteps) && $processSteps->isNotEmpty())
                @foreach($processSteps as $step)
                <div class="step reveal">
                    <div class="step-num">{{ $step->formatted_number }}</div>
                    <h4>{{ $step->title }}</h4>
                    <p>{{ $step->short_description ?: \Illuminate\Support\Str::limit($step->description, 100) }}</p>
                </div>
                @endforeach
            @else
                <div class="step reveal">
                    <div class="step-num">01</div>
                    <h4>Free Consultation</h4>
                    <p>Book a free session with our expert counselors to discuss your goals and profile.</p>
                </div>
                <div class="step reveal">
                    <div class="step-num">02</div>
                    <h4>Profile Assessment</h4>
                    <p>We evaluate your academic background, English proficiency, and preferences.</p>
                </div>
                <div class="step reveal">
                    <div class="step-num">03</div>
                    <h4>University Selection</h4>
                    <p>Get a curated list of best-fit universities matching your goals and budget.</p>
                </div>
                <div class="step reveal">
                    <div class="step-num">04</div>
                    <h4>Application Submission</h4>
                    <p>We prepare and submit strong applications on your behalf to selected universities.</p>
                </div>
                <div class="step reveal">
                    <div class="step-num">05</div>
                    <h4>Visa Processing</h4>
                    <p>Complete documentation support and interview preparation for visa success.</p>
                </div>
                <div class="step reveal">
                    <div class="step-num">06</div>
                    <h4>Fly & Settle</h4>
                    <p>Pre-departure orientation, accommodation support, and arrival guidance.</p>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- ===== CEO SECTION ===== -->
<section class="ceo-section">
    <div class="container">
        <div class="ceo-inner">
            <div class="ceo-img-wrap reveal-left">
                <div class="ceo-deco"></div>
                <div class="ceo-img-frame">
                    <img src="/images/ceo.jpg" alt="Midhat Abduzzahir Mishu – Founder & CEO">
                    <div class="ceo-name-overlay">
                        <div class="name">Midhat Abduzzahir (Mishu)</div>
                        <div class="role">Founder & CEO, Springway Education</div>
                    </div>
                </div>
            </div>
            <div class="ceo-content reveal-right">
                <div class="section-tag" style="justify-content:flex-start;"><i class="fas fa-quote-left"></i> CEO's Message</div>
                <div class="quote-mark">"</div>
                <p class="ceo-quote">
                    "Every student deserves a chance at a world-class education, regardless of where they come from. At Springway, we are committed to turning global aspirations into reality — one student at a time."
                </p>
                <p class="ceo-bio">
                    With a deep passion for education and international development, Midhat Abduzzahir Mishu founded Springway Education with a singular vision: to democratize access to quality global education for Bangladeshi students. Under his leadership, Springway has grown into one of Sylhet's most trusted study-abroad consultancies, guiding hundreds of students to universities across the UK, Canada, Australia, and beyond.
                </p>
                <div class="ceo-signature">Midhat Abduzzahir (Mishu)</div>
                <div class="ceo-role">Founder & CEO, Springway Education</div>
            </div>
        </div>
    </div>
</section>

<!-- ===== GALLERY TEASER ===== -->
<section class="home-gallery" id="gallery-preview">
    <div class="home-gallery-inner">
        <div class="section-header">
            <div class="section-tag"><i class="fas fa-camera"></i> Life at Springway & Success</div>
            <h2>Moments of <span>Success & Excellence</span></h2>
            <p>A glimpse into our students receiving their visas, university seminars, and vibrant office counseling sessions in Sylhet.</p>
        </div>

        <div class="home-gallery-grid">
            @foreach($featuredGallery as $item)
            <a href="{{ route('gallery') }}" class="home-gallery-card">
                <img src="{{ $item->thumbnail ?? $item->url }}" alt="{{ $item->title }}" loading="lazy">
                <div class="home-gallery-overlay">
                    <span class="home-gallery-tag">{{ $item->category }}</span>
                    <h4 class="home-gallery-title">{{ $item->title }}</h4>
                </div>
            </a>
            @endforeach
        </div>

        <div class="center-btn-wrap">
            <a href="{{ route('gallery') }}" class="btn-primary" style="display:inline-flex; align-items:center; gap:8px;">
                <i class="fas fa-images"></i> Explore Full Photo & Video Gallery
            </a>
        </div>
    </div>
</section>

<!-- ===== LATEST NEWS & UPDATES ===== -->
<section class="home-news" id="news-preview">
    <div class="home-news-inner">
        <div class="section-header">
            <div class="section-tag"><i class="fas fa-newspaper"></i> Latest News & Announcements</div>
            <h2>Stay Updated with <span>Global Education Insights</span></h2>
            <p>Crucial visa regulation alerts, upcoming university intake deadlines, and scholarship notices from our senior counselors.</p>
        </div>

        <div class="home-news-grid">
            @foreach($latestNews as $post)
            <div class="home-news-card">
                <div class="home-news-img">
                    <img src="{{ $post->image }}" alt="{{ $post->title }}" loading="lazy">
                </div>
                <div class="home-news-body">
                    <div class="home-news-meta">
                        <span class="home-news-cat">{{ $post->category }}</span>
                        <span><i class="far fa-calendar-alt"></i> {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Recent' }}</span>
                    </div>
                    <h3 class="home-news-title">{{ $post->title }}</h3>
                    <p class="home-news-excerpt">{{ $post->summary }}</p>
                    <div>
                        <a href="{{ route('news.show', $post->slug) }}" class="home-news-link">
                            Read Full Story <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="center-btn-wrap">
            <a href="{{ route('news') }}" class="btn-secondary" style="display:inline-flex; align-items:center; gap:8px;">
                <i class="fas fa-book-open"></i> Browse All News & Insights
            </a>
        </div>
    </div>
</section>

<!-- ===== CONTACT / CTA ===== -->
<section class="cta-section" id="contact">
    <div class="cta-inner">
        <div class="cta-grid">
            <div class="cta-left reveal-left">
                <h2>Ready to Start Your <span>Global Journey?</span></h2>
                <p>Book a free consultation today. Our expert counselors are here to guide you from your first question to your flight date.</p>
                <div class="contact-items">
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="contact-text">
                            <div class="label">Office Address</div>
                            <div class="value">Kaniz Plaza (3rd Floor), Zindabazar, Sylhet-3100, Bangladesh</div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                        <div class="contact-text">
                            <div class="label">WhatsApp / Call</div>
                            <div class="value"><a href="tel:+8801341558822">+880 1341 55 88 22</a></div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                        <div class="contact-text">
                            <div class="label">Email</div>
                            <div class="value"><a href="mailto:info@springwaybd.com">info@springwaybd.com</a></div>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-globe"></i></div>
                        <div class="contact-text">
                            <div class="label">Website</div>
                            <div class="value"><a href="https://www.springwaybd.com" target="_blank">www.springwaybd.com</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="reveal-right">
                <div class="cta-form">
                    <h3>Book Free Consultation</h3>
                    <p>Fill in your details and we'll get back to you within 24 hours.</p>

                    @if(session('consultation_success'))
                        <div style="background: rgba(37,211,102,.15); border: 1.5px solid #25D366; color: #7cf3aa; border-radius: 12px; padding: 14px 18px; margin-bottom: 20px; font-size: .9rem; display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-check-circle" style="font-size: 1.2rem; color: #25D366;"></i>
                            <span>{{ session('consultation_success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('consultation.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="source" value="Homepage Consultation Form">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="name" placeholder="Your full name" required>
                            </div>
                            <div class="form-group">
                                <label>Phone / WhatsApp</label>
                                <input type="tel" name="phone" placeholder="+880 XXXX XXXX" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" placeholder="your@email.com" required>
                        </div>
                        <div class="form-group">
                            <label>Preferred Destination</label>
                            <select name="destination">
                                <option value="">-- Select Country --</option>
                                <option>United Kingdom</option>
                                <option>Canada</option>
                                <option>Australia</option>
                                <option>United States</option>
                                <option>Malaysia</option>
                                <option>Germany</option>
                                <option>New Zealand</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea name="message" placeholder="Tell us about your academic background and goals..."></textarea>
                        </div>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-paper-plane"></i> Send My Request
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer>
    <div class="footer-inner">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="footer-logo">
                    <img src="/images/logo.jpg" alt="Springway">
                    <div class="footer-logo-text">
                        <div class="name"><span class="s">SPRING</span><span class="w">WAY</span></div>
                        <div class="sub">Education</div>
                    </div>
                </div>
                <p>Springway Education is a premier study-abroad consultancy based in Sylhet, Bangladesh. We believe every student deserves access to world-class global education. <em>Global Education. Brighter Future.</em></p>
                <div class="footer-socials">
                    <a href="https://facebook.com" target="_blank" class="fsoc"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com" target="_blank" class="fsoc"><i class="fab fa-instagram"></i></a>
                    <a href="https://linkedin.com" target="_blank" class="fsoc"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://youtube.com" target="_blank" class="fsoc"><i class="fab fa-youtube"></i></a>
                    <a href="https://wa.me/8801341558822" target="_blank" class="fsoc"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h4>Our Services</h4>
                <ul>
                    <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Free Counseling</a></li>
                    <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> University Admission</a></li>
                    <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Visa Processing</a></li>
                    <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> IELTS Registration</a></li>
                    <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Accommodation Support</a></li>
                    <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Pre-Departure Briefing</a></li>
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
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right"></i> Home</a></li>
                    <li><a href="{{ route('about') }}"><i class="fas fa-chevron-right"></i> About Us</a></li>
                    <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Our Services</a></li>
                    <li><a href="{{ route('destinations') }}"><i class="fas fa-chevron-right"></i> Destinations</a></li>
                    <li><a href="{{ route('study_in_bangladesh') }}"><i class="fas fa-chevron-right"></i> Study in Bangladesh (MBBS/BDS)</a></li>
                    <li><a href="{{ route('process') }}"><i class="fas fa-chevron-right"></i> Application Process</a></li>
                    <li><a href="{{ route('gallery') }}"><i class="fas fa-chevron-right"></i> Photo & Video Gallery</a></li>
                    <li><a href="{{ route('news') }}"><i class="fas fa-chevron-right"></i> News & Updates</a></li>
                    <li><a href="{{ route('contact') }}"><i class="fas fa-chevron-right"></i> Contact Us</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Springway Education. All Rights Reserved.</p>
            <p>Developed by <a href="https://pritomdam.site" target="_blank" rel="noopener noreferrer">Pritom Dam</a> for <a href="/">Springway Education</a></p>
        </div>
    </div>
</footer>

<!-- ===== WHATSAPP FLOAT ===== -->
<a href="https://wa.me/8801341558822" target="_blank" class="wa-float" title="Chat on WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- ===== SCROLL TO TOP ===== -->
<button class="scroll-top" id="scrollTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">
    <i class="fas fa-chevron-up"></i>
</button>

<script>
/* ===== PREMIUM LOADER SCRIPT ===== */
(function() {
    const loader = document.getElementById('loader');
    const pctEl = document.getElementById('loaderPct');
    const fillEl = document.getElementById('loaderFill');
    let pct = 0;

    const interval = setInterval(() => {
        pct += Math.floor(Math.random() * 8) + 4;
        if (pct >= 100) {
            pct = 100;
            clearInterval(interval);
            if (pctEl) pctEl.textContent = '100%';
            if (fillEl) fillEl.style.width = '100%';
            setTimeout(() => {
                loader.classList.add('hidden');
                // Trigger slider progress animation on first active slide
                startSliderAuto();
            }, 400);
        } else {
            if (pctEl) pctEl.textContent = pct + '%';
            if (fillEl) fillEl.style.width = pct + '%';
        }
    }, 60);

    // Fallback hide in 2.8s
    setTimeout(() => {
        if (!loader.classList.contains('hidden')) {
            loader.classList.add('hidden');
            startSliderAuto();
        }
    }, 2800);
})();

/* ===== HERO SLIDER SYSTEM ===== */
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;
const sliderTrack = document.getElementById('sliderTrack');
const dotsContainer = document.getElementById('sliderDots');
const dots = dotsContainer ? dotsContainer.querySelectorAll('.slider-dot') : [];
const slideCurrentEl = document.getElementById('slideCurrent');
const progressFill = document.getElementById('sliderProgressFill');
let slideInterval = null;
const SLIDE_DURATION = 6000;

function resetProgressAnimation() {
    if (!progressFill) return;
    progressFill.style.animation = 'none';
    progressFill.offsetHeight; // trigger reflow
    progressFill.style.animation = `slideProgress ${SLIDE_DURATION}ms linear`;
}

function goToSlide(index) {
    if (index < 0) index = totalSlides - 1;
    if (index >= totalSlides) index = 0;

    slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === index);
    });

    if (sliderTrack) {
        sliderTrack.style.transform = `translateX(-${index * 100}%)`;
    }

    dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === index);
    });

    if (slideCurrentEl) {
        slideCurrentEl.textContent = String(index + 1).padStart(2, '0');
    }

    currentSlide = index;
    resetProgressAnimation();
}

function nextSlide() {
    goToSlide(currentSlide + 1);
}

function prevSlide() {
    goToSlide(currentSlide - 1);
}

function startSliderAuto() {
    stopSliderAuto();
    resetProgressAnimation();
    slideInterval = setInterval(nextSlide, SLIDE_DURATION);
}

function stopSliderAuto() {
    if (slideInterval) {
        clearInterval(slideInterval);
        slideInterval = null;
    }
}

// Arrow Controls
const nextBtn = document.getElementById('slideNext');
const prevBtn = document.getElementById('slidePrev');
if (nextBtn) {
    nextBtn.addEventListener('click', () => {
        nextSlide();
        startSliderAuto();
    });
}
if (prevBtn) {
    prevBtn.addEventListener('click', () => {
        prevSlide();
        startSliderAuto();
    });
}

// Dot Controls
dots.forEach((dot) => {
    dot.addEventListener('click', (e) => {
        const targetIndex = parseInt(e.currentTarget.getAttribute('data-index'), 10);
        goToSlide(targetIndex);
        startSliderAuto();
    });
});

// Keyboard Navigation
document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowRight') {
        nextSlide();
        startSliderAuto();
    } else if (e.key === 'ArrowLeft') {
        prevSlide();
        startSliderAuto();
    }
});

// Touch / Swipe Navigation for Mobile
let touchStartX = 0;
let touchEndX = 0;
const heroSection = document.getElementById('home');
if (heroSection) {
    heroSection.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    heroSection.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, { passive: true });
}

function handleSwipe() {
    const diff = touchStartX - touchEndX;
    if (Math.abs(diff) > 50) {
        if (diff > 0) {
            nextSlide(); // swipe left
        } else {
            prevSlide(); // swipe right
        }
        startSliderAuto();
    }
}

/* ===== NAVBAR SCROLL ===== */
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    if (navbar) navbar.classList.toggle('scrolled', window.scrollY > 40);
    const topBtn = document.getElementById('scrollTop');
    if (topBtn) topBtn.classList.toggle('visible', window.scrollY > 300);
});

/* ===== MOBILE NAVIGATION DROPDOWN ===== */
const hamburger = document.getElementById('hamburger');
const navLinks = document.getElementById('navLinks');

if (hamburger && navLinks) {
    hamburger.addEventListener('click', (e) => {
        e.stopPropagation();
        hamburger.classList.toggle('open');
        navLinks.classList.toggle('open');
    });

    // Close when clicking any link
    navLinks.querySelectorAll('a').forEach(a => {
        a.addEventListener('click', () => {
            hamburger.classList.remove('open');
            navLinks.classList.remove('open');
        });
    });

    // Close when clicking outside navbar
    document.addEventListener('click', (e) => {
        if (!e.target.closest('#navbar')) {
            hamburger.classList.remove('open');
            navLinks.classList.remove('open');
        }
    });
}

/* ===== NUMBER COUNTERS ===== */
function animateCount(el, target, duration = 2000) {
    if (!el) return;
    let start = 0;
    const step = target / (duration / 16);
    const timer = setInterval(() => {
        start += step;
        if (start >= target) {
            el.textContent = target;
            clearInterval(timer);
        } else {
            el.textContent = Math.floor(start);
        }
    }, 16);
}
let counted = false;
function startCounters() {
    if (counted) return;
    counted = true;
    animateCount(document.getElementById('c1'), 1500);
    animateCount(document.getElementById('c2'), 200);
    animateCount(document.getElementById('c3'), 98);
    animateCount(document.getElementById('c4'), 10);
}

/* ===== INTERSECTION OBSERVER ===== */
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.12 });

document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => observer.observe(el));

/* Start counters when hero is in view */
const heroObs = new IntersectionObserver((entries) => {
    if (entries[0] && entries[0].isIntersecting) startCounters();
}, { threshold: 0.2 });
if (heroSection) heroObs.observe(heroSection);

/* ===== ACTIVE NAV LINK ===== */
const sections = document.querySelectorAll('section[id]');
const navAnchors = document.querySelectorAll('.nav-links a');
window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(s => {
        if (window.scrollY >= s.offsetTop - 120) current = s.id;
    });
    navAnchors.forEach(a => {
        const href = a.getAttribute('href');
        if (href === '#' + current) {
            a.style.color = 'var(--blue)';
        } else if (href && href.startsWith('#')) {
            a.style.color = '';
        }
    });
});
</script>
</body>
</html>

