@extends('layouts.admin')

@section('title', 'Consultation Inquiries - Springway Admin')
@section('header_title', 'Consultation Inquiries')
@section('header_subtitle', 'Review and respond to messages submitted via website consultation forms')

@section('content')
<div class="space-y-8">

    <!-- Top Banner -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-3xl shadow-sm border border-slate-200">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-teal-600 mb-1">
                <i class="fa-solid fa-envelope-open-text"></i>
                <span>Direct Website Inquiries</span>
            </div>
            <h1 class="text-2xl font-heading font-extrabold text-navy-950">Book Consultation Messages</h1>
            <p class="text-sm text-slate-500 mt-1">
                Prospective students who filled out the consultation form on the Homepage and Contact page.
            </p>
        </div>

        <div class="flex items-center gap-3">
            @if($unseenCount > 0)
            <form action="{{ route('admin.consultations.mark_all_seen') }}" method="POST">
                @csrf
                <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-teal-50 hover:bg-teal-100 text-teal-700 border border-teal-200 font-bold text-xs transition shadow-sm">
                    <i class="fa-solid fa-check-double"></i>
                    <span>Mark All as Seen ({{ $unseenCount }})</span>
                </button>
            </form>
            @endif
        </div>
    </div>

    <!-- Metrics Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <!-- Total Inquiries -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Requests</span>
                <div class="w-10 h-10 rounded-2xl bg-blue-50 text-brand-blue flex items-center justify-center text-base">
                    <i class="fa-solid fa-inbox"></i>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-slate-900">{{ number_format($totalCount) }}</div>
            <p class="text-[11px] text-slate-400 mt-1 font-medium">All-time consultation submissions</p>
        </div>

        <!-- Unseen / New -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-rose-600">Unseen Messages</span>
                <div class="w-10 h-10 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-base">
                    <i class="fa-solid fa-envelope"></i>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-rose-600 flex items-center gap-2">
                <span>{{ number_format($unseenCount) }}</span>
                @if($unseenCount > 0)
                <span class="w-2.5 h-2.5 rounded-full bg-rose-500 animate-ping"></span>
                @endif
            </div>
            <p class="text-[11px] text-slate-400 mt-1 font-medium">Awaiting counselor review</p>
        </div>

        <!-- Today's Inquiries -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-teal-600">Today's Inquiries</span>
                <div class="w-10 h-10 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-base">
                    <i class="fa-solid fa-calendar-day"></i>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-teal-600">{{ number_format($todayCount) }}</div>
            <p class="text-[11px] text-slate-400 mt-1 font-medium">Received in last 24 hours</p>
        </div>

        <!-- Contacted -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">Contacted Students</span>
                <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-base">
                    <i class="fa-solid fa-paper-plane"></i>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-emerald-600">{{ number_format($contactedCount) }}</div>
            <p class="text-[11px] text-slate-400 mt-1 font-medium">Reached via Gmail / WhatsApp</p>
        </div>
    </div>

    <!-- Filters & Search Toolbar -->
    <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-sm space-y-4">
        
        <!-- Filter Tabs -->
        <div class="flex flex-wrap items-center gap-2 border-b border-slate-100 pb-4">
            <a href="{{ route('admin.consultations.index') }}"
               class="px-4 py-2 rounded-xl text-xs font-bold transition {{ !request()->has('filter') ? 'bg-navy-950 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                All Messages ({{ $totalCount }})
            </a>
            <a href="{{ route('admin.consultations.index', array_merge(request()->except('page'), ['filter' => 'unseen'])) }}"
               class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ request('filter') === 'unseen' ? 'bg-rose-600 text-white shadow-sm' : 'bg-rose-50 text-rose-700 hover:bg-rose-100' }}">
                <span class="w-2 h-2 rounded-full {{ request('filter') === 'unseen' ? 'bg-white' : 'bg-rose-500' }}"></span>
                <span>Unseen ({{ $unseenCount }})</span>
            </a>
            <a href="{{ route('admin.consultations.index', array_merge(request()->except('page'), ['filter' => 'seen'])) }}"
               class="px-4 py-2 rounded-xl text-xs font-bold transition {{ request('filter') === 'seen' ? 'bg-navy-950 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Seen ({{ $seenCount }})
            </a>
            <a href="{{ route('admin.consultations.index', array_merge(request()->except('page'), ['filter' => 'contacted'])) }}"
               class="px-4 py-2 rounded-xl text-xs font-bold transition {{ request('filter') === 'contacted' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}">
                Contacted ({{ $contactedCount }})
            </a>
            <a href="{{ route('admin.consultations.index', array_merge(request()->except('page'), ['filter' => 'in_progress'])) }}"
               class="px-4 py-2 rounded-xl text-xs font-bold transition {{ request('filter') === 'in_progress' ? 'bg-amber-600 text-white shadow-sm' : 'bg-amber-50 text-amber-700 hover:bg-amber-100' }}">
                In Progress
            </a>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.consultations.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3">
            @if(request('filter'))
                <input type="hidden" name="filter" value="{{ request('filter') }}">
            @endif

            <div class="lg:col-span-5 relative">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search by student name, email, phone, message..."
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-500 transition">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
            </div>

            <div class="lg:col-span-3">
                <select name="destination" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-500 bg-white">
                    <option value="">All Destinations</option>
                    @foreach($destinations as $dest)
                        <option value="{{ $dest }}" {{ request('destination') === $dest ? 'selected' : '' }}>{{ $dest }}</option>
                    @endforeach
                </select>
            </div>

            <div class="lg:col-span-2">
                <select name="source" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-500 bg-white">
                    <option value="">All Form Sources</option>
                    <option value="Home" {{ request('source') === 'Home' ? 'selected' : '' }}>Homepage</option>
                    <option value="Contact" {{ request('source') === 'Contact' ? 'selected' : '' }}>Contact Page</option>
                </select>
            </div>

            <div class="lg:col-span-2 flex items-center gap-2">
                <button type="submit"
                        class="flex-1 py-2.5 px-4 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs transition shadow-sm text-center">
                    Apply Filter
                </button>
                @if(request()->hasAny(['search', 'destination', 'source']))
                <a href="{{ route('admin.consultations.index', request('filter') ? ['filter' => request('filter')] : []) }}"
                   class="p-2.5 rounded-xl border border-slate-200 hover:bg-slate-100 text-slate-500 transition" title="Clear Filters">
                    <i class="fa-solid fa-rotate-right text-xs"></i>
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Messages List -->
    <div class="space-y-4">
        @forelse($consultations as $item)
        <div class="bg-white rounded-3xl p-5 sm:p-6 border transition-all duration-200 {{ !$item->is_seen ? 'border-teal-300 ring-2 ring-teal-500/10 shadow-md bg-gradient-to-r from-teal-50/20 via-white to-white' : 'border-slate-200/80 shadow-sm hover:shadow-md' }}">
            
            <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-5">
                
                <!-- Left: Student Info & Message Content -->
                <div class="flex-1 min-w-0 space-y-3">
                    
                    <!-- Header Badges & Timestamps -->
                    <div class="flex flex-wrap items-center gap-2">
                        <!-- Seen / Unseen Status -->
                        @if(!$item->is_seen)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                            <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                            <span>Unseen Message</span>
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                            <i class="fa-solid fa-check-double text-[10px] text-teal-600"></i>
                            <span>Seen</span>
                        </span>
                        @endif

                        <!-- Destination Badge -->
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-brand-blue border border-blue-200">
                            <i class="fa-solid fa-earth-americas text-[10px]"></i>
                            <span>{{ $item->destination ?: 'Not Specified' }}</span>
                        </span>

                        <!-- Source Badge -->
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-semibold bg-slate-100 text-slate-500">
                            <i class="fa-regular fa-window-maximize text-[9px]"></i>
                            <span>{{ $item->source }}</span>
                        </span>

                        <!-- Timestamp -->
                        <span class="text-xs text-slate-400 font-mono ml-auto">
                            <i class="fa-regular fa-clock text-[10px]"></i>
                            {{ $item->created_at->format('M d, Y h:i A') }} ({{ $item->created_at->diffForHumans() }})
                        </span>
                    </div>

                    <!-- Student Name & Contacts -->
                    <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-teal-600 to-sky-600 text-white font-extrabold flex items-center justify-center text-sm shadow-md">
                                {{ strtoupper(substr($item->name, 0, 2)) }}
                            </div>
                            <div>
                                <h3 class="text-base font-extrabold text-navy-950 flex items-center gap-2">
                                    <span>{{ $item->name }}</span>
                                    @if($item->status === 'contacted')
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">Contacted</span>
                                    @elseif($item->status === 'in_progress')
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-amber-100 text-amber-800">In Progress</span>
                                    @endif
                                </h3>
                                <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500 mt-0.5">
                                    <span class="flex items-center gap-1 font-mono text-slate-700">
                                        <i class="fa-solid fa-phone text-teal-600 text-[11px]"></i>
                                        {{ $item->phone }}
                                    </span>
                                    <span class="text-slate-300">&bull;</span>
                                    <span class="flex items-center gap-1 text-slate-700">
                                        <i class="fa-regular fa-envelope text-blue-600 text-[11px]"></i>
                                        {{ $item->email }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Academic Preferences (if from Contact page) -->
                    @if($item->education_level || $item->english_test)
                    <div class="flex flex-wrap items-center gap-2 text-xs pt-1">
                        @if($item->education_level)
                        <span class="px-2.5 py-1 rounded-lg bg-slate-50 border border-slate-200 text-slate-700 font-medium">
                            <strong class="text-slate-500">Education:</strong> {{ $item->education_level }}
                        </span>
                        @endif
                        @if($item->english_test)
                        <span class="px-2.5 py-1 rounded-lg bg-slate-50 border border-slate-200 text-slate-700 font-medium">
                            <strong class="text-slate-500">English:</strong> {{ $item->english_test }}
                        </span>
                        @endif
                    </div>
                    @endif

                    <!-- Student Message Box -->
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 text-xs sm:text-sm text-slate-700 leading-relaxed relative">
                        <div class="font-bold text-[11px] uppercase tracking-wider text-slate-400 mb-1 flex items-center gap-1.5">
                            <i class="fa-solid fa-quote-left text-teal-600 text-xs"></i>
                            <span>Student's Message:</span>
                        </div>
                        <p class="whitespace-pre-line">{{ $item->message ?: 'No message provided. The student booked a consultation request directly.' }}</p>
                    </div>

                    @if($item->notes)
                    <div class="text-xs text-amber-800 bg-amber-50/70 p-2.5 rounded-xl border border-amber-200 flex items-start gap-2">
                        <i class="fa-solid fa-note-sticky text-amber-600 mt-0.5"></i>
                        <div>
                            <strong>Counselor Internal Notes:</strong> {{ $item->notes }}
                        </div>
                    </div>
                    @endif

                </div>

                <!-- Right: Action Buttons (Gmail, WhatsApp, Seen Toggle, Status) -->
                <div class="lg:w-64 flex flex-col gap-2 pt-2 lg:pt-0 border-t lg:border-t-0 border-slate-100">
                    
                    <!-- Primary CTA: Contact via Gmail -->
                    <a href="{{ $item->gmail_compose_url }}" target="_blank"
                       onclick="markSeenAjax({{ $item->id }})"
                       class="inline-flex items-center justify-center gap-2.5 w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-rose-600 via-red-600 to-rose-700 hover:from-rose-700 hover:to-red-700 text-white text-xs font-bold shadow-md shadow-rose-600/20 transition group">
                        <i class="fa-brands fa-google text-white text-sm group-hover:scale-110 transition"></i>
                        <span>Contact via Gmail</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[9px] opacity-75"></i>
                    </a>

                    <!-- Secondary CTA: WhatsApp Chat -->
                    <a href="{{ $item->whatsapp_url }}" target="_blank"
                       onclick="markSeenAjax({{ $item->id }})"
                       class="inline-flex items-center justify-center gap-2 w-full py-2 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-sm transition">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        <span>WhatsApp Chat</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[9px] opacity-75"></i>
                    </a>

                    <div class="grid grid-cols-2 gap-2 pt-1">
                        <!-- Toggle Seen / Unseen -->
                        <form action="{{ route('admin.consultations.toggle_seen', $item->id) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit"
                                    class="w-full py-2 px-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold transition flex items-center justify-center gap-1.5"
                                    title="{{ $item->is_seen ? 'Mark as Unseen' : 'Mark as Seen' }}">
                                <i class="fa-regular {{ $item->is_seen ? 'fa-envelope' : 'fa-envelope-open' }} text-slate-500"></i>
                                <span>{{ $item->is_seen ? 'Mark Unseen' : 'Mark Seen' }}</span>
                            </button>
                        </form>

                        <!-- Open Detail & Manage Modal -->
                        <button type="button"
                                onclick="openManageModal({{ json_encode($item) }})"
                                class="w-full py-2 px-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold transition flex items-center justify-center gap-1.5">
                            <i class="fa-solid fa-pen-to-square text-slate-500"></i>
                            <span>Details</span>
                        </button>
                    </div>

                    <!-- Delete Button -->
                    <form action="{{ route('admin.consultations.destroy', $item->id) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this consultation message from {{ $item->name }}?');"
                          class="pt-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full py-1.5 px-3 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 text-[11px] font-semibold transition flex items-center justify-center gap-1">
                            <i class="fa-regular fa-trash-can"></i>
                            <span>Delete Inquiry</span>
                        </button>
                    </form>

                </div>

            </div>

        </div>
        @empty
        <div class="bg-white rounded-3xl p-12 text-center border border-slate-200 text-slate-400">
            <div class="w-16 h-16 mx-auto mb-3 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-2xl">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
            <h4 class="font-bold text-base text-slate-800">No consultation inquiries found</h4>
            <p class="text-xs text-slate-400 mt-1">When students submit the "Book Free Consultation" form on the website, their messages will appear here.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($consultations->hasPages())
    <div class="p-4 bg-white rounded-2xl border border-slate-200">
        {{ $consultations->links() }}
    </div>
    @endif

</div>

<!-- Manage / Quick View Consultation Modal -->
<div id="consultationModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-xl w-full border border-slate-200 overflow-hidden my-8 animate-fade-in max-h-[92vh] flex flex-col">
        
        <!-- Modal Header -->
        <div class="px-6 py-5 bg-gradient-to-r from-navy-950 via-navy-900 to-teal-950 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-teal-500/20 text-teal-300 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
                <div>
                    <h3 class="font-heading font-extrabold text-base text-white" id="modalStudentName">Consultation Details</h3>
                    <p class="text-xs text-teal-300" id="modalSourceTime">Submitted via website</p>
                </div>
            </div>
            <button onclick="closeManageModal()" class="text-slate-400 hover:text-white p-2">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6 overflow-y-auto space-y-5 flex-1 text-xs sm:text-sm">
            
            <!-- Quick Contacts Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 p-4 rounded-2xl bg-slate-50 border border-slate-200 text-xs">
                <div>
                    <span class="text-slate-400 block font-bold uppercase tracking-wider text-[10px]">Email Address</span>
                    <a href="" id="modalEmailLink" class="font-bold text-brand-blue hover:underline break-all"></a>
                </div>
                <div>
                    <span class="text-slate-400 block font-bold uppercase tracking-wider text-[10px]">Phone / WhatsApp</span>
                    <span id="modalPhone" class="font-bold text-slate-800 font-mono"></span>
                </div>
                <div>
                    <span class="text-slate-400 block font-bold uppercase tracking-wider text-[10px]">Target Destination</span>
                    <span id="modalDestination" class="font-bold text-slate-800"></span>
                </div>
                <div>
                    <span class="text-slate-400 block font-bold uppercase tracking-wider text-[10px]">Academic Background</span>
                    <span id="modalAcademics" class="font-bold text-slate-800"></span>
                </div>
            </div>

            <!-- Full Message -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Student Inquiry Message</label>
                <div class="p-4 rounded-2xl bg-teal-50/40 border border-teal-200/60 text-slate-800 whitespace-pre-line text-xs sm:text-sm leading-relaxed" id="modalMessage">
                </div>
            </div>

            <!-- Direct Contact Actions -->
            <div class="border-t border-slate-100 pt-4 space-y-2">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Direct Communication</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <a href="" id="modalGmailBtn" target="_blank"
                       class="inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs shadow-sm transition">
                        <i class="fa-brands fa-google"></i>
                        <span>Compose in Gmail</span>
                    </a>
                    <a href="" id="modalWhatsAppBtn" target="_blank"
                       class="inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition">
                        <i class="fa-brands fa-whatsapp"></i>
                        <span>WhatsApp Chat</span>
                    </a>
                </div>
            </div>

            <!-- Update Status & Notes Form -->
            <form id="modalStatusForm" method="POST" class="border-t border-slate-100 pt-4 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Update Stage / Status</label>
                    <select name="status" id="modalStatusSelect" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs outline-none bg-white font-semibold">
                        <option value="new">New Inquiry (Unaddressed)</option>
                        <option value="contacted">Contacted via Gmail / WhatsApp</option>
                        <option value="in_progress">In Progress (Session Scheduled)</option>
                        <option value="archived">Archived / Closed</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Internal Counselor Remarks / Notes</label>
                    <textarea name="notes" id="modalNotes" rows="3" placeholder="Add follow-up notes, discussion points, or appointment date..."
                              class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs outline-none focus:ring-2 focus:ring-teal-500"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-2">
                    <button type="button" onclick="closeManageModal()"
                            class="px-4 py-2 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-100 text-xs font-bold transition">
                        Close
                    </button>
                    <button type="submit"
                            class="px-5 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold shadow-sm transition">
                        Save Status & Notes
                    </button>
                </div>
            </form>

        </div>

    </div>
</div>

<script>
    function openManageModal(item) {
        document.getElementById('modalStudentName').textContent = item.name;
        document.getElementById('modalSourceTime').textContent = (item.source || 'Website') + ' • ' + (item.created_at ? new Date(item.created_at).toLocaleString() : '');
        
        document.getElementById('modalEmailLink').textContent = item.email;
        document.getElementById('modalEmailLink').href = 'mailto:' + item.email;
        document.getElementById('modalPhone').textContent = item.phone;
        document.getElementById('modalDestination').textContent = item.destination || 'Not Specified';
        
        let academics = [];
        if (item.education_level) academics.push(item.education_level);
        if (item.english_test) academics.push(item.english_test);
        document.getElementById('modalAcademics').textContent = academics.length ? academics.join(' • ') : 'Not Specified';

        document.getElementById('modalMessage').textContent = item.message || 'No additional message was written.';
        
        // Gmail URL
        const subject = encodeURIComponent('Regarding Your Free Consultation Request - Springway Education');
        const body = encodeURIComponent("Dear " + item.name + ",\n\nThank you for reaching out to Springway Education regarding your study plans in " + (item.destination || 'abroad') + ".\n\nOur counseling team has received your consultation request and would like to invite you for a 1-on-1 profile assessment and roadmap discussion.\n\nPlease let us know what day and time would be most convenient for you (in-person at our Sylhet office or online via WhatsApp/Meet).\n\nBest regards,\nSpringway Education Advisory Team\nKaniz Plaza (3rd Floor), Zindabazar, Sylhet\nPhone/WhatsApp: +880 1341 55 88 22\nWebsite: https://springwaybd.com");
        document.getElementById('modalGmailBtn').href = 'https://mail.google.com/mail/?view=cm&fs=1&to=' + encodeURIComponent(item.email) + '&su=' + subject + '&body=' + body;

        // WhatsApp URL
        let cleanPhone = (item.phone || '').replace(/[^0-9]/g, '');
        if (cleanPhone.startsWith('01')) cleanPhone = '88' + cleanPhone;
        const waText = encodeURIComponent("Hello " + item.name + ", this is Springway Education following up on your consultation request for " + (item.destination || 'study abroad') + ".");
        document.getElementById('modalWhatsAppBtn').href = 'https://wa.me/' + cleanPhone + '?text=' + waText;

        // Form Action
        document.getElementById('modalStatusForm').action = '/admin/consultations/' + item.id + '/status';
        document.getElementById('modalStatusSelect').value = item.status || 'new';
        document.getElementById('modalNotes').value = item.notes || '';

        document.getElementById('consultationModal').classList.remove('hidden');

        // Mark as seen in background
        if (!item.is_seen) {
            markSeenAjax(item.id);
        }
    }

    function closeManageModal() {
        document.getElementById('consultationModal').classList.add('hidden');
    }

    function markSeenAjax(id) {
        // Trigger quick view endpoint which marks as seen
        fetch('/admin/consultations/' + id + '/quick-view', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).catch(() => {});
    }

    // Close on escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeManageModal();
        }
    });
</script>
@endsection

