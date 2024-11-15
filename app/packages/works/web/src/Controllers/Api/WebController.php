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
        return response()->json(Web::all(), 200);
    }

    public function showBySlug($slug)
    {
        $web = Web::where('slug', $slug)->firstOrFail();
        return response()->json($web, 200);
    }

}
