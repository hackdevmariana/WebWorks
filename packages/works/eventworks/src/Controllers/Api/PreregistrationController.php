<?php

namespace Works\Eventworks\Controllers\Api;

use App\Http\Controllers\Controller;
use Works\Eventworks\Models\Event;
use Works\Eventworks\Models\Preregistration;
use Illuminate\Http\Request;

class PreregistrationController extends Controller
{
    // Obtener todos los pre-registrados de un evento por su slug
    public function getPreRegisteredByEvent($eventSlug)
    {
        // Buscar el evento por su slug
        $event = Event::where('slug', $eventSlug)->firstOrFail();

        // Obtener los pre-registrados asociados al evento
        $preRegistered = Preregistration::where('event_id', $event->id)->get();

        return response()->json($preRegistered);
    }
}
