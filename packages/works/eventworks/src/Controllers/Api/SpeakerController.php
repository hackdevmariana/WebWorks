<?php

namespace Works\Eventworks\Controllers\Api;

use App\Http\Controllers\Controller;
use Works\Eventworks\Models\Speaker;
use Works\Eventworks\Models\Event;

class SpeakerController extends Controller
{
    // Obtener conferenciante por nombre
    public function getSpeakerByName($speakerName)
    {
        $speaker = Speaker::where('slug', 'LIKE', '%' . $speakerName . '%')->firstOrFail();
        return response()->json($speaker);
    }

    // Listar todos los conferenciantes
    public function getAllSpeakers()
    {
        $speakers = Speaker::all();
        return response()->json($speakers);
    }

    // Listar conferenciantes de un evento específico
    public function getSpeakersByEvent($eventSlug)
    {
        $event = Event::where('slug', $eventSlug)->firstOrFail();
        $speakers = $event->speakers; // Relación de muchos a muchos entre Event y Speaker
        return response()->json($speakers);
    }
}
