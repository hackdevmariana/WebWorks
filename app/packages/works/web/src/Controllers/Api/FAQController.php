<?php

namespace Works\Web\Controllers\Api;

use App\Http\Controllers\Controller;
use Works\Web\Models\FAQ;
use Works\Web\Models\Web;

class FAQController extends Controller
{
    public function index($webSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        return response()->json($web->faqs()->with('questions')->get());
    }

    public function show($webSlug, $faqSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        $faq = $web->faqs()->where('slug', $faqSlug)->with('questions')->firstOrFail();
        return response()->json($faq);
    }
}
