@extends('layouts.app')

@section('title', 'News & Updates – Springway Education | Announcements, Visa Alerts & Events')
@section('meta_description', 'Stay informed with the latest international education announcements, university expos, visa regulation amendments, scholarship notices, and student success stories.')

@section('styles')
<style>
    .news-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        display: flex;
        flex-direction: column;
    }
    .news-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-md);
    }
    .news-img-wrap {
        position: relative;
        height: 220px;
        overflow: hidden;
    }
    .news-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .news-card:hover .news-img-wrap img {
        transform: scale(1.08);
    }
    .news-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        background: rgba(7, 19, 66, 0.8);
        backdrop-filter: blur(8px);
        color: #ffffff;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }
    .news-body {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .news-meta {
        display: flex;
        align-items: center;
        gap: 14px;
        font-size: 0.78rem;
        color: var(--gray);
        margin-bottom: 12px;
    }
    .news-meta span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .news-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--navy);
        line-height: 1.45;
        margin-bottom: 12px;
    }
    .news-title a { color: inherit; transition: color 0.25s ease; }
    .news-title a:hover { color: var(--blue); }
    .news-summary {
        font-size: 0.88rem;
        color: var(--gray);
        line-height: 1.7;
        margin-bottom: 20px;
    }
    .news-link {
        margin-top: auto;
        color: var(--blue);
        font-weight: 700;
        font-size: 0.88rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: gap 0.25s ease;
    }
    .news-link:hover { gap: 10px; }
</style>
@endsection

@section('content')
<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero-grid"></div>
    <div class="page-hero-content">
        <div class="page-hero-badge"><i class="fas fa-newspaper"></i> Official Updates</div>
        <h1 class="page-hero-title">Latest News & <span class="accent">Announcements</span></h1>
        <p class="page-hero-sub">
            Stay updated with global visa alerts, upcoming education expos in Sylhet, scholarship deadlines, and institutional delegation visits.
        </p>
        <div class="breadcrumb-trail">
            <a href="{{ route('home') }}">Home</a>
            <i class="fas fa-chevron-right" style="font-size:0.7rem;"></i>
            <span>News & Activities</span>
        </div>
    </div>
</section>

<!-- News Section -->
<section style="background:var(--gray-light); padding: 80px 0;">
    <div class="container">

        <!-- Search & Category Filter Bar -->
        <div style="background:#fff; border-radius:18px; padding:20px 24px; box-shadow:var(--shadow-sm); border:1px solid #e2e8f0; margin-bottom:48px; display:flex; justify-content:space-between; align-items:center; gap:20px; flex-wrap:wrap;">
            <!-- Categories -->
            <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                <a href="{{ route('news.index') }}" style="padding:7px 16px; border-radius:50px; font-size:0.82rem; font-weight:700; border:1px solid {{ !request('category') ? 'transparent' : '#e2e8f0' }}; background:{{ !request('category') ? 'var(--gradient)' : '#fff' }}; color:{{ !request('category') ? '#fff' : 'var(--navy)' }};">
                    All Categories
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('news.index', ['category' => $cat]) }}" style="padding:7px 16px; border-radius:50px; font-size:0.82rem; font-weight:700; border:1px solid {{ request('category') === $cat ? 'transparent' : '#e2e8f0' }}; background:{{ request('category') === $cat ? 'var(--gradient)' : '#fff' }}; color:{{ request('category') === $cat ? '#fff' : 'var(--navy)' }};">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <!-- Search -->
            <form action="{{ route('news.index') }}" method="GET" style="position:relative; min-width:240px;">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search news..." style="width:100%; padding:9px 14px 9px 36px; border:1px solid #cbd5e1; border-radius:50px; font-size:0.84rem; outline:none;">
                <i class="fas fa-search" style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:var(--gray); font-size:0.85rem;"></i>
            </form>
        </div>

        <!-- News Cards Grid -->
        <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap:32px;">
            @forelse($newsPosts as $post)
                <article class="news-card">
                    <div class="news-img-wrap">
                        <span class="news-badge">{{ $post->category }}</span>
                        <img src="{{ $post->image ?: '/images/hero/slide1.jpg' }}" alt="{{ $post->title }}">
                    </div>
                    <div class="news-body">
                        <div class="news-meta">
                            <span><i class="far fa-calendar-alt"></i> {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                            <span><i class="far fa-clock"></i> 3 min read</span>
                            @if($post->views_count > 0)
                                <span><i class="far fa-eye"></i> {{ $post->views_count }}</span>
                            @endif
                        </div>

                        <h2 class="news-title">
                            <a href="{{ route('news.show', $post->slug) }}">{{ $post->title }}</a>
                        </h2>

                        <p class="news-summary">
                            {{ Str::limit($post->summary, 120) }}
                        </p>

                        <a href="{{ route('news.show', $post->slug) }}" class="news-link">
                            Read Full Story <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </article>
            @empty
                <div style="grid-column: 1 / -1; text-align:center; padding:60px 20px; background:#fff; border-radius:18px; border:1px solid #e2e8f0;">
                    <i class="fas fa-newspaper" style="font-size:3rem; color:#cbd5e1; margin-bottom:14px; display:block;"></i>
                    <h3 style="color:var(--navy); font-size:1.2rem; margin-bottom:6px;">No news articles found</h3>
                    <p style="color:var(--gray); font-size:0.88rem;">Try searching with different terms or check back soon.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($newsPosts->hasPages())
            <div style="margin-top:48px; display:flex; justify-content:center;">
                {{ $newsPosts->links() }}
            </div>
        @endif
    </div>
</section>
@endsection

