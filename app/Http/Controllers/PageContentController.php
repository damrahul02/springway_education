<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use App\Models\ServiceItem;
use App\Models\DestinationItem;
use App\Models\ProcessStep;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    /**
     * Display page content manager with tabbed sections.
     */
    public function index(Request $request)
    {
        $activeTab = $request->query('tab', 'about');
        $validTabs = ['about', 'services', 'destinations', 'process', 'contact', 'home'];

        if (! in_array($activeTab, $validTabs)) {
            $activeTab = 'about';
        }

        $sections = PageContent::where('page', $activeTab)->get()->keyBy('section_key');
        $serviceItems = ($activeTab === 'services') ? ServiceItem::orderBy('sort_order')->latest('id')->get() : collect();
        $destinationItems = ($activeTab === 'destinations') ? DestinationItem::orderBy('sort_order')->latest('id')->get() : collect();
        $processSteps = ($activeTab === 'process') ? ProcessStep::orderBy('sort_order')->latest('id')->get() : collect();

        return view('admin.pages.index', compact('activeTab', 'sections', 'serviceItems', 'destinationItems', 'processSteps'));
    }

    /**
     * Save/Update a specific section content for a page.
     */
    public function updateSection(Request $request)
    {
        $validated = $request->validate([
            'page'        => ['required', 'string'],
            'section_key' => ['required', 'string'],
            'title'       => ['nullable', 'string', 'max:255'],
            'subtitle'    => ['nullable', 'string', 'max:255'],
            'content'     => ['nullable', 'string'],
            'image_file'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'image_url'   => ['nullable', 'string', 'max:1000'],
        ]);

        $section = PageContent::firstOrNew([
            'page'        => $validated['page'],
            'section_key' => $validated['section_key'],
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'page_' . $validated['page'] . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pages'), $filename);
            $section->image = '/uploads/pages/' . $filename;
        } elseif ($request->filled('image_url')) {
            $section->image = $request->image_url;
        }

        $section->title = $validated['title'] ?? null;
        $section->subtitle = $validated['subtitle'] ?? null;
        $section->content = $validated['content'] ?? null;
        $section->save();

        ActivityLog::record(
            'Page Content CMS',
            'updated',
            "Updated section '" . str_replace('_', ' ', $validated['section_key']) . "' on " . ucfirst($validated['page']) . " page",
            ['page' => $validated['page'], 'section_key' => $validated['section_key']]
        );

        return redirect()->route('admin.pages.index', ['tab' => $validated['page']])
            ->with('success', 'Page section [' . ucfirst($validated['page']) . ' &bull; ' . str_replace('_', ' ', $validated['section_key']) . '] updated successfully.');
    }
}
