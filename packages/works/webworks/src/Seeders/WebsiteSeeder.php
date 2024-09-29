<?php

namespace Works\Webworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Webworks\Models\Website;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Website::updateOrCreate(
            ['web' => 'example.com'],  // Criterio de búsqueda
            [
                'web' => 'example.com',
                'home' => '/',
                'title' => 'Example Website',
                'description' => 'This is an example website for testing.',
                'keywords' => 'example, demo, website',
                'favicon' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/favicon.ico',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
