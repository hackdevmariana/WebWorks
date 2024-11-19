<?php

namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\Link;

class LinkSeeder extends Seeder
{
    public function run()
    {
        $webId = 1;

        $links = [
            ['text' => 'Facebook', 'slug' => 'facebook', 'url' => 'https://www.facebook.com', 'icon' => 'fa-facebook'],
            ['text' => 'Twitter', 'slug' => 'twitter', 'url' => 'https://www.twitter.com', 'icon' => 'fa-twitter'],
            ['text' => 'Instagram', 'slug' => 'instagram', 'url' => 'https://www.instagram.com', 'icon' => 'fa-instagram'],
            ['text' => 'LinkedIn', 'slug' => 'linkedin', 'url' => 'https://www.linkedin.com', 'icon' => 'fa-linkedin'],
        ];

        foreach ($links as $link) {
            Link::create(array_merge(['web_id' => $webId], $link));
        }
    }
}
