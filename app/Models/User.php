<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'birthday',
        'profile_photo',
        'bio'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'birthday' => 'date',
        ];
    }

    // Helper method voor admin check
    public function isAdmin(): bool
    {
        return (bool) $this->is_admin;
    }

    // Relatie met News items
    public function news()
    {
        return $this->hasMany(News::class);
    }
}