<?php

namespace Works\Web\Controllers\Api;

use Illuminate\Http\Request;
use Works\Web\Models\Web;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    public function index($webSlug)
    {
        $web = Web::where('slug', $webSlug)->first();

        if (!$web) {
            return response()->json(['message' => 'Web not found.'], 404);
        }

        // Solo seleccionamos los campos deseados de los links
        $links = $web->links->map(function ($link) {
            return $link->only(['text', 'slug', 'url', 'icon']);
        });

        return response()->json([
            'web' => $web->name,
            'links' => $links,
        ]);
    }

    public function show($webSlug, $linkSlug)
    {
        $web = Web::where('slug', $webSlug)->first();

        if (!$web) {
            return response()->json(['message' => 'Web not found.'], 404);
        }

        $link = $web->links()->where('slug', $linkSlug)->first();

        if (!$link) {
            return response()->json(['message' => 'Link not found.'], 404);
        }

        // Solo seleccionamos los campos deseados del link
        return response()->json($link->only(['text', 'slug', 'url', 'icon']));
    }
}
