<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'permissions',
        'status',
        'designation',
        'avatar',
        'bio',
        'last_login_at',
        'email_verified_at',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at'     => 'datetime',
            'password'          => 'hashed',
            'permissions'        => 'array',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isExecutive(): bool
    {
        return $this->role === 'executive';
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if user has permission to access a section.
     */
    public function canAccess(string $permission): bool
    {
        if ($this->isAdmin()) {
            return true;
        }

        if (! $this->isActive()) {
            return false;
        }

        $perms = $this->permissions ?? [];
        if (in_array($permission, $perms, true)) {
            return true;
        }

        // Student files counselors also get access to consultation inquiries
        if ($permission === 'consultations' && in_array('student_files', $perms, true)) {
            return true;
        }

        return false;
    }

    /**
     * Get the first route name this user has permission to visit.
     */
    public function firstAllowedRoute(): string
    {
        if ($this->isAdmin() || $this->canAccess('student_files')) {
            return 'admin.dashboard';
        }

        if ($this->canAccess('pages')) {
            return 'admin.pages.index';
        }

        if ($this->canAccess('news')) {
            return 'admin.news.index';
        }

        if ($this->canAccess('gallery')) {
            return 'admin.gallery.index';
        }

        if ($this->canAccess('consultations')) {
            return 'admin.consultations.index';
        }

        return 'home';
    }

    /**
     * Map of available permission definitions.
     */
    public static function availablePermissions(): array
    {
        return [
            'student_files' => [
                'name'        => 'Dashboard & Student Files',
                'description' => 'View total lead metrics, search student files, update admission status, and manage inquiry records',
                'icon'        => 'fa-chart-pie',
                'color'       => 'blue',
            ],
            'consultations' => [
                'name'        => 'Consultation Inquiries',
                'description' => 'Review website consultation submissions, mark messages as seen/unseen, and contact students directly via Gmail and WhatsApp',
                'icon'        => 'fa-envelope-open-text',
                'color'       => 'teal',
            ],
            'pages' => [
                'name'        => 'Page Content CMS',
                'description' => 'Edit headlines, hero banners, service cards, destinations, and roadmap steps across public pages',
                'icon'        => 'fa-file-lines',
                'color'       => 'amber',
            ],
            'news' => [
                'name'        => 'News & Updates',
                'description' => 'Write, publish, modify, and delete news articles, press updates, and scholarship announcements',
                'icon'        => 'fa-newspaper',
                'color'       => 'emerald',
            ],
            'gallery' => [
                'name'        => 'Photo & Video Gallery',
                'description' => 'Upload student visa success pictures, orientation videos, and manage featured gallery media',
                'icon'        => 'fa-photo-film',
                'color'       => 'purple',
            ],
        ];
    }

    public function assignedInquiries()
    {
        return $this->hasMany(Inquiry::class, 'assigned_to');
    }

    public function studentFiles()
    {
        return $this->hasMany(StudentFile::class, 'assigned_to');
    }
}
