<?php

namespace Works\Webworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Webworks\Models\CustomMenu;
use Works\Webworks\Models\Screen;

class CustomMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menú principal visible en todas las pantallas
        $mainMenu = CustomMenu::create([
            'website_id' => 1,
            'name' => 'Main Menu',
        ]);
        // Obtener todas las pantallas y relacionarlas con el menú
        $mainMenu->screens()->attach(Screen::all()->pluck('id'));

        // Footer Menu visible solo en pantallas xs y sm
        $footerMenuMobile = CustomMenu::create([
            'website_id' => 1,
            'name' => 'Footer Menu Mobile',
        ]);
        $footerMenuMobile->screens()->attach([1, 2]); // Solo en xs y sm

        // Sidebar Menu visible solo en pantallas md y mayores
        $sidebarMenu = CustomMenu::create([
            'website_id' => 1,
            'name' => 'Sidebar Menu',
        ]);
        $sidebarMenu->screens()->attach([3, 4, 5]); // Solo en md, lg y xl
    }
}
