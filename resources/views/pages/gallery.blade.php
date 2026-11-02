@extends('layouts.app')

@section('title', 'Photo & Video Gallery – Springway Education | Moments & Milestones')
@section('meta_description', 'View photo and video highlights from Springway Education: International Education Expos, university delegation visits, student visa celebrations, and pre-departure briefings.')

@section('styles')
<style>
    .filter-tabs {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 40px;
    }
    .filter-btn {
        padding: 9px 20px;
        border-radius: 50px;
        font-size: 0.86rem;
        font-weight: 600;
        border: 1.5px solid #e2e8f0;
        background: #ffffff;
        color: var(--navy);
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .filter-btn:hover,
    .filter-btn.active {
        background: var(--gradient);
        color: #ffffff;
        border-color: transparent;
        box-shadow: var(--shadow-sm);
    }
    .gallery-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        display: flex;
        flex-direction: column;
    }
    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }
    .gallery-thumb-wrap {
        position: relative;
        height: 230px;
        overflow: hidden;
        background: #060e2a;
        cursor: pointer;
    }
    .gallery-thumb-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .gallery-card:hover .gallery-thumb-wrap img {
        transform: scale(1.06);
    }
    .media-type-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        background: rgba(7, 19, 66, 0.75);
        backdrop-filter: blur(8px);
        color: #ffffff;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 50px;
        display: flex;
        align-items: center;
        gap: 5px;
        z-index: 2;
    }
    .video-play-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, 0.25);
        transition: background 0.3s ease;
    }
    .gallery-card:hover .video-play-overlay {
        background: rgba(0, 0, 0, 0.4);
    }
    .play-btn-circle {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.95);
        color: var(--blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease, background 0.3s ease;
    }
    .gallery-card:hover .play-btn-circle {
        transform: scale(1.15);
        background: var(--sky);
        color: #fff;
    }
    .gallery-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .gallery-category {
        font-size: 0.74rem;
        color: var(--blue);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 6px;
    }
    .gallery-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--navy);
        line-height: 1.4;
        margin-bottom: 8px;
    }
    .gallery-caption {
        font-size: 0.84rem;
        color: var(--gray);
        line-height: 1.6;
        margin-top: auto;
    }

    /* Modal Lightbox */
    .media-modal {
        position: fixed;
        inset: 0;
        background: rgba(4, 9, 31, 0.88);
        backdrop-filter: blur(10px);
        z-index: 2000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 24px;
    }
    .media-modal.active { display: flex; }
    .media-modal-box {
        position: relative;
        max-width: 900px;
        width: 100%;
        background: #000;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5);
    }
    .media-modal-close {
        position: absolute;
        top: 14px;
        right: 14px;
        z-index: 10;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        border: none;
        font-size: 1.4rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s ease;
    }
    .media-modal-close:hover { background: rgba(255, 255, 255, 0.4); }
</style>
@endsection

@section('content')
<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero-grid"></div>
    <div class="page-hero-content">
        <div class="page-hero-badge"><i class="fas fa-camera-retro"></i> Life at Springway</div>
        <h1 class="page-hero-title">Photo & Video <span class="accent">Gallery</span></h1>
        <p class="page-hero-sub">
            Glimpses of student seminars, university delegation symposiums, visa success celebrations, and pre-departure briefings.
        </p>
        <div class="breadcrumb-trail">
            <a href="{{ route('home') }}">Home</a>
            <i class="fas fa-chevron-right" style="font-size:0.7rem;"></i>
            <span>Gallery</span>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section style="background:var(--gray-light); padding: 80px 0;">
    <div class="container">

        <!-- Filter Controls -->
        <div class="filter-tabs">
            <a href="{{ route('gallery') }}" class="filter-btn {{ !request('type') && !request('category') ? 'active' : '' }}">
                <i class="fas fa-border-all"></i> All Media
            </a>
            <a href="{{ route('gallery', ['type' => 'image']) }}" class="filter-btn {{ request('type') === 'image' ? 'active' : '' }}">
                <i class="fas fa-image"></i> Photos Only
            </a>
            <a href="{{ route('gallery', ['type' => 'video']) }}" class="filter-btn {{ request('type') === 'video' ? 'active' : '' }}">
                <i class="fas fa-play-circle"></i> Videos Only
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('gallery', ['category' => $cat]) }}" class="filter-btn {{ request('category') === $cat ? 'active' : '' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        <!-- Gallery Grid -->
        <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap:28px;">
            @forelse($items as $item)
                <div class="gallery-card">
                    <div class="gallery-thumb-wrap" onclick="viewMedia('{{ $item->type }}', '{{ $item->isVideo() ? $item->embed_url : $item->url }}', '{{ addslashes($item->title) }}')">
                        <span class="media-type-badge">
                            <i class="fas {{ $item->isVideo() ? 'fa-video' : 'fa-camera' }}"></i>
                            {{ ucfirst($item->type) }}
                        </span>

                        @if($item->isVideo())
                            <img src="{{ $item->thumbnail ?: '/images/hero/slide4.jpg' }}" alt="{{ $item->title }}">
                            <div class="video-play-overlay">
                                <div class="play-btn-circle">
                                    <i class="fas fa-play" style="margin-left:3px;"></i>
                                </div>
                            </div>
                        @else
                            <img src="{{ $item->url }}" alt="{{ $item->title }}" onerror="this.src='/images/hero/slide1.jpg'">
                        @endif
                    </div>

                    <div class="gallery-body">
                        <div class="gallery-category">{{ $item->category }}</div>
                        <h3 class="gallery-title">{{ $item->title }}</h3>
                        @if($item->caption)
                            <p class="gallery-caption">{{ $item->caption }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align:center; padding:60px 20px; background:#fff; border-radius:18px; border:1px solid #e2e8f0;">
                    <i class="fas fa-images" style="font-size:3rem; color:#cbd5e1; margin-bottom:14px; display:block;"></i>
                    <h3 style="color:var(--navy); font-size:1.2rem; margin-bottom:6px;">No gallery items found</h3>
                    <p style="color:var(--gray); font-size:0.88rem;">Try clearing your filters or check back soon for fresh updates.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($items->hasPages())
            <div style="margin-top:48px; display:flex; justify-content:center;">
                {{ $items->links() }}
            </div>
        @endif
    </div>
</section>

<!-- Media Modal Viewer -->
<div class="media-modal" id="mediaModal" onclick="closeMediaModal(event)">
    <div class="media-modal-box" id="mediaBox" onclick="event.stopPropagation()">
        <button class="media-modal-close" onclick="closeMediaModal()" aria-label="Close">&times;</button>
        <div id="mediaContainer" style="line-height:0;"></div>
        <div id="mediaCaption" style="padding:16px 20px; color:#fff; font-size:0.95rem; font-weight:600; background:#071342;"></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function viewMedia(type, url, title) {
    const modal = document.getElementById('mediaModal');
    const container = document.getElementById('mediaContainer');
    const caption = document.getElementById('mediaCaption');

    caption.textContent = title;

    if (type === 'video') {
        container.innerHTML = `
            <div style="position:relative; padding-bottom:56.25%; height:0; overflow:hidden;">
                <iframe src="${url}?autoplay=1" style="position:absolute; top:0; left:0; width:100%; height:100%; border:none;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        `;
    } else {
        container.innerHTML = `
            <img src="${url}" alt="${title}" style="max-height:80vh; width:100%; object-fit:contain; display:block; margin:0 auto; background:#000;">
        `;
    }

    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeMediaModal(e) {
    if (e && e.target !== document.getElementById('mediaModal') && !e.target.classList.contains('media-modal-close')) {
        return;
    }
    const modal = document.getElementById('mediaModal');
    const container = document.getElementById('mediaContainer');
    modal.classList.remove('active');
    container.innerHTML = '';
    document.body.style.overflow = '';
}

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeMediaModal();
});
</script>
@endsection

