<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'level',
        'requirements',
        'what_you_learn',
        'duration_weeks',
        'is_published'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'requirements' => 'array',
        'what_you_learn' => 'array'
    ];

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Helper methods
    public function getLevelBadgeAttribute()
    {
        return match($this->level) {
            'beginner' => 'bg-green-100 text-green-800',
            'intermediate' => 'bg-yellow-100 text-yellow-800',
            'advanced' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
}