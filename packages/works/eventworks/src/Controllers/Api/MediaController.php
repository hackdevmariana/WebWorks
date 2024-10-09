<?php

namespace Works\Eventworks\Controllers\Api;

use Works\Eventworks\Models\Media;
use Illuminate\Http\JsonResponse;

class MediaController
{
    // Listado de todos los archivos multimedia
    public function index(): JsonResponse
    {
        $media = Media::select('name', 'slug', 'description', 'url', 'alt')->get();
        return response()->json($media);
    }

    // Detalles de un archivo multimedia en particular por su slug
    public function show($slug): JsonResponse
    {
        $mediaItem = Media::select('name', 'slug', 'description', 'url', 'alt')
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json($mediaItem);
    }
}
