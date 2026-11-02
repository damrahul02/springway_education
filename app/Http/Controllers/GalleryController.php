<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of gallery items for admin.
     */
    public function index(Request $request)
    {
        $query = GalleryItem::orderBy('sort_order')->latest();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $items = $query->paginate(15)->withQueryString();
        $categories = GalleryItem::select('category')->distinct()->pluck('category');

        return view('admin.gallery.index', compact('items', 'categories'));
    }

    /**
     * Store a newly created gallery item.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'type'         => ['required', 'in:image,video'],
            'category'     => ['required', 'string', 'max:100'],
            'caption'      => ['nullable', 'string', 'max:1000'],
            'image_file'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'media_url'    => ['nullable', 'string', 'max:1000'],
            'thumbnail_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'is_featured'  => ['nullable', 'boolean'],
            'sort_order'   => ['nullable', 'integer'],
        ]);

        $url = null;
        if ($validated['type'] === 'image') {
            if ($request->hasFile('image_file')) {
                $file = $request->file('image_file');
                $filename = 'gallery_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/gallery'), $filename);
                $url = '/uploads/gallery/' . $filename;
            } elseif ($request->filled('media_url')) {
                $url = $request->media_url;
            } else {
                return back()->with('error', 'Please upload an image file or provide an image URL.')->withInput();
            }
        } else {
            // Video
            if ($request->filled('media_url')) {
                $url = $request->media_url;
            } else {
                return back()->with('error', 'Please provide a video URL (YouTube, Vimeo, etc.).')->withInput();
            }
        }

        $thumbnail = null;
        if ($request->hasFile('thumbnail_file')) {
            $thumbFile = $request->file('thumbnail_file');
            $thumbName = 'thumb_' . time() . '_' . uniqid() . '.' . $thumbFile->getClientOriginalExtension();
            $thumbFile->move(public_path('uploads/gallery'), $thumbName);
            $thumbnail = '/uploads/gallery/' . $thumbName;
        }

        $item = GalleryItem::create([
            'title'       => $validated['title'],
            'type'        => $validated['type'],
            'url'         => $url,
            'thumbnail'   => $thumbnail,
            'category'    => $validated['category'],
            'caption'     => $validated['caption'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'sort_order'  => $validated['sort_order'] ?? 0,
        ]);

        ActivityLog::record(
            'Photo & Video Gallery',
            'created',
            "Uploaded {$validated['type']} to gallery: '{$validated['title']}' (" . ucfirst($validated['category']) . ")",
            ['item_id' => $item->id, 'type' => $validated['type']]
        );

        return back()->with('success', 'Gallery item "' . $validated['title'] . '" added successfully.');
    }

    /**
     * Update the specified gallery item.
     */
    public function update(Request $request, $id)
    {
        $item = GalleryItem::findOrFail($id);

        $validated = $request->validate([
            'title'          => ['required', 'string', 'max:255'],
            'type'           => ['required', 'in:image,video'],
            'category'       => ['required', 'string', 'max:100'],
            'caption'        => ['nullable', 'string', 'max:1000'],
            'image_file'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'media_url'      => ['nullable', 'string', 'max:1000'],
            'thumbnail_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'is_featured'    => ['nullable', 'boolean'],
            'sort_order'     => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'gallery_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery'), $filename);
            $item->url = '/uploads/gallery/' . $filename;
        } elseif ($request->filled('media_url')) {
            $item->url = $request->media_url;
        }

        if ($request->hasFile('thumbnail_file')) {
            $thumbFile = $request->file('thumbnail_file');
            $thumbName = 'thumb_' . time() . '_' . uniqid() . '.' . $thumbFile->getClientOriginalExtension();
            $thumbFile->move(public_path('uploads/gallery'), $thumbName);
            $item->thumbnail = '/uploads/gallery/' . $thumbName;
        }

        $item->title = $validated['title'];
        $item->type = $validated['type'];
        $item->category = $validated['category'];
        $item->caption = $validated['caption'] ?? null;
        $item->is_featured = $request->boolean('is_featured');
        $item->sort_order = $validated['sort_order'] ?? 0;
        $item->save();

        ActivityLog::record(
            'Photo & Video Gallery',
            'updated',
            "Updated gallery item '{$item->title}'",
            ['item_id' => $item->id]
        );

        return back()->with('success', 'Gallery item updated successfully.');
    }

    /**
     * Remove the specified gallery item.
     */
    public function destroy($id)
    {
        $item = GalleryItem::findOrFail($id);
        $title = $item->title;
        $item->delete();

        ActivityLog::record(
            'Photo & Video Gallery',
            'deleted',
            "Deleted gallery item '{$title}'",
            ['item_id' => $id, 'title' => $title]
        );

        return back()->with('success', 'Gallery item "' . $title . '" deleted.');
    }

    /**
     * Toggle featured status.
     */
    public function toggleFeatured($id)
    {
        $item = GalleryItem::findOrFail($id);
        $item->is_featured = ! $item->is_featured;
        $item->save();

        $featuredText = $item->is_featured ? 'featured' : 'unfeatured';
        ActivityLog::record(
            'Photo & Video Gallery',
            'toggled',
            "Marked gallery item '{$item->title}' as {$featuredText}",
            ['item_id' => $item->id, 'is_featured' => $item->is_featured]
        );

        return back()->with('success', 'Featured status updated for "' . $item->title . '".');
    }
}
