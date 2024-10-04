<?php

namespace Works\Webworks\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Works\Webworks\Models\Content;
use Works\Webworks\Models\Website;

class GalleryController extends Controller
{
    public function index($websiteName, Request $request)
    {
        $website = Website::where('name', $websiteName)->firstOrFail();
        
        $query = Content::where('website_id', $website->id)
                        ->where('content_type', 'gallery');
        
        $galleries = $query->paginate($request->get('perPage', 10));

        return response()->json($galleries);
    }

    public function show($websiteName, $galleryName)
    {
        $website = Website::where('name', $websiteName)->firstOrFail();

        $galleryItem = Content::where('website_id', $website->id)
                               ->where('name', $galleryName)
                               ->where('content_type', 'gallery')
                               ->firstOrFail();
                               
        return response()->json($galleryItem);
    }
}
