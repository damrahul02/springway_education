<?php

namespace App\Http\Controllers;

use App\Models\ServiceItem;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Store a newly created service box.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'icon'        => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'features'    => ['nullable', 'string'],
            'link_text'   => ['nullable', 'string', 'max:100'],
            'link_url'    => ['nullable', 'string', 'max:255'],
            'badge'       => ['nullable', 'string', 'max:50'],
            'sort_order'  => ['nullable', 'integer'],
            'is_active'   => ['nullable', 'boolean'],
        ]);

        // Convert newline-separated features into array
        $featuresArray = [];
        if (! empty($validated['features'])) {
            $featuresArray = array_values(array_filter(array_map('trim', explode("\n", $validated['features']))));
        }

        $service = ServiceItem::create([
            'title'       => $validated['title'],
            'icon'        => $validated['icon'],
            'description' => $validated['description'],
            'features'    => $featuresArray,
            'link_text'   => $validated['link_text'] ?: 'Book Free Counseling',
            'link_url'    => $validated['link_url'] ?: '/contact',
            'badge'       => $validated['badge'] ?: null,
            'sort_order'  => $validated['sort_order'] ?? 0,
            'is_active'   => $request->boolean('is_active', true),
        ]);

        ActivityLog::record(
            'Services',
            'created',
            "Added new service box '{$service->title}'",
            ['service_id' => $service->id]
        );

        return redirect()->route('admin.pages.index', ['tab' => 'services'])
            ->with('success', 'Service box "' . $validated['title'] . '" added successfully.');
    }

    /**
     * Update the specified service box.
     */
    public function update(Request $request, $id)
    {
        $service = ServiceItem::findOrFail($id);

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'icon'        => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'features'    => ['nullable', 'string'],
            'link_text'   => ['nullable', 'string', 'max:100'],
            'link_url'    => ['nullable', 'string', 'max:255'],
            'badge'       => ['nullable', 'string', 'max:50'],
            'sort_order'  => ['nullable', 'integer'],
            'is_active'   => ['nullable', 'boolean'],
        ]);

        $featuresArray = [];
        if (! empty($validated['features'])) {
            $featuresArray = array_values(array_filter(array_map('trim', explode("\n", $validated['features']))));
        }

        $service->update([
            'title'       => $validated['title'],
            'icon'        => $validated['icon'],
            'description' => $validated['description'],
            'features'    => $featuresArray,
            'link_text'   => $validated['link_text'] ?: 'Book Free Counseling',
            'link_url'    => $validated['link_url'] ?: '/contact',
            'badge'       => $validated['badge'] ?: null,
            'sort_order'  => $validated['sort_order'] ?? 0,
            'is_active'   => $request->boolean('is_active'),
        ]);

        ActivityLog::record(
            'Services',
            'updated',
            "Updated service box '{$service->title}'",
            ['service_id' => $service->id]
        );

        return redirect()->route('admin.pages.index', ['tab' => 'services'])
            ->with('success', 'Service box "' . $service->title . '" updated successfully.');
    }

    /**
     * Delete the specified service box.
     */
    public function destroy($id)
    {
        $service = ServiceItem::findOrFail($id);
        $title = $service->title;
        $service->delete();

        ActivityLog::record(
            'Services',
            'deleted',
            "Deleted service box '{$title}'",
            ['service_id' => $id, 'title' => $title]
        );

        return redirect()->route('admin.pages.index', ['tab' => 'services'])
            ->with('success', 'Service box "' . $title . '" deleted.');
    }

    /**
     * Toggle the active status.
     */
    public function toggleActive($id)
    {
        $service = ServiceItem::findOrFail($id);
        $service->is_active = ! $service->is_active;
        $service->save();

        $status = $service->is_active ? 'Active' : 'Hidden/Inactive';
        ActivityLog::record(
            'Services',
            'toggled',
            "Toggled service '{$service->title}' status to {$status}",
            ['service_id' => $service->id, 'is_active' => $service->is_active]
        );

        return redirect()->route('admin.pages.index', ['tab' => 'services'])
            ->with('success', "Service \"{$service->title}\" status changed to {$status}.");
    }
}

