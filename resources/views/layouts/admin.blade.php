<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Portal') - Springway Education</title>
    <link rel="icon" href="/images/logo.jpg" type="image/jpeg">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: {
                            950: '#060b1c',
                            900: '#070d24',
                            800: '#0d2b8e',
                            700: '#103bb3',
                        },
                        brand: {
                            blue: '#1a73e8',
                            sky: '#00aaff',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        heading: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.4);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-100 text-slate-800 font-sans antialiased min-h-screen flex">

    <!-- Mobile Sidebar Backdrop -->
    <div id="sidebar-backdrop" onclick="toggleAdminSidebar()" class="fixed inset-0 bg-slate-900/60 z-40 hidden lg:hidden backdrop-blur-sm transition-opacity"></div>

    <!-- Sidebar -->
    <aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-gradient-to-b from-navy-950 via-navy-900 to-[#0a1845] text-white flex flex-col transition-transform duration-300 -translate-x-full lg:translate-x-0 shadow-2xl border-r border-white/5">
        
        <!-- Brand Header -->
        <div class="h-20 px-6 flex items-center justify-between border-b border-white/10">
            <a href="{{ route(Auth::user()->firstAllowedRoute() ?? 'admin.dashboard') }}" class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-xl bg-white p-1 flex items-center justify-center shadow-lg shadow-sky-500/20 group-hover:scale-105 transition">
                    <img src="/images/logo.jpg" alt="Springway" class="max-h-full max-w-full object-contain">
                </div>
                <div>
                    <span class="block font-heading font-extrabold text-base tracking-wide text-white group-hover:text-sky-300 transition">
                        SPRINGWAY
                    </span>
                    <span class="text-[10px] uppercase font-bold tracking-widest text-sky-400">
                        Management Portal
                    </span>
                </div>
            </a>
            <button onclick="toggleAdminSidebar()" class="lg:hidden p-2 text-slate-400 hover:text-white rounded-lg">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <!-- User Profile Card -->
        <a href="{{ route('admin.profile.index') }}" title="Click on your name to change profile info & password"
           class="block px-5 py-4 border-b border-white/10 bg-white/[0.02] hover:bg-white/[0.08] transition group">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-full bg-gradient-to-tr from-[#1a73e8] to-[#00aaff] flex items-center justify-center font-bold text-white shadow-md text-sm border border-white/20 group-hover:scale-105 transition">
                    {{ strtoupper(substr(Auth::user()->name ?? 'User', 0, 2)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between">
                        <h4 class="text-sm font-bold text-white truncate group-hover:text-sky-300 transition">{{ Auth::user()->name ?? 'Administrator' }}</h4>
                        <i class="fa-solid fa-gear text-xs text-slate-400 group-hover:text-sky-300 transition"></i>
                    </div>
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <span class="w-2 h-2 rounded-full {{ (Auth::user()->role ?? '') === 'admin' ? 'bg-amber-400' : 'bg-emerald-400' }} animate-pulse"></span>
                        <span class="text-xs font-semibold uppercase tracking-wider {{ (Auth::user()->role ?? '') === 'admin' ? 'text-amber-300' : 'text-emerald-300' }}">
                            {{ ucfirst(Auth::user()->role ?? 'executive') }}
                        </span>
                        <span class="text-[10px] text-sky-400 ml-auto opacity-0 group-hover:opacity-100 transition font-medium">Edit &rarr;</span>
                    </div>
                </div>
            </div>
        </a>

        <!-- Navigation Links -->
        <div class="flex-1 overflow-y-auto px-4 py-5 custom-scrollbar space-y-6">
            
            <!-- Group: Main (Student Files) -->
            @if(Auth::user()->canAccess('student_files'))
            <div>
                <p class="px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">Main Navigation</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-brand-blue to-brand-sky text-white shadow-lg shadow-blue-600/30 font-bold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <i class="fa-solid fa-chart-pie w-5 text-center text-base {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-sky-400' }}"></i>
                        <span>Dashboard & Student Files</span>
                    </a>
                </div>
            </div>
            @endif

            <!-- Group: Content Management -->
            @if(Auth::user()->canAccess('pages') || Auth::user()->canAccess('news') || Auth::user()->canAccess('gallery'))
            <div>
                <p class="px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">Website CMS</p>
                <div class="space-y-1">
                    <!-- Page Contents -->
                    @if(Auth::user()->canAccess('pages'))
                    <a href="{{ route('admin.pages.index') }}"
                       class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.pages.*') ? 'bg-gradient-to-r from-brand-blue to-brand-sky text-white shadow-lg shadow-blue-600/30 font-bold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fa-solid fa-file-lines w-5 text-center text-base {{ request()->routeIs('admin.pages.*') ? 'text-white' : 'text-amber-400' }}"></i>
                            <span>Page Content CMS</span>
                        </div>
                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-white/10 text-slate-200">6 Pages</span>
                    </a>
                    @endif

                    <!-- News Posts -->
                    @if(Auth::user()->canAccess('news'))
                    <a href="{{ route('admin.news.index') }}"
                       class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.news.*') ? 'bg-gradient-to-r from-brand-blue to-brand-sky text-white shadow-lg shadow-blue-600/30 font-bold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fa-solid fa-newspaper w-5 text-center text-base {{ request()->routeIs('admin.news.*') ? 'text-white' : 'text-emerald-400' }}"></i>
                            <span>News & Updates</span>
                        </div>
                        <i class="fa-solid fa-angle-right text-xs opacity-60"></i>
                    </a>
                    @endif

                    <!-- Gallery Items -->
                    @if(Auth::user()->canAccess('gallery'))
                    <a href="{{ route('admin.gallery.index') }}"
                       class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.gallery.*') ? 'bg-gradient-to-r from-brand-blue to-brand-sky text-white shadow-lg shadow-blue-600/30 font-bold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fa-solid fa-photo-film w-5 text-center text-base {{ request()->routeIs('admin.gallery.*') ? 'text-white' : 'text-purple-400' }}"></i>
                            <span>Photo & Video Gallery</span>
                        </div>
                        <i class="fa-solid fa-angle-right text-xs opacity-60"></i>
                    </a>
                    @endif
                </div>
            </div>
            @endif

            <!-- Group: Admin Only (Permission Manager & User Access) -->
            @if(Auth::user()->isAdmin())
            <div>
                <p class="px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">Access Control</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.permissions.index') }}"
                       class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.permissions.*') ? 'bg-gradient-to-r from-brand-blue to-brand-sky text-white shadow-lg shadow-blue-600/30 font-bold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fa-solid fa-user-shield w-5 text-center text-base {{ request()->routeIs('admin.permissions.*') ? 'text-white' : 'text-rose-400' }}"></i>
                            <span>Permission Manager</span>
                        </div>
                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-rose-500/20 text-rose-300 font-bold">Admin</span>
                    </a>

                    <a href="{{ route('admin.logs.index') }}"
                       class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.logs.*') ? 'bg-gradient-to-r from-brand-blue to-brand-sky text-white shadow-lg shadow-blue-600/30 font-bold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <div class="flex items-center gap-3.5">
                            <i class="fa-solid fa-clock-rotate-left w-5 text-center text-base {{ request()->routeIs('admin.logs.*') ? 'text-white' : 'text-amber-400' }}"></i>
                            <span>History & Audit Logs</span>
                        </div>
                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-amber-500/20 text-amber-300 font-bold">Audit</span>
                    </a>
                </div>
            </div>
            @endif

            <!-- Group: Quick Shortcuts to Public Pages -->
            <div>
                <p class="px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">Live Public Pages</p>
                <div class="grid grid-cols-2 gap-1.5 px-1">
                    <a href="{{ route('about') }}" target="_blank" class="px-2.5 py-1.5 rounded-lg text-xs bg-white/5 hover:bg-white/15 text-slate-300 hover:text-white transition flex items-center justify-between">
                        <span>About Us</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[9px] opacity-60"></i>
                    </a>
                    <a href="{{ route('services') }}" target="_blank" class="px-2.5 py-1.5 rounded-lg text-xs bg-white/5 hover:bg-white/15 text-slate-300 hover:text-white transition flex items-center justify-between">
                        <span>Services</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[9px] opacity-60"></i>
                    </a>
                    <a href="{{ route('destinations') }}" target="_blank" class="px-2.5 py-1.5 rounded-lg text-xs bg-white/5 hover:bg-white/15 text-slate-300 hover:text-white transition flex items-center justify-between">
                        <span>Destinations</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[9px] opacity-60"></i>
                    </a>
                    <a href="{{ route('process') }}" target="_blank" class="px-2.5 py-1.5 rounded-lg text-xs bg-white/5 hover:bg-white/15 text-slate-300 hover:text-white transition flex items-center justify-between">
                        <span>Our Process</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[9px] opacity-60"></i>
                    </a>
                    <a href="{{ route('gallery') }}" target="_blank" class="px-2.5 py-1.5 rounded-lg text-xs bg-white/5 hover:bg-white/15 text-slate-300 hover:text-white transition flex items-center justify-between">
                        <span>Gallery</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[9px] opacity-60"></i>
                    </a>
                    <a href="{{ route('news') }}" target="_blank" class="px-2.5 py-1.5 rounded-lg text-xs bg-white/5 hover:bg-white/15 text-slate-300 hover:text-white transition flex items-center justify-between">
                        <span>News</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[9px] opacity-60"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-white/10 bg-white/[0.02] space-y-2">
            <a href="{{ route('admin.profile.index') }}"
               class="flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl {{ request()->routeIs('admin.profile.*') ? 'bg-gradient-to-r from-brand-blue to-brand-sky text-white shadow-lg shadow-blue-500/25 font-bold' : 'bg-white/5 hover:bg-white/10 text-xs font-bold text-slate-300 hover:text-white' }} transition">
                <i class="fa-solid fa-user-gear text-sky-400"></i>
                <span>My Profile & Password</span>
            </a>
            <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-center gap-2 w-full py-2 px-4 rounded-xl bg-white/5 hover:bg-white/10 text-xs font-bold text-slate-300 hover:text-white transition">
                <i class="fa-solid fa-globe text-sky-400"></i>
                <span>Open Public Website</span>
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center justify-center gap-2 w-full py-2 px-4 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-300 hover:text-rose-200 text-xs font-bold transition">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Sign Out</span>
                </button>
            </form>

            <!-- Sidebar Developer Credit -->
            <div class="pt-3 border-t border-white/10 text-center text-[11px] text-slate-400">
                <span>Developed by <a href="https://pritomdam.site" target="_blank" class="text-sky-400 hover:text-sky-300 font-bold hover:underline">Pritom Dam</a> (<a href="https://pritomdam.site" target="_blank" class="text-slate-300 hover:underline">pritomdam.site</a>)</span>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col lg:pl-72 min-w-0 min-h-screen">
        
        <!-- Admin Topbar -->
        <header class="h-20 bg-white border-b border-slate-200 sticky top-0 z-30 px-4 sm:px-8 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <button onclick="toggleAdminSidebar()" class="lg:hidden p-2 rounded-xl text-slate-600 hover:bg-slate-100 focus:outline-none">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <div>
                    <h1 class="text-xl font-bold text-slate-900 leading-tight">
                        @yield('header_title', 'Admin Dashboard')
                    </h1>
                    <p class="text-xs text-slate-500 hidden sm:block">
                        @yield('header_subtitle', 'Springway Education Sylhet Management System')
                    </p>
                </div>
            </div>

            <!-- Header Quick Actions -->
            <div class="flex items-center gap-3">
                @yield('header_actions')
                
                <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex items-center gap-2 px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition">
                    <i class="fa-solid fa-arrow-up-right-from-square text-sky-500"></i>
                    <span>Live Site</span>
                </a>

                <div class="h-8 w-px bg-slate-200 mx-1 hidden sm:block"></div>

                <a href="{{ route('admin.profile.index') }}" title="Click on your name to edit profile & change password"
                   class="flex items-center gap-2.5 p-1.5 pr-2.5 rounded-xl hover:bg-slate-100 transition group border border-transparent hover:border-slate-200">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#1a73e8] to-[#00aaff] flex items-center justify-center font-bold text-white shadow-sm text-xs group-hover:scale-105 transition">
                        {{ strtoupper(substr(Auth::user()->name ?? 'User', 0, 2)) }}
                    </div>
                    <div class="text-left hidden md:block">
                        <span class="block text-xs font-bold text-slate-800 group-hover:text-brand-blue transition leading-tight">
                            {{ Auth::user()->name ?? 'User' }}
                        </span>
                        <span class="block text-[10px] text-slate-400 font-medium leading-none">
                            Edit Profile & Password
                        </span>
                    </div>
                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase {{ (Auth::user()->role ?? '') === 'admin' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800' }}">
                        {{ Auth::user()->role ?? 'executive' }}
                    </span>
                </a>
            </div>
        </header>

        <!-- Flash Messages -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-between text-emerald-800 shadow-sm animate-fade-in">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-xl"></i>
                    <p class="text-sm font-semibold">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 p-1">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 flex items-center justify-between text-rose-800 shadow-sm animate-fade-in">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-exclamation text-rose-600 text-xl"></i>
                    <p class="text-sm font-semibold">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 p-1">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-6 p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 shadow-sm">
                <div class="flex items-center gap-2 font-bold text-sm mb-1 text-amber-800">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>Please correct the errors below:</span>
                </div>
                <ul class="list-disc list-inside text-xs space-y-1 text-amber-700">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="px-8 py-4 bg-white border-t border-slate-200 text-center sm:text-left sm:flex sm:justify-between text-xs text-slate-500">
            <p>&copy; {{ date('Y') }} Springway Education Sylhet. All rights reserved.</p>
            <p class="mt-1 sm:mt-0">
                Developed by <a href="https://pritomdam.site" target="_blank" class="text-brand-blue hover:underline font-bold">Pritom Dam</a> (<a href="https://pritomdam.site" target="_blank" class="text-sky-600 hover:underline">pritomdam.site</a>)
            </p>
        </footer>
    </div>

    <!-- Toggle Script -->
    <script>
        function toggleAdminSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
            }
        }
    </script>
    @stack('scripts')
</body>
</html>

