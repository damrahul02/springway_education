<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\StudentFile;
use App\Models\NewsPost;
use App\Models\GalleryItem;
use App\Models\PageContent;
use App\Models\ServiceItem;
use App\Models\DestinationItem;
use App\Models\ProcessStep;
use App\Models\Consultation;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Homepage with highlights from all sections
     */
    public function index()
    {
        $latestNews = NewsPost::where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        $featuredGallery = GalleryItem::where('is_featured', true)
            ->orderBy('sort_order')
            ->latest()
            ->take(6)
            ->get();

        if ($featuredGallery->isEmpty()) {
            $featuredGallery = GalleryItem::orderBy('sort_order')->latest()->take(6)->get();
        }

        $homeContent = PageContent::where('page', 'home')->get()->keyBy('section_key');
        $serviceItems = ServiceItem::where('is_active', true)->orderBy('sort_order')->take(6)->get();
        $destinationItems = DestinationItem::where('is_active', true)->orderBy('sort_order')->get();
        $processSteps = ProcessStep::where('is_active', true)->orderBy('sort_order')->get();

        return view('home', compact('latestNews', 'featuredGallery', 'homeContent', 'serviceItems', 'destinationItems', 'processSteps'));
    }

    /**
     * Dedicated About Us Page
     */
    public function about()
    {
        $aboutContent = PageContent::where('page', 'about')->get()->keyBy('section_key');
        return view('pages.about', compact('aboutContent'));
    }

    /**
     * Dedicated Services Page
     */
    public function services()
    {
        $servicesContent = PageContent::where('page', 'services')->get()->keyBy('section_key');
        $serviceItems = ServiceItem::where('is_active', true)->orderBy('sort_order')->get();
        return view('pages.services', compact('servicesContent', 'serviceItems'));
    }

    /**
     * Dedicated Study Destinations Page
     */
    public function destinations()
    {
        $destContent = PageContent::where('page', 'destinations')->get()->keyBy('section_key');
        $destinationItems = DestinationItem::where('is_active', true)->orderBy('sort_order')->get();
        return view('pages.destinations', compact('destContent', 'destinationItems'));
    }

    /**
     * Dedicated Process & Roadmap Page
     */
    public function process()
    {
        $processContent = PageContent::where('page', 'process')->get()->keyBy('section_key');
        $processSteps = ProcessStep::where('is_active', true)->orderBy('sort_order')->get();
        return view('pages.process', compact('processContent', 'processSteps'));
    }

    /**
     * Dedicated Gallery Page (Photos & Videos)
     */
    public function gallery(Request $request)
    {
        $query = GalleryItem::orderBy('sort_order')->latest();

        if ($request->filled('type') && in_array($request->type, ['image', 'video'])) {
            $query->where('type', $request->type);
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $items = $query->paginate(12)->withQueryString();
        $categories = GalleryItem::select('category')->distinct()->pluck('category');

        return view('pages.gallery', compact('items', 'categories'));
    }

    /**
     * Dedicated News & Activities Page
     */
    public function news(Request $request)
    {
        $query = NewsPost::with('author')
            ->where('is_published', true)
            ->latest('published_at');

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $newsPosts = $query->paginate(9)->withQueryString();
        $categories = NewsPost::where('is_published', true)->select('category')->distinct()->pluck('category');
        $featuredPost = NewsPost::where('is_published', true)->latest('published_at')->first();

        return view('pages.news.index', compact('newsPosts', 'categories', 'featuredPost'));
    }

    /**
     * Single News Article Page
     */
    public function newsShow($slug)
    {
        $post = NewsPost::with('author')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Increment view count
        $post->increment('views_count');

        $relatedPosts = NewsPost::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->latest('published_at')
            ->take(3)
            ->get();

        if ($relatedPosts->isEmpty()) {
            $relatedPosts = NewsPost::where('is_published', true)
                ->where('id', '!=', $post->id)
                ->latest('published_at')
                ->take(3)
                ->get();
        }

        return view('pages.news.show', compact('post', 'relatedPosts'));
    }

    /**
     * Dedicated Contact Us Page
     */
    public function contact()
    {
        $contactContent = PageContent::where('page', 'contact')->get()->keyBy('section_key');
        return view('pages.contact', compact('contactContent'));
    }

    /**
     * Submit consultation inquiry from any page
     */
    public function submitConsultation(Request $request)
    {
        $validated = $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'email'           => ['required', 'email', 'max:255'],
            'phone'           => ['required', 'string', 'max:50'],
            'destination'     => ['nullable', 'string', 'max:100'],
            'education_level' => ['nullable', 'string', 'max:255'],
            'english_test'    => ['nullable', 'string', 'max:100'],
            'message'         => ['nullable', 'string', 'max:3000'],
            'source'          => ['nullable', 'string', 'max:100'],
        ]);

        $source = $validated['source'] ?? ($request->is('*contact*') ? 'Contact Page' : 'Home Page');

        // 1. Create dedicated Consultation record
        $consultation = Consultation::create([
            'name'            => $validated['name'],
            'email'           => $validated['email'],
            'phone'           => $validated['phone'],
            'destination'     => $validated['destination'] ?? 'Not Specified',
            'education_level' => $validated['education_level'] ?? null,
            'english_test'    => $validated['english_test'] ?? null,
            'message'         => $validated['message'] ?? null,
            'source'          => $source,
            'is_seen'         => false,
            'status'          => 'new',
            'ip_address'      => $request->ip(),
        ]);

        // 2. Mirror into StudentFile for CRM lead workflows
        StudentFile::create([
            'name'            => $validated['name'],
            'email'           => $validated['email'],
            'phone'           => $validated['phone'],
            'destination'     => $validated['destination'] ?? 'Not Specified',
            'education_level' => $validated['education_level'] ?? null,
            'english_test'    => $validated['english_test'] ?? null,
            'message'         => $validated['message'] ?? null,
            'status'          => 'new',
            'internal_notes'  => "Inquiry submitted via {$source}",
        ]);

        // 3. Mirror into Inquiry table for backward compatibility
        Inquiry::create([
            'name'           => $validated['name'],
            'email'          => $validated['email'],
            'phone'          => $validated['phone'],
            'destination'    => $validated['destination'] ?? 'Not Specified',
            'message'        => $validated['message'] ?? null,
            'status'         => 'new',
            'internal_notes' => "Inquiry submitted via {$source}",
        ]);

        // 4. Audit Log
        ActivityLog::record(
            'Consultation Inquiries',
            'created',
            "New free consultation request from '{$consultation->name}' ({$consultation->destination}) via {$source}",
            ['consultation_id' => $consultation->id, 'email' => $consultation->email, 'phone' => $consultation->phone]
        );

        return back()->with('consultation_success', 'Thank you, ' . $validated['name'] . '! Your consultation request has been received. Our senior counselor will contact you within 24 hours.');
    }
}
