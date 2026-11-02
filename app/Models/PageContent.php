<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'page',
        'section_key',
        'title',
        'subtitle',
        'content',
        'meta',
        'image',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * Helper to retrieve section content with fallback
     */
    public static function getSection(string $page, string $sectionKey, $default = null): ?self
    {
        return static::where('page', $page)->where('section_key', $sectionKey)->first();
    }
}
