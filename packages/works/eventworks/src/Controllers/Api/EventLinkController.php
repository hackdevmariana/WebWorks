<?php

namespace Works\Eventworks\Controllers\Api;

use Works\Eventworks\Models\EventLink;
use Illuminate\Http\JsonResponse;

class EventLinkController
{
    // Listado de todos los enlaces
    public function index(): JsonResponse
    {
        $links = EventLink::select('name', 'slug', 'url', 'alt')->get();
        return response()->json($links);
    }

    // Detalles de un enlace en particular por su slug
    public function show($slug): JsonResponse
    {
        $link = EventLink::select('name', 'slug', 'url', 'alt')
            ->where('slug', $slug)
            ->firstOrFail();
        
        return response()->json($link);
    }
}
