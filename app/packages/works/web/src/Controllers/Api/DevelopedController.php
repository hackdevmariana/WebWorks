<?php

namespace Works\Web\Controllers\Api;

use Illuminate\Http\Request;
use Works\Web\Models\Web;
use Works\Web\Models\Developed;
use App\Http\Controllers\Controller;

class DevelopedController extends Controller
{
    public function index($webSlug)
    {
        $web = Web::where('slug', $webSlug)->first();

        if (!$web) {
            return response()->json(['message' => 'Web not found.'], 404);
        }

        $developeds = $web->developeds;

        return response()->json([
            'web' => $web->name,
            'developeds' => $developeds,
        ]);
    }

    public function show($webSlug, $developedSlug)
    {
        $web = Web::where('slug', $webSlug)->first();

        if (!$web) {
            return response()->json(['message' => 'Web not found.'], 404);
        }

        $developed = $web->developeds()->where('slug', $developedSlug)->first();

        if (!$developed) {
            return response()->json(['message' => 'Developed item not found.'], 404);
        }

        return response()->json($developed);
    }
}
