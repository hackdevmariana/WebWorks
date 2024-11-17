<?php

namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\Content;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        Content::create([
            'web_id' => 1,
            'author_id' => 1,
            'name' => 'Example Content',
            'slug' => 'example-content',
            'title' => 'Welcome to Our Website',
            'subtitle' => 'Your Subtitle Here',
            'text' => 'This is an example content for testing purposes.',
            'image' => 'https://via.placeholder.com/300',
            'url' => 'https://example.com',
            'alt' => 'Example image description',
            'content_type' => 'article',
            'is_default' => true,
            'draft' => false,
        ]);
    }
}
