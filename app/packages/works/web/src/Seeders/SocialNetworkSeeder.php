<?php

namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\SocialNetwork;

class SocialNetworkSeeder extends Seeder
{
    public function run(): void
    {
        SocialNetwork::create([
            'web_id' => 1,
            'title' => 'Facebook Page',
            'slug' => 'facebook-page',
            'description' => 'Official Facebook page for our website.',
            'socialnetwork' => 'facebook',
            'url' => 'https://www.facebook.com/ourwebsite',
        ]);

        SocialNetwork::create([
            'web_id' => 1,
            'title' => 'Twitter Profile',
            'slug' => 'twitter-profile',
            'description' => 'Follow us on Twitter for updates.',
            'socialnetwork' => 'twitter',
            'url' => 'https://twitter.com/ourwebsite',
        ]);

        SocialNetwork::create([
            'web_id' => 1,
            'title' => 'Instagram',
            'slug' => 'instagram',
            'description' => 'Our Instagram profile with latest photos.',
            'socialnetwork' => 'instagram',
            'url' => 'https://www.instagram.com/ourwebsite',
        ]);
    }
}
