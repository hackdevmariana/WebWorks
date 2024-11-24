<?php

namespace Works\Web\Controllers\Api;

use Illuminate\Http\Request;
use Works\Web\Models\Gallery;
use Works\Web\Models\Web;

class GalleryController
{
    public function index($webSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        return response()->json($web->galleries()->with('contents')->get());
    }

    public function show($webSlug, $gallerySlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        $gallery = $web->galleries()->where('slug', $gallerySlug)->with('contents')->firstOrFail();
        return response()->json($gallery);
    }
}
