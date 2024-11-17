<?php

namespace Works\Web\Controllers\Api;

use App\Http\Controllers\Controller;
use Works\Web\Models\Web;
use Works\Web\Models\Content;

class ContentController extends Controller
{
    /**
     * Get all contents for a given web slug.
     *
     * @param string $webSlug
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($webSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        $contents = $web->contents; // Assumes the `Web` model has a `contents` relationship

        return response()->json($contents);
    }

    /**
     * Get a specific content for a given web slug and content slug.
     *
     * @param string $webSlug
     * @param string $contentSlug
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($webSlug, $contentSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        $content = $web->contents()->where('slug', $contentSlug)->firstOrFail();

        return response()->json($content);
    }
}
