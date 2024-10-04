<?php
namespace Works\Webworks\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Works\Webworks\Models\Content;
use Works\Webworks\Models\Website;

class HeroController extends Controller
{
    public function index($websiteName)
    {
        $heros = Content::where('website_id', $websiteName)
                        ->where('content_type', 'hero')
                        ->get();
        return response()->json($heros);
    }

    public function show($websiteName, $heroItemName)
    {
        $heroItem = Content::where('website_id', $websiteName)
                           ->where('name', $heroItemName)
                           ->where('content_type', 'hero')
                           ->firstOrFail();
        return response()->json($heroItem);
    }
}
