<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'difficulty_level',
        'duration_weeks',
        'is_published',
        'requirements',
        'what_you_learn',
        'level'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'duration_weeks' => 'integer',
        'requirements' => 'array',
        'what_you_learn' => 'array'
    ];


    // Relatie met gebruikers die ingeschreven zijn
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user')
                    ->withTimestamps();
    }

    // Relatie met categorieën
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'course_category')
                    ->withTimestamps();
    }

    // Relatie met voortgang
    public function progress()
    {
        return $this->belongsToMany(User::class, 'course_progress')
                    ->withPivot('completed_at', 'progress_percentage')
                    ->withTimestamps();
    }

    public function getProgressForUser(User $user)
    {
        return $this->progress()
                    ->where('user_id', $user->id)
                    ->first()
                    ?->pivot
                    ?->progress_percentage ?? 0;
    }

    // Scope voor filtering op publicatie status
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Scopes
    public function scopePopular($query)
    {
        return $query->withCount('students')
                    ->orderByDesc('students_count');
    }

    public function scopeWithProgressForUser($query, User $user)
    {
        return $query->with(['progress' => function($q) use ($user) {
            $q->where('user_id', $user->id);
        }]);
    }

    // Automatisch een slug genereren
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($course) {
            $course->slug = Str::slug($course->title);
        });
    }
}