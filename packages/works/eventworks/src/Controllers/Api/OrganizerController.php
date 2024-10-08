<?php
namespace Works\Eventworks\Controllers\Api;

use Works\Eventworks\Models\Organizer;
use Illuminate\Http\JsonResponse;

class OrganizerController
{
    // Listado de todas las organizaciones
    public function index(): JsonResponse
    {
        // Selecciona solo los campos específicos
        $organizers = Organizer::select('name', 'slug', 'phone', 'email')->get();
        return response()->json($organizers);
    }

    // Detalles de una organización en particular por su slug
    public function show($slug): JsonResponse
    {
        // Selecciona solo los campos específicos
        $organizer = Organizer::select('name', 'slug', 'phone', 'email')
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json($organizer);
    }
}
