<?php

namespace Works\Dictionaryworks\Controllers;

use App\Http\Controllers\Controller;
use Works\Dictionaryworks\Models\DictionaryCategory;

class DictionaryCategoryController extends Controller
{
    // Lista todas las categorías
    public function index()
    {
        $categories = DictionaryCategory::all();
        return response()->json($categories);
    }

    // Lista los términos más populares de una categoría
    public function populars($category)
    {
        $category = DictionaryCategory::where('slug', $category)->firstOrFail();
        $popularTerms = $category->terms()->orderBy('views', 'desc')->take(10)->get();
        return response()->json($popularTerms);
    }

    // Lista las últimas definiciones subidas de una categoría
    public function latest($category)
    {
        $category = DictionaryCategory::where('slug', $category)->firstOrFail();
        $latestTerms = $category->terms()->orderBy('created_at', 'desc')->take(10)->get();
        return response()->json($latestTerms);
    }

    // Lista todos los términos que pertenecen a una categoría
    public function termsByCategory($category)
    {
        $category = DictionaryCategory::where('slug', $category)->firstOrFail();
        $terms = $category->terms()->get();
        return response()->json($terms);
    }
}
