<?php

namespace Works\Web\Controllers\Api;

use Illuminate\Http\Request;
use Works\Web\Models\Web;
use Works\Web\Models\Copy;
use App\Http\Controllers\Controller;

class CopyController extends Controller
{
    /**
     * Retrieve all copies for a specific web by its slug.
     *
     * @param string $webSlug
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($webSlug)
    {
        $web = Web::where('slug', $webSlug)->first();

        if (!$web) {
            return response()->json(['message' => 'Web not found.'], 404);
        }

        $copies = $web->copies; // Assumes a one-to-many relationship between Web and Copy.

        return response()->json([
            'web' => $web->name,
            'copies' => $copies,
        ]);
    }

    /**
     * Retrieve a specific copy for a web by webSlug and copySlug.
     *
     * @param string $webSlug
     * @param string $copySlug
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($webSlug, $copySlug)
    {
        $web = Web::where('slug', $webSlug)->first();

        if (!$web) {
            return response()->json(['message' => 'Web not found.'], 404);
        }

        $copy = $web->copies()->where('slug', $copySlug)->first();

        if (!$copy) {
            return response()->json(['message' => 'Copy not found.'], 404);
        }

        return response()->json($copy);
    }
}
