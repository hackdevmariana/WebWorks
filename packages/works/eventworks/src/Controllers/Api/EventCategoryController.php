<?php

namespace Works\Eventworks\Controllers\Api;

use Works\Eventworks\Models\EventCategory;
use Illuminate\Http\JsonResponse;

class EventCategoryController
{
    public function index(): JsonResponse
    {
        // Seleccionar sólo 'name' y 'slug'
        $categories = EventCategory::select('name', 'slug')->get();
        return response()->json($categories);
    }
}
