@extends('layouts.admin')

@section('title', 'News & Announcements - Admin Portal')
@section('header_title', 'News & Announcements')
@section('header_subtitle', 'Publish and manage educational updates, visa alerts, and scholarship news')

@section('header_actions')
<a href="{{ route('admin.news.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-navy-800 to-brand-blue text-white text-xs font-bold shadow-md shadow-blue-800/20 hover:from-brand-blue hover:to-brand-sky transition">
    <i class="fa-solid fa-plus"></i>
    <span>Create News Post</span>
</a>
@endsection

@section('content')
<!-- Filter & Search Toolbar -->
<div class="bg-white rounded-2xl p-4 border border-slate-200 shadow-sm mb-6">
    <form action="{{ route('admin.news.index') }}" method="GET" class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex-1 w-full sm:w-auto relative">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search news by title or content..."
                class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
        </div>

        <div class="flex items-center gap-2 w-full sm:w-auto">
            <select name="category" onchange="this.form.submit()" class="px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>

            <select name="status" onchange="this.form.submit()" class="px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                <option value="">All Status</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
            </select>

            @if(request()->anyFilled(['search', 'category', 'status']))
            <a href="{{ route('admin.news.index') }}" class="px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold transition" title="Clear Filters">
                <i class="fa-solid fa-rotate-left"></i>
            </a>
            @endif
        </div>
    </form>
</div>

<!-- News Cards Grid -->
@if($newsPosts->count() > 0)
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($newsPosts as $post)
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col overflow-hidden group">
        <!-- Thumbnail -->
        <div class="relative h-48 bg-slate-100 overflow-hidden">
            <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 via-transparent to-transparent"></div>

            <div class="absolute top-3 left-3">
                <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-white/95 text-[#0d2b8e] backdrop-blur-md shadow-sm">
                    {{ $post->category }}
                </span>
            </div>

            <div class="absolute top-3 right-3">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold {{ $post->is_published ? 'bg-emerald-500 text-white' : 'bg-slate-700 text-slate-200' }} shadow-sm">
                    <span class="w-1.5 h-1.5 rounded-full {{ $post->is_published ? 'bg-white' : 'bg-slate-400' }}"></span>
                    {{ $post->is_published ? 'Published' : 'Draft' }}
                </span>
            </div>

            <div class="absolute bottom-3 left-3 right-3 text-white text-[11px] flex items-center justify-between">
                <span><i class="fa-regular fa-calendar mr-1"></i> {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Unscheduled' }}</span>
                <span><i class="fa-regular fa-eye mr-1"></i> {{ $post->views_count ?? 0 }} views</span>
            </div>
        </div>

        <!-- Body -->
        <div class="p-5 flex-1 flex flex-col justify-between">
            <div>
                <h3 class="font-extrabold text-base text-slate-900 group-hover:text-[#1a73e8] transition line-clamp-2 leading-snug mb-2">
                    {{ $post->title }}
                </h3>
                <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                    {{ $post->summary }}
                </p>
            </div>

            <!-- Footer Actions -->
            <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-1">
                    <!-- Toggle Publish -->
                    <form action="{{ route('admin.news.toggle', $post->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="p-2 rounded-lg text-xs {{ $post->is_published ? 'text-amber-600 hover:bg-amber-50' : 'text-emerald-600 hover:bg-emerald-50' }} transition" title="{{ $post->is_published ? 'Unpublish to draft' : 'Publish live' }}">
                            <i class="fa-solid {{ $post->is_published ? 'fa-eye-slash' : 'fa-globe' }}"></i>
                        </button>
                    </form>

                    <!-- Edit -->
                    <a href="{{ route('admin.news.edit', $post->id) }}" class="p-2 rounded-lg text-xs text-blue-600 hover:bg-blue-50 transition" title="Edit Article">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>

                    <!-- View Live -->
                    <a href="{{ route('news.show', $post->slug) }}" target="_blank" class="p-2 rounded-lg text-xs text-slate-500 hover:bg-slate-100 transition" title="View Public Page">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                </div>

                <!-- Delete -->
                <form action="{{ route('admin.news.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 rounded-lg text-xs text-rose-500 hover:bg-rose-50 transition" title="Delete">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-8">
    {{ $newsPosts->links() }}
</div>
@else
<div class="bg-white rounded-3xl p-12 text-center border border-slate-200">
    <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-2xl mx-auto mb-4">
        <i class="fa-regular fa-newspaper"></i>
    </div>
    <h3 class="text-base font-bold text-slate-800">No news articles found</h3>
    <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Publish updates on university deadlines, visa rules, and student success stories.</p>
    <a href="{{ route('admin.news.create') }}" class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 rounded-xl bg-[#1a73e8] text-white text-xs font-bold shadow-md hover:bg-[#0d2b8e] transition">
        <i class="fa-solid fa-plus"></i>
        <span>Create First Article</span>
    </a>
</div>
@endif
@endsection

