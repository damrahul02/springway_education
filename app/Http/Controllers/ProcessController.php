<?php

namespace App\Http\Controllers;

use App\Models\ProcessStep;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /**
     * Store a newly created process roadmap step.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'step_number'       => ['nullable', 'string', 'max:20'],
            'title'             => ['required', 'string', 'max:255'],
            'description'       => ['required', 'string'],
            'short_description' => ['nullable', 'string'],
            'badge'             => ['nullable', 'string', 'max:255'],
            'sort_order'        => ['nullable', 'integer'],
            'is_active'         => ['nullable', 'boolean'],
        ]);

        $sortOrder = $validated['sort_order'] ?? ((ProcessStep::max('sort_order') ?? 0) + 1);
        $stepNumber = $validated['step_number'] ?: str_pad((string)$sortOrder, 2, '0', STR_PAD_LEFT);

        $step = ProcessStep::create([
            'step_number'       => $stepNumber,
            'title'             => $validated['title'],
            'description'       => $validated['description'],
            'short_description' => $validated['short_description'] ?: null,
            'badge'             => $validated['badge'] ?: null,
            'sort_order'        => $sortOrder,
            'is_active'         => $request->boolean('is_active', true),
        ]);

        ActivityLog::record(
            'Process Steps',
            'created',
            "Added roadmap step '{$step->step_number}: {$step->title}'",
            ['step_id' => $step->id]
        );

        return redirect()->route('admin.pages.index', ['tab' => 'process'])
            ->with('success', 'Process Step "' . $validated['title'] . '" added successfully.');
    }

    /**
     * Update the specified process roadmap step.
     */
    public function update(Request $request, $id)
    {
        $step = ProcessStep::findOrFail($id);

        $validated = $request->validate([
            'step_number'       => ['nullable', 'string', 'max:20'],
            'title'             => ['required', 'string', 'max:255'],
            'description'       => ['required', 'string'],
            'short_description' => ['nullable', 'string'],
            'badge'             => ['nullable', 'string', 'max:255'],
            'sort_order'        => ['nullable', 'integer'],
            'is_active'         => ['nullable', 'boolean'],
        ]);

        $sortOrder = $validated['sort_order'] ?? $step->sort_order;
        $stepNumber = $validated['step_number'] ?: str_pad((string)$sortOrder, 2, '0', STR_PAD_LEFT);

        $step->update([
            'step_number'       => $stepNumber,
            'title'             => $validated['title'],
            'description'       => $validated['description'],
            'short_description' => $validated['short_description'] ?: null,
            'badge'             => $validated['badge'] ?: null,
            'sort_order'        => $sortOrder,
            'is_active'         => $request->boolean('is_active'),
        ]);

        ActivityLog::record(
            'Process Steps',
            'updated',
            "Updated roadmap step '{$step->step_number}: {$step->title}'",
            ['step_id' => $step->id]
        );

        return redirect()->route('admin.pages.index', ['tab' => 'process'])
            ->with('success', 'Process Step "' . $step->title . '" updated successfully.');
    }

    /**
     * Delete the specified process roadmap step.
     */
    public function destroy($id)
    {
        $step = ProcessStep::findOrFail($id);
        $title = $step->title;
        $step->delete();

        ActivityLog::record(
            'Process Steps',
            'deleted',
            "Deleted roadmap step '{$step->step_number}: {$title}'",
            ['step_id' => $id, 'title' => $title]
        );

        return redirect()->route('admin.pages.index', ['tab' => 'process'])
            ->with('success', 'Process Step "' . $title . '" deleted successfully.');
    }

    /**
     * Toggle the active visibility status of the step.
     */
    public function toggleActive($id)
    {
        $step = ProcessStep::findOrFail($id);
        $step->is_active = !$step->is_active;
        $step->save();

        $statusText = $step->is_active ? 'visible' : 'hidden';
        ActivityLog::record(
            'Process Steps',
            'toggled',
            "Toggled step '{$step->title}' visibility to {$statusText}",
            ['step_id' => $step->id, 'is_active' => $step->is_active]
        );

        return redirect()->route('admin.pages.index', ['tab' => 'process'])
            ->with('success', 'Process Step "' . $step->title . '" is now ' . ($step->is_active ? 'visible on public site' : 'hidden from public site') . '.');
    }
}

