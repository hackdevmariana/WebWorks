<?php

namespace Works\Web\Controllers\Api;

use Illuminate\Http\Request;
use Works\Web\Models\Web;
use Works\Web\Models\ErrorPage;
use App\Http\Controllers\Controller;

class ErrorPageController extends Controller
{
    public function index($webSlug)
    {
        $web = Web::where('slug', $webSlug)->first();

        if (!$web) {
            return response()->json(['message' => 'Web not found.'], 404);
        }

        $errorPages = $web->errorPages;

        return response()->json([
            'web' => $web->name,
            'error_pages' => $errorPages,
        ]);
    }

    public function show($webSlug, $errorNumber)
    {
        $web = Web::where('slug', $webSlug)->first();

        if (!$web) {
            return response()->json(['message' => 'Web not found.'], 404);
        }

        $errorPage = $web->errorPages()->where('error_number', $errorNumber)->first();

        if (!$errorPage) {
            return response()->json(['message' => 'Error page not found.'], 404);
        }

        return response()->json($errorPage);
    }
}
