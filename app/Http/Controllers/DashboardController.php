<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inquiry;
use App\Models\StudentFile;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    /**
     * Display the role-based dashboard.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $isAdmin = $user->isAdmin();

        // Query for student files based on role & filters
        $studentFilesQuery = StudentFile::with(['assignedUser', 'creator'])->latest();

        if (! $isAdmin) {
            // Executives see assigned leads + unassigned new leads
            $studentFilesQuery->where(function ($q) use ($user) {
                $q->where('assigned_to', $user->id)
                  ->orWhereNull('assigned_to');
            });
        }

        // Search & Filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $studentFilesQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('destination', 'like', "%{$search}%")
                  ->orWhere('desired_course', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $studentFilesQuery->where('status', $request->input('status'));
        }

        if ($request->filled('destination')) {
            $studentFilesQuery->where('destination', $request->input('destination'));
        }

        if ($isAdmin && $request->filled('assigned_to')) {
            if ($request->input('assigned_to') === 'unassigned') {
                $studentFilesQuery->whereNull('assigned_to');
            } else {
                $studentFilesQuery->where('assigned_to', $request->input('assigned_to'));
            }
        }

        $studentFiles = $studentFilesQuery->paginate(15)->withQueryString();
        $inquiries = $studentFiles; // alias for backwards compatibility

        // Statistics calculated dynamically from database
        if ($isAdmin) {
            $stats = [
                'total_leads'     => StudentFile::count(),
                'new_leads'       => StudentFile::where('status', 'new')->count(),
                'in_progress'     => StudentFile::whereIn('status', ['contacted', 'in_progress'])->count(),
                'successful'      => StudentFile::whereIn('status', ['admitted', 'visa_granted'])->count(),
                'total_staff'     => User::count(),
                'active_staff'    => User::where('status', 'active')->count(),
            ];
            $executives = User::where('role', 'executive')->where('status', 'active')->get();
            $allStaff = User::latest()->get();
            $recentLogs = ActivityLog::latest()->take(10)->get();
        } else {
            $stats = [
                'my_assigned'     => StudentFile::where('assigned_to', $user->id)->count(),
                'unassigned_new'  => StudentFile::whereNull('assigned_to')->where('status', 'new')->count(),
                'in_progress'     => StudentFile::where('assigned_to', $user->id)->whereIn('status', ['contacted', 'in_progress'])->count(),
                'my_success'      => StudentFile::where('assigned_to', $user->id)->whereIn('status', ['admitted', 'visa_granted'])->count(),
            ];
            $executives = collect();
            $allStaff = collect();
            $recentLogs = collect();
        }

        return view('admin.dashboard', compact('user', 'isAdmin', 'studentFiles', 'inquiries', 'stats', 'executives', 'allStaff', 'recentLogs'));
    }

    /**
     * Store a newly created student file (Admin and Executive).
     */
    public function storeStudentFile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'phone'           => ['required', 'string', 'max:50'],
            'email'           => ['nullable', 'email', 'max:255'],
            'destination'     => ['nullable', 'string', 'max:100'],
            'desired_course'  => ['nullable', 'string', 'max:255'],
            'intake'          => ['nullable', 'string', 'max:100'],
            'education_level' => ['nullable', 'string', 'max:255'],
            'english_test'    => ['nullable', 'string', 'max:100'],
            'message'         => ['nullable', 'string', 'max:3000'],
            'status'          => ['required', 'string', 'in:new,contacted,in_progress,admitted,visa_granted,rejected,closed'],
            'assigned_to'     => ['nullable', 'exists:users,id'],
            'internal_notes'  => ['nullable', 'string', 'max:3000'],
        ]);

        $assignedTo = $validated['assigned_to'] ?? null;
        if (! $user->isAdmin() && empty($assignedTo)) {
            // Executive defaults to assigning to self unless specified
            $assignedTo = $user->id;
        }

        $studentFile = StudentFile::create([
            'name'            => $validated['name'],
            'phone'           => $validated['phone'],
            'email'           => $validated['email'] ?? null,
            'destination'     => $validated['destination'] ?? 'Not Specified',
            'desired_course'  => $validated['desired_course'] ?? null,
            'intake'          => $validated['intake'] ?? null,
            'education_level' => $validated['education_level'] ?? null,
            'english_test'    => $validated['english_test'] ?? null,
            'message'         => $validated['message'] ?? null,
            'status'          => $validated['status'],
            'assigned_to'     => $assignedTo,
            'created_by'      => $user->id,
            'internal_notes'  => $validated['internal_notes'] ?? null,
        ]);

        // Keep inquiries table mirrored
        Inquiry::create([
            'name'           => $validated['name'],
            'email'          => $validated['email'] ?? '',
            'phone'          => $validated['phone'],
            'destination'    => $validated['destination'] ?? 'Not Specified',
            'message'        => $validated['message'] ?? null,
            'status'         => $validated['status'],
            'assigned_to'    => $assignedTo,
            'internal_notes' => $validated['internal_notes'] ?? null,
        ]);

        ActivityLog::record(
            'Student Files',
            'created',
            "Created student file for '{$studentFile->name}' (Destination: {$studentFile->destination}, Stage: " . ucfirst(str_replace('_', ' ', $studentFile->status)) . ")",
            ['student_file_id' => $studentFile->id, 'phone' => $studentFile->phone, 'destination' => $studentFile->destination]
        );

        return back()->with('success', 'Student file for ' . $studentFile->name . ' created successfully.');
    }

    /**
     * Update a student file status, assignment, or internal notes.
     */
    public function updateStudentFile(Request $request, $id)
    {
        $studentFile = StudentFile::findOrFail($id);
        $user = Auth::user();

        // Security check for non-admin
        if (! $user->isAdmin() && $studentFile->assigned_to !== null && $studentFile->assigned_to !== $user->id) {
            return back()->with('error', 'You can only update student files assigned to you or unassigned files.');
        }

        $validated = $request->validate([
            'status'         => ['required', 'string', 'in:new,contacted,in_progress,admitted,visa_granted,rejected,closed'],
            'destination'    => ['nullable', 'string', 'max:100'],
            'desired_course' => ['nullable', 'string', 'max:255'],
            'intake'         => ['nullable', 'string', 'max:100'],
            'internal_notes' => ['nullable', 'string', 'max:3000'],
            'assigned_to'    => ['nullable', 'exists:users,id'],
        ]);

        // If executive takes unassigned lead, auto assign to themselves
        if (! $user->isAdmin() && empty($studentFile->assigned_to)) {
            $studentFile->assigned_to = $user->id;
        } elseif ($user->isAdmin() && $request->has('assigned_to')) {
            $studentFile->assigned_to = $request->input('assigned_to') ?: null;
        }

        $studentFile->status = $validated['status'];
        if ($request->has('destination')) {
            $studentFile->destination = $validated['destination'];
        }
        if ($request->has('desired_course')) {
            $studentFile->desired_course = $validated['desired_course'];
        }
        if ($request->has('intake')) {
            $studentFile->intake = $validated['intake'];
        }
        if ($request->has('internal_notes')) {
            $studentFile->internal_notes = $validated['internal_notes'];
        }
        $studentFile->save();

        // Sync with inquiries table if matching record exists
        Inquiry::where('id', $id)->orWhere('phone', $studentFile->phone)->update([
            'status'         => $studentFile->status,
            'assigned_to'    => $studentFile->assigned_to,
            'internal_notes' => $studentFile->internal_notes,
            'destination'    => $studentFile->destination,
        ]);

        ActivityLog::record(
            'Student Files',
            'updated',
            "Updated student file for '{$studentFile->name}' (Status: " . ucfirst(str_replace('_', ' ', $studentFile->status)) . ", Destination: {$studentFile->destination})",
            ['student_file_id' => $studentFile->id, 'new_status' => $studentFile->status]
        );

        return back()->with('success', 'Student file for ' . $studentFile->name . ' updated successfully.');
    }

    /**
     * Delete student file.
     */
    public function deleteStudentFile($id)
    {
        $user = Auth::user();
        if (! $user->isAdmin()) {
            abort(403);
        }

        $studentFile = StudentFile::findOrFail($id);
        $name = $studentFile->name;
        $studentFile->delete();

        // Also remove from inquiries if present
        Inquiry::where('id', $id)->orWhere('phone', $studentFile->phone)->delete();

        ActivityLog::record(
            'Student Files',
            'deleted',
            "Deleted student file of '{$name}' (ID #{$id})",
            ['student_id' => $id, 'name' => $name]
        );

        return back()->with('success', 'Student file for ' . $name . ' has been removed.');
    }

    /**
     * Backward-compatible alias for updateInquiry.
     */
    public function updateInquiry(Request $request, $id)
    {
        return $this->updateStudentFile($request, $id);
    }

    /**
     * Backward-compatible alias for deleteInquiry.
     */
    public function deleteInquiry($id)
    {
        return $this->deleteStudentFile($id);
    }

    /**
     * Admin only: Create a new user / counselor.
     */
    public function storeUser(Request $request)
    {
        if (! Auth::user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'       => ['nullable', 'string', 'max:50'],
            'role'        => ['required', 'string', 'in:admin,executive'],
            'designation' => ['nullable', 'string', 'max:255'],
            'password'    => ['required', 'string', 'min:6'],
        ]);

        User::create([
            'name'              => $validated['name'],
            'email'             => $validated['email'],
            'phone'             => $validated['phone'] ?? null,
            'role'              => $validated['role'],
            'status'            => 'active',
            'designation'       => $validated['designation'] ?? null,
            'password'          => Hash::make($validated['password']),
            'email_verified_at' => now(),
        ]);

        ActivityLog::record(
            'Staff',
            'created',
            "Added new team member '{$validated['name']}' ({$validated['email']}) as " . ucfirst($validated['role'])
        );

        return back()->with('success', 'New team member (' . $validated['name'] . ') added successfully.');
    }

    /**
     * Admin only: Toggle staff status active/inactive.
     */
    public function toggleUserStatus($id)
    {
        if (! Auth::user()->isAdmin()) {
            abort(403);
        }

        $targetUser = User::findOrFail($id);

        // Prevent deactivating oneself
        if ($targetUser->id === Auth::id()) {
            return back()->with('error', 'You cannot deactivate your own administrative account.');
        }

        $targetUser->status = ($targetUser->status === 'active') ? 'inactive' : 'active';
        $targetUser->save();

        ActivityLog::record(
            'Staff',
            'toggled',
            "Changed account status of '{$targetUser->name}' to " . ucfirst($targetUser->status)
        );

        return back()->with('success', 'Status for ' . $targetUser->name . ' changed to ' . ucfirst($targetUser->status) . '.');
    }
}

