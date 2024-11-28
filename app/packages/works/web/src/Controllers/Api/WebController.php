<?php

namespace Works\Web\Controllers\Api;

use Works\Web\Models\Web;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    /**
     * Display a listing of the websites.
     */
    public function index()
    {
        // Select only the necessary fields
        $webs = Web::select('url', 'home', 'title', 'description', 'keywords', 'favicon', 'name', 'slug')->get();
        return response()->json($webs, 200);
    }

    /**
     * Display the specified website by slug.
     */
    public function showBySlug($slug)
    {
        // Select only the necessary fields and search by slug
        $web = Web::select('url', 'home', 'title', 'description', 'keywords', 'favicon', 'name', 'slug')
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json($web, 200);
    }
}
