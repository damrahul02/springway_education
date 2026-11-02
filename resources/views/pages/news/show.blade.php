@extends('layouts.app')

@section('title', $post->title . ' – Springway Education')
@section('meta_description', Str::limit(strip_tags($post->summary ?: $post->content), 160))

@section('styles')
<style>
    .article-content {
        color: #1e293b;
        font-size: 1.05rem;
        line-height: 1.9;
    }
    .article-content h2, .article-content h3 {
        font-family: 'Poppins', sans-serif;
        color: var(--navy);
        margin: 28px 0 14px;
        font-weight: 700;
    }
    .article-content p {
        margin-bottom: 20px;
    }
    .article-content ul, .article-content ol {
        margin: 0 0 24px 24px;
        line-height: 1.8;
    }
    .article-content li {
        margin-bottom: 8px;
    }
    .article-content strong {
        color: var(--navy);
    }
</style>
@endsection

@section('content')
<!-- Article Header Hero -->
<section style="background: linear-gradient(135deg, #071342 0%, #0d2b8e 100%); color:#fff; padding: 70px 24px 50px;">
    <div class="container" style="max-width: 900px; text-align:center;">
        <div style="display:inline-block; background:rgba(255,255,255,0.15); backdrop-filter:blur(10px); padding:6px 16px; border-radius:50px; font-size:0.78rem; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:18px;">
            {{ $post->category }}
        </div>
        <h1 style="font-family:'Poppins',sans-serif; font-size:clamp(1.8rem, 4vw, 2.7rem); font-weight:800; line-height:1.3; margin-bottom:18px;">
            {{ $post->title }}
        </h1>
        <div style="display:flex; align-items:center; justify-content:center; gap:20px; font-size:0.86rem; color:rgba(255,255,255,0.7); flex-wrap:wrap;">
            <span><i class="far fa-calendar-alt"></i> {{ $post->published_at ? $post->published_at->format('F d, Y') : $post->created_at->format('F d, Y') }}</span>
            <span><i class="far fa-user"></i> Springway Editorial</span>
            <span><i class="far fa-eye"></i> {{ $post->views_count }} views</span>
        </div>
    </div>
</section>

<!-- Article Body -->
<section style="background:#fff; padding: 60px 0;">
    <div class="container" style="max-width: 900px;">
        @if($post->image)
            <div style="border-radius:20px; overflow:hidden; box-shadow:var(--shadow-md); margin-bottom:40px;">
                <img src="{{ $post->image }}" alt="{{ $post->title }}" style="width:100%; max-height:480px; object-fit:cover;">
            </div>
        @endif

        @if($post->summary)
            <div style="background:var(--sky-light); border-left:4px solid var(--blue); border-radius:12px; padding:20px 24px; font-size:1.1rem; font-weight:600; color:var(--navy); line-height:1.7; margin-bottom:32px;">
                {{ $post->summary }}
            </div>
        @endif

        <div class="article-content">
            {!! $post->content !!}
        </div>

        <!-- Share & Back -->
        <div style="border-top:1px solid #e2e8f0; border-bottom:1px solid #e2e8f0; padding:24px 0; margin:48px 0; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;">
            <div style="font-size:0.9rem; font-weight:700; color:var(--navy);">
                Share this announcement:
            </div>
            <div style="display:flex; gap:10px;">
                <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" style="width:36px; height:36px; border-radius:50%; background:#1877f2; color:#fff; display:flex; align-items:center; justify-content:center; font-size:0.9rem;">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->fullUrl()) }}" target="_blank" style="width:36px; height:36px; border-radius:50%; background:#25D366; color:#fff; display:flex; align-items:center; justify-content:center; font-size:0.9rem;">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->fullUrl()) }}" target="_blank" style="width:36px; height:36px; border-radius:50%; background:#000; color:#fff; display:flex; align-items:center; justify-content:center; font-size:0.9rem;">
                    <i class="fab fa-x-twitter"></i>
                </a>
            </div>
        </div>

        <!-- Related Stories -->
        @if($relatedPosts->isNotEmpty())
            <div style="margin-top:40px;">
                <h3 style="font-family:'Poppins',sans-serif; font-size:1.35rem; color:var(--navy); font-weight:800; margin-bottom:24px;">Related Updates</h3>
                <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap:20px;">
                    @foreach($relatedPosts as $rel)
                        <a href="{{ route('news.show', $rel->slug) }}" style="display:block; background:var(--gray-light); border-radius:14px; overflow:hidden; border:1px solid #e2e8f0; transition:var(--transition);" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='none'">
                            <img src="{{ $rel->image ?: '/images/hero/slide1.jpg' }}" alt="{{ $rel->title }}" style="width:100%; height:140px; object-fit:cover;">
                            <div style="padding:16px;">
                                <div style="font-size:0.72rem; color:var(--blue); font-weight:700; text-transform:uppercase;">{{ $rel->category }}</div>
                                <h4 style="font-family:'Poppins',sans-serif; font-size:0.95rem; font-weight:700; color:var(--navy); margin-top:4px; line-height:1.4;">
                                    {{ Str::limit($rel->title, 55) }}
                                </h4>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

