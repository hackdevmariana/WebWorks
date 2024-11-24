<?php

namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\CustomMenu;
use Works\Web\Models\Link;

class CustomMenuSeeder extends Seeder
{
    public function run()
    {

        $menu = CustomMenu::firstOrCreate(
            ['slug' => 'social-media'], 
            [
                'web_id' => 1, 
                'name' => 'Social Media Links', 
            ]
        );

        $links = Link::whereIn('slug', ['facebook', 'twitter', 'instagram', 'linkedin'])->get();

        foreach ($links as $link) {
            $menu->links()->attach($link->id);
        }
    }
}
