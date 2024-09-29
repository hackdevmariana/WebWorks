<?php

namespace Works\Webworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Webworks\Models\ErrorPage;

class ErrorPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Error 404
        ErrorPage::updateOrCreate(
            [
                'website_id' => 1,
                'error_number' => 404
            ], 
            [
                'title' => 'Page Not Found',
                'subtitle' => 'Oops! The page you are looking for does not exist.',
                'text' => 'The link might be broken, or the page has been removed.',
                'image' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/404.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Error 500
        ErrorPage::updateOrCreate(
            [
                'website_id' => 1,
                'error_number' => 500
            ], // Criterios de búsqueda
            [
                'title' => 'Internal Server Error',
                'subtitle' => 'Something went wrong!',
                'text' => 'Please try again later or contact support.',
                'image' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/500.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
