<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFile extends Model
{
    use HasFactory;

    protected $table = 'student_files';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'destination',
        'desired_course',
        'intake',
        'education_level',
        'english_test',
        'message',
        'status',
        'assigned_to',
        'created_by',
        'internal_notes',
    ];

    /**
     * Assigned counselor / staff member.
     */
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Staff member who created this file.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Status badge styling metadata.
     */
    public function getStatusBadgeAttribute(): array
    {
        $statusMap = [
            'new'          => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'label' => 'New Lead'],
            'contacted'    => ['bg' => 'bg-blue-50',    'text' => 'text-blue-700',    'border' => 'border-blue-200',    'label' => 'Contacted'],
            'in_progress'  => ['bg' => 'bg-amber-50',   'text' => 'text-amber-700',   'border' => 'border-amber-200',   'label' => 'In Progress'],
            'admitted'     => ['bg' => 'bg-purple-50',  'text' => 'text-purple-700',  'border' => 'border-purple-200',  'label' => 'Admitted'],
            'visa_granted' => ['bg' => 'bg-sky-50',     'text' => 'text-sky-700',     'border' => 'border-sky-200',     'label' => 'Visa Granted'],
            'rejected'     => ['bg' => 'bg-rose-50',    'text' => 'text-rose-700',    'border' => 'border-rose-200',    'label' => 'Rejected'],
            'closed'       => ['bg' => 'bg-slate-100',  'text' => 'text-slate-600',   'border' => 'border-slate-200',   'label' => 'Closed'],
        ];

        return $statusMap[$this->status] ?? [
            'bg' => 'bg-slate-100',
            'text' => 'text-slate-600',
            'border' => 'border-slate-200',
            'label' => ucfirst($this->status),
        ];
    }
}

