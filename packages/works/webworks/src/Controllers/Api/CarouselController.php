<?php

namespace Works\Webworks\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Works\Webworks\Models\Content;
use Works\Webworks\Models\Website;

class CarouselController extends Controller
{
    public function index($websiteName, Request $request)
    {
        $website = Website::where('name', $websiteName)->firstOrFail();
        
        $query = Content::where('website_id', $website->id)
                        ->where('content_type', 'carousel');
        
        $carousels = $query->paginate($request->get('perPage', 10));

        return response()->json($carousels);
    }

    public function show($websiteName, $carouselName)
    {
        $website = Website::where('name', $websiteName)->firstOrFail();

        $carouselItem = Content::where('website_id', $website->id)
                               ->where('name', $carouselName)
                               ->where('content_type', 'carousel')
                               ->firstOrFail();
                               
        return response()->json($carouselItem);
    }
}
