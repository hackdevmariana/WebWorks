<?php

namespace Works\Eventworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Eventworks\Models\Media;

class MediaSeeder extends Seeder
{
    public function run()
    {
        Media::create([
            'name' => 'University Logo',
            'slug' => 'university-logo',
            'description' => 'Official logo of the university.',
            'url' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/logo_organization.png',
            'alt' => 'University Logo',
        ]);

        Media::create([
            'name' => 'Conference Banner',
            'slug' => 'conference-banner',
            'description' => 'Banner for the annual conference.',
            'url' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/banner.jpg',
            'alt' => 'Conference Banner',
        ]);

        Media::create([
            'name' => 'Speaker Portrait',
            'slug' => 'speaker-portrait',
            'description' => 'Portrait of keynote speaker.',
            'url' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/lecturer.jpg',
            'alt' => 'Speaker Portrait',
        ]);
    }
}
