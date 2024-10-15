<?php

namespace Works\Dictionaryworks\Controllers;

use Works\Dictionaryworks\Models\DictionaryTerm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DictionaryTermController extends Controller
{
    // Lista todos los términos
    public function index()
    {
        $terms = DictionaryTerm::all();
        return response()->json($terms);
    }

    public function show($term)
    {
        $term = DictionaryTerm::where('slug', $term)->firstOrFail();

        // Incrementar las vistas
        $term->increment('views');

        return response()->json($term);
    }


    // Lista términos aprobados
    public function approved()
    {
        $terms = DictionaryTerm::where('status', 'approved')->get();
        return response()->json($terms);
    }

    // Lista términos pendientes
    public function pending()
    {
        $terms = DictionaryTerm::where('status', 'pending')->get();
        return response()->json($terms);
    }

    // Lista términos rechazados
    public function rejected()
    {
        $terms = DictionaryTerm::where('status', 'rejected')->get();
        return response()->json($terms);
    }

    // Lista términos que empiezan por una letra específica
    public function getByInitial($letter)
    {
        $terms = DictionaryTerm::where('term', 'LIKE', $letter . '%')->get();
        return response()->json($terms);
    }

    // Lista sinónimos de un término
    public function synonyms($term)
    {
        $term = DictionaryTerm::where('slug', $term)->firstOrFail();
        return response()->json($term->synonyms);
    }

    // Lista antónimos de un término
    public function antonyms($term)
    {
        $term = DictionaryTerm::where('slug', $term)->firstOrFail();
        return response()->json($term->antonyms);
    }

    // Lista hipónimos de un término
    public function hyponyms($term)
    {
        $term = DictionaryTerm::where('slug', $term)->firstOrFail();
        return response()->json($term->hyponyms);
    }

    // Lista hiperónimos de un término
    public function hypernyms($term)
    {
        $term = DictionaryTerm::where('slug', $term)->firstOrFail();
        return response()->json($term->hypernyms);
    }

    // Lista términos relacionados (sinónimos, antónimos, hipónimos, hiperónimos)
    public function relatedTerms($term)
    {
        $term = DictionaryTerm::where('slug', $term)->firstOrFail();
        $relatedTerms = [
            'synonyms' => $term->synonyms,
            'antonyms' => $term->antonyms,
            'hyponyms' => $term->hyponyms,
            'hypernyms' => $term->hypernyms,
        ];

        return response()->json($relatedTerms);
    }

    // Lista términos más populares (por vistas)
    public function populars()
    {
        $terms = DictionaryTerm::orderBy('views', 'desc')->take(10)->get();
        return response()->json($terms);
    }

    // Lista últimas definiciones subidas
    public function latest()
    {
        $terms = DictionaryTerm::orderBy('created_at', 'desc')->take(10)->get();
        return response()->json($terms);
    }

    // Historial de cambios de un término
    public function history($term)
    {
        // Supongamos que tienes un modelo DictionaryTermHistory para el historial
        $history = DictionaryTerm::where('slug', $term)->firstOrFail()->history()->get();
        return response()->json($history);
    }

    // Sugerencias de cambios para un término específico
    public function suggestions($term)
    {
        // Supongamos que tienes un modelo DictionaryTermSuggestion para las sugerencias
        $suggestions = DictionaryTerm::where('slug', $term)->firstOrFail()->suggestions()->get();
        return response()->json($suggestions);
    }
}
