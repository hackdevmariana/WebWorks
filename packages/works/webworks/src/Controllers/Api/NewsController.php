<?php

namespace Works\Webworks\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Works\Webworks\Models\Content;
use Works\Webworks\Models\Website;

class NewsController extends Controller
{
    public function index($websiteName, Request $request)
    {
        $website = Website::where('name', $websiteName)->firstOrFail();
        
        $query = Content::where('website_id', $website->id)
                        ->where('content_type', 'news');
        
        if ($request->has('date')) {
            $query->whereDate('created_at', $request->date);
        }
        
        if ($request->has('start') && $request->has('end')) {
            $query->whereBetween('created_at', [$request->start, $request->end]);
        }

        $news = $query->paginate($request->get('perPage', 10));

        return response()->json($news);
    }

    public function show($websiteName, $slug)
    {
        $website = Website::where('name', $websiteName)->firstOrFail();

        $newsItem = Content::where('website_id', $website->id)
                           ->where('name', $slug)
                           ->where('content_type', 'news')
                           ->firstOrFail();
                           
        return response()->json($newsItem);
    }

    public function filterByTag($websiteName, $tag, Request $request)
    {
        $website = Website::where('name', $websiteName)->firstOrFail();

        $news = Content::where('website_id', $website->id)
                       ->where('content_type', 'news')
                       ->where('tags', 'LIKE', "%$tag%")
                       ->paginate($request->get('perPage', 10));

        return response()->json($news);
    }
}
