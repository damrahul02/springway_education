<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'step_number',
        'title',
        'description',
        'short_description',
        'badge',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the formatted 2-digit step number (e.g. "01", "02").
     */
    public function getFormattedNumberAttribute(): string
    {
        if (!empty($this->step_number)) {
            return str_pad($this->step_number, 2, '0', STR_PAD_LEFT);
        }
        return str_pad((string)($this->sort_order ?: 1), 2, '0', STR_PAD_LEFT);
    }
}

