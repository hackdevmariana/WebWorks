<?php
namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        // Datos fijos para los autores
        $authors = [
            [
                'website_id' => 1,
                'username' => 'pepeperez',
                'name' => 'Pepe',
                'surname' => 'Pérez',
                'links' => json_encode([
                    'twitter' => 'https://twitter.com/pepeperez',
                    'github' => 'https://github.com/pepeperez'
                ]),
                'photo' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/author.jpg',
                'biography' => 'Biografía de Pepe Pérez.',
                'slug' => 'pepe-perez',
            ],
            [
                'website_id' => 1,
                'username' => 'anagarcia',
                'name' => 'Ana',
                'surname' => 'García',
                'links' => json_encode([
                    'twitter' => 'https://twitter.com/anagarcia',
                    'github' => 'https://github.com/anagarcia'
                ]),
                'photo' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/female_author.jpeg',
                'biography' => 'Biografía de Ana García.',
                'slug' => 'ana-garcia',
            ],
            // Añadir más autores según sea necesario
        ];

        foreach ($authors as $authorData) {
            Author::create($authorData);
        }
    }
}
