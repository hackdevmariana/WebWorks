<?php

namespace Works\Webworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Webworks\Models\Developed;
use Works\Webworks\Models\Website;

class DevelopedSeeder extends Seeder
{
    public function run()
    {
        $website = Website::first();

        Developed::create([
            'website_id' => $website->id,
            'name' => 'backend',
            'author' => 'John Doe',
            'url' => 'https://backend.example.com',
            'technology' => 'WebWorks'
        ]);

        Developed::create([
            'website_id' => $website->id,
            'name' => 'frontend',
            'author' => 'Jane Smith',
            'url' => 'https://frontend.example.com',
            'technology' => 'Buey'
        ]);
    }
}
