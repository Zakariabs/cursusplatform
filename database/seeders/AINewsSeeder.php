<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class AINewsSeeder extends Seeder
{
    public function run(): void
    {
        $newsItems = [
            [
                'title' => 'Nieuwe GPT-4 Cursus Beschikbaar',
                'content' => 'We zijn verheugd om onze nieuwe cursus over GPT-4 en Large Language Models aan te kondigen. Leer hoe je deze krachtige AI-modellen kunt inzetten voor jouw projecten.',
                'publish_date' => now(),
                'user_id' => 1
            ],
            [
                'title' => 'Workshop Computer Vision',
                'content' => 'Volgende maand starten we met een praktische workshop over Computer Vision met TensorFlow en OpenCV. Perfect voor wie wil leren over beeldherkenning en object detectie.',
                'publish_date' => now()->addDays(7),
                'user_id' => 1
            ],
            [
                'title' => 'AI Ethics Module Toegevoegd',
                'content' => 'Nieuw in ons curriculum: een module over AI Ethics en verantwoordelijke AI ontwikkeling.',
                'publish_date' => now()->addDays(14),
                'user_id' => 1
            ]
        ];

        foreach ($newsItems as $item) {
            News::create($item);
        }
    }
}