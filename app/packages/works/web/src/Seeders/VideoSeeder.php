<?php

namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\Video;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        Video::create([
            'web_id' => 1,
            'title' => 'Crea una REST API CRUD en Laravel desde Cero',
            'slug' => 'crea-rest-api',
            'subtitle' => 'Learn the basics of web development',
            'description' => 'A beginner-friendly introduction to web development.',
            'author' => 'Fatz Code',
            'youtube_id' => 'eLI8c_NtkBk',
        ]);

        Video::create([
            'web_id' => 1,
            'title' => 'Aprende Nuxt.js 3 Ahora!',
            'slug' => 'aprende-nuxt',
            'subtitle' => 'Deep dive into Nuxt programming',
            'description' => 'Learn advanced techniques for Nuxt development.',
            'author' => 'Yirsis Hertz',
            'url' => 'https://www.youtube.com/watch?v=PxeQ9xBUyxM',
        ]);
    }
}
