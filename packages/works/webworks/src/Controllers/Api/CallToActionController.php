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
        $website = Website::where('web', $websiteName)->firstOrFail();
        
        $query = Content::where('website_id', $website->id)
                        ->whereIn('content_type', ['call-to-action', 'call_to_action', 'calltoaction']);
        
        $callToActions = $query->paginate($request->get('perPage', 10));

        return response()->json($callToActions);
    }

    public function show($websiteName, $callToActionName)
    {
        $website = Website::where('web', $websiteName)->firstOrFail();

        $callToActionItem = Content::where('website_id', $website->id)
                                   ->where('name', $callToActionName)
                                   ->whereIn('content_type', ['call-to-action', 'call_to_action', 'calltoaction'])
                                   ->firstOrFail();
                                   
        return response()->json($callToActionItem);
    }
}
