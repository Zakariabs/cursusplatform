<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::firstOrCreate(
            ['slug' => 'machine-learning-fundamentals'],
            [
                'title' => 'Machine Learning Fundamentals',
                'description' => 'Een complete introductie tot machine learning concepten en praktische implementaties.',
                'level' => 'beginner',
                'requirements' => json_encode(["Python basics", "Wiskunde"]),
                'what_you_learn' => json_encode(["Supervised Learning", "Neural Networks", "Data Preprocessing"]),
                'duration_weeks' => 8,
                'is_published' => true,
            ]
        );
    }
}