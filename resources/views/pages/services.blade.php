@extends('layouts.app')

@section('title', 'Our Services – Springway Education | Comprehensive Overseas Study Assistance')
@section('meta_description', 'Explore Springway Education services: Free Career Counseling, Direct University Admissions, Visa Documentation & Mock Interviews, IELTS Registration, Accommodation Support & Pre-Departure Briefings.')

@section('content')
<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero-grid"></div>
    <div class="page-hero-content">
        <div class="page-hero-badge"><i class="fas fa-cogs"></i> {{ $servicesContent['hero']->subtitle ?? 'Complete 360° Guidance' }}</div>
        <h1 class="page-hero-title">
            @if(!empty($servicesContent['hero']->title))
                {{ $servicesContent['hero']->title }}
            @else
                Our Study Abroad <span class="accent">Services</span>
            @endif
        </h1>
        <p class="page-hero-sub">
            {{ $servicesContent['hero']->content ?? 'From discovering your ideal university match to settling into your overseas dorm — explore our specialized student consultancy services.' }}
        </p>
        <div class="breadcrumb-trail">
            <a href="{{ route('home') }}">Home</a>
            <i class="fas fa-chevron-right" style="font-size:0.7rem;"></i>
            <span>Services</span>
        </div>
    </div>
</section>

<!-- Services Grid In-Depth -->
<section style="background:#fff; padding: 90px 0;">
    <div class="container">
        <div class="section-header">
            <div class="section-tag"><i class="fas fa-award"></i> {{ $servicesContent['support_promise']->subtitle ?? 'Professional Assistance' }}</div>
            <h2 class="section-title">
                @if(!empty($servicesContent['support_promise']->title))
                    {{ $servicesContent['support_promise']->title }}
                @else
                    Designed for <span class="accent">Your Success</span>
                @endif
            </h2>
            <p class="section-desc">
                {{ $servicesContent['support_promise']->content ?? 'Every step is engineered to maximize admissions offers, scholarship awards, and visa approvals.' }}
            </p>
        </div>

        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap:32px;">
            @forelse($serviceItems as $service)
            <div style="background:#fff; border:1.5px solid #e8edf8; border-radius:20px; padding:36px 30px; box-shadow:var(--shadow-sm); transition:var(--transition); position:relative; overflow:hidden;" class="group">
                @if($service->badge)
                <div style="position:absolute; top:20px; right:20px; background:var(--sky-light); color:var(--blue); font-weight:800; font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px; padding:4px 12px; border-radius:50px;">
                    {{ $service->badge }}
                </div>
                @endif
                <div style="width:64px; height:64px; border-radius:16px; background:var(--sky-light); color:var(--blue); display:flex; align-items:center; justify-content:center; font-size:1.8rem; margin-bottom:24px;">
                    <i class="{{ $service->icon }}"></i>
                </div>
                <h3 style="font-family:'Poppins',sans-serif; font-size:1.3rem; font-weight:700; color:var(--navy); margin-bottom:12px;">
                    {{ $service->title }}
                </h3>
                <p style="color:var(--gray); font-size:0.92rem; line-height:1.75; margin-bottom:20px;">
                    {{ $service->description }}
                </p>

                @if(!empty($service->features))
                <ul style="color:var(--dark); font-size:0.86rem; line-height:1.9; margin-bottom:24px;">
                    @foreach($service->features as $feature)
                    <li><i class="fas fa-check-circle" style="color:var(--sky); margin-right:8px;"></i> {{ $feature }}</li>
                    @endforeach
                </ul>
                @endif

                <a href="{{ $service->link_url ?: route('contact') }}" style="color:var(--blue); font-weight:700; font-size:0.88rem; display:inline-flex; align-items:center; gap:6px;">
                    {{ $service->link_text ?: 'Book Free Counseling' }} <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align:center; padding: 40px; color:var(--gray);">
                <p>No services currently published. Check back soon!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Bottom CTA Banner -->
<section style="background:var(--gray-light); padding: 80px 0;">
    <div class="container" style="background:var(--gradient); border-radius:24px; padding:60px 40px; color:#fff; text-align:center;">
        <h2 style="font-family:'Poppins',sans-serif; font-size:2.3rem; font-weight:800; margin-bottom:14px;">All Services Covered Under One Roof</h2>
        <p style="color:rgba(255,255,255,0.85); font-size:1.05rem; max-width:640px; margin:0 auto 30px; line-height:1.7;">
            Connect directly with Springway Education counselors at Kaniz Plaza, Zindabazar, Sylhet or start your process digitally from anywhere.
        </p>
        <a href="{{ route('contact') }}" style="background:#fff; color:var(--navy); font-weight:800; padding:15px 36px; border-radius:50px; display:inline-flex; align-items:center; gap:8px;">
            <i class="fas fa-paper-plane"></i> Request Free Consultation
        </a>
    </div>
</section>
@endsection
