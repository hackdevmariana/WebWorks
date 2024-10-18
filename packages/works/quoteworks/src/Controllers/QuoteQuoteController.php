<?php

namespace Works\Quoteworks\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Works\Quoteworks\Models\QuoteQuote;
use Works\Quoteworks\Models\QuoteAuthor;
use Works\Quoteworks\Models\QuoteCategory;

class QuoteQuoteController extends Controller
{

    public function show($slug)
    {
        $quote = QuoteQuote::where('slug', $slug)->firstOrFail();
        $quote->increment('views'); // Sumar 1 a las visualizaciones

        // Devolver los datos con autor y libro
        return response()->json([
            'quote' => $quote->quote,
            'author' => $quote->author->name . ' ' . $quote->author->surname ?? 'Unknown',
            'book' => $quote->book->title_in_spanish ?? 'Unknown',
            'views' => $quote->views,
        ]);
    }
    // 1. Devuelve una cita aleatoria
    public function randomQuote()
    {
        $quote = QuoteQuote::inRandomOrder()->first();
        return response()->json($quote);
    }

    // 2. Devuelve una cita aleatoria de un autor específico
    public function randomQuoteByAuthor($author)
    {
        $authorModel = QuoteAuthor::where('slug', $author)->firstOrFail();
        $quote = QuoteQuote::where('author_id', $authorModel->id)->inRandomOrder()->first();
        return response()->json($quote);
    }

    // 3. Devuelve todas las citas de un autor específico
    public function quotesByAuthor($author)
    {
        $authorModel = QuoteAuthor::where('slug', $author)->firstOrFail();
        $quotes = QuoteQuote::where('author_id', $authorModel->id)->get();
        return response()->json($quotes);
    }

    // 4. Devuelve las citas relacionadas con una categoría o tema específico
    public function quotesByTag($tag)
    {
        $category = QuoteCategory::where('slug', $tag)->firstOrFail();
        $quotes = $category->quoteQuotes()->get();
        return response()->json($quotes);
    }

    // 5. Devuelve las citas más vistas
    public function topQuotes()
    {
        $topQuotes = QuoteQuote::orderBy('views', 'desc')->take(10)->get();
        return response()->json($topQuotes);
    }
}
