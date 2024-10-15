<?php

namespace Works\Dictionaryworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Dictionaryworks\Models\DictionaryTag;
use Illuminate\Support\Str;

class DictionaryTagSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            'Religión',
            'Catolicismo',
            'Evolucionismo',
            'Historia medieval',
            'Filosofía',
            'Ciencia',
            'Arte',
            'Política'
        ];

        foreach ($tags as $tag) {
            DictionaryTag::create([
                'name' => $tag,
                'slug' => Str::slug($tag),
                'description' => 'Descripción para la etiqueta ' . $tag,
            ]);
        }
    }
}

