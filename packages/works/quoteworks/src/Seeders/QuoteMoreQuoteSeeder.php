<?php

namespace Works\Quoteworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Quoteworks\Models\QuoteQuote;
use Illuminate\Support\Str;

class QuoteMoreQuoteSeeder extends Seeder
{
    public function run()
    {
        // Array de frases con autor y libro correspondientes
        $quotes = [
            [
                'quote' => 'To be or not to be, that is the question.',
                'author_id' => 4, // ID del autor correspondiente
                'id_book' => 1,   // ID del libro correspondiente
            ],
            [
                'quote' => 'Segunda frase.',
                'author_id' => 4, // ID del autor correspondiente
                'id_book' => 1,   // ID del libro correspondiente
            ],
            [
                'quote' => 'Una frase más.',
                'author_id' => 4, // ID del autor correspondiente
                'id_book' => 1,   // ID del libro correspondiente
            ],
            [
                'quote' => 'Otra frase de prueba.',
                'author_id' => 4, // ID del autor correspondiente
                'id_book' => 1,   // ID del libro correspondiente
            ],
        ];

        // Recorrer el array y crear cada cita
        foreach ($quotes as $data) {
            QuoteQuote::firstOrCreate([
                'quote' => $data['quote'],
                'author_id' => $data['author_id'],
                'id_book' => $data['id_book'],
                'slug' => Str::slug(Str::limit($data['quote'], 50)), // Generar el slug con la frase correspondiente
                'views' => 0,
            ]);
        }
    }
}
