@extends('layouts.app')

@section('title', 'Our 6-Step Process – Springway Education | Student Roadmap')
@section('meta_description', 'Discover Springway Education straightforward 6-step study abroad process: Consultation, Profile Assessment, University Shortlisting, Application, Visa Filing, and Departure.')

@section('content')
<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero-grid"></div>
    <div class="page-hero-content">
        <div class="page-hero-badge"><i class="fas fa-route"></i> {{ $processContent['hero']->subtitle ?? 'Seamless Journey' }}</div>
        <h1 class="page-hero-title">
            @if(!empty($processContent['hero']->title))
                {{ $processContent['hero']->title }}
            @else
                Your Pathway in <span class="accent">6 Simple Steps</span>
            @endif
        </h1>
        <p class="page-hero-sub">
            {{ $processContent['hero']->content ?? 'We transform a complex admissions and visa procedure into an organized, stress-free sequence where you are informed and confident at every phase.' }}
        </p>
        <div class="breadcrumb-trail">
            <a href="{{ route('home') }}">Home</a>
            <i class="fas fa-chevron-right" style="font-size:0.7rem;"></i>
            <span>Our Process</span>
        </div>
    </div>
</section>

<!-- Timeline Steps -->
<section style="background:#fff; padding: 90px 0;">
    <div class="container">
        <div class="section-header">
            <div class="section-tag"><i class="fas fa-list-ol"></i> Step-by-Step Roadmap</div>
            <h2 class="section-title">The Springway <span class="accent">Proven Framework</span></h2>
            <p class="section-desc">Follow our structured path tested across thousands of successful Bangladeshi scholars.</p>
        </div>

        <div style="display:flex; flex-direction:column; gap:40px; max-width:960px; margin:0 auto;">

            @forelse($processSteps as $step)
            <div style="display:grid; grid-template-columns: 80px 1fr; gap:28px; background:var(--gray-light); border:1px solid #e2e8f0; border-radius:20px; padding:32px 28px; transition:var(--transition);">
                <div style="width:72px; height:72px; border-radius:50%; background:var(--gradient); color:#fff; display:flex; align-items:center; justify-content:center; font-family:'Poppins',sans-serif; font-size:1.6rem; font-weight:800; box-shadow:var(--shadow-sm);">
                    {{ $step->formatted_number }}
                </div>
                <div>
                    <h3 style="font-family:'Poppins',sans-serif; font-size:1.3rem; color:var(--navy); margin-bottom:8px;">
                        {{ \Illuminate\Support\Str::startsWith($step->title, 'Step') ? $step->title : ('Step ' . (ltrim($step->formatted_number, '0') ?: $step->formatted_number) . ': ' . $step->title) }}
                    </h3>
                    <p style="color:var(--gray); line-height:1.75; font-size:0.92rem; margin-bottom:12px;">
                        {{ $step->description }}
                    </p>
                    @if($step->badge)
                    <span style="display:inline-block; background:var(--sky-light); color:var(--blue); font-size:0.78rem; font-weight:700; padding:4px 12px; border-radius:50px;">
                        {{ $step->badge }}
                    </span>
                    @endif
                </div>
            </div>
            @empty
            <div style="text-align:center; padding: 40px; color:var(--gray);">
                <p>No roadmap steps published at this time. Please check back soon!</p>
            </div>
            @endforelse

        </div>

        <div style="text-align:center; margin-top:50px;">
            <a href="{{ route('contact') }}" style="background:var(--gradient); color:#fff; font-weight:700; padding:15px 36px; border-radius:50px; display:inline-flex; align-items:center; gap:8px; box-shadow:var(--shadow-md);">
                <i class="fas fa-play"></i> Start Step 1 Today
            </a>
        </div>
    </div>
</section>
@endsection

