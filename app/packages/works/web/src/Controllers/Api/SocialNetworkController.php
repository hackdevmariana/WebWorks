<?php

namespace Works\Web\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Works\Web\Models\SocialNetwork;
use Works\Web\Models\Web;

class SocialNetworkController extends Controller
{
    public function index($webSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        return response()->json($web->socialNetworks);
    }

    public function show($webSlug, $socialNetworkSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        $socialNetwork = $web->socialNetworks()->where('slug', $socialNetworkSlug)->firstOrFail();
        return response()->json($socialNetwork);
    }
}
