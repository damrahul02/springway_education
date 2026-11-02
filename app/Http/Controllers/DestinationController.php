<?php

namespace App\Http\Controllers;

use App\Models\DestinationItem;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Store a newly created destination card.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'country'         => ['required', 'string', 'max:150'],
            'flag'            => ['required', 'string', 'max:50'],
            'gradient'        => ['nullable', 'string', 'max:255'],
            'badge'           => ['nullable', 'string', 'max:50'],
            'short_detail'    => ['nullable', 'string', 'max:255'],
            'description'     => ['required', 'string'],
            'intakes'         => ['nullable', 'string', 'max:255'],
            'post_study_work' => ['nullable', 'string', 'max:255'],
            'extra_info'      => ['nullable', 'string', 'max:255'],
            'link_text'       => ['nullable', 'string', 'max:100'],
            'link_url'        => ['nullable', 'string', 'max:255'],
            'sort_order'      => ['nullable', 'integer'],
            'is_active'       => ['nullable', 'boolean'],
        ]);

        $dest = DestinationItem::create([
            'country'         => $validated['country'],
            'flag'            => $validated['flag'],
            'gradient'        => $validated['gradient'] ?: 'linear-gradient(135deg, #0d2b8e, #1a73e8)',
            'badge'           => $validated['badge'] ?: null,
            'short_detail'    => $validated['short_detail'] ?: null,
            'description'     => $validated['description'],
            'intakes'         => $validated['intakes'] ?: null,
            'post_study_work' => $validated['post_study_work'] ?: null,
            'extra_info'      => $validated['extra_info'] ?: null,
            'link_text'       => $validated['link_text'] ?: 'Explore Universities →',
            'link_url'        => $validated['link_url'] ?: '/contact',
            'sort_order'      => $validated['sort_order'] ?? 0,
            'is_active'       => $request->boolean('is_active', true),
        ]);

        ActivityLog::record(
            'Destinations',
            'created',
            "Added new study destination '{$dest->country}'",
            ['destination_id' => $dest->id]
        );

        return redirect()->route('admin.pages.index', ['tab' => 'destinations'])
            ->with('success', 'Destination card "' . $validated['country'] . '" added successfully.');
    }

    /**
     * Update the specified destination card.
     */
    public function update(Request $request, $id)
    {
        $destination = DestinationItem::findOrFail($id);

        $validated = $request->validate([
            'country'         => ['required', 'string', 'max:150'],
            'flag'            => ['required', 'string', 'max:50'],
            'gradient'        => ['nullable', 'string', 'max:255'],
            'badge'           => ['nullable', 'string', 'max:50'],
            'short_detail'    => ['nullable', 'string', 'max:255'],
            'description'     => ['required', 'string'],
            'intakes'         => ['nullable', 'string', 'max:255'],
            'post_study_work' => ['nullable', 'string', 'max:255'],
            'extra_info'      => ['nullable', 'string', 'max:255'],
            'link_text'       => ['nullable', 'string', 'max:100'],
            'link_url'        => ['nullable', 'string', 'max:255'],
            'sort_order'      => ['nullable', 'integer'],
            'is_active'       => ['nullable', 'boolean'],
        ]);

        $destination->update([
            'country'         => $validated['country'],
            'flag'            => $validated['flag'],
            'gradient'        => $validated['gradient'] ?: 'linear-gradient(135deg, #0d2b8e, #1a73e8)',
            'badge'           => $validated['badge'] ?: null,
            'short_detail'    => $validated['short_detail'] ?: null,
            'description'     => $validated['description'],
            'intakes'         => $validated['intakes'] ?: null,
            'post_study_work' => $validated['post_study_work'] ?: null,
            'extra_info'      => $validated['extra_info'] ?: null,
            'link_text'       => $validated['link_text'] ?: 'Explore Universities →',
            'link_url'        => $validated['link_url'] ?: '/contact',
            'sort_order'      => $validated['sort_order'] ?? 0,
            'is_active'       => $request->boolean('is_active'),
        ]);

        ActivityLog::record(
            'Destinations',
            'updated',
            "Updated study destination '{$destination->country}'",
            ['destination_id' => $destination->id]
        );

        return redirect()->route('admin.pages.index', ['tab' => 'destinations'])
            ->with('success', 'Destination card "' . $destination->country . '" updated successfully.');
    }

    /**
     * Delete the specified destination card.
     */
    public function destroy($id)
    {
        $destination = DestinationItem::findOrFail($id);
        $country = $destination->country;
        $destination->delete();

        ActivityLog::record(
            'Destinations',
            'deleted',
            "Deleted destination card '{$country}'",
            ['destination_id' => $id, 'country' => $country]
        );

        return redirect()->route('admin.pages.index', ['tab' => 'destinations'])
            ->with('success', 'Destination card "' . $country . '" deleted.');
    }

    /**
     * Toggle the active status.
     */
    public function toggleActive($id)
    {
        $destination = DestinationItem::findOrFail($id);
        $destination->is_active = ! $destination->is_active;
        $destination->save();

        $status = $destination->is_active ? 'Active' : 'Hidden/Inactive';
        ActivityLog::record(
            'Destinations',
            'toggled',
            "Toggled destination '{$destination->country}' status to {$status}",
            ['destination_id' => $destination->id, 'is_active' => $destination->is_active]
        );

        return redirect()->route('admin.pages.index', ['tab' => 'destinations'])
            ->with('success', "Destination \"{$destination->country}\" status changed to {$status}.");
    }
}

