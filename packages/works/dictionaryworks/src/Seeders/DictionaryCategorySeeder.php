<?php

namespace Works\Dictionaryworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Dictionaryworks\Models\DictionaryCategory;
use Illuminate\Support\Str;

class DictionaryCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Historia de España',
            'Historia de América',
            'Edad de Bronce',
            'Edad de Hierro',
            'Edad Media',
            'Siglo de Oro',
            'Escuela de Salamanca'
        ];

        foreach ($categories as $category) {
            DictionaryCategory::create([
                'name' => $category,
                'slug' => Str::slug($category),
                'description' => 'Descripción para la categoría ' . $category,
            ]);
        }
    }
}
