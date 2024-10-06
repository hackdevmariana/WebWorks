<?php

namespace Works\Webworks\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Works\Webworks\Models\Content;
use Works\Webworks\Models\Website;

class PostsController extends Controller
{
    public function index($websiteName, Request $request)
    {
        $website = Website::where('web', $websiteName)->firstOrFail();
        
        $query = Content::where('website_id', $website->id)
                        ->where('content_type', 'post');
        
        if ($request->has('date')) {
            $query->whereDate('created_at', $request->date);
        }
        
        if ($request->has('start') && $request->has('end')) {
            $query->whereBetween('created_at', [$request->start, $request->end]);
        }

        $posts = $query->paginate($request->get('perPage', 10));

        return response()->json($posts);
    }

    public function show($websiteName, $slug)
    {
        $website = Website::where('name', $websiteName)->firstOrFail();

        $postItem = Content::where('website_id', $website->id)
                           ->where('name', $slug)
                           ->where('content_type', 'post')
                           ->firstOrFail();
                           
        return response()->json($postItem);
    }

    public function filterByTag($websiteName, $tag, Request $request)
    {
        $website = Website::where('name', $websiteName)->firstOrFail();

        $posts = Content::where('website_id', $website->id)
                       ->where('content_type', 'post')
                       ->where('tags', 'LIKE', "%$tag%")
                       ->paginate($request->get('perPage', 10));

        return response()->json($posts);
    }
}
