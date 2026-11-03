<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    /**
     * Display a listing of student consultation messages.
     */
    public function index(Request $request)
    {
        $query = Consultation::with('seenByUser')->latest();

        // Status or Seen filter
        if ($filter = $request->query('filter')) {
            if ($filter === 'unseen') {
                $query->unseen();
            } elseif ($filter === 'seen') {
                $query->seen();
            } elseif (in_array($filter, ['new', 'contacted', 'in_progress', 'archived'])) {
                $query->where('status', $filter);
            }
        }

        // Destination filter
        if ($dest = $request->query('destination')) {
            $query->where('destination', $dest);
        }

        // Source filter
        if ($source = $request->query('source')) {
            $query->where('source', 'like', "%{$source}%");
        }

        // Search
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('destination', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%")
                  ->orWhere('education_level', 'like', "%{$search}%");
            });
        }

        $consultations = $query->paginate(15)->withQueryString();

        // Metrics
        $totalCount     = Consultation::count();
        $unseenCount    = Consultation::unseen()->count();
        $seenCount      = Consultation::seen()->count();
        $contactedCount = Consultation::where('status', 'contacted')->count();
        $todayCount     = Consultation::whereDate('created_at', today())->count();

        $destinations = Consultation::select('destination')
            ->distinct()
            ->whereNotNull('destination')
            ->where('destination', '!=', '')
            ->pluck('destination');

        return view('admin.consultations.index', compact(
            'consultations',
            'totalCount',
            'unseenCount',
            'seenCount',
            'contactedCount',
            'todayCount',
            'destinations'
        ));
    }

    /**
     * Toggle the seen / unseen status of a consultation message.
     */
    public function toggleSeen($id)
    {
        $consultation = Consultation::findOrFail($id);

        if ($consultation->is_seen) {
            $consultation->markAsUnseen();
            $actionLabel = 'unseen';
        } else {
            $consultation->markAsSeen(Auth::user());
            $actionLabel = 'seen';
        }

        ActivityLog::record(
            'Consultation Inquiries',
            'updated',
            "Marked consultation request from '{$consultation->name}' as {$actionLabel}",
            ['consultation_id' => $consultation->id, 'is_seen' => $consultation->is_seen]
        );

        return back()->with('success', "Message from {$consultation->name} marked as {$actionLabel}.");
    }

    /**
     * Mark all consultation messages as seen.
     */
    public function markAllSeen()
    {
        $unseenCount = Consultation::unseen()->count();

        Consultation::unseen()->update([
            'is_seen' => true,
            'seen_at' => now(),
            'seen_by' => Auth::id(),
        ]);

        ActivityLog::record(
            'Consultation Inquiries',
            'updated',
            "Marked all ({$unseenCount}) consultation inquiries as seen"
        );

        return back()->with('success', "All {$unseenCount} unseen consultation inquiries marked as seen.");
    }

    /**
     * Update consultation status and internal counselor notes.
     */
    public function updateStatus(Request $request, $id)
    {
        $consultation = Consultation::findOrFail($id);

        $validated = $request->validate([
            'status' => ['required', 'string', 'in:new,contacted,in_progress,archived'],
            'notes'  => ['nullable', 'string', 'max:3000'],
        ]);

        $oldStatus = $consultation->status;

        $consultation->update([
            'status'  => $validated['status'],
            'notes'   => $validated['notes'] ?? $consultation->notes,
            'is_seen' => true,
            'seen_at' => $consultation->seen_at ?? now(),
            'seen_by' => $consultation->seen_by ?? Auth::id(),
        ]);

        ActivityLog::record(
            'Consultation Inquiries',
            'updated',
            "Updated status of consultation for '{$consultation->name}' from " . ucfirst($oldStatus) . " to " . ucfirst($validated['status']),
            ['consultation_id' => $consultation->id, 'status' => $validated['status']]
        );

        return back()->with('success', "Consultation for {$consultation->name} status updated to " . ucfirst($validated['status']) . ".");
    }

    /**
     * Get quick view JSON data for a consultation message.
     */
    public function quickView($id)
    {
        $consultation = Consultation::with('seenByUser')->findOrFail($id);

        // Auto mark as seen on view
        if (! $consultation->is_seen) {
            $consultation->markAsSeen(Auth::user());
        }

        return response()->json([
            'id'              => $consultation->id,
            'name'            => $consultation->name,
            'email'           => $consultation->email,
            'phone'           => $consultation->phone,
            'destination'     => $consultation->destination ?: 'Not Specified',
            'education_level' => $consultation->education_level ?: 'Not Specified',
            'english_test'    => $consultation->english_test ?: 'Not Specified',
            'message'         => $consultation->message ?: 'No additional message was provided.',
            'source'          => $consultation->source,
            'is_seen'         => $consultation->is_seen,
            'status'          => $consultation->status,
            'notes'           => $consultation->notes ?: '',
            'created_at'      => $consultation->created_at->format('M d, Y h:i A'),
            'created_diff'    => $consultation->created_at->diffForHumans(),
            'gmail_url'       => $consultation->gmail_compose_url,
            'whatsapp_url'    => $consultation->whatsapp_url,
            'mailto_url'      => $consultation->mailto_url,
        ]);
    }

    /**
     * Delete a consultation inquiry.
     */
    public function destroy($id)
    {
        $consultation = Consultation::findOrFail($id);
        $name = $consultation->name;
        $consultation->delete();

        ActivityLog::record(
            'Consultation Inquiries',
            'deleted',
            "Deleted consultation inquiry from '{$name}'",
            ['consultation_id' => $id, 'name' => $name]
        );

        return back()->with('success', "Consultation inquiry from {$name} has been deleted.");
    }
}

