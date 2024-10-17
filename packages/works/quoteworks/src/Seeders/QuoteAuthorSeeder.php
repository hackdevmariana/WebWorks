<?php

namespace Works\Quoteworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Quoteworks\Models\QuoteAuthor;

class QuoteAuthorSeeder extends Seeder
{
    public function run()
    {
        $authors = [
            [
                'name' => 'Miguel',
                'surname' => 'de Cervantes',
                'slug' => 'miguel-de-cervantes',
                'biography' => 'Escritor español, autor de Don Quijote de la Mancha.',
                'areas_of_study' => json_encode(['literatura', 'novela']),
                'school' => json_encode(['Siglo de Oro Español']),
                'urls' => json_encode([]),
                'birth' => json_encode(['date' => '1547-09-29', 'place' => 'Alcalá de Henares, España']),
                'death' => json_encode(['date' => '1616-04-23', 'place' => 'Madrid, España']),
                'published_books' => json_encode(['Don Quijote de la Mancha']),
                'links_to_articles' => json_encode([]),
                'author_slug' => 'miguel-de-cervantes',
                'views' => 0,
            ],
            [
                'name' => 'Lope',
                'surname' => 'de Vega',
                'slug' => 'lope-de-vega',
                'biography' => 'Famoso dramaturgo español del Siglo de Oro.',
                'areas_of_study' => json_encode(['teatro', 'poesía']),
                'school' => json_encode(['Siglo de Oro Español']),
                'urls' => json_encode([]),
                'birth' => json_encode(['date' => '1562-11-25', 'place' => 'Madrid, España']),
                'death' => json_encode(['date' => '1635-08-27', 'place' => 'Madrid, España']),
                'published_books' => json_encode(['Fuenteovejuna']),
                'links_to_articles' => json_encode([]),
                'author_slug' => 'lope-de-vega',
                'views' => 0,
            ],
            [
                'name' => 'Isabel',
                'surname' => 'Allende',
                'slug' => 'isabel-allende',
                'biography' => 'Escritora chilena, autora de La Casa de los Espíritus.',
                'areas_of_study' => json_encode(['novela', 'literatura']),
                'school' => json_encode([]),
                'urls' => json_encode([
                    'twitter' => 'https://twitter.com/isabelallende',
                    'instagram' => 'https://instagram.com/isabelallende',
                    'youtube' => 'https://youtube.com/user/isabelallende'
                ]),
                'birth' => json_encode(['date' => '1942-08-02', 'place' => 'Lima, Perú']),
                'death' => null,
                'published_books' => json_encode(['La Casa de los Espíritus']),
                'links_to_articles' => json_encode([]),
                'author_slug' => 'isabel-allende',
                'views' => 0,
            ]
        ];

        foreach ($authors as $author) {
            QuoteAuthor::create($author);
        }
    }
}
