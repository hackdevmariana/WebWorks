<?php

namespace Works\Eventworks\Controllers\Api;

use App\Http\Controllers\Controller;
use Works\Eventworks\Models\Attendance;
use Works\Eventworks\Models\Event;
use Works\Eventworks\Models\Participant;

class AttendanceController extends Controller
{
    // Obtener asistencias de un participante
    public function getAttendanceByParticipant($participantSlug)
    {
        $participant = Participant::where('slug', $participantSlug)->firstOrFail();
        $attendances = Attendance::where('participant_id', $participant->id)->with('event')->get();
        
        return response()->json($attendances);
    }

    // Obtener participantes de un evento
    public function getParticipantsByEvent($eventSlug)
    {
        $event = Event::where('slug', $eventSlug)->firstOrFail();
        $participants = $event->attendances()->with('participant')->get();
        
        return response()->json($participants);
    }
}
