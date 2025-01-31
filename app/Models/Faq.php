<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'faq_category_id'
    ];

    // Relatie met FaqCategory
    public function category()
    {
        return $this->belongsTo(FaqCategory::class, 'faq_category_id');
    }
}