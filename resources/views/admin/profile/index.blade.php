@extends('layouts.admin')

@section('title', 'My Profile & Account Security - Springway Admin')
@section('header-title', 'My Profile & Security')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">

    <!-- Top Banner -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-sky-600 mb-1">
                <i class="fa-solid fa-id-badge"></i>
                <span>Account Management</span>
            </div>
            <h1 class="text-2xl font-heading font-extrabold text-navy-950">Profile & Security Settings</h1>
            <p class="text-sm text-slate-500 mt-1">
                Update your personal counselor credentials, contact details, and manage your account password.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl text-xs font-bold {{ $user->isAdmin() ? 'bg-amber-50 text-amber-800 border border-amber-200' : 'bg-emerald-50 text-emerald-800 border border-emerald-200' }}">
                <i class="fa-solid {{ $user->isAdmin() ? 'fa-crown text-amber-500' : 'fa-user-tie text-emerald-500' }}"></i>
                <span>{{ $user->isAdmin() ? 'Super Administrator' : 'Executive Member' }}</span>
            </span>
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

    @if($errors->any())
    <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm space-y-1">
        <div class="font-bold flex items-center gap-2">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <span>Please resolve the following errors:</span>
        </div>
        <ul class="list-disc list-inside pl-2 space-y-0.5 text-xs text-rose-700">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Main Content Layout (Grid) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Left Column: User Summary Card -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm text-center relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-24 bg-gradient-to-r from-navy-950 via-navy-900 to-brand-blue"></div>
                
                <div class="relative pt-6">
                    <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-tr from-[#1a73e8] to-[#00aaff] text-white font-extrabold text-2xl flex items-center justify-center border-4 border-white shadow-xl">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>

                    <h3 class="text-xl font-heading font-extrabold text-navy-950 mt-4">{{ $user->name }}</h3>
                    <p class="text-xs font-semibold text-slate-500">{{ $user->designation ?? ($user->isAdmin() ? 'Super Administrator' : 'Executive Member') }}</p>

                    <div class="flex justify-center items-center gap-2 mt-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold {{ $user->status === 'active' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600' }}">
                            <span class="w-2 h-2 rounded-full {{ $user->status === 'active' ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                            <span>{{ ucfirst($user->status) }} Account</span>
                        </span>
                    </div>

                    <div class="border-t border-slate-100 mt-6 pt-5 text-left space-y-3.5 text-xs">
                        <div class="flex items-center justify-between text-slate-600">
                            <span class="font-medium flex items-center gap-2 text-slate-400">
                                <i class="fa-regular fa-envelope w-4"></i>
                                Email
                            </span>
                            <span class="font-semibold text-slate-800 truncate max-w-[180px]">{{ $user->email }}</span>
                        </div>

                        <div class="flex items-center justify-between text-slate-600">
                            <span class="font-medium flex items-center gap-2 text-slate-400">
                                <i class="fa-solid fa-phone w-4"></i>
                                Phone
                            </span>
                            <span class="font-semibold text-slate-800">{{ $user->phone ?? 'Not provided' }}</span>
                        </div>

                        <div class="flex items-center justify-between text-slate-600">
                            <span class="font-medium flex items-center gap-2 text-slate-400">
                                <i class="fa-regular fa-calendar w-4"></i>
                                Joined On
                            </span>
                            <span class="font-semibold text-slate-800">{{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}</span>
                        </div>

                        <div class="flex items-center justify-between text-slate-600">
                            <span class="font-medium flex items-center gap-2 text-slate-400">
                                <i class="fa-regular fa-clock w-4"></i>
                                Last Login
                            </span>
                            <span class="font-semibold text-slate-800">{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Just now' }}</span>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Quick Tips Card -->
            <div class="bg-gradient-to-br from-slate-900 to-navy-950 text-white rounded-2xl p-6 shadow-md border border-slate-800">
                <div class="flex items-center gap-2 text-sky-400 text-sm font-bold mb-2">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>Security Recommendations</span>
                </div>
                <p class="text-xs text-slate-300 leading-relaxed">
                    Always use a strong, unique password of at least 8 characters with a blend of letters, numbers, and symbols. Never share your administrative credentials with unauthorized personnel.
                </p>
            </div>
        </div>

        <!-- Right Column: Profile Info & Password Forms -->
        <div class="lg:col-span-2 space-y-8">

            <!-- Section 1: Edit Profile Info -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-200 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-brand-blue flex items-center justify-center text-lg">
                            <i class="fa-solid fa-user-pen"></i>
                        </div>
                        <div>
                            <h3 class="font-heading font-extrabold text-lg text-navy-950">Personal Information</h3>
                            <p class="text-xs text-slate-500">Update your public contact info, display name, and bio</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.profile.update_info') }}" method="POST" class="p-6 space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Full Name *
                            </label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Email Address (Login Username) *
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Contact Phone
                            </label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+880 1712 345678"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Designation / Role Title
                            </label>
                            <input type="text" name="designation" value="{{ old('designation', $user->designation) }}" placeholder="e.g. Senior Admission Counselor"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Counselor Bio / Notes
                        </label>
                        <textarea name="bio" rows="3" placeholder="Brief summary about your expertise, destinations handled, or advisory role..."
                                  class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none transition">{{ old('bio', $user->bio) }}</textarea>
                    </div>

                    <div class="flex items-center justify-end pt-3 border-t border-slate-100">
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-brand-blue to-brand-sky hover:from-blue-700 hover:to-sky-600 text-white font-bold text-sm shadow-md transition">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <span>Save Profile Information</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Section 2: Change Password & Security -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-200 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-key"></i>
                        </div>
                        <div>
                            <h3 class="font-heading font-extrabold text-lg text-navy-950">Change Password</h3>
                            <p class="text-xs text-slate-500">Verify your current credentials and set a new secure password</p>
                        </div>
                    </div>
                    <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-rose-50 text-rose-700 border border-rose-200">
                        Requires Current Password
                    </span>
                </div>

                <form action="{{ route('admin.profile.update_password') }}" method="POST" class="p-6 space-y-6" id="passwordForm">
                    @csrf

                    <!-- Current Password -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Current Password *
                        </label>
                        <div class="relative">
                            <input type="password" name="current_password" id="current_password" required
                                   placeholder="Enter your current account password"
                                   class="w-full px-4 py-2.5 pr-11 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none transition">
                            <button type="button" onclick="togglePassVisibility('current_password', 'currentPassEye')"
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1">
                                <i class="fa-regular fa-eye" id="currentPassEye"></i>
                            </button>
                        </div>
                        <p class="text-[11px] text-slate-500 mt-1">Needed to confirm identity before modifying sensitive credentials.</p>
                    </div>

                    <div class="border-t border-slate-100 pt-5 space-y-5">
                        
                        <!-- New Password -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                New Password *
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="new_password" required minlength="8"
                                       placeholder="Choose a strong new password (min. 8 characters)"
                                       oninput="evaluatePasswordStrength(this.value)"
                                       class="w-full px-4 py-2.5 pr-11 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none transition">
                                <button type="button" onclick="togglePassVisibility('new_password', 'newPassEye')"
                                        class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1">
                                    <i class="fa-regular fa-eye" id="newPassEye"></i>
                                </button>
                            </div>

                            <!-- Password Strength Progress Bar -->
                            <div class="mt-3 space-y-1.5">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="font-bold text-slate-600">Password Strength:</span>
                                    <span id="strengthText" class="font-bold text-slate-400">Empty</span>
                                </div>
                                <div class="w-full h-2 rounded-full bg-slate-100 overflow-hidden">
                                    <div id="strengthBar" class="h-full w-0 transition-all duration-300 rounded-full bg-slate-300"></div>
                                </div>
                            </div>

                            <!-- Password Requirements Live Checklist -->
                            <div class="mt-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200 grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs">
                                <div id="rule-length" class="flex items-center gap-2 text-slate-400 transition">
                                    <i class="fa-regular fa-circle text-[10px]"></i>
                                    <span>At least 8 characters</span>
                                </div>
                                <div id="rule-upper" class="flex items-center gap-2 text-slate-400 transition">
                                    <i class="fa-regular fa-circle text-[10px]"></i>
                                    <span>At least 1 uppercase letter</span>
                                </div>
                                <div id="rule-lower" class="flex items-center gap-2 text-slate-400 transition">
                                    <i class="fa-regular fa-circle text-[10px]"></i>
                                    <span>At least 1 lowercase letter</span>
                                </div>
                                <div id="rule-number" class="flex items-center gap-2 text-slate-400 transition">
                                    <i class="fa-regular fa-circle text-[10px]"></i>
                                    <span>At least 1 number (0-9)</span>
                                </div>
                                <div id="rule-special" class="flex items-center gap-2 text-slate-400 transition sm:col-span-2">
                                    <i class="fa-regular fa-circle text-[10px]"></i>
                                    <span>At least 1 symbol (!@#$%^&*...)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Confirm New Password -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Confirm New Password *
                            </label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation" required minlength="8"
                                       placeholder="Re-type your new password"
                                       oninput="checkPasswordMatch()"
                                       class="w-full px-4 py-2.5 pr-11 rounded-xl border border-slate-300 focus:border-brand-blue focus:ring-2 focus:ring-blue-500/20 text-sm outline-none transition">
                                <button type="button" onclick="togglePassVisibility('password_confirmation', 'confirmPassEye')"
                                        class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1">
                                    <i class="fa-regular fa-eye" id="confirmPassEye"></i>
                                </button>
                            </div>
                            <div id="matchMessage" class="mt-1.5 text-xs hidden flex items-center gap-1.5 font-semibold"></div>
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end pt-4 border-t border-slate-100">
                        <button type="submit" id="submitPassBtn"
                                class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-rose-600 to-rose-700 hover:from-rose-700 hover:to-rose-800 text-white font-bold text-sm shadow-md transition">
                            <i class="fa-solid fa-lock"></i>
                            <span>Update Password & Secure Account</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>

</div>

<script>
    // Eye show/hide password toggle
    function togglePassVisibility(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (!input || !icon) return;

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Dynamic password strength evaluator
    function evaluatePasswordStrength(password) {
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');

        if (!password) {
            strengthBar.style.width = '0%';
            strengthBar.className = 'h-full transition-all duration-300 rounded-full bg-slate-300';
            strengthText.textContent = 'Empty';
            strengthText.className = 'font-bold text-slate-400';
            resetRules();
            checkPasswordMatch();
            return;
        }

        const hasLength = password.length >= 8;
        const hasUpper = /[A-Z]/.test(password);
        const hasLower = /[a-z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        const hasSpecial = /[^A-Za-z0-9]/.test(password);

        updateRule('rule-length', hasLength);
        updateRule('rule-upper', hasUpper);
        updateRule('rule-lower', hasLower);
        updateRule('rule-number', hasNumber);
        updateRule('rule-special', hasSpecial);

        let score = 0;
        if (hasLength) score++;
        if (hasUpper && hasLower) score++;
        if (hasNumber) score++;
        if (hasSpecial) score++;

        if (score === 1) {
            strengthBar.style.width = '25%';
            strengthBar.className = 'h-full transition-all duration-300 rounded-full bg-rose-500';
            strengthText.textContent = 'Weak';
            strengthText.className = 'font-bold text-rose-500';
        } else if (score === 2) {
            strengthBar.style.width = '50%';
            strengthBar.className = 'h-full transition-all duration-300 rounded-full bg-amber-500';
            strengthText.textContent = 'Fair';
            strengthText.className = 'font-bold text-amber-500';
        } else if (score === 3) {
            strengthBar.style.width = '75%';
            strengthBar.className = 'h-full transition-all duration-300 rounded-full bg-sky-500';
            strengthText.textContent = 'Good';
            strengthText.className = 'font-bold text-sky-500';
        } else if (score >= 4) {
            strengthBar.style.width = '100%';
            strengthBar.className = 'h-full transition-all duration-300 rounded-full bg-emerald-500';
            strengthText.textContent = 'Strong (Excellent)';
            strengthText.className = 'font-bold text-emerald-600';
        }

        checkPasswordMatch();
    }

    function updateRule(elementId, passed) {
        const el = document.getElementById(elementId);
        if (!el) return;

        const icon = el.querySelector('i');
        if (passed) {
            el.className = 'flex items-center gap-2 text-emerald-600 font-semibold transition';
            icon.className = 'fa-solid fa-circle-check text-xs text-emerald-600';
        } else {
            el.className = 'flex items-center gap-2 text-slate-400 transition';
            icon.className = 'fa-regular fa-circle text-[10px] text-slate-400';
        }
    }

    function resetRules() {
        ['rule-length', 'rule-upper', 'rule-lower', 'rule-number', 'rule-special'].forEach(id => {
            updateRule(id, false);
        });
    }

    // Check if new password and confirm match
    function checkPasswordMatch() {
        const pass = document.getElementById('new_password').value;
        const confirm = document.getElementById('password_confirmation').value;
        const msg = document.getElementById('matchMessage');

        if (!confirm) {
            msg.className = 'mt-1.5 text-xs hidden';
            return;
        }

        msg.classList.remove('hidden');
        if (pass === confirm) {
            msg.className = 'mt-1.5 text-xs flex items-center gap-1.5 font-semibold text-emerald-600';
            msg.innerHTML = '<i class="fa-solid fa-circle-check"></i> <span>Passwords match successfully</span>';
        } else {
            msg.className = 'mt-1.5 text-xs flex items-center gap-1.5 font-semibold text-rose-500';
            msg.innerHTML = '<i class="fa-solid fa-circle-xmark"></i> <span>Passwords do not match</span>';
        }
    }
</script>
@endsection

