<?php

namespace Works\Web\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Works\Web\Models\Headline;
use Works\Web\Models\Web;

class HeadlineController extends Controller
{
    public function index($webSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        return response()->json($web->headlines);
    }

    public function show($webSlug, $headlineSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        $headline = $web->headlines()->where('slug', $headlineSlug)->firstOrFail();
        return response()->json($headline);
    }
}
