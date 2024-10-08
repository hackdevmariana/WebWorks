<?php
namespace Works\Eventworks\Controllers\Api;

use Works\Eventworks\Models\EventTag;
use Illuminate\Http\JsonResponse;

class EventTagController
{
    public function index(): JsonResponse
    {
        // Selecciona solo 'name' y 'slug' y devuelve los resultados
        $tags = EventTag::select('name', 'slug')->get();
        return response()->json($tags);
    }
}
