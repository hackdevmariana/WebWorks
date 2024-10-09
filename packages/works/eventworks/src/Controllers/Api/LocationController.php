<?php

namespace Works\Eventworks\Controllers\Api;

use Works\Eventworks\Models\Location;
use Illuminate\Http\JsonResponse;

class LocationController
{
    // Listado de todas las ubicaciones
    public function index(): JsonResponse
    {
        // Cargar relaciones de ciudad y país
        $locations = Location::with(['city', 'country'])
            ->select('name', 'slug', 'address', 'city_id', 'country_id', 'zip', 'phone')
            ->get()
            ->map(function ($location) {
                return [
                    'name' => $location->name,
                    'slug' => $location->slug,
                    'address' => $location->address,
                    'city' => $location->city->name,      // Nombre de la ciudad
                    'country' => $location->country->name,  // Nombre del país
                    'zip' => $location->zip,
                    'phone' => $location->phone
                ];
            });

        return response()->json($locations);
    }

    // Detalles de una ubicación en particular por su slug
    public function show($slug): JsonResponse
    {
        // Cargar relaciones de ciudad y país
        $location = Location::with(['city', 'country'])
            ->select('name', 'slug', 'address', 'city_id', 'country_id', 'zip', 'phone')
            ->where('slug', $slug)
            ->firstOrFail();

        // Formatear la respuesta
        $formattedLocation = [
            'name' => $location->name,
            'slug' => $location->slug,
            'address' => $location->address,
            'city' => $location->city->name,        // Nombre de la ciudad
            'country' => $location->country->name,  // Nombre del país
            'zip' => $location->zip,
            'phone' => $location->phone
        ];

        return response()->json($formattedLocation);
    }
}
