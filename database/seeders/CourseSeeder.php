<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::create([
            'title' => 'Machine Learning Fundamentals',
            'description' => 'Een complete introductie tot machine learning concepten en praktische implementaties.',
            'level' => 'beginner',
            'requirements' => json_encode(['Python basics', 'Wiskunde']),
            'what_you_learn' => json_encode(['Supervised Learning', 'Neural Networks', 'Data Preprocessing']),
            'duration_weeks' => 8,
            'is_published' => true
        ]);

        Course::create([
            'title' => 'Deep Learning Advanced',
            'description' => 'Geavanceerde neural networks en deep learning technieken.',
            'level' => 'advanced',
            'requirements' => json_encode(['Machine Learning basics', 'Python', 'PyTorch']),
            'what_you_learn' => json_encode(['CNN', 'RNN', 'Transformers', 'GANs']),
            'duration_weeks' => 12,
            'is_published' => true
        ]);
    }
}