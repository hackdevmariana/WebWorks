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
            'Economía',
            'Filosofía',
            'Historia',
            'Política',
            'Sociología',
            'Antropología',
            'Psicología',
            'Literatura',
            'Derecho',
            'Arte',
            'Teología',
        ];

        foreach ($tags as $tag) {
            EventTag::create([
                'name' => $tag,
                'slug' => Str::slug($tag), 
            ]);
        }
    }
}
