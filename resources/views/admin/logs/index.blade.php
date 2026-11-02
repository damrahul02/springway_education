@extends('layouts.admin')

@section('title', 'History & Audit Logs - Springway Admin')
@section('header-title', 'History & Audit Logs')

@section('content')
<div class="space-y-8">

    <!-- Top Banner -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-amber-600 mb-1">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span>Super Admin Audit Trail</span>
            </div>
            <h1 class="text-2xl font-heading font-extrabold text-navy-950">System History & Activity Logs</h1>
            <p class="text-sm text-slate-500 mt-1">
                Real-time audit log of every change made across student files, website CMS, news, gallery, and executive permissions.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <button onclick="document.getElementById('clearLogsModal').classList.remove('hidden')"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-rose-200 bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold text-xs transition">
                <i class="fa-solid fa-trash-can"></i>
                <span>Clear Older Logs</span>
            </button>
        </div>
    </div>

    <!-- Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Logged Events</p>
                <h3 class="text-2xl font-extrabold text-navy-950 mt-1">{{ number_format($totalLogs) }}</h3>
                <p class="text-xs text-slate-500 mt-0.5">Historical activity records</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-brand-blue flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-list-check"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Activities Today</p>
                <h3 class="text-2xl font-extrabold text-emerald-600 mt-1">{{ number_format($todayLogs) }}</h3>
                <p class="text-xs text-slate-500 mt-0.5">Events in the last 24h</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-calendar-day"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Active Staff Today</p>
                <h3 class="text-2xl font-extrabold text-purple-600 mt-1">{{ $activeUsersToday }}</h3>
                <p class="text-xs text-slate-500 mt-0.5">Team members recorded</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Audit Precision</p>
                <h3 class="text-base font-extrabold text-navy-950 mt-1 flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Per-Second Accuracy
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Includes IP & user snapshots</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-stopwatch"></i>
            </div>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <form method="GET" action="{{ route('admin.logs.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3">
            
            <!-- Search Text -->
            <div class="lg:col-span-2">
                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Search Keywords</label>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search description, user, IP..."
                           class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-xs outline-none">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                </div>
            </div>

            <!-- Module Filter -->
            <div>
                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Module</label>
                <select name="module" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-xs outline-none bg-white">
                    <option value="">All Modules</option>
                    @foreach($modules as $mod)
                        <option value="{{ $mod }}" {{ request('module') === $mod ? 'selected' : '' }}>{{ $mod }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Action Filter -->
            <div>
                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Action Type</label>
                <select name="action" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-xs outline-none bg-white">
                    <option value="">All Actions</option>
                    @foreach($actions as $actKey => $actLabel)
                        <option value="{{ $actKey }}" {{ request('action') === $actKey ? 'selected' : '' }}>{{ $actLabel }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Executive Filter -->
            <div>
                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Executive / Actor</label>
                <select name="user_id" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-xs outline-none bg-white">
                    <option value="">All Staff</option>
                    @foreach($executives as $exec)
                        <option value="{{ $exec->id }}" {{ request('user_id') == $exec->id ? 'selected' : '' }}>{{ $exec->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Date & Actions -->
            <div class="flex items-end gap-2">
                <button type="submit"
                        class="flex-1 py-2 px-3 rounded-xl bg-brand-blue hover:bg-blue-700 text-white font-bold text-xs transition text-center shadow-sm">
                    Filter
                </button>
                @if(request()->hasAny(['search', 'module', 'action', 'user_id', 'date']))
                <a href="{{ route('admin.logs.index') }}"
                   class="py-2 px-3 rounded-xl border border-slate-300 hover:bg-slate-100 text-slate-600 font-bold text-xs transition" title="Clear Filters">
                    <i class="fa-solid fa-rotate-right"></i>
                </a>
                @endif
            </div>

        </form>
    </div>

    <!-- Logs Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="font-heading font-extrabold text-lg text-navy-950">Activity Timeline & Modifications</h3>
                <p class="text-xs text-slate-500 mt-0.5">Showing exact chronological trace of all actions</p>
            </div>
            <div class="text-xs font-semibold text-slate-500">
                Showing {{ $logs->firstItem() ?? 0 }} - {{ $logs->lastItem() ?? 0 }} of {{ $logs->total() }} events
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-200 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-4 px-6">Timestamp & Date</th>
                        <th class="py-4 px-6">Executive / Actor</th>
                        <th class="py-4 px-6">Module</th>
                        <th class="py-4 px-6">Action</th>
                        <th class="py-4 px-6">Description of Modification</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($logs as $log)
                    @php
                        $badge = $log->action_badge;
                    @endphp
                    <tr class="hover:bg-slate-50/60 transition group">
                        
                        <!-- Timestamp -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            <div class="text-xs font-bold text-navy-950 font-mono">
                                {{ $log->created_at->format('M d, Y') }}
                            </div>
                            <div class="text-[11px] text-slate-500 font-mono flex items-center gap-1.5 mt-0.5">
                                <i class="fa-regular fa-clock text-[10px] text-sky-500"></i>
                                <span>{{ $log->created_at->format('h:i:s A') }}</span>
                                <span class="text-slate-300">&bull;</span>
                                <span class="text-slate-400">{{ $log->created_at->diffForHumans() }}</span>
                            </div>
                        </td>

                        <!-- Executive / Actor -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-[#1a73e8] to-[#00aaff] text-white font-bold flex items-center justify-center text-xs shadow-sm">
                                    {{ strtoupper(substr($log->user_name, 0, 2)) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-xs text-navy-950">{{ $log->user_name }}</h4>
                                    <div class="flex items-center gap-1.5 mt-0.5">
                                        <span class="text-[10px] font-semibold text-slate-400">{{ $log->user_email }}</span>
                                        <span class="text-[9px] px-1.5 py-0.2 rounded font-bold uppercase {{ $log->user_role === 'admin' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800' }}">
                                            {{ $log->user_role }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Module -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                <i class="fa-solid {{ $log->module_icon }} text-sky-600 text-[10px]"></i>
                                <span>{{ $log->module }}</span>
                            </span>
                        </td>

                        <!-- Action -->
                        <td class="py-4 px-6 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $badge['bg'] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $badge['dot'] }}"></span>
                                <span>{{ $badge['label'] }}</span>
                            </span>
                        </td>

                        <!-- Description -->
                        <td class="py-4 px-6">
                            <p class="text-xs font-medium text-slate-800 leading-snug">
                                {{ $log->description }}
                            </p>
                            @if($log->ip_address)
                            <div class="mt-1 flex items-center gap-2 text-[10px] text-slate-400 font-mono">
                                <i class="fa-solid fa-network-wired text-[9px]"></i>
                                <span>IP: {{ $log->ip_address }}</span>
                            </div>
                            @endif
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-slate-400">
                            <div class="w-14 h-14 mx-auto mb-3 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 text-2xl">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                            </div>
                            <h4 class="font-bold text-slate-600">No activity logs recorded yet</h4>
                            <p class="text-xs text-slate-400 mt-1">Actions performed by executives will appear here automatically with timestamps.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($logs->hasPages())
        <div class="p-4 border-t border-slate-200">
            {{ $logs->links() }}
        </div>
        @endif
    </div>

</div>

<!-- Clear Logs Modal -->
<div id="clearLogsModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full border border-slate-200 overflow-hidden animate-fade-in">
        <div class="px-6 py-5 bg-gradient-to-r from-rose-900 to-navy-950 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div>
                    <h3 class="font-bold text-base text-white">Clear Audit Logs</h3>
                    <p class="text-xs text-rose-200">Remove historical entries</p>
                </div>
            </div>
            <button onclick="document.getElementById('clearLogsModal').classList.add('hidden')" class="text-slate-400 hover:text-white p-1">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <form action="{{ route('admin.logs.clear') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Retention Period</label>
                <select name="days" class="w-full px-3 py-2.5 rounded-xl border border-slate-300 text-sm outline-none bg-white">
                    <option value="90">Keep last 90 days (Delete older)</option>
                    <option value="60">Keep last 60 days (Delete older)</option>
                    <option value="30" selected>Keep last 30 days (Delete older)</option>
                    <option value="7">Keep last 7 days (Delete older)</option>
                    <option value="0">Delete ALL logs (Purge completely)</option>
                </select>
            </div>

            <p class="text-xs text-slate-500 leading-relaxed">
                This action is permanent and clears audit entries matching the selected retention period.
            </p>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('clearLogsModal').classList.add('hidden')"
                        class="px-4 py-2 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-100 font-bold text-xs transition">
                    Cancel
                </button>
                <button type="submit"
                        class="px-5 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs shadow-md transition">
                    Confirm & Clear
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

