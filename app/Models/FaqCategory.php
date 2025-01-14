<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    // Relatie met FAQ's
    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }
}