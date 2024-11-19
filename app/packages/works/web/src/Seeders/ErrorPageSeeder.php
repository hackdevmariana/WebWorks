<?php

namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\ErrorPage;

class ErrorPageSeeder extends Seeder
{
    public function run()
    {
        ErrorPage::create([
            'web_id' => 1,
            'error_number' => 404,
            'title' => 'Page Not Found',
            'subtitle' => 'We couldn’t find the page you were looking for.',
            'text' => 'The page might have been removed, renamed, or is temporarily unavailable.',
            'image' => 'images/errors/404.png',
        ]);

        ErrorPage::create([
            'web_id' => 1,
            'error_number' => 500,
            'title' => 'Internal Server Error',
            'subtitle' => 'Something went wrong on our side.',
            'text' => 'Please try again later or contact support if the issue persists.',
            'image' => 'images/errors/500.png',
        ]);
    }
}
