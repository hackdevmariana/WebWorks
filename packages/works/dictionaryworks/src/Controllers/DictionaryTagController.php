<?php

namespace Works\Dictionaryworks\Controllers;

use App\Http\Controllers\Controller;
use Works\Dictionaryworks\Models\DictionaryTag;

class DictionaryTagController extends Controller
{
    // Lista todas las etiquetas
    public function index()
    {
        $tags = DictionaryTag::all();
        return response()->json($tags);
    }

    // Lista los términos más populares de una etiqueta
    public function populars($tag)
    {
        $tag = DictionaryTag::where('slug', $tag)->firstOrFail();
        $popularTerms = $tag->terms()->orderBy('views', 'desc')->take(10)->get();
        return response()->json($popularTerms);
    }

    // Lista las últimas definiciones subidas con una etiqueta
    public function latest($tag)
    {
        $tag = DictionaryTag::where('slug', $tag)->firstOrFail();
        $latestTerms = $tag->terms()->orderBy('created_at', 'desc')->take(10)->get();
        return response()->json($latestTerms);
    }

    // Lista todos los términos que pertenecen a una etiqueta
    public function termsByTag($tag)
    {
        $tag = DictionaryTag::where('slug', $tag)->firstOrFail();
        $terms = $tag->terms()->get();
        return response()->json($terms);
    }
}
