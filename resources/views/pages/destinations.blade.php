@extends('layouts.app')

@section('title', 'Study Destinations – Springway Education | UK, Canada, Australia, USA & Europe')
@section('meta_description', 'Discover top global study destinations with Springway Education: UK, Canada, Australia, USA, Malaysia, Germany & New Zealand. Complete details on intakes, scholarships, and work visas.')

@section('content')
<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero-grid"></div>
    <div class="page-hero-content">
        <div class="page-hero-badge"><i class="fas fa-globe-americas"></i> {{ $destContent['hero']->subtitle ?? 'Global Horizons' }}</div>
        <h1 class="page-hero-title">
            @if(!empty($destContent['hero']->title))
                {{ $destContent['hero']->title }}
            @else
                Popular Study <span class="accent">Destinations</span>
            @endif
        </h1>
        <p class="page-hero-sub">
            {{ $destContent['hero']->content ?? 'Explore world-ranking universities across the United Kingdom, Canada, Australia, the United States, Malaysia, Germany, and beyond.' }}
        </p>
        <div class="breadcrumb-trail">
            <a href="{{ route('home') }}">Home</a>
            <i class="fas fa-chevron-right" style="font-size:0.7rem;"></i>
            <span>Destinations</span>
        </div>
    </div>
</section>

<!-- Country Destination Cards Grid -->
<section style="background:#fff; padding: 90px 0;">
    <div class="container">
        <div class="section-header">
            <div class="section-tag"><i class="fas fa-map-marked-alt"></i> Where Will You Study?</div>
            <h2 class="section-title">Explore Your <span class="accent">Next Destination</span></h2>
            <p class="section-desc">Key highlights, work permit regulations, and intake timelines across top educational hubs.</p>
        </div>

        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap:32px;">

            @forelse($destinationItems as $dest)
            <div style="background:#fff; border:1px solid #e2e8f0; border-radius:20px; overflow:hidden; box-shadow:var(--shadow-sm); transition:var(--transition);">
                <div style="height:150px; background:{{ $dest->gradient ?: 'linear-gradient(135deg, #012169, #1a73e8)' }}; display:flex; align-items:center; justify-content:center; color:#fff; font-size:4.5rem; position:relative;">
                    {{ $dest->flag }}
                    @if($dest->badge)
                    <span style="position:absolute; top:16px; right:16px; background:rgba(255,255,255,0.25); backdrop-filter:blur(8px); padding:4px 12px; border-radius:50px; font-size:0.75rem; font-weight:700;">{{ $dest->badge }}</span>
                    @endif
                </div>
                <div style="padding:28px 24px;">
                    <h3 style="font-family:'Poppins',sans-serif; font-size:1.35rem; font-weight:700; color:var(--navy); margin-bottom:6px;">{{ $dest->country }}</h3>
                    <p style="color:var(--gray); font-size:0.86rem; line-height:1.6; margin-bottom:18px;">
                        {{ $dest->description }}
                    </p>
                    @if($dest->intakes || $dest->post_study_work || $dest->extra_info)
                    <div style="background:var(--gray-light); border-radius:12px; padding:14px; margin-bottom:20px; font-size:0.82rem; line-height:1.7;">
                        @if($dest->intakes)
                        <div><strong>Intakes:</strong> {{ $dest->intakes }}</div>
                        @endif
                        @if($dest->post_study_work)
                        <div><strong>Post-Study Work:</strong> {{ $dest->post_study_work }}</div>
                        @endif
                        @if($dest->extra_info)
                        <div><strong>Key Corridor:</strong> {{ $dest->extra_info }}</div>
                        @endif
                    </div>
                    @endif
                    <a href="{{ $dest->link_url ?: route('contact') }}" style="display:block; text-align:center; background:var(--sky-light); color:var(--navy); font-weight:700; font-size:0.88rem; padding:11px; border-radius:10px; transition:var(--transition);">
                        {{ $dest->link_text ?: ('Explore ' . $dest->country . ' Admissions →') }}
                    </a>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align:center; padding: 40px; color:var(--gray);">
                <p>No study destinations available at the moment. Please check back soon!</p>
            </div>
            @endforelse

        </div>
    </div>
</section>
@endsection

