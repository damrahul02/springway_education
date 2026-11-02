<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'user_role',
        'module',
        'action',
        'description',
        'details',
        'ip_address',
        'user_agent',
    ];

    protected function casts(): array
    {
        return [
            'details' => 'array',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Record an audit activity log entry.
     */
    public static function record(
        string $module,
        string $action,
        string $description,
        ?array $details = null,
        ?User $user = null
    ): self {
        $currentUser = $user ?? Auth::user();

        return self::create([
            'user_id'     => $currentUser?->id,
            'user_name'   => $currentUser?->name ?? 'System / Guest',
            'user_email'  => $currentUser?->email ?? 'system@springwaybd.com',
            'user_role'   => $currentUser?->role ?? 'system',
            'module'      => $module,
            'action'      => strtolower($action),
            'description' => $description,
            'details'     => $details,
            'ip_address'  => Request::ip(),
            'user_agent'  => substr(Request::userAgent() ?? '', 0, 500),
        ]);
    }

    /**
     * Get visual badge class for the action.
     */
    public function getActionBadgeAttribute(): array
    {
        return match ($this->action) {
            'created', 'added', 'store' => [
                'bg'    => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                'dot'   => 'bg-emerald-500',
                'label' => 'Created',
                'icon'  => 'fa-plus',
            ],
            'updated', 'edit' => [
                'bg'    => 'bg-blue-50 text-blue-700 border-blue-200',
                'dot'   => 'bg-blue-500',
                'label' => 'Updated',
                'icon'  => 'fa-pen-to-square',
            ],
            'deleted', 'destroy' => [
                'bg'    => 'bg-rose-50 text-rose-700 border-rose-200',
                'dot'   => 'bg-rose-500',
                'label' => 'Deleted',
                'icon'  => 'fa-trash-can',
            ],
            'toggled', 'status_change' => [
                'bg'    => 'bg-amber-50 text-amber-700 border-amber-200',
                'dot'   => 'bg-amber-500',
                'label' => 'Toggled',
                'icon'  => 'fa-toggle-on',
            ],
            'login' => [
                'bg'    => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                'dot'   => 'bg-indigo-500',
                'label' => 'Sign In',
                'icon'  => 'fa-right-to-bracket',
            ],
            'logout' => [
                'bg'    => 'bg-slate-100 text-slate-700 border-slate-300',
                'dot'   => 'bg-slate-500',
                'label' => 'Sign Out',
                'icon'  => 'fa-right-from-bracket',
            ],
            default => [
                'bg'    => 'bg-slate-50 text-slate-700 border-slate-200',
                'dot'   => 'bg-slate-400',
                'label' => ucfirst($this->action),
                'icon'  => 'fa-circle-dot',
            ],
        };
    }

    /**
     * Get module icon.
     */
    public function getModuleIconAttribute(): string
    {
        return match ($this->module) {
            'Student Files', 'Inquiries' => 'fa-graduation-cap',
            'News & Updates'              => 'fa-newspaper',
            'Photo & Video Gallery'       => 'fa-photo-film',
            'Page Content CMS'            => 'fa-file-lines',
            'Services'                    => 'fa-hand-holding-heart',
            'Destinations'                => 'fa-earth-americas',
            'Process Steps'               => 'fa-route',
            'Permission Manager', 'Staff' => 'fa-user-shield',
            'Profile & Security'          => 'fa-id-badge',
            'Authentication'              => 'fa-key',
            default                       => 'fa-clock-rotate-left',
        };
    }
}

