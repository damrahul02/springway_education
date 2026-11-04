@extends('layouts.app')

@section('title', 'Study MBBS & BDS in Bangladesh for International Students – Springway BD')
@section('meta_description', 'Springway BD guides international students from India, Nepal, Pakistan, Egypt & worldwide to study MBBS and BDS in top medical colleges in Bangladesh.')

@section('styles')
<style>
    /* Medical & Academic Accent Theme */
    :root {
        --med-emerald: #059669;
        --med-teal: #0d9488;
        --med-blue: #0284c7;
        --med-light: #f0fdfa;
        --med-border: #ccfbf1;
    }

    .med-hero {
        position: relative;
        background: linear-gradient(135deg, #071342 0%, #0d2b8e 45%, #0284c7 85%, #0d9488 100%);
        padding: 90px 24px 80px;
        color: #ffffff;
        overflow: hidden;
    }

    .med-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 80% 20%, rgba(13, 148, 136, 0.25) 0%, transparent 60%),
                    radial-gradient(circle at 15% 85%, rgba(0, 170, 255, 0.2) 0%, transparent 55%);
        pointer-events: none;
    }

    .med-hero-grid {
        position: absolute;
        inset: 0;
        background-image: linear-gradient(rgba(255,255,255,.04) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(255,255,255,.04) 1px, transparent 1px);
        background-size: 40px 40px;
        pointer-events: none;
    }

    .med-hero-container {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    .med-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.12);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.22);
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        color: #67e8f9;
        margin-bottom: 20px;
    }

    .med-hero-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(2.2rem, 4.5vw, 3.6rem);
        font-weight: 800;
        line-height: 1.15;
        margin-bottom: 18px;
        color: #ffffff;
    }

    .med-hero-title .accent-emerald {
        background: linear-gradient(135deg, #a7f3d0 0%, #38bdf8 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .med-hero-tagline {
        font-size: clamp(1.15rem, 2.2vw, 1.45rem);
        font-weight: 700;
        color: #fdba74;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .med-hero-lead {
        font-size: 1.05rem;
        line-height: 1.8;
        color: rgba(255,255,255,0.92);
        max-width: 980px;
        margin-bottom: 24px;
    }

    .med-callout-box {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.2);
        border-left: 5px solid #38bdf8;
        border-radius: 14px;
        padding: 22px 26px;
        backdrop-filter: blur(10px);
        margin-bottom: 30px;
        max-width: 980px;
    }

    .med-callout-box p {
        font-size: 1.02rem;
        line-height: 1.75;
        color: #ffffff;
        margin: 0;
    }

    .med-callout-box strong {
        color: #67e8f9;
    }

    .country-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 14px;
    }

    .country-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.15);
        border: 1px solid rgba(255,255,255,0.25);
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #ffffff;
    }

    .hero-btn-group {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        margin-top: 28px;
    }

    .btn-med-primary {
        background: linear-gradient(135deg, #0ea5e9 0%, #059669 100%);
        color: #ffffff !important;
        padding: 14px 28px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 8px 24px rgba(14, 165, 233, 0.4);
        transition: var(--transition);
        text-decoration: none;
    }

    .btn-med-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(14, 165, 233, 0.55);
        background: linear-gradient(135deg, #059669 0%, #0ea5e9 100%);
    }

    .btn-med-secondary {
        background: rgba(255,255,255,0.12);
        color: #ffffff !important;
        border: 1.5px solid rgba(255,255,255,0.3);
        padding: 14px 26px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        backdrop-filter: blur(8px);
        transition: var(--transition);
        text-decoration: none;
    }

    .btn-med-secondary:hover {
        background: rgba(255,255,255,0.25);
        border-color: #ffffff;
        transform: translateY(-2px);
    }

    /* Trust highlights bar */
    .med-trust-bar {
        background: #ffffff;
        border-bottom: 1px solid #e2e8f0;
        padding: 24px 0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }

    .trust-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
    }

    .trust-item {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .trust-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: var(--sky-light);
        color: var(--blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .trust-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--navy);
        line-height: 1.3;
    }

    .trust-sub {
        font-size: 0.78rem;
        color: var(--gray);
    }

    /* Program Cards Section */
    .programs-section {
        padding: 85px 0 75px;
        background: #f8fafc;
    }

    .programs-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 32px;
        margin-top: 45px;
    }

    .program-card {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid #e2e8f0;
        padding: 40px 36px;
        box-shadow: var(--shadow-sm);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .program-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 45px rgba(13,43,142,0.12);
        border-color: #cbd5e1;
    }

    .program-card.mbbs-card {
        border-top: 6px solid #0284c7;
    }

    .program-card.bds-card {
        border-top: 6px solid #0d9488;
    }

    .program-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 16px;
        width: fit-content;
    }

    .badge-mbbs {
        background: #e0f2fe;
        color: #0369a1;
    }

    .badge-bds {
        background: #ccfbf1;
        color: #0f766e;
    }

    .program-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.85rem;
        font-weight: 800;
        color: var(--navy);
        margin-bottom: 12px;
    }

    .program-desc {
        color: #475569;
        font-size: 0.98rem;
        line-height: 1.7;
        margin-bottom: 24px;
    }

    .program-guidance-heading {
        font-size: 0.92rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--navy);
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .program-list {
        list-style: none;
        padding: 0;
        margin: 0 0 28px 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .program-list li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        font-size: 0.93rem;
        color: #334155;
        line-height: 1.6;
    }

    .program-list li i {
        font-size: 1rem;
        margin-top: 3px;
        flex-shrink: 0;
    }

    .mbbs-card .program-list li i { color: #0284c7; }
    .bds-card .program-list li i { color: #0d9488; }

    .program-card-footer {
        padding-top: 20px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Why Bangladesh Section */
    .why-section {
        padding: 90px 0;
        background: #ffffff;
    }

    .why-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
        margin-top: 45px;
    }

    .why-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 32px 26px;
        transition: var(--transition);
        display: flex;
        flex-direction: column;
        gap: 16px;
        position: relative;
    }

    .why-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 36px rgba(13,43,142,0.08);
        border-color: var(--blue);
    }

    .why-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        background: linear-gradient(135deg, #e0f2fe 0%, #ccfbf1 100%);
        color: var(--navy);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        transition: var(--transition);
    }

    .why-card:hover .why-icon {
        background: var(--gradient);
        color: #ffffff;
        transform: scale(1.05);
    }

    .why-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--navy);
        line-height: 1.4;
    }

    .why-text {
        font-size: 0.92rem;
        color: #64748b;
        line-height: 1.65;
        margin: 0;
    }

    /* 6 Steps Admission Support Section */
    .support-section {
        padding: 90px 0;
        background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
    }

    .steps-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 26px;
        margin-top: 45px;
    }

    .step-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 32px 26px;
        box-shadow: 0 4px 18px rgba(0,0,0,0.04);
        position: relative;
        transition: var(--transition);
    }

    .step-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 32px rgba(13,43,142,0.1);
        border-color: #38bdf8;
    }

    .step-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .step-number {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--gradient);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Poppins', sans-serif;
        font-weight: 800;
        font-size: 1.15rem;
    }

    .step-icon {
        color: #94a3b8;
        font-size: 1.3rem;
    }

    .step-name {
        font-family: 'Poppins', sans-serif;
        font-size: 1.18rem;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 10px;
    }

    .step-desc {
        color: #64748b;
        font-size: 0.92rem;
        line-height: 1.65;
        margin: 0;
    }

    /* Who Can Apply Section */
    .eligibility-section {
        padding: 80px 0;
        background: #ffffff;
    }

    .eligibility-card {
        background: linear-gradient(135deg, #0d2b8e 0%, #1a73e8 70%, #0284c7 100%);
        border-radius: 24px;
        padding: 50px 48px;
        color: #ffffff;
        box-shadow: var(--shadow-md);
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 40px;
        align-items: center;
    }

    .eligibility-left h2 {
        font-family: 'Poppins', sans-serif;
        font-size: 2.1rem;
        font-weight: 800;
        margin-bottom: 16px;
        color: #ffffff;
    }

    .eligibility-lead {
        font-size: 1.05rem;
        line-height: 1.8;
        color: rgba(255,255,255,0.92);
        margin-bottom: 18px;
    }

    .eligibility-note {
        font-size: 0.92rem;
        line-height: 1.7;
        color: #cbd5e1;
        background: rgba(255,255,255,0.08);
        border-left: 4px solid #67e8f9;
        padding: 14px 18px;
        border-radius: 10px;
    }

    .eligibility-right {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 18px;
        padding: 30px 26px;
        backdrop-filter: blur(10px);
    }

    .eligibility-right h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #67e8f9;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .criteria-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .criteria-list li {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.9rem;
        color: #ffffff;
    }

    .criteria-list li i {
        color: #a7f3d0;
        font-size: 0.95rem;
    }

    /* Callout Banner */
    .cta-banner-section {
        padding: 70px 0;
        background: #f8fafc;
    }

    .cta-banner {
        background: linear-gradient(135deg, #071342 0%, #0d2b8e 100%);
        border-radius: 24px;
        padding: 50px 48px;
        color: #ffffff;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 50% 50%, rgba(56, 189, 248, 0.15) 0%, transparent 70%);
        pointer-events: none;
    }

    .cta-banner-content {
        position: relative;
        z-index: 2;
        max-width: 860px;
        margin: 0 auto;
    }

    .cta-banner-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(1.8rem, 3.2vw, 2.5rem);
        font-weight: 800;
        margin-bottom: 14px;
        color: #ffffff;
    }

    .cta-banner-subtitle {
        font-size: 1.15rem;
        font-weight: 600;
        color: #38bdf8;
        margin-bottom: 16px;
    }

    .cta-banner-desc {
        font-size: 1rem;
        line-height: 1.75;
        color: rgba(255,255,255,0.88);
        margin-bottom: 24px;
    }

    .cta-banner-brand {
        display: inline-block;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.22);
        padding: 10px 22px;
        border-radius: 50px;
        font-size: 0.95rem;
        font-weight: 700;
        color: #a7f3d0;
        letter-spacing: 0.4px;
    }

    /* Consultation Form Section */
    .med-form-section {
        padding: 85px 0 100px;
        background: #ffffff;
    }

    .med-form-wrapper {
        max-width: 860px;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 40px rgba(13,43,142,0.08);
        padding: 48px;
    }

    .form-header-area {
        text-align: center;
        margin-bottom: 34px;
    }

    .form-header-area .badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #e0f2fe;
        color: #0369a1;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .form-header-area h3 {
        font-family: 'Poppins', sans-serif;
        font-size: 2.1rem;
        font-weight: 800;
        color: var(--navy);
        margin-bottom: 10px;
    }

    .form-header-area p {
        color: #64748b;
        font-size: 0.96rem;
    }

    .med-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .med-form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 18px;
    }

    .med-form-group.full-width {
        grid-column: 1 / -1;
    }

    .med-form-group label {
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--navy);
    }

    .med-form-group label .req {
        color: #ef4444;
    }

    .med-form-control {
        width: 100%;
        padding: 13px 16px;
        border: 1.5px solid #cbd5e1;
        border-radius: 12px;
        font-size: 0.95rem;
        font-family: inherit;
        color: var(--dark);
        background: #ffffff;
        transition: var(--transition);
        outline: none;
    }

    .med-form-control:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 4px rgba(26,115,232,0.12);
    }

    textarea.med-form-control {
        min-height: 120px;
        resize: vertical;
    }

    .btn-med-submit {
        width: 100%;
        background: var(--gradient);
        color: #ffffff;
        border: none;
        padding: 16px 28px;
        border-radius: 14px;
        font-size: 1.05rem;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 8px 25px rgba(26,115,232,0.35);
        transition: var(--transition);
        margin-top: 10px;
    }

    .btn-med-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(26,115,232,0.45);
        background: var(--gradient-rev);
    }

    .form-trust-badges {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: 24px;
        margin-top: 28px;
        padding-top: 22px;
        border-top: 1px solid #f1f5f9;
    }

    .trust-badge-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #64748b;
    }

    .trust-badge-item i {
        color: #10b981;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .programs-grid { grid-template-columns: 1fr; }
        .why-grid { grid-template-columns: 1fr 1fr; }
        .steps-grid { grid-template-columns: 1fr 1fr; }
        .trust-grid { grid-template-columns: 1fr 1fr; gap: 20px; }
        .eligibility-card { grid-template-columns: 1fr; padding: 36px 28px; }
    }

    @media (max-width: 768px) {
        .med-hero { padding: 65px 20px 60px; }
        .why-grid { grid-template-columns: 1fr; }
        .steps-grid { grid-template-columns: 1fr; }
        .trust-grid { grid-template-columns: 1fr; }
        .med-form-wrapper { padding: 32px 20px; }
        .med-form-grid { grid-template-columns: 1fr; gap: 0; }
        .cta-banner { padding: 36px 24px; }
    }
</style>
@endsection

@section('content')

<!-- ===== HERO BANNER ===== -->
<section class="med-hero">
    <div class="med-hero-grid"></div>
    <div class="med-hero-container">
        
        <div class="med-badge">
            <i class="fas fa-user-md"></i> Study in Bangladesh &bull; International Medical Admissions
        </div>

        <h1 class="med-hero-title">
            Study MBBS & BDS in Bangladesh <br>
            <span class="accent-emerald">for International Students</span>
        </h1>

        <div class="med-hero-tagline">
            <i class="fas fa-stethoscope"></i> Your Journey Towards a Successful Medical Career Starts Here!
        </div>

        <p class="med-hero-lead">
            Bangladesh is an attractive destination for international students seeking quality medical and dental education. With established medical institutions, clinical learning opportunities, experienced faculty members, and a diverse academic environment, Bangladesh offers opportunities for students who aspire to build a career in medicine and dentistry.
        </p>

        <div class="med-callout-box">
            <p>
                <strong>Springway BD</strong> is committed to guiding international students throughout their admission journey to medical and dental institutions in Bangladesh. Whether you are from India, Nepal, Pakistan, Egypt, or another country, our team is here to help you explore suitable educational opportunities and understand the admission process.
            </p>
            <div class="country-pills">
                <span class="country-pill">🇮🇳 India</span>
                <span class="country-pill">🇳🇵 Nepal</span>
                <span class="country-pill">🇵🇰 Pakistan</span>
                <span class="country-pill">🇪🇬 Egypt</span>
                <span class="country-pill">🇱🇰 Sri Lanka</span>
                <span class="country-pill">🌍 All Global Applicants</span>
            </div>
        </div>

        <div class="hero-btn-group">
            <a href="#consultation-form" class="btn-med-primary">
                <i class="fas fa-file-medical"></i> Apply for MBBS / BDS
            </a>
            <a href="https://wa.me/8801341558822?text=Hello%20Springway%20BD%2C%20I%20am%20interested%20in%20studying%20MBBS%2FBDS%20in%20Bangladesh." target="_blank" class="btn-med-secondary">
                <i class="fab fa-whatsapp"></i> Chat with Medical Advisor
            </a>
        </div>

        <div class="breadcrumb-trail" style="margin-top: 36px;">
            <a href="{{ route('home') }}">Home</a>
            <i class="fas fa-chevron-right" style="font-size:0.7rem;"></i>
            <span>Study in Bangladesh</span>
        </div>

    </div>
</section>

<!-- ===== TRUST HIGHLIGHTS BAR ===== -->
<div class="med-trust-bar">
    <div class="trust-grid">
        <div class="trust-item">
            <div class="trust-icon"><i class="fas fa-award"></i></div>
            <div>
                <div class="trust-title">Recognized Worldwide</div>
                <div class="trust-sub">BMDC, WHO, NMC & WFME eligible</div>
            </div>
        </div>
        <div class="trust-item">
            <div class="trust-icon"><i class="fas fa-book-reader"></i></div>
            <div>
                <div class="trust-title">100% English Medium</div>
                <div class="trust-sub">Curriculum taught in English</div>
            </div>
        </div>
        <div class="trust-item">
            <div class="trust-icon"><i class="fas fa-hospital"></i></div>
            <div>
                <div class="trust-title">Clinical Hospitals</div>
                <div class="trust-sub">High patient flow & hands-on rounds</div>
            </div>
        </div>
        <div class="trust-item">
            <div class="trust-icon"><i class="fas fa-hand-holding-dollar"></i></div>
            <div>
                <div class="trust-title">Affordable Fee Structure</div>
                <div class="trust-sub">Flexible instalment options</div>
            </div>
        </div>
    </div>
</div>

<!-- ===== DUAL PROGRAMS: MBBS & BDS ===== -->
<section class="programs-section">
    <div class="container">
        <div class="section-header">
            <div class="section-tag"><i class="fas fa-graduation-cap"></i> Medical & Dental Programs</div>
            <h2 class="section-title">Explore Your <span class="accent">Academic Pathways</span></h2>
            <p class="section-desc">Comprehensive support from college shortlisting to DGHS equivalence and clinical enrollment.</p>
        </div>

        <div class="programs-grid">

            <!-- Card 1: Study MBBS in Bangladesh -->
            <div class="program-card mbbs-card">
                <div>
                    <div class="program-badge badge-mbbs">
                        <i class="fas fa-stethoscope"></i> MBBS Program &bull; 5 Yrs + 1 Yr Internship
                    </div>
                    <h3 class="program-title">Study MBBS in Bangladesh</h3>
                    <p class="program-desc">
                        Are you planning to pursue an MBBS degree abroad? Bangladesh offers international students the opportunity to study medicine at eligible medical colleges under the country's medical education system.
                    </p>

                    <div class="program-guidance-heading">
                        <i class="fas fa-clipboard-check" style="color:#0284c7;"></i> Our team provides guidance regarding:
                    </div>

                    <ul class="program-list">
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span><strong>Medical college selection</strong> and admission opportunities.</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span><strong>Academic eligibility</strong> and admission requirements.</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span><strong>Application procedures</strong> and document preparation.</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span><strong>Tuition fees</strong> and admission-related information.</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span><strong>Admission documentation</strong> and application follow-up.</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span><strong>Pre-arrival</strong> and student support guidance.</span>
                        </li>
                    </ul>
                </div>

                <div class="program-card-footer">
                    <span style="font-size:0.85rem; font-weight:700; color:#0284c7;">
                        <i class="fas fa-user-graduate"></i> Open for Upcoming Session
                    </span>
                    <a href="#consultation-form" class="btn-med-primary" style="padding:10px 20px; font-size:0.88rem;">
                        Enquire for MBBS <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Card 2: Study BDS in Bangladesh -->
            <div class="program-card bds-card">
                <div>
                    <div class="program-badge badge-bds">
                        <i class="fas fa-tooth"></i> BDS Program &bull; Dental Surgery
                    </div>
                    <h3 class="program-title">Study BDS in Bangladesh</h3>
                    <p class="program-desc">
                        For students interested in dentistry, Bangladesh also offers opportunities to pursue Bachelor of Dental Surgery (BDS) programs at eligible dental colleges.
                    </p>

                    <div class="program-guidance-heading">
                        <i class="fas fa-clipboard-check" style="color:#0d9488;"></i> Springway BD assists prospective international students with:
                    </div>

                    <ul class="program-list">
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span><strong>Information about dental colleges</strong> in Bangladesh.</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span><strong>BDS admission requirements</strong> and eligibility.</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span><strong>Application and documentation</strong> guidance.</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span><strong>Tuition fee</strong> information.</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span><strong>Admission procedures</strong> and follow-up support.</span>
                        </li>
                    </ul>
                </div>

                <div class="program-card-footer">
                    <span style="font-size:0.85rem; font-weight:700; color:#0d9488;">
                        <i class="fas fa-tooth"></i> High-Demand Dentistry Seats
                    </span>
                    <a href="#consultation-form" class="btn-med-primary" style="background: linear-gradient(135deg, #0d9488 0%, #059669 100%); padding:10px 20px; font-size:0.88rem;">
                        Enquire for BDS <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===== WHY CHOOSE BANGLADESH ===== -->
<section class="why-section">
    <div class="container">
        <div class="section-header">
            <div class="section-tag"><i class="fas fa-star"></i> Key Advantages</div>
            <h2 class="section-title">Why Choose Bangladesh for <span class="accent">Medical & Dental Education?</span></h2>
            <p class="section-desc">A respected destination combining British-pattern medical curricula, high clinical patient volume, and cultural warmth.</p>
        </div>

        <div class="why-grid">

            <div class="why-card">
                <div class="why-icon"><i class="fas fa-university"></i></div>
                <h3 class="why-title">Eligible Institutions</h3>
                <p class="why-text">Opportunities to study MBBS and BDS at eligible institutions recognized by regulatory authorities worldwide.</p>
            </div>

            <div class="why-card">
                <div class="why-icon"><i class="fas fa-language"></i></div>
                <h3 class="why-title">English-Medium Instruction</h3>
                <p class="why-text">English-medium academic instruction in relevant programs, ensuring smooth learning and global exam readiness.</p>
            </div>

            <div class="why-card">
                <div class="why-icon"><i class="fas fa-hospital-user"></i></div>
                <h3 class="why-title">Clinical Learning & Practical Training</h3>
                <p class="why-text">Clinical learning and practical training opportunities with direct hands-on clinical exposure in attached teaching hospitals.</p>
            </div>

            <div class="why-card">
                <div class="why-icon"><i class="fas fa-users"></i></div>
                <h3 class="why-title">Multicultural Student Community</h3>
                <p class="why-text">A multicultural environment with international students from India, Nepal, the Middle East, and beyond.</p>
            </div>

            <div class="why-card">
                <div class="why-icon"><i class="fas fa-notes-medical"></i></div>
                <h3 class="why-title">Diverse Healthcare Settings</h3>
                <p class="why-text">Exposure to diverse healthcare settings, pathology spectrums, and tropical medicine cases rarely seen elsewhere.</p>
            </div>

            <div class="why-card">
                <div class="why-icon"><i class="fas fa-heart"></i></div>
                <h3 class="why-title">Culture & Hospitality</h3>
                <p class="why-text">Opportunities to experience Bangladeshi culture, warm hospitality, safe campus hostels, and familiar food traditions.</p>
            </div>

        </div>
    </div>
</section>

<!-- ===== OUR ADMISSION SUPPORT SERVICES ===== -->
<section class="support-section">
    <div class="container">
        <div class="section-header">
            <div class="section-tag"><i class="fas fa-hands-helping"></i> End-to-End Guidance</div>
            <h2 class="section-title">Our Admission <span class="accent">Support Services</span></h2>
            <p class="section-desc">At Springway BD, we aim to make the admission journey easier and more organized for international applicants.</p>
        </div>

        <div class="steps-grid">

            <div class="step-card">
                <div class="step-header">
                    <div class="step-number">1</div>
                    <div class="step-icon"><i class="fas fa-comments"></i></div>
                </div>
                <h3 class="step-name">Initial Consultation</h3>
                <p class="step-desc">Understand your academic background, career ambitions, and specific study goals.</p>
            </div>

            <div class="step-card">
                <div class="step-header">
                    <div class="step-number">2</div>
                    <div class="step-icon"><i class="fas fa-clipboard-check"></i></div>
                </div>
                <h3 class="step-name">Eligibility Assessment</h3>
                <p class="step-desc">Review your academic qualifications against applicable admission requirements and DGHS criteria.</p>
            </div>

            <div class="step-card">
                <div class="step-header">
                    <div class="step-number">3</div>
                    <div class="step-icon"><i class="fas fa-building-columns"></i></div>
                </div>
                <h3 class="step-name">College Selection</h3>
                <p class="step-desc">Explore suitable medical and dental institutions aligned with your budget and location preference.</p>
            </div>

            <div class="step-card">
                <div class="step-header">
                    <div class="step-number">4</div>
                    <div class="step-icon"><i class="fas fa-file-signature"></i></div>
                </div>
                <h3 class="step-name">Application Assistance</h3>
                <p class="step-desc">Get guidance with application forms, DGHS equivalence certificate, and required attested documents.</p>
            </div>

            <div class="step-card">
                <div class="step-header">
                    <div class="step-number">5</div>
                    <div class="step-icon"><i class="fas fa-envelope-open-text"></i></div>
                </div>
                <h3 class="step-name">Admission Follow-up</h3>
                <p class="step-desc">Receive active support throughout the application process until formal offer issuance and seat confirmation.</p>
            </div>

            <div class="step-card">
                <div class="step-header">
                    <div class="step-number">6</div>
                    <div class="step-icon"><i class="fas fa-plane-arrival"></i></div>
                </div>
                <h3 class="step-name">Pre-Arrival Guidance</h3>
                <p class="step-desc">Get information about student visa documentation, campus accommodation, and arrival arrangements.</p>
            </div>

        </div>
    </div>
</section>

<!-- ===== WHO CAN APPLY? ===== -->
<section class="eligibility-section">
    <div class="container">
        <div class="eligibility-card">
            
            <div class="eligibility-left">
                <div class="section-tag" style="background:rgba(255,255,255,0.15); color:#67e8f9; border-color:rgba(255,255,255,0.25); margin-bottom:14px;">
                    <i class="fas fa-user-check"></i> Applicant Profile
                </div>
                <h2>Who Can Apply?</h2>
                <p class="eligibility-lead">
                    International students who meet the applicable academic qualifications and admission criteria may apply for MBBS or BDS programs in Bangladesh.
                </p>
                <div class="eligibility-note">
                    <i class="fas fa-info-circle"></i>
                    Eligibility, required academic results, subject requirements, and other conditions depend on the official admission guidelines for the relevant academic session.
                </div>
            </div>

            <div class="eligibility-right">
                <h4><i class="fas fa-check-double"></i> General Prerequisites:</h4>
                <ul class="criteria-list">
                    <li><i class="fas fa-check"></i> 10+2 / 12th Standard with Physics, Chemistry & Biology (PCB)</li>
                    <li><i class="fas fa-check"></i> Minimum qualifying GPA / marks per DGHS session guidelines</li>
                    <li><i class="fas fa-check"></i> NEET Qualification (mandatory for Indian nationals)</li>
                    <li><i class="fas fa-check"></i> Valid International Passport</li>
                    <li><i class="fas fa-check"></i> Passing year criteria as per Ministry regulations</li>
                </ul>
            </div>

        </div>
    </div>
</section>

<!-- ===== CALLOUT BANNER ===== -->
<section class="cta-banner-section">
    <div class="container">
        <div class="cta-banner">
            <div class="cta-banner-content">
                <h2 class="cta-banner-title">Start Your Medical Education Journey in Bangladesh</h2>
                <div class="cta-banner-subtitle">Your dream of becoming a doctor or dentist deserves the right guidance.</div>
                <p class="cta-banner-desc">
                    Let Springway BD help you explore medical and dental education opportunities in Bangladesh. Contact our team today to learn more about admission requirements, available institutions, and application procedures.
                </p>
                <div class="cta-banner-brand">
                    <i class="fas fa-shield-alt"></i> Springway BD &ndash; Connecting Global Students with Educational Opportunities in Bangladesh.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CONTACT / CONSULTATION FORM ===== -->
<section class="med-form-section" id="consultation-form">
    <div class="container">
        <div class="med-form-wrapper">

            <div class="form-header-area">
                <span class="badge"><i class="fas fa-envelope-open-text"></i> Admissions Open</span>
                <h3>Know more about MBBS & BDS - Contact Here</h3>
                <p>Fill in your details below. Our senior medical admission specialists will review your academic profile and get back to you within 24 hours.</p>
            </div>

            @if(session('consultation_success'))
                <div style="background: #ecfdf5; border: 1.5px solid #10b981; color: #065f46; border-radius: 14px; padding: 18px 22px; margin-bottom: 24px; font-size: .95rem; display: flex; align-items: center; gap: 14px;">
                    <i class="fas fa-check-circle" style="font-size: 1.4rem; color: #10b981; flex-shrink: 0;"></i>
                    <div>
                        <strong style="display:block; margin-bottom: 2px;">Inquiry Received!</strong>
                        <span>{{ session('consultation_success') }}</span>
                    </div>
                </div>
            @endif

            <form action="{{ route('consultation.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="source" value="Study in Bangladesh (MBBS/BDS) Page">
                <input type="hidden" name="destination" value="Bangladesh (MBBS/BDS)">

                <div class="med-form-grid">

                    <div class="med-form-group">
                        <label for="name">Full Name <span class="req">*</span></label>
                        <input type="text" name="name" id="name" required class="med-form-control" placeholder="e.g. Rahul Sharma / Fatima Noor" value="{{ old('name') }}">
                    </div>

                    <div class="med-form-group">
                        <label for="phone">Phone / WhatsApp (with Country Code) <span class="req">*</span></label>
                        <input type="tel" name="phone" id="phone" required class="med-form-control" placeholder="e.g. +91 98765 43210 / +977 98..." value="{{ old('phone') }}">
                    </div>

                    <div class="med-form-group">
                        <label for="email">Email Address <span class="req">*</span></label>
                        <input type="email" name="email" id="email" required class="med-form-control" placeholder="yourname@gmail.com" value="{{ old('email') }}">
                    </div>

                    <div class="med-form-group">
                        <label for="education_level">Program of Interest <span class="req">*</span></label>
                        <select name="education_level" id="education_level" class="med-form-control" required>
                            <option value="">-- Select Program --</option>
                            <option value="MBBS (Bachelor of Medicine & Bachelor of Surgery)" {{ old('education_level') == 'MBBS (Bachelor of Medicine & Bachelor of Surgery)' ? 'selected' : '' }}>MBBS (Medicine & Surgery)</option>
                            <option value="BDS (Bachelor of Dental Surgery)" {{ old('education_level') == 'BDS (Bachelor of Dental Surgery)' ? 'selected' : '' }}>BDS (Dental Surgery)</option>
                            <option value="Both / Need Recommendation" {{ old('education_level') == 'Both / Need Recommendation' ? 'selected' : '' }}>Both / Need Counselor Guidance</option>
                        </select>
                    </div>

                    <div class="med-form-group">
                        <label for="country_origin">Country of Origin / Nationality <span class="req">*</span></label>
                        <select name="english_test" id="country_origin" class="med-form-control" required>
                            <option value="">-- Select Country --</option>
                            <option value="India">India</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Egypt">Egypt</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Middle East / GCC">Middle East / GCC</option>
                            <option value="Other Country">Other Country</option>
                        </select>
                    </div>

                    <div class="med-form-group">
                        <label for="academic_status">Current Academic Stage</label>
                        <select class="med-form-control" onchange="document.getElementById('med-message').value += (this.value ? ' [Academic Background: ' + this.value + ']' : '');">
                            <option value="">-- Select Background --</option>
                            <option value="12th Passed (PCB) - NEET Qualified">12th Passed (PCB) - NEET Qualified</option>
                            <option value="12th Passed (PCB) - Awaiting Results">12th Passed (PCB) - Awaiting Results</option>
                            <option value="12th Currently Appearing">12th Currently Appearing</option>
                            <option value="Other High School Equivalency">Other High School Equivalency</option>
                        </select>
                    </div>

                    <div class="med-form-group full-width">
                        <label for="med-message">Academic Results & Questions (Optional)</label>
                        <textarea name="message" id="med-message" class="med-form-control" placeholder="Share your 10th/12th PCB percentage, NEET score (if applicable), preferred medical college, or questions...">{{ old('message') }}</textarea>
                    </div>

                </div>

                <button type="submit" class="btn-med-submit">
                    <i class="fas fa-paper-plane"></i> Submit Medical Admission Inquiry
                </button>

                <div class="form-trust-badges">
                    <div class="trust-badge-item">
                        <i class="fas fa-check-circle"></i> 100% Free Initial Assessment
                    </div>
                    <div class="trust-badge-item">
                        <i class="fas fa-shield-alt"></i> Transparent College Fees
                    </div>
                    <div class="trust-badge-item">
                        <i class="fas fa-clock"></i> Response within 24 Hours
                    </div>
                    <div class="trust-badge-item">
                        <i class="fas fa-lock"></i> Strict Privacy Guaranteed
                    </div>
                </div>

            </form>

        </div>
    </div>
</section>

@endsection

