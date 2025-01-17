<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'image',
        'content',
        'publish_date',
        'user_id'
    ];

    protected $casts = [
        'publish_date' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}