<?php

namespace Works\Eventworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Eventworks\Models\EventTag;
use Illuminate\Support\Str; 


class EventTagSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            'Siglo de Oro',
            'Historia de España',
            'Escuela de Salamanca',
            'Renacimiento',
            'Ilustración',
            'Edad Media',
            'Modernismo',
            'Existencialismo',
            'Derecho Romano',
            'Neoclasicismo',
            'Filosofía política',
            'Escuela Austríaca',
            
        ];

        foreach ($tags as $tag) {
            EventTag::create([
                'name' => $tag,
                'slug' => Str::slug($tag), 
            ]);
        }
    }
}
