<?php

namespace Works\Web\Controllers\Api;

use Illuminate\Http\Request;
use Works\Web\Models\Carousel;
use Works\Web\Models\Web;
use App\Http\Controllers\Controller;

class CarouselController extends Controller
{
    public function index($webSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        return Carousel::where('web_id', $web->id)->with('contents')->get();
    }

    public function show($webSlug, $carouselSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        return Carousel::where('web_id', $web->id)
            ->where('slug', $carouselSlug)
            ->with('contents')
            ->firstOrFail();
    }
}
