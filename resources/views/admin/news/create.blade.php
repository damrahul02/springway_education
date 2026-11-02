@extends('layouts.admin')

@section('title', 'Create News Article - Admin Portal')
@section('header_title', 'Create New Article')
@section('header_subtitle', 'Draft or publish an educational article, visa notice, or scholarship announcement')

@section('header_actions')
<a href="{{ route('admin.news.index') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition">
    <i class="fa-solid fa-arrow-left"></i>
    <span>Back to News</span>
</a>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-xl shadow-slate-200/50 space-y-6">
            <!-- Title -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Article Title <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. UK September 2026 Intake: Top Universities Accepting Without IELTS"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#1a73e8] text-sm text-slate-800 transition font-medium">
            </div>

            <!-- Category & Publish status -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Category <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="category" list="category-suggestions" value="{{ old('category') }}" required placeholder="e.g. UK Admissions, Visa Updates..."
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#1a73e8] text-xs text-slate-800 transition">
                    <datalist id="category-suggestions">
                        <option value="UK Admissions">
                        <option value="Canada Visa">
                        <option value="Australia Updates">
                        <option value="USA Scholarships">
                        <option value="Visa Policy">
                        <option value="Success Stories">
                        <option value="Events & Seminars">
                    </datalist>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Publish Status
                    </label>
                    <label class="flex items-center gap-3 p-2.5 rounded-xl border border-slate-200 cursor-pointer hover:bg-slate-50 transition">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}
                            class="w-4 h-4 text-[#1a73e8] rounded border-slate-300 focus:ring-[#1a73e8]">
                        <span class="text-xs font-bold text-slate-700">Publish immediately on website</span>
                    </label>
                </div>
            </div>

            <!-- Summary / Excerpt -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Short Summary / Excerpt (Optional)
                </label>
                <textarea name="summary" rows="2" placeholder="Brief 1-2 sentence preview displayed on cards..."
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#1a73e8] text-xs text-slate-800 transition">{{ old('summary') }}</textarea>
            </div>

            <!-- Cover Image -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Cover Banner Image
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <span class="block text-[11px] text-slate-500 mb-1 font-semibold">Option A: Upload File</span>
                        <input type="file" name="image_file" accept="image/*"
                            class="block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-[#1a73e8] hover:file:bg-sky-100 cursor-pointer border border-slate-200 rounded-xl">
                    </div>
                    <div>
                        <span class="block text-[11px] text-slate-500 mb-1 font-semibold">Option B: Image URL</span>
                        <input type="text" name="image_url" value="{{ old('image_url') }}" placeholder="https://... or /images/hero/slide1.jpg"
                            class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#1a73e8] text-xs text-slate-800 transition">
                    </div>
                </div>
            </div>

            <!-- Full Article Content -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Article Full Content (HTML or formatted text) <span class="text-rose-500">*</span>
                </label>
                <textarea name="content" rows="14" required placeholder="Write your full article paragraphs here. You can use HTML paragraphs <p>, bold <b>, lists <ul> <li>, or plain text..."
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#1a73e8] text-sm text-slate-800 transition font-mono leading-relaxed">{{ old('content') }}</textarea>
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.news.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-navy-800 to-brand-blue text-white text-xs font-bold shadow-md shadow-blue-800/20 hover:from-brand-blue hover:to-brand-sky transition">
                    <i class="fa-solid fa-paper-plane mr-1.5"></i>
                    <span>Save & Publish Article</span>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

