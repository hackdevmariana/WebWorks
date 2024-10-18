<?php

namespace Works\Quoteworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Quoteworks\Models\{
    QuoteAuthor,
    QuoteBook,
    QuoteQuote,
    QuoteCategory
};
use Illuminate\Support\Str;

class QuoteQuoteSeeder extends Seeder
{
    public function run()
    {
        $author = QuoteAuthor::firstOrCreate([
            'name' => 'John',
            'surname' => 'Doe',
            'slug' => Str::slug('John Doe'),
            'biography' => 'John Doe is a contemporary philosopher.',
        ]);

        $book = QuoteBook::firstOrCreate([
            'title_in_spanish' => 'El título en español',
            'slug' => Str::slug('El título en español'),
            'author' => $author->name . ' ' . $author->surname,
        ]);

        $category = QuoteCategory::firstOrCreate([
            'name' => 'Philosophy',
            'slug' => Str::slug('Philosophy'),
        ]);

        QuoteQuote::firstOrCreate([
            'quote' => 'Una frase de prueba.',
            'author_id' => $author->id,
            'id_book' => $book->id,
            'views' => 1000,
        ]);

        QuoteQuote::firstOrCreate([
            'quote' => 'Probando con otra frase.',
            'author_id' => $author->id,
            'id_book' => $book->id,
            'views' => 800,
        ]);

        // Adjuntar citas a la categoría
        $category->quoteQuotes()->attach(QuoteQuote::all()->pluck('id')->toArray());
    }
}
