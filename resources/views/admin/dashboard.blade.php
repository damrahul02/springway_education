@extends('layouts.admin')

@section('title', $isAdmin ? 'Admin Dashboard - Lead Management' : 'Counselor Workspace')
@section('header_title', $isAdmin ? 'Admin Control Center' : 'Counselor Workspace')
@section('header_subtitle', $isAdmin ? 'Real-time overview of student consultations, applications, and counseling staff' : 'Manage your assigned student leads, follow-ups, and admissions')

@section('header_actions')
<button onclick="document.getElementById('newStudentModal').classList.remove('hidden')" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-xs font-bold shadow-md shadow-emerald-700/20 hover:from-emerald-700 hover:to-teal-700 transition">
    <i class="fa-solid fa-folder-plus"></i>
    <span>Create Student File</span>
</button>
@if($isAdmin)
<button onclick="document.getElementById('newUserModal').classList.remove('hidden')" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-gradient-to-r from-navy-800 to-brand-blue text-white text-xs font-bold shadow-md hover:from-brand-blue hover:to-brand-sky transition">
    <i class="fa-solid fa-user-plus"></i>
    <span>Add Counselor</span>
</button>
@endif
@endsection

@section('content')
<!-- Statistics Grid -->
<div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
    @if($isAdmin)
    <!-- Stat 1 -->
    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-md hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Leads</span>
            <div class="w-10 h-10 rounded-2xl bg-blue-50 text-[#1a73e8] flex items-center justify-center text-base">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>
        <div class="text-3xl font-black text-slate-900">{{ number_format($stats['total_leads'] ?? 0) }}</div>
        <p class="text-[11px] text-slate-400 mt-1 font-medium">All student consultation inquiries</p>
    </div>

    <!-- Stat 2 -->
    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-md hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">New Inquiries</span>
            <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-base">
                <i class="fa-solid fa-bell"></i>
            </div>
        </div>
        <div class="text-3xl font-black text-emerald-600">{{ number_format($stats['new_leads'] ?? 0) }}</div>
        <p class="text-[11px] text-slate-400 mt-1 font-medium">Pending initial contact</p>
    </div>

    <!-- Stat 3 -->
    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-md hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-bold uppercase tracking-wider text-amber-600">In Progress</span>
            <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-base">
                <i class="fa-solid fa-spinner"></i>
            </div>
        </div>
        <div class="text-3xl font-black text-amber-600">{{ number_format($stats['in_progress'] ?? 0) }}</div>
        <p class="text-[11px] text-slate-400 mt-1 font-medium">Active applications & counseling</p>
    </div>

    <!-- Stat 4 -->
    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-md hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-bold uppercase tracking-wider text-sky-600">Visas / Admitted</span>
            <div class="w-10 h-10 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-base">
                <i class="fa-solid fa-passport"></i>
            </div>
        </div>
        <div class="text-3xl font-black text-sky-600">{{ number_format($stats['successful'] ?? 0) }}</div>
        <p class="text-[11px] text-slate-400 mt-1 font-medium">Successful student milestones</p>
    </div>
    @else
    <!-- Counselor View Stats -->
    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-md">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">My Leads</span>
            <div class="w-10 h-10 rounded-2xl bg-blue-50 text-[#1a73e8] flex items-center justify-center text-base">
                <i class="fa-solid fa-user-check"></i>
            </div>
        </div>
        <div class="text-3xl font-black text-slate-900">{{ number_format($stats['my_assigned'] ?? 0) }}</div>
        <p class="text-[11px] text-slate-400 mt-1">Assigned directly to you</p>
    </div>

    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-md">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">Unassigned New</span>
            <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-base">
                <i class="fa-solid fa-hand-holding-hand"></i>
            </div>
        </div>
        <div class="text-3xl font-black text-emerald-600">{{ number_format($stats['unassigned_new'] ?? 0) }}</div>
        <p class="text-[11px] text-slate-400 mt-1">Available to claim & counsel</p>
    </div>

    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-md">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-bold uppercase tracking-wider text-amber-600">My In-Progress</span>
            <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-base">
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
        </div>
        <div class="text-3xl font-black text-amber-600">{{ number_format($stats['in_progress'] ?? 0) }}</div>
        <p class="text-[11px] text-slate-400 mt-1">Under your active processing</p>
    </div>

    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-md">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-bold uppercase tracking-wider text-sky-600">My Successes</span>
            <div class="w-10 h-10 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-base">
                <i class="fa-solid fa-award"></i>
            </div>
        </div>
        <div class="text-3xl font-black text-sky-600">{{ number_format($stats['my_success'] ?? 0) }}</div>
        <p class="text-[11px] text-slate-400 mt-1">Visas & admissions achieved</p>
    </div>
    @endif
</div>

<!-- Inquiries Section -->
<div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/40 mb-10 overflow-hidden">
    <!-- Header & Filters Bar -->
    <div class="p-6 border-b border-slate-100">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-4">
            <div>
                <h3 class="text-lg font-extrabold text-slate-900">Student Files & Leads ({{ $studentFiles->total() }})</h3>
                <p class="text-xs text-slate-500 mt-0.5">Database records of student applications, intake status, counselor assignments, and progress notes</p>
            </div>
            <button onclick="document.getElementById('newStudentModal').classList.remove('hidden')" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-xs font-bold shadow-md shadow-emerald-700/20 hover:from-emerald-700 hover:to-teal-700 transition self-start lg:self-auto">
                <i class="fa-solid fa-folder-plus"></i>
                <span>Create Student File</span>
            </button>
        </div>

        <form action="{{ route('admin.dashboard') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
            <!-- Search -->
            <div class="relative lg:col-span-2">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by student name, phone, email, country, course..."
                    class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
            </div>

            <!-- Status Filter -->
            <div>
                <select name="status" onchange="this.form.submit()" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                    <option value="">All Statuses</option>
                    <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
                    <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>Contacted</option>
                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="admitted" {{ request('status') === 'admitted' ? 'selected' : '' }}>Admitted</option>
                    <option value="visa_granted" {{ request('status') === 'visa_granted' ? 'selected' : '' }}>Visa Granted</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>

            <!-- Destination Filter -->
            <div>
                <select name="destination" onchange="this.form.submit()" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                    <option value="">All Destinations</option>
                    <option value="United Kingdom" {{ request('destination') === 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                    <option value="Canada" {{ request('destination') === 'Canada' ? 'selected' : '' }}>Canada</option>
                    <option value="Australia" {{ request('destination') === 'Australia' ? 'selected' : '' }}>Australia</option>
                    <option value="United States" {{ request('destination') === 'United States' ? 'selected' : '' }}>United States</option>
                    <option value="Malaysia" {{ request('destination') === 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                    <option value="Germany" {{ request('destination') === 'Germany' ? 'selected' : '' }}>Germany</option>
                </select>
            </div>

            <!-- Counselor Filter (Admin only) or Action -->
            <div class="flex items-center gap-2">
                @if($isAdmin)
                <select name="assigned_to" onchange="this.form.submit()" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                    <option value="">All Counselors</option>
                    <option value="unassigned" {{ request('assigned_to') === 'unassigned' ? 'selected' : '' }}>Unassigned Only</option>
                    @foreach($executives as $exec)
                    <option value="{{ $exec->id }}" {{ request('assigned_to') == $exec->id ? 'selected' : '' }}>{{ $exec->name }}</option>
                    @endforeach
                </select>
                @endif

                @if(request()->anyFilled(['search', 'status', 'destination', 'assigned_to']))
                <a href="{{ route('admin.dashboard') }}" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs" title="Reset Filters">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/80 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200/80">
                    <th class="py-3.5 px-6">Student Info</th>
                    <th class="py-3.5 px-4">Contact</th>
                    <th class="py-3.5 px-4">Destination</th>
                    <th class="py-3.5 px-4">Assigned To</th>
                    <th class="py-3.5 px-4">Status</th>
                    <th class="py-3.5 px-4">Received</th>
                    <th class="py-3.5 px-6 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                @forelse($studentFiles as $item)
                <tr class="hover:bg-slate-50/60 transition group">
                    <!-- Student Info -->
                    <td class="py-4 px-6">
                        <div class="font-extrabold text-slate-900 text-sm group-hover:text-[#1a73e8] transition">
                            {{ $item->name }}
                        </div>
                        @if($item->desired_course)
                        <div class="text-[11px] font-semibold text-slate-800 mt-1 flex items-center gap-1.5">
                            <i class="fa-solid fa-graduation-cap text-[#1a73e8]"></i>
                            <span>{{ $item->desired_course }}</span>
                            @if($item->intake)
                            <span class="px-1.5 py-0.5 rounded text-[10px] bg-slate-100 text-slate-600 font-mono">({{ $item->intake }})</span>
                            @endif
                        </div>
                        @elseif($item->intake)
                        <div class="text-[10px] text-slate-500 font-mono mt-0.5">
                            <i class="fa-regular fa-calendar mr-1"></i>Intake: {{ $item->intake }}
                        </div>
                        @endif
                        <div class="text-[11px] text-slate-500 mt-1 space-x-2">
                            @if($item->education_level)
                            <span><i class="fa-solid fa-book-open text-slate-400 mr-1"></i>{{ $item->education_level }}</span>
                            @endif
                            @if($item->english_test)
                            <span>&bull; {{ $item->english_test }}</span>
                            @endif
                        </div>
                        @if($item->message)
                        <div class="text-[11px] text-slate-600 bg-slate-50 rounded-lg p-1.5 mt-2 max-w-xs italic line-clamp-2 border border-slate-200/60">
                            "{{ $item->message }}"
                        </div>
                        @endif
                    </td>

                    <!-- Contact -->
                    <td class="py-4 px-4 whitespace-nowrap">
                        <div class="space-y-1">
                            <a href="tel:{{ $item->phone }}" class="flex items-center gap-1.5 font-semibold text-slate-800 hover:text-[#1a73e8]">
                                <i class="fa-solid fa-phone text-sky-500 text-[10px]"></i>
                                <span>{{ $item->phone }}</span>
                            </a>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->phone) }}" target="_blank" class="inline-flex items-center gap-1 text-[11px] text-emerald-600 hover:underline">
                                <i class="fa-brands fa-whatsapp text-emerald-500"></i>
                                <span>WhatsApp</span>
                            </a>
                            @if($item->email)
                            <div class="text-[11px] text-slate-500">
                                <i class="fa-regular fa-envelope text-slate-400 mr-1"></i>{{ $item->email }}
                            </div>
                            @endif
                        </div>
                    </td>

                    <!-- Destination -->
                    <td class="py-4 px-4 whitespace-nowrap">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-sky-50 text-[#0d2b8e] border border-sky-100">
                            <i class="fa-solid fa-location-dot text-sky-500 text-[10px]"></i>
                            {{ $item->destination ?: 'Not Specified' }}
                        </span>
                    </td>

                    <!-- Assigned Counselor -->
                    <td class="py-4 px-4 whitespace-nowrap">
                        @if($item->assignedUser)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                {{ $item->assignedUser->name }}
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-rose-50 text-rose-700">
                                Unassigned
                            </span>
                        @endif
                    </td>

                    <!-- Status -->
                    <td class="py-4 px-4 whitespace-nowrap">
                        @php
                            $statusMap = [
                                'new'          => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'label' => 'New Lead'],
                                'contacted'    => ['bg' => 'bg-blue-50',    'text' => 'text-blue-700',    'border' => 'border-blue-200',    'label' => 'Contacted'],
                                'in_progress'  => ['bg' => 'bg-amber-50',   'text' => 'text-amber-700',   'border' => 'border-amber-200',   'label' => 'In Progress'],
                                'admitted'     => ['bg' => 'bg-purple-50',  'text' => 'text-purple-700',  'border' => 'border-purple-200',  'label' => 'Admitted'],
                                'visa_granted' => ['bg' => 'bg-sky-50',     'text' => 'text-sky-700',     'border' => 'border-sky-200',     'label' => 'Visa Granted'],
                                'rejected'     => ['bg' => 'bg-rose-50',    'text' => 'text-rose-700',    'border' => 'border-rose-200',    'label' => 'Rejected'],
                                'closed'       => ['bg' => 'bg-slate-100',  'text' => 'text-slate-600',   'border' => 'border-slate-200',   'label' => 'Closed'],
                            ];
                            $badge = $statusMap[$item->status] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-600', 'border' => 'border-slate-200', 'label' => ucfirst($item->status)];
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $badge['bg'] }} {{ $badge['text'] }} {{ $badge['border'] }}">
                            {{ $badge['label'] }}
                        </span>
                    </td>

                    <!-- Received -->
                    <td class="py-4 px-4 whitespace-nowrap text-[11px] text-slate-500">
                        {{ $item->created_at->diffForHumans() }}
                    </td>

                    <!-- Actions -->
                    <td class="py-4 px-6 text-right whitespace-nowrap">
                        <div class="flex items-center justify-end gap-2">
                            <button onclick="openUpdateModal({{ json_encode($item) }})" class="px-3 py-1.5 rounded-lg bg-[#1a73e8] hover:bg-[#0d2b8e] text-white text-xs font-bold transition shadow-sm" title="Update status and notes">
                                <i class="fa-solid fa-pen-to-square mr-1"></i> Update
                            </button>

                            @if($isAdmin)
                            <form action="{{ route('admin.student_files.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete student file for {{ addslashes($item->name) }} permanently?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-rose-500 hover:bg-rose-50 rounded-lg transition" title="Delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-12 text-center text-slate-400">
                        <i class="fa-regular fa-folder-open text-3xl mb-2 block"></i>
                        <p class="text-sm font-semibold">No student files found matching your filters.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($inquiries->hasPages())
    <div class="p-4 border-t border-slate-100">
        {{ $inquiries->links() }}
    </div>
    @endif
</div>

<!-- Staff Management Section (Admin Only) -->
@if($isAdmin)
<div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/40 p-6 sm:p-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-lg font-extrabold text-slate-900">Counseling Staff & Administrators</h3>
            <p class="text-xs text-slate-500 mt-0.5">Manage team access, counselor accounts, and toggle user active status</p>
        </div>
        <button onclick="document.getElementById('newUserModal').classList.remove('hidden')" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-sky-50 text-[#1a73e8] border border-sky-200 text-xs font-bold hover:bg-sky-100 transition">
            <i class="fa-solid fa-user-plus"></i>
            <span>Add New Staff</span>
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($allStaff as $staff)
        <div class="p-4 rounded-2xl border border-slate-200/80 bg-slate-50/50 flex items-center justify-between">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-navy-800 to-brand-blue text-white flex items-center justify-center font-bold text-xs">
                    {{ strtoupper(substr($staff->name, 0, 2)) }}
                </div>
                <div class="min-w-0">
                    <h5 class="text-xs font-bold text-slate-900 truncate">{{ $staff->name }}</h5>
                    <p class="text-[11px] text-slate-500 truncate">{{ $staff->email }}</p>
                    <div class="flex items-center gap-1.5 mt-1">
                        <span class="text-[9px] font-black uppercase px-2 py-0.5 rounded-md {{ $staff->role === 'admin' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800' }}">
                            {{ $staff->role }}
                        </span>
                        <span class="text-[10px] {{ $staff->status === 'active' ? 'text-emerald-600 font-semibold' : 'text-slate-400' }}">
                            &bull; {{ ucfirst($staff->status) }}
                        </span>
                    </div>
                </div>
            </div>

            @if($staff->id !== Auth::id())
            <form action="{{ route('admin.users.toggle', $staff->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-2.5 py-1.5 rounded-lg text-xs font-semibold {{ $staff->status === 'active' ? 'text-rose-600 hover:bg-rose-50' : 'text-emerald-600 hover:bg-emerald-50' }} transition">
                    {{ $staff->status === 'active' ? 'Deactivate' : 'Activate' }}
                </button>
            </form>
            @endif
        </div>
        @endforeach
    </div>
</div>

<!-- Super Admin Audit History Logs Section -->
<div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-md mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm shadow-inner">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </span>
                <h3 class="text-lg font-black text-slate-900">Recent History & Audit Logs</h3>
                <span class="text-[10px] px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 font-bold uppercase">Live Audit</span>
            </div>
            <p class="text-xs text-slate-500 mt-0.5">Live trace of which executive made what change with exact per-second timestamps</p>
        </div>
        <a href="{{ route('admin.logs.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold shadow-md transition">
            <span>View Full History Logs</span>
            <i class="fa-solid fa-arrow-right text-[10px]"></i>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/75 border-b border-slate-200 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                    <th class="py-3 px-4">Exact Timestamp</th>
                    <th class="py-3 px-4">Executive / Actor</th>
                    <th class="py-3 px-4">Module</th>
                    <th class="py-3 px-4">Action</th>
                    <th class="py-3 px-4">Modification Details</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-xs">
                @forelse($recentLogs as $log)
                @php $badge = $log->action_badge; @endphp
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-4 whitespace-nowrap">
                        <span class="font-bold text-slate-800 font-mono">{{ $log->created_at->format('M d, Y') }}</span>
                        <div class="text-[10px] text-slate-400 font-mono flex items-center gap-1 mt-0.5">
                            <i class="fa-regular fa-clock text-sky-500"></i>
                            <span>{{ $log->created_at->format('h:i:s A') }}</span>
                            <span class="text-slate-300">&bull;</span>
                            <span>{{ $log->created_at->diffForHumans() }}</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-4 whitespace-nowrap">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-[#1a73e8] to-[#00aaff] text-white font-bold flex items-center justify-center text-[10px] shadow-sm">
                                {{ strtoupper(substr($log->user_name, 0, 2)) }}
                            </div>
                            <div>
                                <span class="font-bold text-slate-900 block leading-tight">{{ $log->user_name }}</span>
                                <span class="text-[10px] text-slate-400 block">{{ $log->user_role }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="py-3.5 px-4 whitespace-nowrap">
                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-lg text-[11px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                            <i class="fa-solid {{ $log->module_icon }} text-sky-600 text-[10px]"></i>
                            <span>{{ $log->module }}</span>
                        </span>
                    </td>
                    <td class="py-3.5 px-4 whitespace-nowrap">
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $badge['bg'] }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $badge['dot'] }}"></span>
                            <span>{{ $badge['label'] }}</span>
                        </span>
                    </td>
                    <td class="py-3.5 px-4">
                        <p class="font-medium text-slate-800 leading-snug">{{ $log->description }}</p>
                        @if($log->ip_address)
                        <span class="text-[9px] text-slate-400 font-mono">IP: {{ $log->ip_address }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-slate-400">
                        <i class="fa-solid fa-clock-rotate-left text-xl text-slate-300 mb-1 block"></i>
                        <span class="text-xs">No activity logs recorded yet. Changes made by staff will be tracked here.</span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif

<!-- Create Student File Modal (Admin and Executive) -->
<div id="newStudentModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl border border-slate-200 relative animate-fade-in max-h-[92vh] overflow-y-auto">
        <button type="button" onclick="document.getElementById('newStudentModal').classList.add('hidden')" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>

        <div class="mb-5">
            <div class="flex items-center gap-2 mb-1">
                <span class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm">
                    <i class="fa-solid fa-folder-plus"></i>
                </span>
                <h3 class="text-lg font-black text-slate-900">Create New Student File</h3>
            </div>
            <p class="text-xs text-slate-500">Record a new student profile, admission preferences, and counseling stage</p>
        </div>

        <form action="{{ route('admin.student_files.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Student Full Name <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="name" required placeholder="e.g. Tanvir Ahmed Chowdhury"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Phone / WhatsApp <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="phone" required placeholder="+880 1712..."
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Email Address
                    </label>
                    <input type="email" name="email" placeholder="student@example.com"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Target Destination <span class="text-rose-500">*</span>
                    </label>
                    <select name="destination" required class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                        <option value="United Kingdom">United Kingdom 🇬🇧</option>
                        <option value="Canada">Canada 🇨🇦</option>
                        <option value="Australia">Australia 🇦🇺</option>
                        <option value="United States">United States 🇺🇸</option>
                        <option value="Malaysia">Malaysia 🇲🇾</option>
                        <option value="Germany">Germany 🇩🇪</option>
                        <option value="New Zealand">New Zealand 🇳🇿</option>
                        <option value="Other">Other / Multiple</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Desired Course / Program
                    </label>
                    <input type="text" name="desired_course" placeholder="e.g. MSc in Advanced Computer Science"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Preferred Intake
                    </label>
                    <input type="text" name="intake" placeholder="e.g. September 2025, Fall 2026"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Education Level / CGPA
                    </label>
                    <input type="text" name="education_level" placeholder="e.g. BSc in CSE (CGPA 3.65) or HSC 2024"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        English Test Score
                    </label>
                    <input type="text" name="english_test" placeholder="e.g. IELTS 7.0 (L7.5, R7.0, W6.5, S6.5)"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Status / Stage <span class="text-rose-500">*</span>
                    </label>
                    <select name="status" required class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                        <option value="new">New Lead</option>
                        <option value="contacted">Contacted / Call Done</option>
                        <option value="in_progress">In Progress / Docs Submitted</option>
                        <option value="admitted">Admitted / Offer Received</option>
                        <option value="visa_granted">Visa Granted / Successful</option>
                        <option value="rejected">Rejected / Visa Refusal</option>
                        <option value="closed">Closed / Archived</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Assigned Counselor
                    </label>
                    <select name="assigned_to" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                        @if($isAdmin)
                        <option value="">Leave Unassigned</option>
                        @foreach($executives as $exec)
                        <option value="{{ $exec->id }}">{{ $exec->name }} ({{ $exec->email }})</option>
                        @endforeach
                        @else
                        <option value="{{ $user->id }}">Assign to Me ({{ $user->name }})</option>
                        <option value="">Leave Unassigned</option>
                        @endif
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Student Inquiry / Background Notes
                </label>
                <textarea name="message" rows="2" placeholder="Student's career goals, preferences, or consultation inquiry message..."
                    class="w-full px-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 leading-relaxed"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Internal Counselor Notes
                </label>
                <textarea name="internal_notes" rows="2" placeholder="Private internal notes regarding document verification, bank solvency, embassy interview dates..."
                    class="w-full px-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 leading-relaxed"></textarea>
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('newStudentModal').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-xs font-bold shadow-md shadow-emerald-700/20 hover:from-emerald-700 hover:to-teal-700 transition">
                    Create Student File
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Update Student File Modal -->
<div id="updateModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200 relative animate-fade-in max-h-[90vh] overflow-y-auto">
        <button type="button" onclick="document.getElementById('updateModal').classList.add('hidden')" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>

        <div class="mb-5">
            <h3 class="text-lg font-black text-slate-900">Update Student File</h3>
            <p class="text-xs text-slate-500 mt-0.5">Student: <span id="modalStudentName" class="font-bold text-[#1a73e8]"></span></p>
        </div>

        <form id="updateInquiryForm" action="" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Application Status</label>
                    <select name="status" id="modalStatusSelect" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8] bg-white">
                        <option value="new">New Lead</option>
                        <option value="contacted">Contacted / Initial Call Done</option>
                        <option value="in_progress">In Progress / Docs Received</option>
                        <option value="admitted">Admitted / Offer Letter Issued</option>
                        <option value="visa_granted">Visa Granted / Success!</option>
                        <option value="rejected">Rejected / Visa Refusal</option>
                        <option value="closed">Closed / Not Interested</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Destination</label>
                    <select name="destination" id="modalDestinationSelect" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8] bg-white">
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="Canada">Canada</option>
                        <option value="Australia">Australia</option>
                        <option value="United States">United States</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Germany">Germany</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Desired Course</label>
                    <input type="text" name="desired_course" id="modalCourseInput" placeholder="e.g. MSc in Software Eng."
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Intake</label>
                    <input type="text" name="intake" id="modalIntakeInput" placeholder="e.g. September 2025"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                </div>
            </div>

            @if($isAdmin)
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Assign To Counselor</label>
                <select name="assigned_to" id="modalAssignedSelect" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8] bg-white">
                    <option value="">Leave Unassigned</option>
                    @foreach($executives as $exec)
                    <option value="{{ $exec->id }}">{{ $exec->name }} ({{ $exec->email }})</option>
                    @endforeach
                </select>
            </div>
            @endif

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Internal Notes & History</label>
                <textarea name="internal_notes" id="modalNotesText" rows="4" placeholder="Record interview notes, student academic details, universities applied to..."
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8] leading-relaxed"></textarea>
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('updateModal').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-gradient-to-r from-navy-800 to-brand-blue text-white text-xs font-bold shadow-md hover:from-brand-blue hover:to-brand-sky transition">
                    Save Updates
                </button>
            </div>
        </form>
    </div>
</div>

<!-- New User / Counselor Modal (Admin Only) -->
@if($isAdmin)
<div id="newUserModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl border border-slate-200 relative animate-fade-in">
        <button onclick="document.getElementById('newUserModal').classList.add('hidden')" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>

        <div class="mb-5">
            <h3 class="text-lg font-black text-slate-900">Add New Team Member</h3>
            <p class="text-xs text-slate-500 mt-0.5">Create account for a counselor or portal administrator</p>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Full Name <span class="text-rose-500">*</span></label>
                <input type="text" name="name" required placeholder="e.g. Nusrat Jahan"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Email Address <span class="text-rose-500">*</span></label>
                <input type="email" name="email" required placeholder="e.g. nusrat@springwaybd.com"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Phone Number</label>
                <input type="text" name="phone" placeholder="+880 1..."
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Role <span class="text-rose-500">*</span></label>
                    <select name="role" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8] bg-white">
                        <option value="executive">Counselor / Executive</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Password <span class="text-rose-500">*</span></label>
                    <input type="password" name="password" required placeholder="Min 6 characters"
                        class="w-full px-4 py-2 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1a73e8]">
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('newUserModal').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-gradient-to-r from-navy-800 to-brand-blue text-white text-xs font-bold shadow-md hover:from-brand-blue hover:to-brand-sky transition">
                    Create Account
                </button>
            </div>
        </form>
    </div>
</div>
@endif

@push('scripts')
<script>
    function openUpdateModal(item) {
        document.getElementById('updateInquiryForm').action = '/admin/student-files/' + item.id;
        document.getElementById('modalStudentName').textContent = item.name;
        document.getElementById('modalStatusSelect').value = item.status;
        document.getElementById('modalNotesText').value = item.internal_notes || '';
        
        const destSelect = document.getElementById('modalDestinationSelect');
        if (destSelect && item.destination) {
            destSelect.value = item.destination;
        }

        const courseInput = document.getElementById('modalCourseInput');
        if (courseInput) {
            courseInput.value = item.desired_course || '';
        }

        const intakeInput = document.getElementById('modalIntakeInput');
        if (intakeInput) {
            intakeInput.value = item.intake || '';
        }
        
        const assignSelect = document.getElementById('modalAssignedSelect');
        if (assignSelect) {
            assignSelect.value = item.assigned_to || '';
        }

        document.getElementById('updateModal').classList.remove('hidden');
    }
</script>
@endpush
@endsection
