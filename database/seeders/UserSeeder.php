<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@ehb.be'],
            [
                'name' => 'admin',
                'password' => Hash::make('Password!321'),
                'email_verified_at' => now(),
                'is_admin' => true
            ]
        );

        User::firstOrCreate(
            ['email' => 'student@ehb.be'],
            [
                'name' => 'Student',
                'password' => Hash::make('Password!321'),
                'email_verified_at' => now(),
                'is_admin' => false
            ]
        );
    }
}