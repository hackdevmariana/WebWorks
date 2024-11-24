<?php

namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\Content;
use Works\Web\Models\Gallery;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        // Crear los contenidos
        $contents = [
            [
                'web_id' => 1,
                'author_id' => 1,
                'name' => 'Image Gallery 1',
                'slug' => 'image-gallery-1',
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
                'name' => 'Image Gallery 2',
                'slug' => 'image-gallery-2',
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
                'name' => 'Image Gallery 3',
                'slug' => 'image-gallery-3',
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
                'name' => 'Image Gallery 4',
                'slug' => 'image-gallery-4',
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
                'name' => 'Image Gallery 5',
                'slug' => 'image-gallery-5',
                'title' => 'Title 5',
                'subtitle' => 'Subtitle 5',
                'text' => 'Text 5',
                'url' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/image_05.png',
                'alt' => 'Alt text 5',
                'content_type' => 'image',
            ],
        ];

        $contentIds = [];
        foreach ($contents as $data) {
            $content = Content::firstOrCreate(['slug' => $data['slug']], $data);
            $contentIds[] = $content->id;
        }

        // Crear galería y asociar contenidos
        $gallery = Gallery::firstOrCreate(
            ['slug' => 'main-gallery'],
            [
                'web_id' => 1,
                'name' => 'Main Gallery',
                'description' => 'A collection of featured images.',
            ]
        );

        $gallery->contents()->sync($contentIds);
    }
}
