<?php

namespace Works\Webworks\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Works\Webworks\Models\Content;
use Works\Webworks\Models\Website;

class StringController extends Controller
{
    public function index($websiteName, Request $request)
    {
        $website = Website::where('web', $websiteName)->firstOrFail();

        
        $query = Content::where('website_id', $website->id)
                        ->where('content_type', 'string');
        
        $strings = $query->paginate($request->get('perPage', 10));

        return response()->json($strings);
    }

    public function show($websiteName, $stringName)
    {
        $website = Website::where('name', $websiteName)->firstOrFail();

        $stringItem = Content::where('website_id', $website->id)
                             ->where('name', $stringName)
                             ->where('content_type', 'string')
                             ->firstOrFail();
                             
        return response()->json($stringItem);
    }
}
