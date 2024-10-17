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
}
