<?php

namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\Developed;

class DevelopedSeeder extends Seeder
{
    public function run()
    {
        Developed::create([
            'web_id' => 1,
            'name' => 'Frontend',
            'slug' => 'frontend',
            'text' => 'This web frontend is developed using Nuxt.js.',
            'author' => 'Frontend Team',
            'url' => 'https://nuxtjs.org',
            'technology' => 'Nuxt.js',
        ]);

        Developed::create([
            'web_id' => 1,
            'name' => 'Backend',
            'slug' => 'backend',
            'text' => 'This web backend is developed using Laravel.',
            'author' => 'Backend Team',
            'url' => 'https://laravel.com',
            'technology' => 'Laravel',
        ]);
    }
}
