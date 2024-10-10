<?php

namespace Works\Eventworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Eventworks\Models\EventLink; 

class EventLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            ['name' => 'Facebook', 'slug' => 'facebook', 'url' => 'https://facebook.com/', 'alt' => 'Facebook page'],
            ['name' => 'Twitter', 'slug' => 'twitter', 'url' => 'https://twitter.com/', 'alt' => 'Twitter page'],
            ['name' => 'YouTube', 'slug' => 'youtube', 'url' => 'https://youtube.com/', 'alt' => 'YouTube channel'],
            ['name' => 'Course Material', 'slug' => 'course-material', 'url' => 'https://es.wikipedia.org/', 'alt' => 'Wikipedia in Spanish'],
            ['name' => 'Research Paper', 'slug' => 'research-paper', 'url' => 'https://enciclopediaiberoamericana.com', 'alt' => 'Enciclopedia Iberoamericana'],
        ];

        foreach ($links as $link) {
            EventLink::create($link);
        }
    }
}
