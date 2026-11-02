@extends('layouts.app')

@section('title', 'About Us – Springway Education | Leadership & Vision')
@section('meta_description', 'Learn about Springway Education, our founder Midhat Abduzzahir (Mishu), our core values, mission, and why hundreds of students trust us for studying abroad.')

@section('content')
<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero-grid"></div>
    <div class="page-hero-content">
        <div class="page-hero-badge">
            <i class="fas fa-university"></i> {{ $aboutContent['hero']->subtitle ?? 'Empowering Bangladeshi Students' }}
        </div>
        <h1 class="page-hero-title">
            @if(!empty($aboutContent['hero']->title))
                {{ $aboutContent['hero']->title }}
            @else
                Pioneering <span class="accent">Global Education</span> from Sylhet
            @endif
        </h1>
        <p class="page-hero-sub">
            {{ $aboutContent['hero']->content ?? 'Built on pillars of unwavering integrity, personalized guidance, and high visa success rates. We turn your dream of studying abroad into a concrete, achievable reality.' }}
        </p>
        <div class="breadcrumb-trail">
            <a href="{{ route('home') }}">Home</a>
            <i class="fas fa-chevron-right" style="font-size:0.7rem;"></i>
            <span>About Us</span>
        </div>
    </div>
</section>

<!-- Company Overview & Story -->
<section style="background:#fff; padding: 90px 0;">
    <div class="container">
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:60px; align-items:center;">
            <div>
                <div class="section-tag"><i class="fas fa-history"></i> Who We Are</div>
                <h2 class="section-title" style="text-align:left;">More Than A Consultancy, <span class="accent">Your Career Partner</span></h2>
                <p style="color:var(--gray); line-height:1.8; margin-bottom:16px;">
                    Headquartered at <strong>Kaniz Plaza (3rd Floor), Zindabazar, Sylhet</strong>, Springway Education was founded to eliminate the confusion, false assurances, and hidden pitfalls often associated with overseas education applications.
                </p>
                <p style="color:var(--gray); line-height:1.8; margin-bottom:24px;">
                    We believe every student brings unique academic strengths and career ambitions. From our initial complimentary profile mapping to university shortlisting, scholarships, mock visa sessions, and departure arrangements, our certified education counselors stand by you at every juncture.
                </p>
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px;">
                    <div style="background:var(--sky-light); padding:16px 20px; border-radius:12px; border-left:4px solid var(--blue);">
                        <strong style="color:var(--navy); font-size:1.1rem; display:block;">98% Visa Rate</strong>
                        <span style="font-size:0.82rem; color:var(--gray);">Proven track record across UK, Canada, & Australia</span>
                    </div>
                    <div style="background:var(--sky-light); padding:16px 20px; border-radius:12px; border-left:4px solid var(--sky);">
                        <strong style="color:var(--navy); font-size:1.1rem; display:block;">200+ Partners</strong>
                        <span style="font-size:0.82rem; color:var(--gray);">Direct institutional contracts and priority intakes</span>
                    </div>
                </div>
            </div>
            <div style="position:relative;">
                <div style="border-radius:20px; overflow:hidden; box-shadow:var(--shadow-lg);">
                    <img src="{{ !empty($aboutContent['hero']->image) ? $aboutContent['hero']->image : '/images/hero/slide1.jpg' }}" alt="Springway Student Counseling" style="width:100%; height:420px; object-fit:cover;">
                </div>
                <div style="position:absolute; bottom:-20px; right:-15px; background:var(--gradient); color:#fff; padding:20px 24px; border-radius:16px; box-shadow:var(--shadow-md); max-width:260px;">
                    <div style="font-size:1.8rem; font-weight:800; font-family:'Poppins',sans-serif;">100%</div>
                    <div style="font-size:0.8rem; opacity:0.9;">Transparent Counseling & No Hidden File Charges</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CEO Message Section -->
<section style="background:var(--gray-light); padding: 90px 0;">
    <div class="container">
        <div style="display:grid; grid-template-columns: 380px 1fr; gap:60px; align-items:center;">
            <div style="position:relative;">
                <div style="border-radius:20px; overflow:hidden; box-shadow:var(--shadow-lg);">
                    <img src="{{ !empty($aboutContent['ceo_message']->image) ? $aboutContent['ceo_message']->image : '/images/ceo.jpg' }}" alt="Midhat Abduzzahir (Mishu) – Founder & CEO" style="width:100%; height:460px; object-fit:cover; object-position:top;">
                </div>
                <div style="background:#fff; padding:16px 20px; border-radius:14px; box-shadow:var(--shadow-md); margin-top:-30px; margin-left:20px; margin-right:20px; position:relative; z-index:2; border:1px solid #e2e8f0; text-align:center;">
                    <div style="font-weight:800; font-family:'Poppins',sans-serif; color:var(--navy); font-size:1.05rem;">
                        {{ $aboutContent['ceo_message']->subtitle ?? 'Midhat Abduzzahir (Mishu)' }}
                    </div>
                    <div style="font-size:0.78rem; color:var(--gray);">Founder & CEO, Springway Education</div>
                </div>
            </div>

            <div>
                <div class="section-tag"><i class="fas fa-quote-left"></i> {{ $aboutContent['ceo_message']->subtitle ?? "CEO's Message" }}</div>
                <h2 class="section-title" style="text-align:left;">
                    {{ $aboutContent['ceo_message']->title ?? 'A Word From Our Leadership' }}
                </h2>
                <div class="quote-mark" style="font-size:3.5rem; line-height:1; color:var(--sky); font-family:serif; opacity:0.3; margin-bottom:-20px;">"</div>
                <p class="ceo-quote" style="font-size:1.15rem; font-weight:600; color:var(--navy); line-height:1.7; font-style:italic; margin-bottom:20px;">
                    @if(!empty($aboutContent['ceo_message']->content))
                        "{!! nl2br(e($aboutContent['ceo_message']->content)) !!}"
                    @else
                        "At Springway Education, we don't just process visa applications; we construct life pathways. Having walked this path myself, I founded this consultancy with a singular standard: radical honesty and absolute dedication to every aspiring student."
                    @endif
                </p>
                <p style="color:var(--gray); line-height:1.8; margin-bottom:20px;">
                    Under his leadership, Springway Education has evolved from a local consultancy in Sylhet to an internationally recognized agency with trusted university partnerships across the UK, Canada, Australia, and the US.
                </p>
                <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px; border-top:1px solid #e2e8f0; padding-top:20px;">
                    <div>
                        <div style="font-family:'Poppins',sans-serif; font-size:1.4rem; font-weight:800; color:var(--navy);">Midhat Abduzzahir (Mishu)</div>
                        <div style="font-size:0.84rem; color:var(--gray);">Founder & CEO, Springway Education</div>
                    </div>
                    <a href="https://wa.me/8801341558822" target="_blank" style="background:#25D366; color:#fff; padding:10px 18px; border-radius:50px; font-size:0.84rem; font-weight:700; display:inline-flex; align-items:center; gap:8px;">
                        <i class="fab fa-whatsapp"></i> Chat with CEO
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission, Vision & Core Values -->
<section style="background:#fff; padding: 90px 0;">
    <div class="container">
        <div class="section-header">
            <div class="section-tag"><i class="fas fa-compass"></i> {{ $aboutContent['mission_vision']->subtitle ?? 'Guiding Principles' }}</div>
            <h2 class="section-title">{{ $aboutContent['mission_vision']->title ?? 'Mission, Vision & Core Values' }}</h2>
            <p class="section-desc">
                {{ $aboutContent['mission_vision']->content ?? 'What fuels our relentless dedication to every student walking through our doors.' }}
            </p>
        </div>

        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap:28px;">
            <div style="background:var(--gray-light); border:1px solid #e2e8f0; border-radius:18px; padding:36px 28px; transition:var(--transition);">
                <div style="width:58px; height:58px; border-radius:14px; background:var(--gradient); color:#fff; display:flex; align-items:center; justify-content:center; font-size:1.4rem; margin-bottom:20px;">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3 style="font-family:'Poppins',sans-serif; font-size:1.2rem; color:var(--navy); margin-bottom:12px;">Our Mission</h3>
                <p style="color:var(--gray); font-size:0.92rem; line-height:1.7;">
                    To deliver transparent, individualized, and high-impact educational consultancy, connecting scholars with high-ranking institutions that match their talents and life vision.
                </p>
            </div>

            <div style="background:var(--gray-light); border:1px solid #e2e8f0; border-radius:18px; padding:36px 28px; transition:var(--transition);">
                <div style="width:58px; height:58px; border-radius:14px; background:var(--gradient); color:#fff; display:flex; align-items:center; justify-content:center; font-size:1.4rem; margin-bottom:20px;">
                    <i class="fas fa-eye"></i>
                </div>
                <h3 style="font-family:'Poppins',sans-serif; font-size:1.2rem; color:var(--navy); margin-bottom:12px;">Our Vision</h3>
                <p style="color:var(--gray); font-size:0.92rem; line-height:1.7;">
                    To be Bangladesh’s most trusted global education gateway, renowned for unmatched ethical standards, visa compliance, and enduring student mentorship.
                </p>
            </div>

            <div style="background:var(--gray-light); border:1px solid #e2e8f0; border-radius:18px; padding:36px 28px; transition:var(--transition);">
                <div style="width:58px; height:58px; border-radius:14px; background:var(--gradient); color:#fff; display:flex; align-items:center; justify-content:center; font-size:1.4rem; margin-bottom:20px;">
                    <i class="fas fa-gem"></i>
                </div>
                <h3 style="font-family:'Poppins',sans-serif; font-size:1.2rem; color:var(--navy); margin-bottom:12px;">
                    {{ $aboutContent['values']->title ?? 'Core Values' }}
                </h3>
                <p style="color:var(--gray); font-size:0.92rem; line-height:1.7;">
                    {{ $aboutContent['values']->content ?? 'Integrity in every recommendation, relentless attention to compliance detail, mutual respect, and lifelong support from enrollment through graduation.' }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Call to action -->
<section style="background:linear-gradient(135deg, #071342 0%, #0d2b8e 100%); color:#fff; padding:70px 0; text-align:center;">
    <div class="container" style="max-width:800px;">
        <h2 style="font-family:'Poppins',sans-serif; font-size:2.2rem; font-weight:800; margin-bottom:14px;">Ready to Explore Your Global Opportunities?</h2>
        <p style="color:rgba(255,255,255,0.8); line-height:1.7; margin-bottom:28px;">
            Book a complimentary one-on-one session with our senior counseling panel at Kaniz Plaza, Zindabazar, Sylhet or consult with us online.
        </p>
        <a href="{{ route('contact') }}" style="background:#fff; color:var(--navy); font-weight:800; padding:15px 36px; border-radius:50px; display:inline-flex; align-items:center; gap:8px; box-shadow:var(--shadow-md);">
            <i class="fas fa-calendar-check"></i> Book Free Consultation
        </a>
    </div>
</section>
@endsection
