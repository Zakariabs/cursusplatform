<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    // Specificeer de table naam
    protected $table = 'news';

    protected $fillable = [
        'title',
        'image',
        'content',
        'publish_date',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}