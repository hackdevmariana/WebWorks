<?php

namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\FAQ;
use Works\Web\Models\QuestionAnswer;

class FAQSeeder extends Seeder
{
    public function run(): void
    {
        // Busca o crea el registro FAQ
        $faq = FAQ::firstOrCreate(
            [
                'slug' => 'general-faq',
            ],
            [
                'web_id' => 1,
                'name' => 'General FAQ',
            ]
        );

        // Busca las preguntas relacionadas por su slug
        $questions = QuestionAnswer::whereIn('slug', [
            'how-to-use-our-platform',
            'how-to-reset-password',
        ])->get();

        // Asocia cada pregunta a la FAQ
        foreach ($questions as $question) {
            $question->update(['faq_id' => $faq->id]);
        }
    }
}
