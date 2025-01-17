<?php

namespace Database\Seeders;

use App\Models\FaqCategory;
use App\Models\Faq;
use Illuminate\Database\Seeder;

class AICategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Machine Learning',
                'description' => 'Vragen over machine learning cursussen en technieken',
                'faqs' => [
                    [
                        'question' => 'Welke voorkennis is nodig voor de ML cursus?',
                        'answer' => 'Basiskennis Python en statistiek is vereist voor de Machine Learning cursussen.'
                    ],
                    [
                        'question' => 'Welke tools gebruiken we?',
                        'answer' => 'We werken met Python, TensorFlow, en scikit-learn.'
                    ]
                ]
            ],
            [
                'name' => 'Deep Learning',
                'description' => 'Alles over neural networks en deep learning',
                'faqs' => [
                    [
                        'question' => 'Heb ik een GPU nodig?',
                        'answer' => 'Voor de praktische oefeningen is een GPU aanbevolen maar niet verplicht.'
                    ]
                ]
            ],
            [
                'name' => 'AI Tools & Frameworks',
                'description' => 'Vragen over verschillende AI tools en frameworks',
                'faqs' => [
                    [
                        'question' => 'Werken jullie met OpenAI APIs?',
                        'answer' => 'Ja, we behandelen GPT en DALL-E integraties in onze cursussen.'
                    ]
                ]
            ]
        ];

        foreach ($categories as $cat) {
            $faqs = $cat['faqs'];
            unset($cat['faqs']);
            
            $category = FaqCategory::create($cat);
            
            foreach ($faqs as $faq) {
                $faq['faq_category_id'] = $category->id;
                Faq::create($faq);
            }
        }
    }
}