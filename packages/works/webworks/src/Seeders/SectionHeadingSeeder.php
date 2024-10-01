<?php

namespace Works\Webworks\Seeders;


use Illuminate\Database\Seeder;
use Works\Webworks\Models\Website;
use Works\Webworks\Models\SectionHeading;

class SectionHeadingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $website = Website::first(); // Usamos la primera web disponible para el ejemplo

        $headings = [
            ['name' => 'news', 'title' => 'Latest News', 'h' => 'h1', 'class' => 'news-header'],
            ['name' => 'contact', 'title' => 'Contact Us', 'h' => 'h2', 'class' => 'contact-header'],
            ['name' => 'social-networks', 'title' => 'Follow Us on Social Media', 'h' => 'h3', 'class' => 'social-header'],
        ];

        foreach ($headings as $heading) {
            SectionHeading::create(array_merge($heading, ['website_id' => $website->id]));
        }
    }
}
