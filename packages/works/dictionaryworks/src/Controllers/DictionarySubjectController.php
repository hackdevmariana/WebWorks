<?php

namespace Works\Dictionaryworks\Controllers;

use App\Http\Controllers\Controller;
use Works\Dictionaryworks\Models\DictionarySubject;

class DictionarySubjectController extends Controller
{
    // Lista todas las materias (subjects)
    public function index()
    {
        $subjects = DictionarySubject::all();
        return response()->json($subjects);
    }

    // Lista los términos más populares de una materia
    public function populars($subject)
    {
        $subject = DictionarySubject::where('slug', $subject)->firstOrFail();
        $popularTerms = $subject->terms()->orderBy('views', 'desc')->take(10)->get();
        return response()->json($popularTerms);
    }

    // Lista las últimas definiciones subidas de una materia
    public function latest($subject)
    {
        $subject = DictionarySubject::where('slug', $subject)->firstOrFail();
        $latestTerms = $subject->terms()->orderBy('created_at', 'desc')->take(10)->get();
        return response()->json($latestTerms);
    }
}
