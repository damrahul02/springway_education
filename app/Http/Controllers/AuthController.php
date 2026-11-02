<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show modern, aesthetic login view.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route(Auth::user()->firstAllowedRoute());
        }

        return view('auth.login');
    }

    /**
     * Process authentication.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember') || $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if (! $user->isActive()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Your account has been deactivated. Please contact the administrator.',
                ])->onlyInput('email');
            }

            $user->update([
                'last_login_at' => now(),
            ]);

            ActivityLog::record(
                'Authentication',
                'login',
                "User '{$user->name}' ({$user->email}) signed in to portal",
                ['role' => $user->role, 'ip' => $request->ip()]
            );

            $request->session()->regenerate();

            $targetRoute = $user->firstAllowedRoute();
            return redirect()->intended(route($targetRoute))->with('welcome', 'Welcome back, ' . $user->name . '!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Destroy authenticated session.
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            ActivityLog::record(
                'Authentication',
                'logout',
                "User '{$user->name}' ({$user->email}) signed out",
                null,
                $user
            );
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('info', 'You have been successfully logged out.');
    }
}

