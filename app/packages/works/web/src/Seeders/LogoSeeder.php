<?php

namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\Logo;

class LogoSeeder extends Seeder
{
    public function run(): void
    {
        $logos = [
            [
                'web_id' => 1,
                'slug' => 'organization-logo',
                'description' => 'Organization Logo',
                'url' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/logo_organization.png',
                'image' => null,
            ],
            [
                'web_id' => 1,
                'slug' => 'buey-logo',
                'description' => 'Buey Logo',
                'url' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/logo_buey.jpeg',
                'image' => null,
            ],
            [
                'web_id' => 1,
                'slug' => 'default-logo',
                'description' => 'Default Logo',
                'url' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/logo.png',
                'image' => null,
            ],
        ];

        foreach ($logos as $logo) {
            Logo::create($logo);
        }
    }
}
