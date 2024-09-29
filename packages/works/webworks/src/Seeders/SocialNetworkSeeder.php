<?php

namespace Works\Webworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Webworks\Models\SocialNetwork;

class SocialNetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ejemplo de redes sociales para una web con id 1
        SocialNetwork::updateOrCreate(
            [
                'website_id' => 1,
                'socialnetwork' => 'Twitter'
            ],
            [
                'url' => 'https://x.com/your_user_account',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        SocialNetwork::updateOrCreate(
            [
                'website_id' => 1,
                'socialnetwork' => 'Facebook'
            ],
            [
                'url' => 'https://facebook.com/your_user_account',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        SocialNetwork::updateOrCreate(
            [
                'website_id' => 1,
                'socialnetwork' => 'Instagram'
            ],
            [
                'url' => 'https://instagram.com/your_user_account',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
