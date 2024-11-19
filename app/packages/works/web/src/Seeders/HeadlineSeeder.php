<?php

namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\Headline;

class HeadlineSeeder extends Seeder
{
    public function run(): void
    {
        Headline::create([
            'web_id' => 1,
            'slug' => 'home-main-header',
            'description' => 'Main header for the homepage',
            'text' => 'Welcome to Our Website',
            'h' => 'h1',
            'class' => 'main-header',
        ]);

        Headline::create([
            'web_id' => 1,
            'slug' => 'about-section-title',
            'description' => 'Title for the About Us section',
            'text' => 'About Us',
            'h' => 'h2',
            'class' => 'section-title',
        ]);
    }
}
