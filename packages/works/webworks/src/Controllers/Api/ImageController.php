<?php

namespace Works\Webworks\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Works\Webworks\Models\Content;
use Works\Webworks\Models\Website;

class ImageController extends Controller
{
    public function index($websiteName, Request $request)
    {
        $website = Website::where('web', $websiteName)->firstOrFail();
        
        $query = Content::where('website_id', $website->id)
                        ->where('content_type', 'image');
        
        $images = $query->paginate($request->get('perPage', 10));

        return response()->json($images);
    }

    public function show($websiteName, $imageName)
    {
        $website = Website::where('name', $websiteName)->firstOrFail();

        $imageItem = Content::where('website_id', $website->id)
                            ->where('name', $imageName)
                            ->where('content_type', 'image')
                            ->firstOrFail();
                            
        return response()->json($imageItem);
    }
}
