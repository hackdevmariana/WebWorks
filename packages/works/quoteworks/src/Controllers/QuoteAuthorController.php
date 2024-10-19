<?php

namespace Works\Quoteworks\Controllers;

use App\Http\Controllers\Controller;
use Works\Quoteworks\Models\QuoteAuthor;

class QuoteAuthorController extends Controller
{

    public function index()
    {
        $authors = QuoteAuthor::all(); // Obtiene todos los autores
        return response()->json($authors);
    }


    public function show($slug)
    {
        $author = QuoteAuthor::where('slug', $slug)->firstOrFail();
        return response()->json($author);
    }

    public function books($slug)
    {
        $author = QuoteAuthor::where('slug', $slug)->firstOrFail();
        return response()->json($author->books);
    }

    public function socialMedia($slug)
    {
        $author = QuoteAuthor::where('slug', $slug)->firstOrFail();
        return response()->json($author->urls); // Asume que 'urls' contiene las cuentas de redes sociales
    }

    public function birth($slug)
    {
        $author = QuoteAuthor::where('slug', $slug)->firstOrFail();
        return response()->json($author->birth); // Datos de fecha y lugar de nacimiento
    }

    public function death($slug)
    {
        $author = QuoteAuthor::where('slug', $slug)->firstOrFail();
        return response()->json($author->death); // Datos de fecha y lugar de muerte
    }

    /*
    public function relations($slug)
    {
        // Asume que el modelo tiene una relación definida llamada "relations"
        $author = QuoteAuthor::where('slug', $slug)->firstOrFail();
        return response()->json($author->relations);
    }
        */

    public function collaborations($slug)
    {
        // Asume que hay un método o relación para obtener colaboraciones
        $author = QuoteAuthor::where('slug', $slug)->firstOrFail();
        return response()->json($author->collaborations);
    }

    public function relatedAuthors($slug)
    {
        // Asume que hay un método o relación para obtener autores relacionados
        $author = QuoteAuthor::where('slug', $slug)->firstOrFail();
        return response()->json($author->relatedAuthors);
    }

    public function tags($slug)
    {
        // Asume que el modelo tiene una relación llamada "tags"
        $author = QuoteAuthor::where('slug', $slug)->firstOrFail();
        return response()->json($author->tags);
    }

    public function school($slug)
    {
        // Asume que el modelo tiene una relación o campo "school"
        $author = QuoteAuthor::where('slug', $slug)->firstOrFail();
        return response()->json($author->school);
    }





    public function relations($slug)
    {
        $author = QuoteAuthor::where('slug', $slug)->firstOrFail();
        return response()->json($author->relations);
    }

    public function topQuotes()
    {
        // Obtener las citas más vistas (aquí se limita a las top 10)
        $topQuotes = QuoteQuote::orderBy('views', 'desc')->take(10)->get();

        // Devolver las citas con sus respectivos autores y libros
        return response()->json($topQuotes->map(function ($quote) {
            return [
                'quote' => $quote->quote,
                'author' => $quote->author->name . ' ' . $quote->author->surname,
                'book' => $quote->book->title_in_spanish,
                'views' => $quote->views,
            ];
        }));
    }

}
