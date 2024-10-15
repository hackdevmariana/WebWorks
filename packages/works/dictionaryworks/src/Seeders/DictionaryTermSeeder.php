<?php

namespace Works\Dictionaryworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Dictionaryworks\Models\DictionaryTerm;

class DictionaryTermSeeder extends Seeder
{
    public function run()
    {
        DictionaryTerm::create([
            'term' => 'Economía',
            'slug' => 'economia',
            'abstract' => 'La economía es el estudio de la acción humana intencionada en un contexto de escasez.',
            'definition' => 'La economía es el estudio de la acción humana intencionada en un contexto de escasez, donde los individuos toman decisiones para maximizar su satisfacción personal, y los precios de mercado reflejan las valoraciones subjetivas de los bienes y servicios.',
            'views' => 0,
            'usage' => null,
            'author' => 'John Doe',
            'status' => 'approved',
        ]);
    }
}
