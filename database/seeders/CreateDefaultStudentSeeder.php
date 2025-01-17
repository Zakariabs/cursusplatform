
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateDefaultStudentSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Student',
            'email' => 'student@ehb.be',
            'password' => Hash::make('Password!321'),
            'email_verified_at' => now(),
            'is_admin' => false
        ]);
    }
}