@extends('layouts.admin')

@section('title', 'Photo & Video Gallery - Admin Portal')
@section('header_title', 'Photo & Video Gallery')
@section('header_subtitle', 'Manage student visa success photos, office moments, university seminars, and video tours')

@section('header_actions')
<button onclick="document.getElementById('upload-modal').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-navy-800 to-brand-blue text-white text-xs font-bold shadow-md shadow-blue-800/20 hover:from-brand-blue hover:to-brand-sky transition">
    <i class="fa-solid fa-cloud-arrow-up"></i>
    <span>Add Photo / Video</span>
</button>
@endsection

@section('content')
<!-- Filter Toolbar -->
<div class="bg-white rounded-2xl p-4 border border-slate-200 shadow-sm mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
    <div class="flex items-center gap-2 w-full sm:w-auto">
        <a href="{{ route('admin.gallery.index') }}"
           class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ !request()->has('type') ? 'bg-navy-800 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
            All Media
        </a>
        <a href="{{ route('admin.gallery.index', ['type' => 'image']) }}"
           class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ request('type') === 'image' ? 'bg-navy-800 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
            <i class="fa-regular fa-image mr-1"></i> Photos
        </a>
        <a href="{{ route('admin.gallery.index', ['type' => 'video']) }}"
           class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ request('type') === 'video' ? 'bg-navy-800 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
            <i class="fa-solid fa-play mr-1"></i> Videos
        </a>
    </div>

    <form action="{{ route('admin.gallery.index') }}" method="GET" class="flex items-center gap-2 w-full sm:w-auto">
        @if(request('type'))
            <input type="hidden" name="type" value="{{ request('type') }}">
        @endif
        <select name="category" onchange="this.form.submit()" class="px-3 py-1.5 rounded-xl border border-slate-200 text-xs text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>

        @if(request()->anyFilled(['type', 'category']))
        <a href="{{ route('admin.gallery.index') }}" class="px-2.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold" title="Clear Filters">
            <i class="fa-solid fa-rotate-left"></i>
        </a>
        @endif
    </form>
</div>

<!-- Gallery Grid -->
@if($items->count() > 0)
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @foreach($items as $item)
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col overflow-hidden group">
        <!-- Media Preview -->
        <div class="relative h-48 bg-slate-900 overflow-hidden">
            @if($item->type === 'video')
                <div class="w-full h-full relative">
                    <img src="{{ $item->thumbnail ?? '/images/hero/slide3.jpg' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-slate-950/40 flex items-center justify-center">
                        <div class="w-12 h-12 rounded-full bg-rose-600 text-white flex items-center justify-center text-lg shadow-lg">
                            <i class="fa-solid fa-play ml-0.5"></i>
                        </div>
                    </div>
                </div>
            @else
                <img src="{{ $item->url }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @endif

            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>

            <!-- Category & Type Pill -->
            <div class="absolute top-3 left-3 flex items-center gap-1.5">
                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-white/90 text-[#0d2b8e] backdrop-blur-md">
                    {{ $item->category }}
                </span>
                <span class="px-2 py-1 rounded-full text-[10px] font-bold {{ $item->type === 'video' ? 'bg-rose-500 text-white' : 'bg-sky-500 text-white' }}">
                    <i class="fa-solid {{ $item->type === 'video' ? 'fa-video' : 'fa-image' }}"></i>
                </span>
            </div>

            <!-- Featured Star -->
            <div class="absolute top-3 right-3">
                <form action="{{ route('admin.gallery.toggle', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-8 h-8 rounded-full backdrop-blur-md flex items-center justify-center transition {{ $item->is_featured ? 'bg-amber-400 text-white shadow-md shadow-amber-500/50' : 'bg-black/40 text-slate-300 hover:text-white' }}" title="{{ $item->is_featured ? 'Featured on home' : 'Click to feature' }}">
                        <i class="fa-solid fa-star text-xs"></i>
                    </button>
                </form>
            </div>

            <div class="absolute bottom-2 left-3 right-3 text-white text-[11px] truncate">
                <i class="fa-regular fa-clock mr-1 text-slate-300"></i> {{ $item->created_at->diffForHumans() }}
            </div>
        </div>

        <!-- Details -->
        <div class="p-4 flex-1 flex flex-col justify-between">
            <div>
                <h4 class="font-extrabold text-sm text-slate-900 group-hover:text-[#1a73e8] transition line-clamp-1">
                    {{ $item->title }}
                </h4>
                @if($item->caption)
                <p class="text-xs text-slate-500 line-clamp-2 mt-1 leading-relaxed">
                    {{ $item->caption }}
                </p>
                @endif
            </div>

            <!-- Action buttons -->
            <div class="pt-3 mt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                @if($item->type === 'video')
                <a href="{{ $item->url }}" target="_blank" class="text-rose-600 font-semibold hover:underline inline-flex items-center gap-1">
                    <span>Watch Video</span>
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                </a>
                @else
                <a href="{{ $item->url }}" target="_blank" class="text-sky-600 font-semibold hover:underline inline-flex items-center gap-1">
                    <span>Full Photo</span>
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                </a>
                @endif

                <div class="flex items-center gap-1">
                    <!-- Edit Button -->
                    <button onclick="openEditModal({{ json_encode($item) }})" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>

                    <!-- Delete Button -->
                    <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this media item?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-1.5 text-rose-500 hover:bg-rose-50 rounded-lg transition" title="Delete">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-8">
    {{ $items->links() }}
</div>
@else
<div class="bg-white rounded-3xl p-12 text-center border border-slate-200">
    <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-2xl mx-auto mb-4">
        <i class="fa-solid fa-photo-film"></i>
    </div>
    <h3 class="text-base font-bold text-slate-800">No gallery media yet</h3>
    <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Upload student visa pictures, events, office counseling sessions, or YouTube video tours.</p>
    <button onclick="document.getElementById('upload-modal').classList.remove('hidden')" class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 rounded-xl bg-[#1a73e8] text-white text-xs font-bold shadow-md hover:bg-[#0d2b8e] transition">
        <i class="fa-solid fa-cloud-arrow-up"></i>
        <span>Upload First Media</span>
    </button>
</div>
@endif

<!-- Upload Modal -->
<div id="upload-modal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200 relative animate-fade-in max-h-[90vh] overflow-y-auto">
        <button onclick="document.getElementById('upload-modal').classList.add('hidden')" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>

        <div class="mb-5">
            <h3 class="text-lg font-black text-slate-900">Upload Media to Gallery</h3>
            <p class="text-xs text-slate-500 mt-0.5">Add a photo or video to be displayed on the public gallery</p>
        </div>

        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Type -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Media Type</label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="flex items-center gap-2 p-3 rounded-xl border border-slate-200 cursor-pointer hover:bg-slate-50 transition">
                        <input type="radio" name="type" value="image" checked onchange="toggleMediaType(this.value)" class="text-[#1a73e8]">
                        <span class="text-xs font-bold text-slate-800"><i class="fa-regular fa-image mr-1 text-sky-500"></i> Photo</span>
                    </label>
                    <label class="flex items-center gap-2 p-3 rounded-xl border border-slate-200 cursor-pointer hover:bg-slate-50 transition">
                        <input type="radio" name="type" value="video" onchange="toggleMediaType(this.value)" class="text-[#1a73e8]">
                        <span class="text-xs font-bold text-slate-800"><i class="fa-solid fa-play mr-1 text-rose-500"></i> Video</span>
                    </label>
                </div>
            </div>

            <!-- Title -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Title <span class="text-rose-500">*</span></label>
                <input type="text" name="title" required placeholder="e.g. UK Visa Granted for Mr. Fahim"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
            </div>

            <!-- Category -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Category <span class="text-rose-500">*</span></label>
                <input type="text" name="category" list="cat-list" required placeholder="e.g. Visa Success, Events, Office Life..."
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                <datalist id="cat-list">
                    <option value="Visa Success">
                    <option value="Events & Seminars">
                    <option value="Office & Team">
                    <option value="Campus Tours">
                </datalist>
            </div>

            <!-- Photo Upload Inputs -->
            <div id="photo-inputs" class="space-y-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Upload Photo File (JPG, PNG, WEBP)</label>
                    <input type="file" name="image_file" accept="image/*"
                        class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-[#1a73e8] hover:file:bg-sky-100 cursor-pointer border border-slate-200 rounded-xl">
                </div>
                <div>
                    <span class="block text-[11px] text-slate-500 mb-1">Or Photo URL</span>
                    <input type="text" name="media_url" placeholder="/images/... or https://..."
                        class="w-full px-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                </div>
            </div>

            <!-- Video Inputs (hidden by default) -->
            <div id="video-inputs" class="space-y-3 hidden">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Video URL (YouTube or Vimeo) <span class="text-rose-500">*</span></label>
                    <input type="text" name="video_url_field" id="video_url_field" placeholder="https://www.youtube.com/watch?v=..."
                        class="w-full px-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Optional Thumbnail Image</label>
                    <input type="file" name="thumbnail_file" accept="image/*"
                        class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-[#1a73e8] hover:file:bg-sky-100 cursor-pointer border border-slate-200 rounded-xl">
                </div>
            </div>

            <!-- Caption -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Caption (Optional)</label>
                <textarea name="caption" rows="2" placeholder="Brief story or details..."
                    class="w-full px-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]"></textarea>
            </div>

            <!-- Featured Checkbox -->
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_featured" value="1" id="is_featured" class="w-4 h-4 text-[#1a73e8] rounded border-slate-300">
                <label for="is_featured" class="text-xs font-semibold text-slate-700 cursor-pointer">Feature on Homepage</label>
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('upload-modal').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-gradient-to-r from-navy-800 to-brand-blue text-white text-xs font-bold shadow-md hover:from-brand-blue hover:to-brand-sky transition">
                    Upload to Gallery
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="edit-modal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200 relative animate-fade-in max-h-[90vh] overflow-y-auto">
        <button onclick="document.getElementById('edit-modal').classList.add('hidden')" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>

        <div class="mb-5">
            <h3 class="text-lg font-black text-slate-900">Edit Media Details</h3>
            <p class="text-xs text-slate-500 mt-0.5">Update title, category, caption, or replacement media</p>
        </div>

        <form id="edit-form" action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="type" id="edit-type">

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Title <span class="text-rose-500">*</span></label>
                <input type="text" name="title" id="edit-title" required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Category <span class="text-rose-500">*</span></label>
                <input type="text" name="category" id="edit-category" list="cat-list" required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Media URL (Photo or Video URL)</label>
                <input type="text" name="media_url" id="edit-url"
                    class="w-full px-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Upload New Photo (optional replacement)</label>
                <input type="file" name="image_file" accept="image/*"
                    class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-[#1a73e8] hover:file:bg-sky-100 cursor-pointer border border-slate-200 rounded-xl">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Caption</label>
                <textarea name="caption" id="edit-caption" rows="2"
                    class="w-full px-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]"></textarea>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_featured" value="1" id="edit-featured" class="w-4 h-4 text-[#1a73e8] rounded border-slate-300">
                <label for="edit-featured" class="text-xs font-semibold text-slate-700 cursor-pointer">Feature on Homepage</label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('edit-modal').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-gradient-to-r from-navy-800 to-brand-blue text-white text-xs font-bold shadow-md hover:from-brand-blue hover:to-brand-sky transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function toggleMediaType(type) {
        const photoInputs = document.getElementById('photo-inputs');
        const videoInputs = document.getElementById('video-inputs');
        const videoField = document.getElementById('video_url_field');
        if (type === 'video') {
            photoInputs.classList.add('hidden');
            videoInputs.classList.remove('hidden');
            videoField.name = 'media_url';
        } else {
            photoInputs.classList.remove('hidden');
            videoInputs.classList.add('hidden');
            videoField.name = 'video_url_field';
        }
    }

    function openEditModal(item) {
        document.getElementById('edit-form').action = '/admin/gallery/' + item.id;
        document.getElementById('edit-title').value = item.title;
        document.getElementById('edit-type').value = item.type;
        document.getElementById('edit-category').value = item.category;
        document.getElementById('edit-url').value = item.url;
        document.getElementById('edit-caption').value = item.caption || '';
        document.getElementById('edit-featured').checked = !!item.is_featured;
        document.getElementById('edit-modal').classList.remove('hidden');
    }
</script>
@endpush
@endsection

