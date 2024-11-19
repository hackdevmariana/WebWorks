<?php

namespace Works\Web\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Works\Web\Models\Logo;
use Works\Web\Models\Web;

class LogoController extends Controller
{
    public function index(string $webSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        return response()->json($web->logos);
    }

    public function show(string $webSlug, string $logoSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        $logo = $web->logos()->where('slug', $logoSlug)->firstOrFail();
        return response()->json($logo);
    }
}
