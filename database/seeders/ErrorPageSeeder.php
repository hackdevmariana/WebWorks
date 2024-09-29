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
        // Crea algunas páginas de error de ejemplo
        ErrorPage::create([
            'website_id' => 1,
            'error_number' => 404,
            'title' => 'Page Not Found',
            'subtitle' => 'Oops! The page you are looking for does not exist.',
            'text' => 'The link might be broken, or the page has been removed.',
            'image' => '404_image.png',
        ]);

        ErrorPage::create([
            'website_id' => 1,
            'error_number' => 500,
            'title' => 'Internal Server Error',
            'subtitle' => 'Something went wrong!',
            'text' => 'Please try again later or contact support.',
            'image' => '500_image.png',
        ]);
    }
}
