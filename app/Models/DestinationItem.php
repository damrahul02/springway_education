<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'flag',
        'gradient',
        'badge',
        'short_detail',
        'description',
        'intakes',
        'post_study_work',
        'extra_info',
        'link_text',
        'link_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}

