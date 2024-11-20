<?php

namespace Works\Web\Controllers\Api;

use Works\Web\Models\Video;
use Works\Web\Models\Web;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class VideoController extends Controller
{
    public function index($webSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        return response()->json($web->videos);
    }

    public function show($webSlug, $videoSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        $video = $web->videos()->where('slug', $videoSlug)->firstOrFail();
        return response()->json($video);
    }
}
