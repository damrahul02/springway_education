@extends('layouts.admin')

@section('title', 'Executive Permission Manager - Springway Admin')
@section('header-title', 'Permission Manager')

@section('content')
<div class="space-y-8">

    <!-- Top Breadcrumb & Page Banner -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-rose-600 mb-1">
                <i class="fa-solid fa-user-shield"></i>
                <span>Super Admin Access Control</span>
            </div>
            <h1 class="text-2xl font-heading font-extrabold text-navy-950">Executive Permission Manager</h1>
            <p class="text-sm text-slate-500 mt-1">
                Configure granular privileges for counselors and staff. Restricting access instantly disables unseen modules and prevents direct URL navigation.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="openAddModal()"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-brand-blue to-brand-sky hover:from-blue-700 hover:to-sky-600 text-white font-bold text-sm shadow-lg shadow-blue-500/25 transition">
                <i class="fa-solid fa-user-plus"></i>
                <span>Add New Executive</span>
            </button>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center justify-between shadow-sm animate-fade-in">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
            <span class="font-semibold">{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm flex items-center justify-between shadow-sm animate-fade-in">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-circle-exclamation text-rose-600 text-lg"></i>
            <span class="font-semibold">{{ session('error') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    @endif

    @if($errors->any())
    <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm space-y-1">
        <div class="font-bold flex items-center gap-2">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <span>Please resolve the following input issues:</span>
        </div>
        <ul class="list-disc list-inside pl-2 space-y-0.5 text-xs text-rose-700">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Metrics Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Staff</p>
                <h3 class="text-2xl font-extrabold text-navy-950 mt-1">{{ $totalExecutives }}</h3>
                <p class="text-xs text-slate-500 mt-0.5">Registered executives</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-brand-blue flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-users-gear"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Active Accounts</p>
                <h3 class="text-2xl font-extrabold text-emerald-600 mt-1">{{ $activeExecutives }}</h3>
                <p class="text-xs text-slate-500 mt-0.5">Able to log into portal</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-user-check"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Modules Covered</p>
                <h3 class="text-2xl font-extrabold text-purple-600 mt-1">4</h3>
                <p class="text-xs text-slate-500 mt-0.5">Granular access domains</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-cubes-stacked"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Access Mode</p>
                <h3 class="text-base font-extrabold text-navy-950 mt-1 flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Strict Gating
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Redirects unauthorized attempts</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-lock"></i>
            </div>
        </div>
    </div>

    <!-- Permission Modules Legend -->
    <div class="bg-gradient-to-r from-slate-900 to-navy-950 text-white rounded-2xl p-6 shadow-md border border-slate-800">
        <div class="flex items-center gap-2 mb-3">
            <span class="px-2.5 py-0.5 rounded-full bg-sky-500/20 text-sky-300 text-xs font-bold uppercase tracking-wider">
                Permission Structure
            </span>
            <span class="text-xs text-slate-400">Available Modules for Staff Assignment</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
            @foreach($availablePermissions as $key => $perm)
            <div class="bg-white/5 border border-white/10 rounded-xl p-4 hover:bg-white/10 transition">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-sky-400">
                        <i class="fa-solid {{ $perm['icon'] }}"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-white">{{ $perm['name'] }}</h4>
                        <span class="text-[10px] font-mono text-sky-300">permission:{{ $key }}</span>
                    </div>
                </div>
                <p class="text-xs text-slate-300 leading-relaxed">{{ $perm['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Executives Table Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="font-heading font-extrabold text-lg text-navy-950">Staff & Executive Accounts</h3>
                <p class="text-xs text-slate-500 mt-0.5">Manage permissions, designations, and account status</p>
            </div>
            <div class="text-xs font-semibold text-slate-500">
                Showing {{ $executives->count() }} registered executives
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-200 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-4 px-6">Executive Member</th>
                        <th class="py-4 px-6">Contact & Info</th>
                        <th class="py-4 px-6">Assigned Permissions</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($executives as $exec)
                    @php
                        $userPerms = is_array($exec->permissions) ? $exec->permissions : [];
                    @endphp
                    <tr class="hover:bg-slate-50/60 transition group">
                        
                        <!-- Member Info -->
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-[#1a73e8] to-[#00aaff] text-white font-bold flex items-center justify-center text-xs shadow-sm">
                                    {{ strtoupper(substr($exec->name, 0, 2)) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-navy-950 group-hover:text-brand-blue transition">{{ $exec->name }}</h4>
                                    <p class="text-xs text-slate-500">{{ $exec->designation ?? 'Executive Counselor' }}</p>
                                </div>
                            </div>
                        </td>

                        <!-- Contact -->
                        <td class="py-4 px-6">
                            <div class="space-y-0.5 text-xs">
                                <div class="font-medium text-slate-700 flex items-center gap-1.5">
                                    <i class="fa-regular fa-envelope text-slate-400 w-3.5"></i>
                                    <span>{{ $exec->email }}</span>
                                </div>
                                <div class="text-slate-500 flex items-center gap-1.5">
                                    <i class="fa-solid fa-phone text-slate-400 w-3.5"></i>
                                    <span>{{ $exec->phone ?? 'No phone added' }}</span>
                                </div>
                            </div>
                        </td>

                        <!-- Permissions Pills -->
                        <td class="py-4 px-6">
                            <div class="flex flex-wrap gap-1.5 max-w-md">
                                @if(empty($userPerms))
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                        <i class="fa-solid fa-ban text-[10px]"></i>
                                        No Access (Restricted)
                                    </span>
                                @else
                                    @if(in_array('student_files', $userPerms))
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        <i class="fa-solid fa-chart-pie text-[10px]"></i>
                                        Dashboard & Leads
                                    </span>
                                    @endif

                                    @if(in_array('consultations', $userPerms))
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-teal-50 text-teal-700 border border-teal-200">
                                        <i class="fa-solid fa-envelope-open-text text-[10px]"></i>
                                        Consultation Inquiries
                                    </span>
                                    @endif

                                    @if(in_array('pages', $userPerms))
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        <i class="fa-solid fa-file-lines text-[10px]"></i>
                                        Page Content CMS
                                    </span>
                                    @endif

                                    @if(in_array('news', $userPerms))
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <i class="fa-solid fa-newspaper text-[10px]"></i>
                                        News & Updates
                                    </span>
                                    @endif

                                    @if(in_array('gallery', $userPerms))
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-purple-50 text-purple-700 border border-purple-200">
                                        <i class="fa-solid fa-photo-film text-[10px]"></i>
                                        Photo & Video
                                    </span>
                                    @endif
                                @endif
                            </div>
                        </td>

                        <!-- Status Toggle -->
                        <td class="py-4 px-6">
                            <form action="{{ route('admin.permissions.toggle', $exec->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        title="Click to toggle status"
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold transition {{ $exec->status === 'active' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100' : 'bg-slate-100 text-slate-600 border border-slate-300 hover:bg-slate-200' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $exec->status === 'active' ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                    <span>{{ ucfirst($exec->status) }}</span>
                                </button>
                            </form>
                        </td>

                        <!-- Actions -->
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button"
                                        onclick="openEditModal({{ json_encode($exec) }})"
                                        class="p-2 text-slate-500 hover:text-brand-blue hover:bg-blue-50 rounded-lg transition"
                                        title="Edit Executive & Permissions">
                                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                                </button>

                                <form action="{{ route('admin.permissions.destroy', $exec->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete executive {{ $exec->name }}? This action cannot be undone.');"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition"
                                            title="Delete Executive">
                                        <i class="fa-solid fa-trash-can text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-slate-400">
                            <div class="w-14 h-14 mx-auto mb-3 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 text-2xl">
                                <i class="fa-solid fa-users-slash"></i>
                            </div>
                            <h4 class="font-bold text-slate-600">No executive accounts created yet</h4>
                            <p class="text-xs text-slate-400 mt-1">Click "Add New Executive" above to create team members and assign permissions.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- ========================================== -->
<!-- ADD NEW EXECUTIVE MODAL                    -->
<!-- ========================================== -->
<div id="addExecutiveModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full border border-slate-200 overflow-hidden my-8 animate-fade-in">
        
        <!-- Modal Header -->
        <div class="px-6 py-5 bg-gradient-to-r from-navy-950 to-navy-900 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <div>
                    <h3 class="font-heading font-extrabold text-lg text-white">Create Executive Account</h3>
                    <p class="text-xs text-sky-300">Set up login credentials and choose accessible modules</p>
                </div>
            </div>
            <button onclick="closeAddModal()" class="text-slate-400 hover:text-white p-2">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <!-- Form Body -->
        <form action="{{ route('admin.permissions.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <!-- Personal Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Full Name *</label>
                    <input type="text" name="name" required placeholder="e.g. Tanvir Ahmed"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Email Address (Login) *</label>
                    <input type="email" name="email" required placeholder="e.g. tanvir@springwaybd.com"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Phone Number</label>
                    <input type="text" name="phone" placeholder="+880 1712 345678"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Designation</label>
                    <input type="text" name="designation" placeholder="e.g. Senior Admission Counselor"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Account Password *</label>
                    <input type="password" name="password" required minlength="6" placeholder="Min. 6 characters"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Initial Status</label>
                    <select name="status" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none bg-white">
                        <option value="active" selected>Active (Allow Login)</option>
                        <option value="inactive">Inactive (Suspended)</option>
                    </select>
                </div>
            </div>

            <!-- Granular Permissions Section -->
            <div class="border-t border-slate-200 pt-5">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h4 class="font-heading font-extrabold text-sm text-navy-950">Module Permissions</h4>
                        <p class="text-xs text-slate-500">Select which sections this executive can access and manage</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="toggleAllCheckboxes('addExecutiveModal', true)"
                                class="text-[11px] font-bold text-brand-blue hover:underline">Select All</button>
                        <span class="text-slate-300">|</span>
                        <button type="button" onclick="toggleAllCheckboxes('addExecutiveModal', false)"
                                class="text-[11px] font-bold text-slate-500 hover:underline">Clear</button>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($availablePermissions as $key => $perm)
                    <label class="flex items-start gap-3 p-3.5 rounded-xl border border-slate-200 hover:border-brand-blue/50 hover:bg-blue-50/20 cursor-pointer transition">
                        <input type="checkbox" name="permissions[]" value="{{ $key }}" checked
                               class="mt-1 w-4 h-4 rounded border-slate-300 text-brand-blue focus:ring-blue-500">
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid {{ $perm['icon'] }} text-xs text-brand-blue"></i>
                                <span class="font-bold text-xs text-navy-950">{{ $perm['name'] }}</span>
                            </div>
                            <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">{{ $perm['description'] }}</p>
                        </div>
                    </label>
                    @endforeach
                </div>
                <div class="mt-2.5 text-[11px] text-amber-700 bg-amber-50 p-2.5 rounded-lg border border-amber-200 flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-amber-500"></i>
                    <span>If an executive is only granted <strong>Page Content CMS</strong>, they cannot view the student files or the main dashboard.</span>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="border-t border-slate-200 pt-5 flex items-center justify-end gap-3">
                <button type="button" onclick="closeAddModal()"
                        class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-100 font-bold text-sm transition">
                    Cancel
                </button>
                <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-brand-blue to-brand-sky hover:from-blue-700 hover:to-sky-600 text-white font-bold text-sm shadow-md transition">
                    Create Executive Account
                </button>
            </div>
        </form>

    </div>
</div>

<!-- ========================================== -->
<!-- EDIT EXECUTIVE & PERMISSIONS MODAL         -->
<!-- ========================================== -->
<div id="editExecutiveModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full border border-slate-200 overflow-hidden my-8 animate-fade-in">
        
        <!-- Modal Header -->
        <div class="px-6 py-5 bg-gradient-to-r from-navy-950 to-navy-900 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-user-pen"></i>
                </div>
                <div>
                    <h3 class="font-heading font-extrabold text-lg text-white">Edit Executive Permissions</h3>
                    <p class="text-xs text-sky-300" id="editModalSubtitle">Modify profile and allowed access modules</p>
                </div>
            </div>
            <button onclick="closeEditModal()" class="text-slate-400 hover:text-white p-2">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <!-- Form Body -->
        <form id="editExecutiveForm" method="POST" class="p-6 space-y-6">
            @csrf

            <!-- Personal Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Full Name *</label>
                    <input type="text" id="edit_name" name="name" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Email Address *</label>
                    <input type="email" id="edit_email" name="email" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Phone Number</label>
                    <input type="text" id="edit_phone" name="phone"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Designation</label>
                    <input type="text" id="edit_designation" name="designation"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">New Password (leave blank to keep)</label>
                    <input type="password" name="password" minlength="6" placeholder="Leave empty to retain current"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Account Status</label>
                    <select id="edit_status" name="status" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none bg-white">
                        <option value="active">Active (Allow Login)</option>
                        <option value="inactive">Inactive (Suspended)</option>
                    </select>
                </div>
            </div>

            <!-- Granular Permissions Section -->
            <div class="border-t border-slate-200 pt-5">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h4 class="font-heading font-extrabold text-sm text-navy-950">Module Permissions</h4>
                        <p class="text-xs text-slate-500">Check each module this executive is permitted to access</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="toggleAllCheckboxes('editExecutiveModal', true)"
                                class="text-[11px] font-bold text-brand-blue hover:underline">Select All</button>
                        <span class="text-slate-300">|</span>
                        <button type="button" onclick="toggleAllCheckboxes('editExecutiveModal', false)"
                                class="text-[11px] font-bold text-slate-500 hover:underline">Clear</button>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($availablePermissions as $key => $perm)
                    <label class="flex items-start gap-3 p-3.5 rounded-xl border border-slate-200 hover:border-brand-blue/50 hover:bg-blue-50/20 cursor-pointer transition">
                        <input type="checkbox" name="permissions[]" value="{{ $key }}" id="edit_perm_{{ $key }}"
                               class="mt-1 w-4 h-4 rounded border-slate-300 text-brand-blue focus:ring-blue-500">
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid {{ $perm['icon'] }} text-xs text-brand-blue"></i>
                                <span class="font-bold text-xs text-navy-950">{{ $perm['name'] }}</span>
                            </div>
                            <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">{{ $perm['description'] }}</p>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="border-t border-slate-200 pt-5 flex items-center justify-end gap-3">
                <button type="button" onclick="closeEditModal()"
                        class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-100 font-bold text-sm transition">
                    Cancel
                </button>
                <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-brand-blue to-brand-sky hover:from-blue-700 hover:to-sky-600 text-white font-bold text-sm shadow-md transition">
                    Save Permission Changes
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    function openAddModal() {
        document.getElementById('addExecutiveModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addExecutiveModal').classList.add('hidden');
    }

    function openEditModal(user) {
        document.getElementById('editModalSubtitle').textContent = 'Editing permissions for ' + user.name;
        document.getElementById('editExecutiveForm').action = '/admin/permissions/executives/' + user.id;

        document.getElementById('edit_name').value = user.name || '';
        document.getElementById('edit_email').value = user.email || '';
        document.getElementById('edit_phone').value = user.phone || '';
        document.getElementById('edit_designation').value = user.designation || '';
        document.getElementById('edit_status').value = user.status || 'active';

        // Set permission checkboxes
        const perms = Array.isArray(user.permissions) ? user.permissions : [];
        const allModules = ['student_files', 'consultations', 'pages', 'news', 'gallery'];

        allModules.forEach(function(mod) {
            const cb = document.getElementById('edit_perm_' + mod);
            if (cb) {
                cb.checked = perms.includes(mod);
            }
        });

        document.getElementById('editExecutiveModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editExecutiveModal').classList.add('hidden');
    }

    function toggleAllCheckboxes(modalId, state) {
        const modal = document.getElementById(modalId);
        if (!modal) return;
        const boxes = modal.querySelectorAll('input[type="checkbox"][name="permissions[]"]');
        boxes.forEach(cb => cb.checked = state);
    }

    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeAddModal();
            closeEditModal();
        }
    });
</script>
@endsection

