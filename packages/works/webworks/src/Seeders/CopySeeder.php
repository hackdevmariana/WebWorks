<?php

namespace Works\Webworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Webworks\Models\Copy;

class CopySeeder extends Seeder
{
    public function run(): void
    {
        Copy::create([
            'website_id' => 1,  // Reemplaza por un ID real de un sitio web
            'name' => 'General Content License',
            'copy' => 'copyleft',
            'license' => 'GPL',
            'author' => 'Manuel Pérez',
            'url' => 'http://manuelperez.com',
            'text' => 'Copyleft [Manuel Pérez](http://manuelperez.com), ningún derecho reservado.',
            'subtext' => 'Siéntase libre de copiar este artículo.'
        ]);

        Copy::create([
            'website_id' => 1,
            'name' => 'Specific Article License',
            'copy' => 'copyright',
            'license' => '',
            'author' => 'Ana García',
            'url' => 'http://anagarcia.com',
            'text' => 'Copyright [Ana García](http://anagarcia.com), todos los derechos reservados.',
            'subtext' => 'Para más información, visite el sitio del autor.'
        ]);
    }
}
