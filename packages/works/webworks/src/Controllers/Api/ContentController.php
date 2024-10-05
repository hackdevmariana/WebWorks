<?php

namespace Works\Webworks\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Works\Webworks\Models\Content;
use Works\Webworks\Models\Website;

class ContentController extends Controller
{
    public function index($websiteName, Request $request)
    {
        $website = Website::where('name', $websiteName)->firstOrFail();
        
        $query = Content::where('website_id', $website->id);
        
        if ($request->has('type')) {
            $query->where('content_type', $request->get('type'));
        }
        
        if ($request->has('name')) {
            $query->where('name', $request->get('name'));
        }

        $contents = $query->paginate($request->get('perPage', 10));

        return response()->json($contents);
    }

    public function show($websiteName, $contentName)
    {
        $website = Website::where('name', $websiteName)->firstOrFail();

        $contentItem = Content::where('website_id', $website->id)
                              ->where('name', $contentName)
                              ->firstOrFail();
                              
        return response()->json($contentItem);
    }
}
