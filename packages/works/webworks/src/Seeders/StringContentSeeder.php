<?php

namespace Works\Webworks\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Works\Webworks\Models\Content;
use Works\Webworks\Models\Website;

class StringContentSeeder extends Seeder
{
    public function run()
    {
        $website = Website::firstOrCreate(
            ['web' => 'example.com'],
            ['url' => 'https://example.com']
        );

        $strings = [
            [
                'slug' => Str::slug('Welcome Message'),
                'name' => 'welcome_message',
                'title' => 'Welcome to our website!',
                'text' => 'We are glad to have you here.',
                'content_type' => 'string'
            ],
            [
                'slug' => Str::slug('Footer Text'),
                'name' => 'footer_text',
                'title' => 'Footer Information',
                'text' => 'Copyleft 2024 Example Inc. - No rights reserved.',
                'content_type' => 'string'
            ],
            [
                'slug' => Str::slug('Contact Info'),
                'name' => 'contact_info',
                'title' => 'Contact Us',
                'text' => 'Email us at contact@example.com',
                'content_type' => 'string'
            ]
        ];

        foreach ($strings as $string) {
            Content::firstOrCreate(
                ['slug' => $string['slug']],
                array_merge($string, ['website_id' => $website->id])
            );
        }
    }
}

