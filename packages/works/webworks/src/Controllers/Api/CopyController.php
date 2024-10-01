<?php

namespace Works\Webworks\Controllers\Api;


use Illuminate\Http\Request;
use Works\Webworks\Models\Website;
use Works\Webworks\Models\Copy;
use App\Http\Controllers\Controller;


class CopyController extends Controller
{
    public function index($name)
    {
        $website = Website::where('web', $name)->firstOrFail();
        $copies = Copy::where('website_id', $website->id)->get();
        
        return response()->json($copies);
    }

    public function show($websiteName, $copyName)
    {
        $website = Website::where('web', $websiteName)->firstOrFail();
        $copy = Copy::where('website_id', $website->id)
                    ->where('name', $copyName)
                    ->firstOrFail();

        return response()->json($copy);
    }
}
