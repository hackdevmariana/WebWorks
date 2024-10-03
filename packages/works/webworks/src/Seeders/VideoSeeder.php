<?php

namespace Works\Webworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Webworks\Models\Video;

class VideoSeeder extends Seeder
{
    public function run()
    {
        Video::create([
            'website_id' => 1,
            'name' => 'intro-video',
            'title' => 'Laravel course',
            'subtitle' => 'The ultimate web development tool',
            'author' => 'The Codeholic',
            'url' => 'https://www.youtube.com/watch?v=eUNWzJUvkCA',
        ]);

        Video::create([
            'website_id' => 1,
            'name' => 'tutorial-1',
            'title' => 'Getting started with Nuxt',
            'subtitle' => 'Learn how to set up your first project',
            'author' => 'Free Code Camp',
            'url' => 'https://www.youtube.com/watch?v=fTPCKnZZ2dk',
        ]);
    }
}
