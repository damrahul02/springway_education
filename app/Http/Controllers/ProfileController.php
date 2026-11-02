<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the authenticated user's profile and security settings.
     */
    public function index()
    {
        $user = Auth::user();

        return view('admin.profile.index', compact('user'));
    }

    /**
     * Update the user's basic profile information.
     */
    public function updateInfo(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone'       => ['nullable', 'string', 'max:40'],
            'designation' => ['nullable', 'string', 'max:120'],
            'bio'         => ['nullable', 'string', 'max:1000'],
        ]);

        $user->update([
            'name'        => $validated['name'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'] ?? null,
            'designation' => $validated['designation'] ?? $user->designation,
            'bio'         => $validated['bio'] ?? null,
        ]);

        ActivityLog::record(
            'Profile & Security',
            'updated',
            "Updated personal profile information (Name: '{$user->name}', Email: {$user->email})"
        );

        return redirect()->route('admin.profile.index')
            ->with('success', 'Profile information updated successfully.');
    }

    /**
     * Update the user's password with current password verification.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'string'],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Verify current password
        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'The provided current password does not match our records.',
            ])->withInput();
        }

        // Prevent setting the exact same password
        if (Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'The new password must be different from your current password.',
            ])->withInput();
        }

        $user->password = Hash::make($request->password);
        $user->save();

        ActivityLog::record(
            'Profile & Security',
            'updated',
            "Changed account security password"
        );

        return redirect()->route('admin.profile.index')
            ->with('success', 'Your password has been changed successfully. Please keep your credentials secure.');
    }
}

