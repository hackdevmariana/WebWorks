<?php

namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\Carousel;
use Works\Web\Models\Content;

class CarouselSeeder extends Seeder
{
    public function run(): void
    {
        $carousel = Carousel::firstOrCreate(
            ['slug' => 'main-carousel'],
            [
                'web_id' => 1,
                'name' => 'Main Carousel',
                'description' => 'Main carousel displaying featured images.',
            ]
        );

        // Contenidos para insertar
        $contents = [
            [
                'web_id' => 1,
                'author_id' => 1,
                'name' => 'Image 1',
                'slug' => 'image-1',
                'title' => 'Title 1',
                'subtitle' => 'Subtitle 1',
                'text' => 'Text 1',
                'url' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/image_01.png',
                'alt' => 'Alt text 1',
                'content_type' => 'image',
            ],
            [
                'web_id' => 1,
                'author_id' => 1,
                'name' => 'Image 2',
                'slug' => 'image-2',
                'title' => 'Title 2',
                'subtitle' => 'Subtitle 2',
                'text' => 'Text 2',
                'url' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/image_02.png',
                'alt' => 'Alt text 2',
                'content_type' => 'image',
            ],
            [
                'web_id' => 1,
                'author_id' => 1,
                'name' => 'Image 3',
                'slug' => 'image-3',
                'title' => 'Title 3',
                'subtitle' => 'Subtitle 3',
                'text' => 'Text 3',
                'url' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/image_03.png',
                'alt' => 'Alt text 3',
                'content_type' => 'image',
            ],
            [
                'web_id' => 1,
                'author_id' => 1,
                'name' => 'Image 4',
                'slug' => 'image-4',
                'title' => 'Title 4',
                'subtitle' => 'Subtitle 4',
                'text' => 'Text 4',
                'url' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/image_04.png',
                'alt' => 'Alt text 4',
                'content_type' => 'image',
            ],
            [
                'web_id' => 1,
                'author_id' => 1,
                'name' => 'Image 5',
                'slug' => 'image-5',
                'title' => 'Title 5',
                'subtitle' => 'Subtitle 5',
                'text' => 'Text 5',
                'url' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/image_05.png',
                'alt' => 'Alt text 5',
                'content_type' => 'image',
            ],
        ];

        Content::insert($contents);


        $carousel->contents()->attach(
            Content::whereIn('slug', ['image-1', 'image-2', 'image-3', 'image-4', 'image-5'])->pluck('id')
        );
    }
}
