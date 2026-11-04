<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageContentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ConsultationController;

/*
|--------------------------------------------------------------------------
| Public Website Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/destinations', [HomeController::class, 'destinations'])->name('destinations');
Route::get('/study-in-bangladesh', [HomeController::class, 'studyInBangladesh'])->name('study_in_bangladesh');
Route::get('/process', [HomeController::class, 'process'])->name('process');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/news', [HomeController::class, 'news'])->name('news');
Route::get('/news-list', [HomeController::class, 'news'])->name('news.index');
Route::get('/news/{slug}', [HomeController::class, 'newsShow'])->name('news.show');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Consultation Form Submission (any page)
Route::post('/consultation-request', [HomeController::class, 'submitConsultation'])->name('consultation.submit');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Accessible only at /login)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Admin Dashboard & Management Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {

    // Profile & Password Management (Available to all authenticated staff & admins)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/info', [ProfileController::class, 'updateInfo'])->name('profile.update_info');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update_password');

    // 1. Dashboard & Student Files (Permission: student_files)
    Route::middleware(['permission:student_files'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/inquiries/{id}/update', [DashboardController::class, 'updateInquiry'])->name('inquiry.update');
        Route::post('/student-files', [DashboardController::class, 'storeStudentFile'])->name('student_files.store');
        Route::post('/student-files/{id}', [DashboardController::class, 'updateStudentFile'])->name('student_files.update');
        Route::delete('/student-files/{id}', [DashboardController::class, 'deleteStudentFile'])->name('student_files.destroy');
    });

    // 2. Consultation Inquiries & Messages (Permission: consultations)
    Route::middleware(['permission:consultations'])->group(function () {
        Route::get('/consultations', [ConsultationController::class, 'index'])->name('consultations.index');
        Route::get('/consultations/{id}/quick-view', [ConsultationController::class, 'quickView'])->name('consultations.quick_view');
        Route::post('/consultations/{id}/toggle-seen', [ConsultationController::class, 'toggleSeen'])->name('consultations.toggle_seen');
        Route::post('/consultations/mark-all-seen', [ConsultationController::class, 'markAllSeen'])->name('consultations.mark_all_seen');
        Route::post('/consultations/{id}/status', [ConsultationController::class, 'updateStatus'])->name('consultations.update_status');
        Route::delete('/consultations/{id}', [ConsultationController::class, 'destroy'])->name('consultations.destroy');
    });

    // 3. News Management (Permission: news)
    Route::middleware(['permission:news'])->group(function () {
        Route::get('/news', [NewsController::class, 'index'])->name('news.index');
        Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
        Route::post('/news', [NewsController::class, 'store'])->name('news.store');
        Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
        Route::post('/news/{id}', [NewsController::class, 'update'])->name('news.update');
        Route::post('/news/{id}/toggle-publish', [NewsController::class, 'togglePublish'])->name('news.toggle');
        Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
    });

    // 3. Gallery Management (Photos & Videos) (Permission: gallery)
    Route::middleware(['permission:gallery'])->group(function () {
        Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
        Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
        Route::post('/gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::post('/gallery/{id}/toggle-featured', [GalleryController::class, 'toggleFeatured'])->name('gallery.toggle');
        Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
    });

    // 4. Page Content CMS (Edit All Pages) (Permission: pages)
    Route::middleware(['permission:pages'])->group(function () {
        Route::get('/pages', [PageContentController::class, 'index'])->name('pages.index');
        Route::post('/pages/update-section', [PageContentController::class, 'updateSection'])->name('pages.update');

        // Service Boxes Management
        Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
        Route::post('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
        Route::post('/services/{id}/toggle-active', [ServiceController::class, 'toggleActive'])->name('services.toggle');

        // Destination Cards Management
        Route::post('/destinations', [DestinationController::class, 'store'])->name('destinations.store');
        Route::post('/destinations/{id}', [DestinationController::class, 'update'])->name('destinations.update');
        Route::delete('/destinations/{id}', [DestinationController::class, 'destroy'])->name('destinations.destroy');
        Route::post('/destinations/{id}/toggle-active', [DestinationController::class, 'toggleActive'])->name('destinations.toggle');

        // Process Steps Management
        Route::post('/process-steps', [ProcessController::class, 'store'])->name('process.store');
        Route::post('/process-steps/{id}', [ProcessController::class, 'update'])->name('process.update');
        Route::delete('/process-steps/{id}', [ProcessController::class, 'destroy'])->name('process.destroy');
        Route::post('/process-steps/{id}/toggle-active', [ProcessController::class, 'toggleActive'])->name('process.toggle');
    });

    // 5. Admin-Only Routes (Role: admin)
    Route::middleware(['role:admin'])->group(function () {
        // Permission Manager
        Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::post('/permissions/executives', [PermissionController::class, 'store'])->name('permissions.store');
        Route::post('/permissions/executives/{id}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('/permissions/executives/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
        Route::post('/permissions/executives/{id}/toggle', [PermissionController::class, 'toggleStatus'])->name('permissions.toggle');

        // History & Activity Audit Logs (Admin Only)
        Route::get('/logs', [ActivityLogController::class, 'index'])->name('logs.index');
        Route::post('/logs/clear', [ActivityLogController::class, 'clear'])->name('logs.clear');

        Route::post('/users', [DashboardController::class, 'storeUser'])->name('users.store');
        Route::post('/users/{id}/toggle-status', [DashboardController::class, 'toggleUserStatus'])->name('users.toggle');
        Route::delete('/inquiries/{id}', [DashboardController::class, 'deleteInquiry'])->name('inquiry.delete');
    });
});
