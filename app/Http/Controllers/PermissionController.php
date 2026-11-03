<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PermissionController extends Controller
{
    /**
     * Display a listing of executives and their assigned permissions.
     */
    public function index()
    {
        $executives = User::where('role', 'executive')->latest()->get();
        $totalExecutives = $executives->count();
        $activeExecutives = $executives->where('status', 'active')->count();
        $availablePermissions = User::availablePermissions();

        return view('admin.permissions.index', compact(
            'executives',
            'totalExecutives',
            'activeExecutives',
            'availablePermissions'
        ));
    }

    /**
     * Store a newly created executive with selected permissions.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users,email',
            'phone'         => 'nullable|string|max:40',
            'designation'   => 'nullable|string|max:120',
            'password'      => 'required|string|min:6',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'string|in:student_files,consultations,pages,news,gallery',
            'status'        => 'nullable|in:active,inactive',
        ]);

        $createdUser = User::create([
            'name'        => $validated['name'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'] ?? null,
            'designation' => $validated['designation'] ?? 'Executive Counselor',
            'role'        => 'executive',
            'permissions' => $validated['permissions'] ?? [],
            'status'      => $validated['status'] ?? 'active',
            'password'    => Hash::make($validated['password']),
        ]);

        ActivityLog::record(
            'Permission Manager',
            'created',
            "Created executive account '{$createdUser->name}' ({$createdUser->email}) with permissions: [" . implode(', ', $createdUser->permissions ?? ['None']) . "]",
            ['user_id' => $createdUser->id, 'email' => $createdUser->email]
        );

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Executive profile created successfully with customized permissions.');
    }

    /**
     * Update an executive's profile and permissions.
     */
    public function update(Request $request, $id)
    {
        $executive = User::where('role', 'executive')->findOrFail($id);

        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users,email,' . $executive->id,
            'phone'         => 'nullable|string|max:40',
            'designation'   => 'nullable|string|max:120',
            'password'      => 'nullable|string|min:6',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'string|in:student_files,consultations,pages,news,gallery',
            'status'        => 'nullable|in:active,inactive',
        ]);

        $data = [
            'name'        => $validated['name'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'] ?? null,
            'designation' => $validated['designation'] ?? 'Executive Counselor',
            'permissions' => $validated['permissions'] ?? [],
            'status'      => $validated['status'] ?? 'active',
        ];

        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $executive->update($data);

        ActivityLog::record(
            'Permission Manager',
            'updated',
            "Updated executive '{$executive->name}' profile & permissions: [" . implode(', ', $executive->permissions ?? ['None']) . "]",
            ['user_id' => $executive->id, 'email' => $executive->email]
        );

        return redirect()->route('admin.permissions.index')
            ->with('success', "Permissions and profile for {$executive->name} updated successfully.");
    }

    /**
     * Toggle active/inactive status of an executive.
     */
    public function toggleStatus($id)
    {
        $executive = User::where('role', 'executive')->findOrFail($id);
        $executive->status = ($executive->status === 'active') ? 'inactive' : 'active';
        $executive->save();

        $statusLabel = $executive->status === 'active' ? 'activated' : 'deactivated';

        ActivityLog::record(
            'Permission Manager',
            'toggled',
            "Changed account status of executive '{$executive->name}' to " . ucfirst($executive->status),
            ['user_id' => $executive->id, 'status' => $executive->status]
        );

        return redirect()->route('admin.permissions.index')
            ->with('success', "Executive account for {$executive->name} has been {$statusLabel}.");
    }

    /**
     * Remove an executive from the system.
     */
    public function destroy($id)
    {
        $executive = User::where('role', 'executive')->findOrFail($id);

        if ($executive->id === Auth::id()) {
            return redirect()->route('admin.permissions.index')
                ->with('error', 'You cannot delete your own active administrator account.');
        }

        $name = $executive->name;
        $email = $executive->email;
        $executive->delete();

        ActivityLog::record(
            'Permission Manager',
            'deleted',
            "Deleted executive account '{$name}' ({$email})",
            ['user_id' => $id, 'name' => $name, 'email' => $email]
        );

        return redirect()->route('admin.permissions.index')
            ->with('success', "Executive {$name} was deleted successfully.");
    }
}

