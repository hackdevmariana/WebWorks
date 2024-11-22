<?php

namespace Works\Web\Controllers\Api;

use Works\Web\Models\Web;
use Works\Web\Models\QuestionAnswer;
use Illuminate\Http\Request;

class QuestionAnswerController
{
    public function index($webSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        return $web->questionAnswers()->get();
    }

    public function categories($webSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        return $web->questionAnswers()->pluck('category')->unique();
    }

    public function show($webSlug, $questionAnswerSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        return $web->questionAnswers()->where('slug', $questionAnswerSlug)->firstOrFail();
    }

    public function questionsByCategory($webSlug, $category)
    {
        // Obtener la web por su slug
        $web = Web::where('slug', $webSlug)->firstOrFail();

        // Obtener las preguntas que coincidan con la categoría
        $questions = $web->questionAnswers()->where('category', $category)->get();

        // Verificar si hay resultados
        if ($questions->isEmpty()) {
            return response()->json(['message' => 'No questions found for this category.'], 404);
        }

        return $questions;
    }

}