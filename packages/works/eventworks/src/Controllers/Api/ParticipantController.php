<?php

namespace Works\Eventworks\Controllers\Api;

use Works\Eventworks\Models\Participant;
// use Works\Eventworks\Models\Event;
use Illuminate\Http\JsonResponse;

class ParticipantController
{
    public function index(): JsonResponse
    {
        $participants = Participant::all();
        return response()->json($participants);
    }

    public function showByUsername(string $username): JsonResponse

    {
        $participant = Participant::where('username', $username)->firstOrFail();
        return response()->json($participant);
    }
    public function showByEvent(Event $event): JsonResponse
    {
        $participants = $event->participants; // Relación evento -> participantes
        return response()->json($participants);
    }

    

}
