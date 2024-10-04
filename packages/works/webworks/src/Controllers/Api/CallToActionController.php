<?php

namespace Works\Webworks\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Works\Webworks\Models\Content;
use Works\Webworks\Models\Website;

class CallToActionController extends Controller
{
    public function index($websiteName, Request $request)
    {
        $website = Website::where('name', $websiteName)->firstOrFail();
        
        $query = Content::where('website_id', $website->id)
                        ->where('content_type', 'calltoaction');
        
        $callToActions = $query->paginate($request->get('perPage', 10));

        return response()->json($callToActions);
    }

    public function show($websiteName, $callToActionName)
    {
        $website = Website::where('name', $websiteName)->firstOrFail();

        $callToActionItem = Content::where('website_id', $website->id)
                                   ->where('name', $callToActionName)
                                   ->where('content_type', 'calltoaction')
                                   ->firstOrFail();
                                   
        return response()->json($callToActionItem);
    }
}
