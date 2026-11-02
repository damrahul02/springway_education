<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of news articles in admin.
     */
    public function index(Request $request)
    {
        $query = NewsPost::with('author')->latest('published_at');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->where('is_published', true);
            } elseif ($request->status === 'draft') {
                $query->where('is_published', false);
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        $newsPosts = $query->paginate(12)->withQueryString();
        $categories = NewsPost::select('category')->distinct()->pluck('category');

        return view('admin.news.index', compact('newsPosts', 'categories'));
    }

    /**
     * Show form to create new article.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store new article.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'category'     => ['required', 'string', 'max:100'],
            'summary'      => ['nullable', 'string', 'max:1000'],
            'content'      => ['required', 'string'],
            'image_file'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'image_url'    => ['nullable', 'string', 'max:1000'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $image = '/images/hero/slide1.jpg'; // fallback
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'news_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/news'), $filename);
            $image = '/uploads/news/' . $filename;
        } elseif ($request->filled('image_url')) {
            $image = $request->image_url;
        }

        $slug = NewsPost::generateUniqueSlug($validated['title']);

        $post = NewsPost::create([
            'title'        => $validated['title'],
            'slug'         => $slug,
            'category'     => $validated['category'],
            'summary'      => $validated['summary'] ?? Str::limit(strip_tags($validated['content']), 160),
            'content'      => $validated['content'],
            'image'        => $image,
            'author_id'    => Auth::id(),
            'is_published' => $request->boolean('is_published'),
            'published_at' => $request->boolean('is_published') ? now() : null,
        ]);

        ActivityLog::record(
            'News & Updates',
            'created',
            "Published news article '{$post->title}' (" . ucfirst($post->category) . ")",
            ['post_id' => $post->id, 'slug' => $post->slug]
        );

        return redirect()->route('admin.news.index')->with('success', 'News post published successfully!');
    }

    /**
     * Show form to edit article.
     */
    public function edit($id)
    {
        $post = NewsPost::findOrFail($id);
        return view('admin.news.edit', compact('post'));
    }

    /**
     * Update article.
     */
    public function update(Request $request, $id)
    {
        $post = NewsPost::findOrFail($id);

        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'category'     => ['required', 'string', 'max:100'],
            'summary'      => ['nullable', 'string', 'max:1000'],
            'content'      => ['required', 'string'],
            'image_file'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'image_url'    => ['nullable', 'string', 'max:1000'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'news_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/news'), $filename);
            $post->image = '/uploads/news/' . $filename;
        } elseif ($request->filled('image_url')) {
            $post->image = $request->image_url;
        }

        if ($post->title !== $validated['title']) {
            $post->slug = NewsPost::generateUniqueSlug($validated['title'], $post->id);
        }

        $wasPublished = $post->is_published;
        $nowPublished = $request->boolean('is_published');

        $post->title = $validated['title'];
        $post->category = $validated['category'];
        $post->summary = $validated['summary'] ?? Str::limit(strip_tags($validated['content']), 160);
        $post->content = $validated['content'];
        $post->is_published = $nowPublished;

        if (! $wasPublished && $nowPublished && empty($post->published_at)) {
            $post->published_at = now();
        }

        $post->save();

        ActivityLog::record(
            'News & Updates',
            'updated',
            "Updated news article '{$post->title}' (" . ucfirst($post->category) . ")",
            ['post_id' => $post->id, 'slug' => $post->slug]
        );

        return redirect()->route('admin.news.index')->with('success', 'Article updated successfully.');
    }

    /**
     * Toggle publish state.
     */
    public function togglePublish($id)
    {
        $post = NewsPost::findOrFail($id);
        $post->is_published = ! $post->is_published;
        if ($post->is_published && empty($post->published_at)) {
            $post->published_at = now();
        }
        $post->save();

        $status = $post->is_published ? 'Published' : 'Draft';
        ActivityLog::record(
            'News & Updates',
            'toggled',
            "Changed article '{$post->title}' status to {$status}",
            ['post_id' => $post->id, 'status' => $status]
        );

        return back()->with('success', "Article status updated: {$status}");
    }

    /**
     * Delete article.
     */
    public function destroy($id)
    {
        $post = NewsPost::findOrFail($id);
        $title = $post->title;
        $post->delete();

        ActivityLog::record(
            'News & Updates',
            'deleted',
            "Deleted news article '{$title}'",
            ['post_id' => $id, 'title' => $title]
        );

        return back()->with('success', "News article '{$title}' deleted.");
    }
}
