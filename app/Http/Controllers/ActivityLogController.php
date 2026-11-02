<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of audit activity and history logs.
     */
    public function index(Request $request)
    {
        $query = ActivityLog::latest();

        // Search filter
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('user_name', 'like', "%{$search}%")
                  ->orWhere('user_email', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%");
            });
        }

        // Module filter
        if ($module = $request->input('module')) {
            $query->where('module', $module);
        }

        // Action filter
        if ($action = $request->input('action')) {
            $query->where('action', $action);
        }

        // User filter
        if ($userId = $request->input('user_id')) {
            $query->where('user_id', $userId);
        }

        // Date filter
        if ($date = $request->input('date')) {
            $query->whereDate('created_at', $date);
        }

        $logs = $query->paginate(25)->withQueryString();

        // Summary metrics
        $totalLogs = ActivityLog::count();
        $todayLogs = ActivityLog::whereDate('created_at', today())->count();
        $activeUsersToday = ActivityLog::whereDate('created_at', today())->distinct('user_id')->count('user_id');
        $executives = User::orderBy('name')->get();

        $modules = [
            'Student Files',
            'Page Content CMS',
            'Services',
            'Destinations',
            'Process Steps',
            'News & Updates',
            'Photo & Video Gallery',
            'Permission Manager',
            'Profile & Security',
            'Authentication',
        ];

        $actions = [
            'created' => 'Created',
            'updated' => 'Updated',
            'deleted' => 'Deleted',
            'toggled' => 'Toggled',
            'login'   => 'Sign In',
            'logout'  => 'Sign Out',
        ];

        return view('admin.logs.index', compact(
            'logs',
            'totalLogs',
            'todayLogs',
            'activeUsersToday',
            'executives',
            'modules',
            'actions'
        ));
    }

    /**
     * Clear older history logs (Admin Only).
     */
    public function clear(Request $request)
    {
        $days = (int) $request->input('days', 30);

        if ($days <= 0) {
            ActivityLog::truncate();
            $msg = 'All activity history logs have been cleared successfully.';
        } else {
            $deletedCount = ActivityLog::where('created_at', '<', now()->subDays($days))->delete();
            $msg = "Cleared {$deletedCount} audit logs older than {$days} days.";
        }

        ActivityLog::record(
            'Permission Manager',
            'deleted',
            "Administrator cleared audit history logs ($msg)"
        );

        return redirect()->route('admin.logs.index')->with('success', $msg);
    }
}

