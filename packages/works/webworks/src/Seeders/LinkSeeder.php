<?php

namespace Works\Webworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Webworks\Models\Link;
use Works\Webworks\Models\CustomMenu;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegurarse de que el menú principal existe o crearlo
        $mainMenu = CustomMenu::firstOrCreate(
            ['name' => 'Main Menu'],
            ['website_id' => 1]
        );
        $mainMenuId = $mainMenu->id;

        // Crear enlaces si no existen
        $homeLink = Link::firstOrCreate([
            'website_id' => 1,
            'text' => 'Home',
            'url' => 'https://www.example.com/home',
            'icon' => 'fa-home',
        ]);

        $contactLink = Link::firstOrCreate([
            'website_id' => 1,
            'text' => 'Contact Us',
            'url' => 'https://www.example.com/contact',
            'icon' => 'fa-envelope',
        ]);

        // Relacionar los enlaces con el menú usando la tabla link_menu
        if (!$homeLink->customMenus()->where('custom_menu_id', $mainMenuId)->exists()) {
            $homeLink->customMenus()->attach($mainMenuId, ['order' => 1]);
        }

        if (!$contactLink->customMenus()->where('custom_menu_id', $mainMenuId)->exists()) {
            $contactLink->customMenus()->attach($mainMenuId, ['order' => 2]);
        }
    }
}
