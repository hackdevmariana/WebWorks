<?php

namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Works\Web\Models\Web;

class WebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Web::insert([
            [
                'url' => 'https://example.com',
                'home' => 'https://example.com/home',
                'title' => 'Example Website',
                'description' => 'This is an example website description.',
                'keywords' => 'example, website, demo',
                'favicon' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/favicon.ico',
                'name' => 'Example Website',
                'slug' => Str::slug('Example Website'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'url' => 'https://anotherexample.com',
                'home' => 'https://anotherexample.com/home',
                'title' => 'Another Example',
                'description' => 'Description for another example website.',
                'keywords' => 'example, another, demo',
                'favicon' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/favicon_1.ico',
                'name' => 'Second Website',
                'slug' => Str::slug('Second Website'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
