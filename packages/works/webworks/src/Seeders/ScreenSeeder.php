<?php
namespace Works\Webworks\Seeders;


use Illuminate\Database\Seeder;
use Works\Webworks\Models\Screen;

class ScreenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $screens = [
            ['screen' => 'xs', 'width' => 576],  // Extra small devices (phones)
            ['screen' => 'sm', 'width' => 768],  // Small devices (tablets)
            ['screen' => 'md', 'width' => 992],  // Medium devices (desktops)
            ['screen' => 'lg', 'width' => 1200], // Large devices (large desktops)
            ['screen' => 'xl', 'width' => 1400], // Extra large devices
        ];

        foreach ($screens as $screen) {
            Screen::create([
                'website_id' => 1,  // Asumiendo que existe una web con ID 1
                'screen' => $screen['screen'],
                'width' => $screen['width'],
            ]);
        }
    }
}
