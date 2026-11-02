@extends('layouts.admin')

@section('title', 'Page Content CMS - ' . ucfirst($activeTab) . ' Page')
@section('header_title', 'Page Content CMS')
@section('header_subtitle', 'Edit text, headlines, descriptions, cards, and banners across all public website pages')

@section('header_actions')
<a href="{{ route($activeTab === 'home' ? 'home' : $activeTab) }}" target="_blank" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-sky-50 text-[#1a73e8] border border-sky-200 text-xs font-bold hover:bg-sky-100 transition">
    <i class="fa-solid fa-arrow-up-right-from-square"></i>
    <span>Preview {{ ucfirst($activeTab) }} Page</span>
</a>
@endsection

@section('content')
<!-- Page Tab Selector Bar -->
<div class="bg-white rounded-2xl p-2 border border-slate-200 shadow-sm mb-8 flex flex-wrap items-center gap-2">
    @php
        $tabList = [
            'about' => ['name' => 'About Us', 'icon' => 'fa-building-columns', 'color' => 'amber'],
            'services' => ['name' => 'Services', 'icon' => 'fa-briefcase', 'color' => 'blue'],
            'destinations' => ['name' => 'Destinations', 'icon' => 'fa-earth-americas', 'color' => 'emerald'],
            'process' => ['name' => 'Our Process', 'icon' => 'fa-diagram-project', 'color' => 'purple'],
            'contact' => ['name' => 'Contact Us', 'icon' => 'fa-envelope-open-text', 'color' => 'rose'],
            'home' => ['name' => 'Homepage', 'icon' => 'fa-house', 'color' => 'sky'],
        ];
    @endphp

    @foreach($tabList as $key => $tab)
    <a href="{{ route('admin.pages.index', ['tab' => $key]) }}"
       class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold transition {{ $activeTab === $key ? 'bg-gradient-to-r from-navy-800 to-brand-blue text-white shadow-md shadow-blue-700/20' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
        <i class="fa-solid {{ $tab['icon'] }} {{ $activeTab === $key ? 'text-sky-300' : 'text-slate-400' }}"></i>
        <span>{{ $tab['name'] }}</span>
    </a>
    @endforeach
</div>

@if($activeTab === 'services')
<!-- Service Cards / Boxes Management Section -->
<div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xl shadow-slate-200/40 mb-10">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 mb-6 border-b border-slate-100 gap-4">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider bg-blue-50 text-[#1a73e8]">
                    Interactive Components
                </span>
                <h3 class="text-lg font-extrabold text-slate-900">Service Boxes & Cards ({{ $serviceItems->count() }} Boxes)</h3>
            </div>
            <p class="text-xs text-slate-500 mt-1">
                Add, edit, or delete the service offering cards displayed in the 3-column grid on the public Services page and Homepage.
            </p>
        </div>

        <button type="button" onclick="document.getElementById('newServiceModal').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-navy-800 to-brand-blue text-white font-bold text-xs shadow-md shadow-blue-800/20 hover:from-brand-blue hover:to-brand-sky transition">
            <i class="fa-solid fa-plus"></i>
            <span>Add New Service Box</span>
        </button>
    </div>

    <!-- Grid of Current Service Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($serviceItems as $service)
        <div class="bg-slate-50/70 border border-slate-200/80 rounded-2xl p-5 flex flex-col justify-between hover:shadow-md transition group">
            <div>
                <!-- Top Row: Icon, Badge & Status -->
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-sky-100 text-[#1a73e8] flex items-center justify-center text-xl shadow-sm">
                        <i class="{{ $service->icon }}"></i>
                    </div>
                    <div class="flex items-center gap-1.5">
                        @if($service->badge)
                        <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-100 text-amber-800">
                            {{ $service->badge }}
                        </span>
                        @endif
                        <span class="px-2 py-0.5 rounded-md text-[10px] font-bold {{ $service->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-600' }}">
                            {{ $service->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>

                <!-- Title & Description -->
                <h4 class="font-extrabold text-sm text-slate-900 mb-2 group-hover:text-[#1a73e8] transition">
                    {{ $service->title }}
                </h4>
                <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed mb-4">
                    {{ $service->description }}
                </p>

                <!-- Features Checklist Preview -->
                @if(!empty($service->features))
                <div class="space-y-1 mb-4 border-t border-slate-200/60 pt-3">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Highlights ({{ count($service->features) }}):</p>
                    @foreach(array_slice($service->features, 0, 3) as $feat)
                    <div class="text-[11px] text-slate-600 flex items-center gap-1.5 truncate">
                        <i class="fa-solid fa-check text-sky-500 text-[10px]"></i>
                        <span class="truncate">{{ $feat }}</span>
                    </div>
                    @endforeach
                    @if(count($service->features) > 3)
                    <p class="text-[10px] text-slate-400 italic">+ {{ count($service->features) - 3 }} more highlights</p>
                    @endif
                </div>
                @endif
            </div>

            <!-- Footer: Actions & Link info -->
            <div class="pt-3 border-t border-slate-200 flex items-center justify-between mt-2">
                <span class="text-[11px] text-slate-500 truncate max-w-[120px]" title="{{ $service->link_text }}">
                    <i class="fa-solid fa-link text-slate-400 mr-1"></i> {{ $service->link_text }}
                </span>

                <div class="flex items-center gap-1">
                    <!-- Toggle Active Form -->
                    <form action="{{ route('admin.services.toggle', $service->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="p-1.5 rounded-lg text-xs {{ $service->is_active ? 'text-amber-600 hover:bg-amber-50' : 'text-emerald-600 hover:bg-emerald-50' }} transition" title="{{ $service->is_active ? 'Hide from public site' : 'Activate' }}">
                            <i class="fa-solid {{ $service->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                        </button>
                    </form>

                    <!-- Edit Button -->
                    <button type="button" onclick="openEditServiceModal({{ json_encode($service) }})" class="p-1.5 rounded-lg text-xs text-blue-600 hover:bg-blue-50 transition" title="Edit this service">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>

                    <!-- Delete Form -->
                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service box permanently?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-1.5 rounded-lg text-xs text-rose-500 hover:bg-rose-50 transition" title="Delete service">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-8 text-center text-slate-400">
            <p class="text-sm">No service boxes found. Click "+ Add New Service Box" to create one.</p>
        </div>
        @endforelse
    </div>
</div>
@endif

@if($activeTab === 'destinations')
<!-- Destination Cards Management Section -->
<div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xl shadow-slate-200/40 mb-10">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 mb-6 border-b border-slate-100 gap-4">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider bg-emerald-50 text-emerald-700">
                    Interactive Components
                </span>
                <h3 class="text-lg font-extrabold text-slate-900">Destination Cards ({{ $destinationItems->count() }} Destinations)</h3>
            </div>
            <p class="text-xs text-slate-500 mt-1">
                Add, edit, or delete the destination cards displayed on the public Destinations page and Homepage.
            </p>
        </div>

        <button type="button" onclick="document.getElementById('newDestinationModal').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold text-xs shadow-md shadow-emerald-700/20 hover:from-emerald-700 hover:to-teal-700 transition">
            <i class="fa-solid fa-plus"></i>
            <span>Add New Destination</span>
        </button>
    </div>

    <!-- Grid of Current Destination Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($destinationItems as $dest)
        <div class="bg-slate-50/70 border border-slate-200/80 rounded-2xl overflow-hidden flex flex-col justify-between hover:shadow-md transition group">
            <div>
                <!-- Flag & Gradient Banner Preview -->
                <div class="h-28 flex items-center justify-center text-4xl relative shadow-inner" style="background: {{ $dest->gradient ?: 'linear-gradient(135deg, #012169, #1a73e8)' }};">
                    <span>{{ $dest->flag }}</span>
                    @if($dest->badge)
                    <span class="absolute top-2 right-2 px-2 py-0.5 rounded-md text-[10px] font-bold bg-white/30 backdrop-blur-md text-white shadow-sm">
                        {{ $dest->badge }}
                    </span>
                    @endif
                    <span class="absolute bottom-2 left-2 px-1.5 py-0.5 rounded text-[9px] font-bold {{ $dest->is_active ? 'bg-emerald-500/90 text-white' : 'bg-slate-800/80 text-slate-200' }}">
                        {{ $dest->is_active ? 'Active' : 'Hidden' }}
                    </span>
                </div>

                <div class="p-4">
                    <h4 class="font-extrabold text-sm text-slate-900 mb-1 group-hover:text-[#1a73e8] transition flex items-center justify-between">
                        <span>{{ $dest->country }}</span>
                        <span class="text-[10px] text-slate-400 font-mono">#{{ $dest->sort_order }}</span>
                    </h4>
                    
                    @if($dest->short_detail)
                    <p class="text-[11px] font-semibold text-slate-600 mb-2 truncate" title="{{ $dest->short_detail }}">
                        {{ $dest->short_detail }}
                    </p>
                    @endif

                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-3">
                        {{ $dest->description }}
                    </p>

                    <div class="space-y-1 bg-white p-2.5 rounded-xl border border-slate-200/60 text-[11px] text-slate-600">
                        @if($dest->intakes)
                        <div class="truncate"><strong class="text-slate-800">Intakes:</strong> {{ $dest->intakes }}</div>
                        @endif
                        @if($dest->post_study_work)
                        <div class="truncate"><strong class="text-slate-800">PSW:</strong> {{ $dest->post_study_work }}</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Footer: Actions -->
            <div class="p-3 border-t border-slate-200/80 bg-white/60 flex items-center justify-between">
                <span class="text-[10px] text-slate-400 truncate max-w-[100px]" title="{{ $dest->link_text }}">
                    {{ $dest->link_text ?: 'Explore' }}
                </span>

                <div class="flex items-center gap-1">
                    <!-- Toggle Form -->
                    <form action="{{ route('admin.destinations.toggle', $dest->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="p-1.5 rounded-lg text-xs {{ $dest->is_active ? 'text-amber-600 hover:bg-amber-50' : 'text-emerald-600 hover:bg-emerald-50' }} transition" title="{{ $dest->is_active ? 'Hide from public site' : 'Activate' }}">
                            <i class="fa-solid {{ $dest->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                        </button>
                    </form>

                    <!-- Edit Button -->
                    <button type="button" onclick="openEditDestinationModal({{ json_encode($dest) }})" class="p-1.5 rounded-lg text-xs text-blue-600 hover:bg-blue-50 transition" title="Edit destination">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>

                    <!-- Delete Form -->
                    <form action="{{ route('admin.destinations.destroy', $dest->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this destination card permanently?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-1.5 rounded-lg text-xs text-rose-500 hover:bg-rose-50 transition" title="Delete destination">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-8 text-center text-slate-400">
            <p class="text-sm">No destinations found. Click "+ Add New Destination" to create one.</p>
        </div>
        @endforelse
    </div>
</div>
@endif

@if($activeTab === 'process')
<!-- Process Roadmap Steps Management Section -->
<div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xl shadow-slate-200/40 mb-10">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 mb-6 border-b border-slate-100 gap-4">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider bg-purple-50 text-purple-700">
                    Interactive Components
                </span>
                <h3 class="text-lg font-extrabold text-slate-900">Roadmap Steps ({{ $processSteps->count() }} Steps)</h3>
            </div>
            <p class="text-xs text-slate-500 mt-1">
                Add, edit, or delete the step-by-step roadmap cards displayed on the public Process page and Homepage.
            </p>
        </div>

        <button type="button" onclick="document.getElementById('newProcessModal').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-purple-700 to-indigo-600 text-white font-bold text-xs shadow-md shadow-purple-800/20 hover:from-purple-800 hover:to-indigo-700 transition">
            <i class="fa-solid fa-plus"></i>
            <span>Add New Process Step</span>
        </button>
    </div>

    <!-- List of Process Steps -->
    <div class="space-y-4">
        @forelse($processSteps as $step)
        <div class="bg-slate-50/70 border border-slate-200/80 rounded-2xl p-5 hover:shadow-md transition flex flex-col md:flex-row md:items-start justify-between gap-5 group">
            <div class="flex items-start gap-4 flex-1">
                <!-- Step Circle -->
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-navy-800 to-brand-blue text-white font-black text-lg flex items-center justify-center shrink-0 shadow-md shadow-blue-900/20">
                    {{ $step->formatted_number }}
                </div>

                <div class="space-y-1.5 flex-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <h4 class="font-extrabold text-sm text-slate-900 group-hover:text-[#1a73e8] transition">
                            {{ $step->title }}
                        </h4>
                        @if($step->badge)
                        <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-sky-100 text-[#0d2b8e]">
                            {{ $step->badge }}
                        </span>
                        @endif
                        <span class="px-2 py-0.5 rounded-md text-[10px] font-bold {{ $step->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-600' }}">
                            {{ $step->is_active ? 'Active' : 'Hidden' }}
                        </span>
                        <span class="text-[10px] text-slate-400 font-mono">Order: #{{ $step->sort_order }}</span>
                    </div>

                    <p class="text-xs text-slate-600 leading-relaxed">
                        {{ $step->description }}
                    </p>

                    @if($step->short_description)
                    <div class="text-[11px] text-slate-500 bg-white p-2.5 rounded-xl border border-slate-200/60 inline-flex items-center gap-2">
                        <span class="text-[9px] font-black uppercase tracking-wider text-slate-400 shrink-0">Homepage Text:</span>
                        <span class="italic text-slate-600">{{ $step->short_description }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-1 self-end md:self-center shrink-0 pt-2 md:pt-0 border-t md:border-t-0 border-slate-200">
                <!-- Toggle Form -->
                <form action="{{ route('admin.process.toggle', $step->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="p-2 rounded-lg text-xs {{ $step->is_active ? 'text-amber-600 hover:bg-amber-50' : 'text-emerald-600 hover:bg-emerald-50' }} transition" title="{{ $step->is_active ? 'Hide from public site' : 'Activate' }}">
                        <i class="fa-solid {{ $step->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                    </button>
                </form>

                <!-- Edit Button -->
                <button type="button" onclick="openEditProcessModal({{ json_encode($step) }})" class="p-2 rounded-lg text-xs text-blue-600 hover:bg-blue-50 transition" title="Edit this step">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>

                <!-- Delete Form -->
                <form action="{{ route('admin.process.destroy', $step->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this process step permanently?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 rounded-lg text-xs text-rose-500 hover:bg-rose-50 transition" title="Delete step">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="py-8 text-center text-slate-400">
            <p class="text-sm">No roadmap steps found. Click "+ Add New Process Step" to create one.</p>
        </div>
        @endforelse
    </div>
</div>
@endif

<!-- Section Cards for the Active Page -->
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-extrabold text-slate-900 flex items-center gap-2">
                <span>Editing: <span class="capitalize text-[#1a73e8]">{{ $activeTab }}</span> Page Headers & Details</span>
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Update the content sections below. Changes will immediately reflect on the live website.
            </p>
        </div>
    </div>

    @php
        // Standard sections based on active tab
        $definedSections = [
            'about' => [
                'hero' => ['label' => 'Hero Banner Header', 'desc' => 'Main headline and introduction subtitle at the top of About Us'],
                'ceo_message' => ['label' => 'Founder & CEO Message', 'desc' => 'Founder guidance, quote, and leader portrait image'],
                'mission_vision' => ['label' => 'Mission & Vision Statement', 'desc' => 'Institutional mission and future vision text'],
                'values' => ['label' => 'Core Values & Promises', 'desc' => 'Integrity, transparency, and student-first philosophy'],
            ],
            'services' => [
                'hero' => ['label' => 'Services Hero Banner', 'desc' => 'Top blue banner headline and introduction text at the very top of the Services page'],
                'support_promise' => ['label' => 'Services Grid Header (Above Service Cards)', 'desc' => 'The headline ("Designed for Your Success"), badge tag, and subtitle text directly above the service cards grid'],
            ],
            'destinations' => [
                'hero' => ['label' => 'Destinations Hero Header', 'desc' => 'Top header describing UK, Canada, Australia, USA, etc.'],
                'intake_notes' => ['label' => 'Upcoming Intakes & Deadlines Note', 'desc' => 'General advice regarding intake deadlines and visa slots'],
            ],
            'process' => [
                'hero' => ['label' => 'Process Roadmap Hero', 'desc' => 'Top header explaining the 6-step visa journey'],
                'timeline_note' => ['label' => 'Timeline & Duration Guidance', 'desc' => 'Average processing timeline and student checklist'],
            ],
            'contact' => [
                'hero' => ['label' => 'Contact Hero Header', 'desc' => 'Top headline inviting students to visit Kaniz Plaza or call'],
                'office_info' => ['label' => 'Office Hours & Notice', 'desc' => 'Walk-in hours (Sat-Thu 10am-7pm, Friday closed) and visiting notice'],
            ],
            'home' => [
                'hero_subtitle' => ['label' => 'Hero Subtitle', 'desc' => 'Primary taglines underneath the main slider'],
                'about_teaser' => ['label' => 'About Springway Homepage Teaser', 'desc' => 'Brief intro section highlighting Sylhet location and founder history'],
            ],
        ];

        $currentDef = $definedSections[$activeTab] ?? [];
    @endphp

    <div class="grid grid-cols-1 gap-8">
        @foreach($currentDef as $secKey => $secMeta)
            @php
                $item = $sections[$secKey] ?? null;
            @endphp
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xl shadow-slate-200/40">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 mb-6 border-b border-slate-100 gap-2">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider bg-sky-50 text-[#1a73e8]">
                                {{ $secKey }}
                            </span>
                            <h3 class="text-base font-extrabold text-slate-900">{{ $secMeta['label'] }}</h3>
                        </div>
                        <p class="text-xs text-slate-500 mt-1">{{ $secMeta['desc'] }}</p>
                    </div>

                    @if($item && $item->updated_at)
                    <span class="text-[11px] text-slate-400">
                        <i class="fa-regular fa-clock mr-1"></i> Last updated: {{ $item->updated_at->diffForHumans() }}
                    </span>
                    @endif
                </div>

                <form action="{{ route('admin.pages.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="page" value="{{ $activeTab }}">
                    <input type="hidden" name="section_key" value="{{ $secKey }}">

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Left Column: Titles & Content -->
                        <div class="space-y-5">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                    Section Title / Headline
                                </label>
                                <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}" placeholder="Enter headline or title..."
                                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#1a73e8] text-sm text-slate-800 transition">
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                    Subtitle / Caption
                                </label>
                                <input type="text" name="subtitle" value="{{ old('subtitle', $item->subtitle ?? '') }}" placeholder="Optional subtitle or badge text..."
                                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#1a73e8] text-sm text-slate-800 transition">
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                    Main Body Content
                                </label>
                                <textarea name="content" rows="6" placeholder="Enter paragraph text or detailed description for this section..."
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#1a73e8] text-sm text-slate-800 transition leading-relaxed">{{ old('content', $item->content ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- Right Column: Image or Media -->
                        <div class="space-y-5">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                    Associated Image / Illustration
                                </label>
                                
                                @if($item && $item->image)
                                <div class="mb-4 p-3 bg-slate-50 rounded-2xl border border-slate-200 flex items-center gap-4">
                                    <div class="w-20 h-20 rounded-xl overflow-hidden bg-slate-200 border border-slate-300 flex-shrink-0">
                                        <img src="{{ $item->image }}" alt="Current image" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-bold text-slate-800 truncate">Current Image</p>
                                        <p class="text-[11px] text-slate-500 truncate">{{ $item->image }}</p>
                                        <a href="{{ $item->image }}" target="_blank" class="inline-flex items-center gap-1 text-[11px] text-[#1a73e8] font-semibold hover:underline mt-1">
                                            <span>View Full Image</span>
                                            <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i>
                                        </a>
                                    </div>
                                </div>
                                @endif

                                <div class="space-y-3">
                                    <div>
                                        <span class="block text-[11px] text-slate-500 mb-1 font-semibold">Option A: Upload New Image File (JPG, PNG, WEBP, max 5MB)</span>
                                        <input type="file" name="image_file" accept="image/*"
                                            class="block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-[#1a73e8] hover:file:bg-sky-100 cursor-pointer border border-slate-200 rounded-xl">
                                    </div>

                                    <div>
                                        <span class="block text-[11px] text-slate-500 mb-1 font-semibold">Option B: Or Enter Image URL / Path</span>
                                        <input type="text" name="image_url" value="{{ old('image_url', $item->image ?? '') }}" placeholder="e.g. /images/hero1.jpg or https://..."
                                            class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#1a73e8] text-xs text-slate-800 transition">
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 rounded-2xl bg-sky-50/60 border border-sky-100 text-xs text-slate-600">
                                <p class="font-bold text-[#0d2b8e] mb-1">
                                    <i class="fa-solid fa-circle-info text-sky-500 mr-1"></i> Live Rendering Note
                                </p>
                                <p class="text-[11px] leading-relaxed text-slate-600">
                                    Once saved, this section is immediately pulled by the public page view template. If left empty, default fallbacks are preserved.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end pt-4 border-t border-slate-100">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-navy-800 to-brand-blue text-white font-bold text-xs shadow-md shadow-blue-800/20 hover:from-brand-blue hover:to-brand-sky transition">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <span>Save Section Changes</span>
                        </button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal: Add New Service Box -->
<div id="newServiceModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200 relative animate-fade-in max-h-[90vh] overflow-y-auto">
        <button type="button" onclick="document.getElementById('newServiceModal').classList.add('hidden')" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>

        <div class="mb-5">
            <h3 class="text-lg font-black text-slate-900">Add New Service Box</h3>
            <p class="text-xs text-slate-500 mt-0.5">Create a new offering card for the Services page grid</p>
        </div>

        <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Service Title <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="title" required placeholder="e.g. 7. Scholarship Assistance & Grants"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Icon (FontAwesome Class) <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="icon" id="new_service_icon" value="fas fa-graduation-cap" required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                <div class="flex flex-wrap gap-2 mt-2">
                    <span class="text-[10px] text-slate-400 font-semibold self-center">Quick pick:</span>
                    <button type="button" onclick="document.getElementById('new_service_icon').value='fas fa-comments'" class="px-2 py-0.5 bg-slate-100 hover:bg-sky-100 rounded text-[11px] text-slate-600"><i class="fas fa-comments mr-1"></i> Comments</button>
                    <button type="button" onclick="document.getElementById('new_service_icon').value='fas fa-university'" class="px-2 py-0.5 bg-slate-100 hover:bg-sky-100 rounded text-[11px] text-slate-600"><i class="fas fa-university mr-1"></i> University</button>
                    <button type="button" onclick="document.getElementById('new_service_icon').value='fas fa-passport'" class="px-2 py-0.5 bg-slate-100 hover:bg-sky-100 rounded text-[11px] text-slate-600"><i class="fas fa-passport mr-1"></i> Passport</button>
                    <button type="button" onclick="document.getElementById('new_service_icon').value='fas fa-award'" class="px-2 py-0.5 bg-slate-100 hover:bg-sky-100 rounded text-[11px] text-slate-600"><i class="fas fa-award mr-1"></i> Award</button>
                    <button type="button" onclick="document.getElementById('new_service_icon').value='fas fa-home'" class="px-2 py-0.5 bg-slate-100 hover:bg-sky-100 rounded text-[11px] text-slate-600"><i class="fas fa-home mr-1"></i> Housing</button>
                    <button type="button" onclick="document.getElementById('new_service_icon').value='fas fa-plane-departure'" class="px-2 py-0.5 bg-slate-100 hover:bg-sky-100 rounded text-[11px] text-slate-600"><i class="fas fa-plane-departure mr-1"></i> Flight</button>
                    <button type="button" onclick="document.getElementById('new_service_icon').value='fas fa-hand-holding-dollar'" class="px-2 py-0.5 bg-slate-100 hover:bg-sky-100 rounded text-[11px] text-slate-600"><i class="fas fa-hand-holding-dollar mr-1"></i> Scholarship</button>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Description <span class="text-rose-500">*</span>
                </label>
                <textarea name="description" rows="3" required placeholder="Describe what this service offers to students..."
                    class="w-full px-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8] leading-relaxed"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Key Features / Bullet Points (One per line)
                </label>
                <textarea name="features" rows="3" placeholder="Point 1&#10;Point 2&#10;Point 3"
                    class="w-full px-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8] leading-relaxed font-mono"></textarea>
                <span class="text-[10px] text-slate-400">Each line will become a bullet point with a checkmark.</span>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Button Label
                    </label>
                    <input type="text" name="link_text" value="Book Free Counseling" placeholder="e.g. Apply Now"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Button Link URL
                    </label>
                    <input type="text" name="link_url" value="/contact" placeholder="e.g. /contact"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Optional Badge
                    </label>
                    <input type="text" name="badge" placeholder="e.g. Popular, Free, New"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Sort Order
                    </label>
                    <input type="number" name="sort_order" value="{{ ($serviceItems->count() ?? 0) + 1 }}"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                </div>
            </div>

            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" name="is_active" value="1" id="new_is_active" checked class="w-4 h-4 text-[#1a73e8] rounded border-slate-300">
                <label for="new_is_active" class="text-xs font-semibold text-slate-700 cursor-pointer">Show on Public Website</label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('newServiceModal').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-gradient-to-r from-navy-800 to-brand-blue text-white text-xs font-bold shadow-md hover:from-brand-blue hover:to-brand-sky transition">
                    Create Service Box
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Edit Service Box -->
<div id="editServiceModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200 relative animate-fade-in max-h-[90vh] overflow-y-auto">
        <button type="button" onclick="document.getElementById('editServiceModal').classList.add('hidden')" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>

        <div class="mb-5">
            <h3 class="text-lg font-black text-slate-900">Edit Service Box</h3>
            <p class="text-xs text-slate-500 mt-0.5">Update details, highlights, or links for this service offering</p>
        </div>

        <form id="editServiceForm" action="" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Service Title <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="title" id="edit_service_title" required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Icon (FontAwesome Class) <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="icon" id="edit_service_icon" required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                <div class="flex flex-wrap gap-2 mt-2">
                    <span class="text-[10px] text-slate-400 font-semibold self-center">Quick pick:</span>
                    <button type="button" onclick="document.getElementById('edit_service_icon').value='fas fa-comments'" class="px-2 py-0.5 bg-slate-100 hover:bg-sky-100 rounded text-[11px] text-slate-600"><i class="fas fa-comments mr-1"></i> Comments</button>
                    <button type="button" onclick="document.getElementById('edit_service_icon').value='fas fa-university'" class="px-2 py-0.5 bg-slate-100 hover:bg-sky-100 rounded text-[11px] text-slate-600"><i class="fas fa-university mr-1"></i> University</button>
                    <button type="button" onclick="document.getElementById('edit_service_icon').value='fas fa-passport'" class="px-2 py-0.5 bg-slate-100 hover:bg-sky-100 rounded text-[11px] text-slate-600"><i class="fas fa-passport mr-1"></i> Passport</button>
                    <button type="button" onclick="document.getElementById('edit_service_icon').value='fas fa-award'" class="px-2 py-0.5 bg-slate-100 hover:bg-sky-100 rounded text-[11px] text-slate-600"><i class="fas fa-award mr-1"></i> Award</button>
                    <button type="button" onclick="document.getElementById('edit_service_icon').value='fas fa-home'" class="px-2 py-0.5 bg-slate-100 hover:bg-sky-100 rounded text-[11px] text-slate-600"><i class="fas fa-home mr-1"></i> Housing</button>
                    <button type="button" onclick="document.getElementById('edit_service_icon').value='fas fa-plane-departure'" class="px-2 py-0.5 bg-slate-100 hover:bg-sky-100 rounded text-[11px] text-slate-600"><i class="fas fa-plane-departure mr-1"></i> Flight</button>
                    <button type="button" onclick="document.getElementById('edit_service_icon').value='fas fa-hand-holding-dollar'" class="px-2 py-0.5 bg-slate-100 hover:bg-sky-100 rounded text-[11px] text-slate-600"><i class="fas fa-hand-holding-dollar mr-1"></i> Scholarship</button>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Description <span class="text-rose-500">*</span>
                </label>
                <textarea name="description" id="edit_service_description" rows="3" required
                    class="w-full px-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8] leading-relaxed"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Key Features / Bullet Points (One per line)
                </label>
                <textarea name="features" id="edit_service_features" rows="4"
                    class="w-full px-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8] leading-relaxed font-mono"></textarea>
                <span class="text-[10px] text-slate-400">Each line will become a bullet point with a checkmark.</span>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Button Label
                    </label>
                    <input type="text" name="link_text" id="edit_service_link_text"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Button Link URL
                    </label>
                    <input type="text" name="link_url" id="edit_service_link_url"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Optional Badge
                    </label>
                    <input type="text" name="badge" id="edit_service_badge" placeholder="e.g. Popular, Free, New"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Sort Order
                    </label>
                    <input type="number" name="sort_order" id="edit_service_sort_order"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                </div>
            </div>

            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" name="is_active" value="1" id="edit_service_is_active" class="w-4 h-4 text-[#1a73e8] rounded border-slate-300">
                <label for="edit_service_is_active" class="text-xs font-semibold text-slate-700 cursor-pointer">Show on Public Website</label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('editServiceModal').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-gradient-to-r from-navy-800 to-brand-blue text-white text-xs font-bold shadow-md hover:from-brand-blue hover:to-brand-sky transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Add New Destination Card -->
<div id="newDestinationModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200 relative animate-fade-in max-h-[90vh] overflow-y-auto">
        <button type="button" onclick="document.getElementById('newDestinationModal').classList.add('hidden')" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>

        <div class="mb-5">
            <h3 class="text-lg font-black text-slate-900">Add New Destination Card</h3>
            <p class="text-xs text-slate-500 mt-0.5">Create a new country card for the Destinations page & Homepage grid</p>
        </div>

        <form action="{{ route('admin.destinations.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-3 gap-3">
                <div class="col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Country Name <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="country" required placeholder="e.g. Ireland, Sweden, Japan"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Flag Emoji <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="flag" id="new_dest_flag" value="🌍" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 text-center text-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <!-- Quick pick emoji -->
            <div class="flex flex-wrap items-center gap-1.5 p-2.5 rounded-xl bg-slate-50 border border-slate-200/60">
                <span class="text-[10px] text-slate-400 font-semibold mr-1">Pick flag:</span>
                @foreach(['🇬🇧','🇨🇦','🇦🇺','🇺🇸','🇲🇾','🇩🇪','🇳🇿','🇮🇪','🇯🇵','🇰🇷','🇫🇷','🇸🇪','🇵🇭','🌍'] as $emoji)
                <button type="button" onclick="document.getElementById('new_dest_flag').value='{{ $emoji }}'" class="w-7 h-7 rounded bg-white hover:bg-emerald-50 border border-slate-200 text-sm flex items-center justify-center transition">{{ $emoji }}</button>
                @endforeach
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Banner Gradient (CSS)
                </label>
                <input type="text" name="gradient" id="new_dest_gradient" value="linear-gradient(135deg, #012169, #1a73e8)"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 font-mono focus:outline-none focus:ring-2 focus:ring-emerald-500">
                
                <!-- Quick presets for gradients -->
                <div class="flex flex-wrap gap-1.5 mt-2">
                    <span class="text-[10px] text-slate-400 font-semibold self-center">Presets:</span>
                    <button type="button" onclick="document.getElementById('new_dest_gradient').value='linear-gradient(135deg, #012169, #C8102E)'" class="px-2 py-0.5 rounded text-[10px] bg-slate-100 hover:bg-slate-200 text-slate-700">UK Navy/Red</button>
                    <button type="button" onclick="document.getElementById('new_dest_gradient').value='linear-gradient(135deg, #D80027, #8B0000)'" class="px-2 py-0.5 rounded text-[10px] bg-slate-100 hover:bg-slate-200 text-slate-700">Canada Red</button>
                    <button type="button" onclick="document.getElementById('new_dest_gradient').value='linear-gradient(135deg, #00008B, #00247D)'" class="px-2 py-0.5 rounded text-[10px] bg-slate-100 hover:bg-slate-200 text-slate-700">Australia Blue</button>
                    <button type="button" onclick="document.getElementById('new_dest_gradient').value='linear-gradient(135deg, #3C3B6E, #B22234)'" class="px-2 py-0.5 rounded text-[10px] bg-slate-100 hover:bg-slate-200 text-slate-700">USA Patriot</button>
                    <button type="button" onclick="document.getElementById('new_dest_gradient').value='linear-gradient(135deg, #000000, #DD0000, #FFCE00)'" class="px-2 py-0.5 rounded text-[10px] bg-slate-100 hover:bg-slate-200 text-slate-700">Germany Tricolor</button>
                    <button type="button" onclick="document.getElementById('new_dest_gradient').value='linear-gradient(135deg, #0d2b8e, #00aaff)'" class="px-2 py-0.5 rounded text-[10px] bg-slate-100 hover:bg-slate-200 text-slate-700">Springway Blue</button>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Badge Tag
                    </label>
                    <input type="text" name="badge" placeholder="e.g. #1 Choice, PR Pathway"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Homepage Short Detail
                    </label>
                    <input type="text" name="short_detail" placeholder="e.g. 50+ Universities · 2-Yr PSW"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Description <span class="text-rose-500">*</span>
                </label>
                <textarea name="description" rows="3" required placeholder="Describe educational benefits, degrees, and opportunities..."
                    class="w-full px-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 leading-relaxed"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Intakes
                    </label>
                    <input type="text" name="intakes" placeholder="e.g. September, January, May"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Post-Study Work (PSW)
                    </label>
                    <input type="text" name="post_study_work" placeholder="e.g. Up to 2 Years"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                    Key Highlights / Extra Info
                </label>
                <input type="text" name="extra_info" placeholder="e.g. Scholarships: Up to 50% waiver / Schengen access"
                    class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Button Label
                    </label>
                    <input type="text" name="link_text" value="Explore Admissions →" placeholder="e.g. Apply Now"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Button Link URL
                    </label>
                    <input type="text" name="link_url" value="/contact" placeholder="e.g. /contact"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 items-center">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Sort Order
                    </label>
                    <input type="number" name="sort_order" value="{{ ($destinationItems->count() ?? 0) + 1 }}"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="flex items-center gap-2 pt-4">
                    <input type="checkbox" name="is_active" value="1" id="new_dest_is_active" checked class="w-4 h-4 text-emerald-600 rounded border-slate-300">
                    <label for="new_dest_is_active" class="text-xs font-semibold text-slate-700 cursor-pointer">Show on Public Website</label>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('newDestinationModal').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-xs font-bold shadow-md hover:from-emerald-700 hover:to-teal-700 transition">
                    Create Destination Card
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Edit Destination Card -->
<div id="editDestinationModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200 relative animate-fade-in max-h-[90vh] overflow-y-auto">
        <button type="button" onclick="document.getElementById('editDestinationModal').classList.add('hidden')" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>

        <div class="mb-5">
            <h3 class="text-lg font-black text-slate-900">Edit Destination Card</h3>
            <p class="text-xs text-slate-500 mt-0.5">Update country information, highlights, or display styling</p>
        </div>

        <form id="editDestinationForm" action="" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-3 gap-3">
                <div class="col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Country Name <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="country" id="edit_dest_country" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Flag Emoji <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="flag" id="edit_dest_flag" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 text-center text-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <!-- Quick pick emoji -->
            <div class="flex flex-wrap items-center gap-1.5 p-2.5 rounded-xl bg-slate-50 border border-slate-200/60">
                <span class="text-[10px] text-slate-400 font-semibold mr-1">Pick flag:</span>
                @foreach(['🇬🇧','🇨🇦','🇦🇺','🇺🇸','🇲🇾','🇩🇪','🇳🇿','🇮🇪','🇯🇵','🇰🇷','🇫🇷','🇸🇪','🇵🇭','🌍'] as $emoji)
                <button type="button" onclick="document.getElementById('edit_dest_flag').value='{{ $emoji }}'" class="w-7 h-7 rounded bg-white hover:bg-emerald-50 border border-slate-200 text-sm flex items-center justify-center transition">{{ $emoji }}</button>
                @endforeach
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Banner Gradient (CSS)
                </label>
                <input type="text" name="gradient" id="edit_dest_gradient"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 font-mono focus:outline-none focus:ring-2 focus:ring-emerald-500">
                
                <!-- Quick presets for gradients -->
                <div class="flex flex-wrap gap-1.5 mt-2">
                    <span class="text-[10px] text-slate-400 font-semibold self-center">Presets:</span>
                    <button type="button" onclick="document.getElementById('edit_dest_gradient').value='linear-gradient(135deg, #012169, #C8102E)'" class="px-2 py-0.5 rounded text-[10px] bg-slate-100 hover:bg-slate-200 text-slate-700">UK Navy/Red</button>
                    <button type="button" onclick="document.getElementById('edit_dest_gradient').value='linear-gradient(135deg, #D80027, #8B0000)'" class="px-2 py-0.5 rounded text-[10px] bg-slate-100 hover:bg-slate-200 text-slate-700">Canada Red</button>
                    <button type="button" onclick="document.getElementById('edit_dest_gradient').value='linear-gradient(135deg, #00008B, #00247D)'" class="px-2 py-0.5 rounded text-[10px] bg-slate-100 hover:bg-slate-200 text-slate-700">Australia Blue</button>
                    <button type="button" onclick="document.getElementById('edit_dest_gradient').value='linear-gradient(135deg, #3C3B6E, #B22234)'" class="px-2 py-0.5 rounded text-[10px] bg-slate-100 hover:bg-slate-200 text-slate-700">USA Patriot</button>
                    <button type="button" onclick="document.getElementById('edit_dest_gradient').value='linear-gradient(135deg, #000000, #DD0000, #FFCE00)'" class="px-2 py-0.5 rounded text-[10px] bg-slate-100 hover:bg-slate-200 text-slate-700">Germany Tricolor</button>
                    <button type="button" onclick="document.getElementById('edit_dest_gradient').value='linear-gradient(135deg, #0d2b8e, #00aaff)'" class="px-2 py-0.5 rounded text-[10px] bg-slate-100 hover:bg-slate-200 text-slate-700">Springway Blue</button>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Badge Tag
                    </label>
                    <input type="text" name="badge" id="edit_dest_badge" placeholder="e.g. #1 Choice, PR Pathway"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Homepage Short Detail
                    </label>
                    <input type="text" name="short_detail" id="edit_dest_short_detail" placeholder="e.g. 50+ Universities · 2-Yr PSW"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Description <span class="text-rose-500">*</span>
                </label>
                <textarea name="description" id="edit_dest_description" rows="3" required
                    class="w-full px-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 leading-relaxed"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Intakes
                    </label>
                    <input type="text" name="intakes" id="edit_dest_intakes"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Post-Study Work (PSW)
                    </label>
                    <input type="text" name="post_study_work" id="edit_dest_post_study_work"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                    Key Highlights / Extra Info
                </label>
                <input type="text" name="extra_info" id="edit_dest_extra_info"
                    class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Button Label
                    </label>
                    <input type="text" name="link_text" id="edit_dest_link_text"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Button Link URL
                    </label>
                    <input type="text" name="link_url" id="edit_dest_link_url"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 items-center">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Sort Order
                    </label>
                    <input type="number" name="sort_order" id="edit_dest_sort_order"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="flex items-center gap-2 pt-4">
                    <input type="checkbox" name="is_active" value="1" id="edit_dest_is_active" class="w-4 h-4 text-emerald-600 rounded border-slate-300">
                    <label for="edit_dest_is_active" class="text-xs font-semibold text-slate-700 cursor-pointer">Show on Public Website</label>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('editDestinationModal').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-xs font-bold shadow-md hover:from-emerald-700 hover:to-teal-700 transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Add New Process Step -->
<div id="newProcessModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200 relative animate-fade-in max-h-[90vh] overflow-y-auto">
        <button type="button" onclick="document.getElementById('newProcessModal').classList.add('hidden')" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>

        <div class="mb-5">
            <h3 class="text-lg font-black text-slate-900">Add New Process Step</h3>
            <p class="text-xs text-slate-500 mt-0.5">Create a new sequential roadmap step for students</p>
        </div>

        <form action="{{ route('admin.process.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Step Number
                    </label>
                    <input type="text" name="step_number" value="{{ str_pad(($processSteps->count() ?? 0) + 1, 2, '0', STR_PAD_LEFT) }}" placeholder="e.g. 01, 07"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 text-center font-bold focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>

                <div class="col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Step Title <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="title" required placeholder="e.g. Visa Interview Prep"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Badge / Tagline
                </label>
                <input type="text" name="badge" placeholder="e.g. Duration: 45–60 mins · Cost: 100% Free"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-purple-600">
                <span class="text-[10px] text-slate-400">Highlighted tag displayed below the description on the Process page.</span>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Full Description (Process Page) <span class="text-rose-500">*</span>
                </label>
                <textarea name="description" rows="3" required placeholder="Detailed explanation of this phase in the student journey..."
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-purple-600 leading-relaxed"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Homepage Short Summary (Compact)
                </label>
                <textarea name="short_description" rows="2" placeholder="Brief 1-2 sentence version displayed on the homepage process grid..."
                    class="w-full px-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-purple-600 leading-relaxed"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-3 items-center">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Sort Order
                    </label>
                    <input type="number" name="sort_order" value="{{ ($processSteps->count() ?? 0) + 1 }}"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>

                <div class="flex items-center gap-2 pt-4">
                    <input type="checkbox" name="is_active" value="1" id="new_process_is_active" checked class="w-4 h-4 text-purple-600 rounded border-slate-300">
                    <label for="new_process_is_active" class="text-xs font-semibold text-slate-700 cursor-pointer">Show on Public Website</label>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('newProcessModal').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-gradient-to-r from-purple-700 to-indigo-600 text-white text-xs font-bold shadow-md hover:from-purple-800 hover:to-indigo-700 transition">
                    Create Process Step
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Edit Process Step -->
<div id="editProcessModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200 relative animate-fade-in max-h-[90vh] overflow-y-auto">
        <button type="button" onclick="document.getElementById('editProcessModal').classList.add('hidden')" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>

        <div class="mb-5">
            <h3 class="text-lg font-black text-slate-900">Edit Process Step</h3>
            <p class="text-xs text-slate-500 mt-0.5">Modify step title, description, badge, or display order</p>
        </div>

        <form id="editProcessForm" action="" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Step Number
                    </label>
                    <input type="text" name="step_number" id="edit_process_step_number" placeholder="e.g. 01, 07"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 text-center font-bold focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>

                <div class="col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Step Title <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="title" id="edit_process_title" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Badge / Tagline
                </label>
                <input type="text" name="badge" id="edit_process_badge" placeholder="e.g. Duration: 45–60 mins · Cost: 100% Free"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-purple-600">
                <span class="text-[10px] text-slate-400">Highlighted tag displayed below the description on the Process page.</span>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Full Description (Process Page) <span class="text-rose-500">*</span>
                </label>
                <textarea name="description" id="edit_process_description" rows="3" required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-purple-600 leading-relaxed"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Homepage Short Summary (Compact)
                </label>
                <textarea name="short_description" id="edit_process_short_description" rows="2"
                    class="w-full px-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-purple-600 leading-relaxed"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-3 items-center">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                        Sort Order
                    </label>
                    <input type="number" name="sort_order" id="edit_process_sort_order"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>

                <div class="flex items-center gap-2 pt-4">
                    <input type="checkbox" name="is_active" value="1" id="edit_process_is_active" class="w-4 h-4 text-purple-600 rounded border-slate-300">
                    <label for="edit_process_is_active" class="text-xs font-semibold text-slate-700 cursor-pointer">Show on Public Website</label>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('editProcessModal').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-gradient-to-r from-purple-700 to-indigo-600 text-white text-xs font-bold shadow-md hover:from-purple-800 hover:to-indigo-700 transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openEditServiceModal(service) {
        document.getElementById('editServiceForm').action = '/admin/services/' + service.id;
        document.getElementById('edit_service_title').value = service.title;
        document.getElementById('edit_service_icon').value = service.icon;
        document.getElementById('edit_service_description').value = service.description;
        
        let features = '';
        if (Array.isArray(service.features)) {
            features = service.features.join("\n");
        }
        document.getElementById('edit_service_features').value = features;
        
        document.getElementById('edit_service_link_text').value = service.link_text || 'Book Free Counseling';
        document.getElementById('edit_service_link_url').value = service.link_url || '/contact';
        document.getElementById('edit_service_badge').value = service.badge || '';
        document.getElementById('edit_service_sort_order').value = service.sort_order || 0;
        document.getElementById('edit_service_is_active').checked = !!service.is_active;

        document.getElementById('editServiceModal').classList.remove('hidden');
    }

    function openEditDestinationModal(dest) {
        document.getElementById('editDestinationForm').action = '/admin/destinations/' + dest.id;
        document.getElementById('edit_dest_country').value = dest.country;
        document.getElementById('edit_dest_flag').value = dest.flag;
        document.getElementById('edit_dest_gradient').value = dest.gradient || 'linear-gradient(135deg, #012169, #1a73e8)';
        document.getElementById('edit_dest_badge').value = dest.badge || '';
        document.getElementById('edit_dest_short_detail').value = dest.short_detail || '';
        document.getElementById('edit_dest_description').value = dest.description;
        document.getElementById('edit_dest_intakes').value = dest.intakes || '';
        document.getElementById('edit_dest_post_study_work').value = dest.post_study_work || '';
        document.getElementById('edit_dest_extra_info').value = dest.extra_info || '';
        document.getElementById('edit_dest_link_text').value = dest.link_text || 'Explore Admissions →';
        document.getElementById('edit_dest_link_url').value = dest.link_url || '/contact';
        document.getElementById('edit_dest_sort_order').value = dest.sort_order || 0;
        document.getElementById('edit_dest_is_active').checked = !!dest.is_active;

        document.getElementById('editDestinationModal').classList.remove('hidden');
    }

    function openEditProcessModal(step) {
        document.getElementById('editProcessForm').action = '/admin/process-steps/' + step.id;
        document.getElementById('edit_process_step_number').value = step.step_number || '';
        document.getElementById('edit_process_title').value = step.title;
        document.getElementById('edit_process_badge').value = step.badge || '';
        document.getElementById('edit_process_description').value = step.description;
        document.getElementById('edit_process_short_description').value = step.short_description || '';
        document.getElementById('edit_process_sort_order').value = step.sort_order || 0;
        document.getElementById('edit_process_is_active').checked = !!step.is_active;

        document.getElementById('editProcessModal').classList.remove('hidden');
    }
</script>
@endpush
@endsection
