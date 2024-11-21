<?php

namespace Works\Web\Controllers\Api;

use Works\Web\Models\Playlist;
use Works\Web\Models\Web;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PlaylistController extends Controller
{
    public function index($webSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();

        return response()->json([
            'playlists' => $web->playlists()->with('videos')->get(),
        ]);
    }

    public function show($webSlug, $playlistSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        $playlist = $web->playlists()->where('slug', $playlistSlug)->with('videos')->firstOrFail();

        return response()->json([
            'playlist' => $playlist,
        ]);
    }
}
