<?php

namespace Works\Web\Controllers\Api;

use Works\Web\Models\Web;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    public function index($webSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();

        // Seleccionamos solo los campos específicos
        $authors = $web->authors()->select(
            'username',
            'name',
            'surname',
            'links',
            'photo',
            'biography',
            'slug'
        )->get();

        return response()->json($authors, 200);
    }

    public function show($webSlug, $authorSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();

        // Seleccionamos solo los campos específicos para un autor
        $author = $web->authors()
            ->select(
                'username',
                'name',
                'surname',
                'links',
                'photo',
                'biography',
                'slug'
            )
            ->where('slug', $authorSlug)
            ->firstOrFail();

        return response()->json($author, 200);
    }
}
