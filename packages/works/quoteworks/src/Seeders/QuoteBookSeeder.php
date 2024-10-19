<?php

namespace Works\Quoteworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Quoteworks\Models\QuoteBook;
use Works\Quoteworks\Models\QuoteAuthor;
use Works\Quoteworks\Models\QuoteQuote;

class QuoteBookSeeder extends Seeder
{
    public function run()
    {
        // Crea un libro de ejemplo
        $book = QuoteBook::firstOrCreate([
            'slug' => 'gran-libro-citas',  
        ], [
            'title_in_spanish' => 'Gran Libro de citas',
            'original_title' => 'The Great Book of Quotes',
            'original_language' => 'English',
            'author' => 'John Doe',
            'translator' => 'Jane Doe',
            'publisher' => 'Philosophy Press',
            'number_of_pages' => 500,
            'publication_date' => '2020-01-01',
            'weight' => '500',
            'dimensions' => '20x25cm',
            'isbn' => '1234567890',
            'category' => 'Philosophy',
            'synopsis' => 'Un libro sobre las ideas filosóficas más importantes.',
        ]);

        QuoteQuote::firstOrCreate([
            'quote' => 'El conocimiento es poder.',
            'id_book' => $book->id,
            'author_id' => null, 
        ]);

        QuoteQuote::firstOrCreate([
            'quote' => 'La vida sin examen no vale la pena ser vivida.',
            'id_book' => $book->id,
            'author_id' => null,
        ]);

        $author = QuoteAuthor::firstOrCreate([
            'slug' => 'juan-garcia', 
        ], [
            'name' => 'Juan García',
            'birth' => json_encode([
                'date' => '1561-01-22', 
                'place' => 'Lugar de nacimiento'
            ]),
            'death' => json_encode([
                'date' => '1626-04-09', 
                'place' => 'Lugar de fallecimiento'
            ]),
        ]);

        $book = QuoteBook::firstOrCreate([
            'slug' => 'gran-libro-de-juan-garcia',  
        ], [
            'title_in_spanish' => 'Gran Libro de Juan García',
            'original_title' => 'The Great Book of Juan García',
            'original_language' => 'English',
            'author' => 'Juan García',
            'translator' => 'Mariano García',
            'publisher' => 'Philosophy Press',
            'number_of_pages' => 500,
            'publication_date' => '2020-01-01',
            'weight' => '250',
            'dimensions' => '20x25cm',
            'isbn' => '1234567890',
            'category' => 'Philosophy',
            'synopsis' => 'Un libro sobre las ideas filosóficas más importantes de Juan García.',
        ]);

        QuoteQuote::firstOrCreate([
                'slug' => 'una-frase-de-juan-garcia',  
            ], [
            'quote' => 'Una frase de Juan García.',
            'id_book' => $book->id, 
            'author_id' => $author->id,
        ]);

        QuoteQuote::firstOrCreate([
                'slug' => 'otra-frase-de-juan-garcia',  
            ], [
            'quote' => 'Otra frase de Juan García.',
            'id_book' => $book->id,
            'author_id' => $author->id, 
        ]);
    }
}
