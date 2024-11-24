<?php

namespace Works\Web\Controllers\Api;

use Works\Web\Models\CustomMenu;
use Works\Web\Models\Web;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomMenuController extends Controller
{
    public function index($webSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        
        $menus = $web->menus()->with('links')->get();


        return response()->json($menus);
    }

    public function show($webSlug, $menuSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        
        // Cargar un solo menú junto con los links relacionados
        $menu = $web->menus()->where('slug', $menuSlug)->with('links')->firstOrFail();

        return response()->json($menu);
    }
}
