<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\News;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CourseSeeder::class,
            AICategorySeeder::class,
            AINewsSeeder::class,
            FaqSeeder::class,
            NewsSeeder::class,
        ]);
    }
}