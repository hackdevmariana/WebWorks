<?php

namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\QuestionAnswer;

class QuestionAnswerSeeder extends Seeder
{
    public function run()
    {
        QuestionAnswer::create([
            'web_id' => 1,
            'title' => 'How to use our platform?',
            'slug' => 'how-to-use-our-platform',
            'question' => 'What are the steps to start using our platform?',
            'answer' => 'To use our platform, register an account, log in, and explore the features.',
            'category' => 'Usage',
        ]);

        QuestionAnswer::create([
            'web_id' => 1,
            'title' => 'How to reset your password?',
            'slug' => 'how-to-reset-password',
            'question' => 'What should I do if I forget my password?',
            'answer' => 'Click on the "Forgot Password" link on the login page to reset it.',
            'category' => 'Management',
        ]);
    }
}
