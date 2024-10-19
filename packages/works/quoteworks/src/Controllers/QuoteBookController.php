<?php

namespace Works\Quoteworks\Controllers;

use Works\Quoteworks\Models\QuoteBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuoteBookController extends Controller
{
    // Listar todos los libros
    public function index()
    {
        return QuoteBook::all();
    }

    // Mostrar detalles de un libro específico, incluyendo citas, autor y cita aleatoria
    public function show($slug)
    {
        $book = QuoteBook::where('slug', $slug)->firstOrFail();

        // Obtener una cita aleatoria del libro
        $randomQuote = $book->quotes()->inRandomOrder()->first();

        // Obtener autores del libro
        $authors = $book->authors;

        return response()->json([
            'book' => $book,
            'authors' => $authors,
            'quotes' => $book->quotes,
            'random_quote' => $randomQuote
        ]);
    }

    // Obtener los autores de un libro específico
    public function authors($slug)
    {
        // Busca el libro por su slug
        $book = QuoteBook::where('slug', $slug)->firstOrFail();

        // Devuelve el campo 'author' en formato JSON
        return response()->json(['author' => $book->author]);
    }

    // Obtener una cita aleatoria del libro
    public function randomQuote($slug)
    {
        // Encuentra el libro por su slug
        $book = QuoteBook::where('slug', $slug)->firstOrFail();

        // Obtén una cita aleatoria del libro
        $quote = $book->quotes()->inRandomOrder()->first();

        if ($quote) {
            return response()->json($quote);
        } else {
            return response()->json(['message' => 'No quotes found for this book'], 404);
        }
    }

    // Obtener todas las citas de un libro específico
    public function quotes($slug)
    {
        $book = QuoteBook::where('slug', $slug)->firstOrFail();
        return response()->json($book->quotes);
    }
}
