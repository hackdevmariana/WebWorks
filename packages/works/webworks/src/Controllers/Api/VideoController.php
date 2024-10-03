<?php

namespace Works\Webworks\Controllers\Api;


use Works\Webworks\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class VideoController extends Controller
{
    // Show all videos from a specific website
    public function index($name)
    {
        $videos = Video::whereHas('website', function ($query) use ($name) {
            $query->where('web', $name);
        })->get();

        return response()->json($videos);
    }

    // Display a specific video by name
    public function show($name, $videoName)
    {
        $video = Video::whereHas('website', function ($query) use ($name) {
            $query->where('web', $name);
        })->where('name', $videoName)->firstOrFail();

        return response()->json($video);
    }
}
