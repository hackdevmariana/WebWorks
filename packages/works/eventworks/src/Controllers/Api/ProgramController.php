<?php

namespace Works\Eventworks\Controllers\Api;


use App\Http\Controllers\Controller;
use Works\Eventworks\Models\Event;
use Works\Eventworks\Models\Program;
use Works\Eventworks\Models\Activity;

class ProgramController extends Controller
{

    public function getProgramByEvent($eventSlug)
    {
        $event = Event::where('slug', $eventSlug)->firstOrFail();
        return Program::where('event_id', $event->id)->with('activities')->get();
    }

    // Obtener programas por día del evento
    public function getProgramByDay($eventSlug, $day)
    {
        $event = Event::where('slug', $eventSlug)->firstOrFail();
        return Program::where('event_id', $event->id)->where('day', $day)->with('activities')->get();
    }


    public function getActivityByName($eventSlug, $activitySlug)
    {
        // Buscar el evento por su slug
        $event = Event::where('slug', $eventSlug)->firstOrFail();
    
        // Buscar la actividad por el slug y asegurarse de que pertenece a un programa del evento
        $activity = Activity::where('slug', $activitySlug)
            ->whereHas('program', function($query) use ($event) {
                $query->where('event_id', $event->id);
            })
            ->with('program') // Traer la información del programa relacionado
            ->firstOrFail();
    
        return response()->json($activity);
    }


    
}
