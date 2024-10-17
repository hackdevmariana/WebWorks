<?php

namespace Works\Scholarshipsworks\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Works\Scholarshipsworks\Models\Scholarships;
use Works\Scholarshipsworks\Models\TypeScholarship;
use Works\Scholarshipsworks\Models\UserScholarships;


class ScholarshipsController extends Controller
{
    public function events()
    {
        $events = TypeScholarship::distinct()->pluck('event');
        return response()->json($events);
    }

    // Devuelve las becas disponibles para un evento específico.
    public function scholarshipsByEvent($eventSlug)
    {
        $scholarships = Scholarships::with('typeScholarship')
            ->whereHas('typeScholarship', function ($query) use ($eventSlug) {
                $query->where('event', $eventSlug);
            })
            ->get();
        return response()->json($scholarships);
    }

    public function candidates()
    {
        // Obtener los candidatos con sus becas como candidatos
        $candidates = UserScholarships::whereHas('scholarshipsAsCandidate')->with('scholarshipsAsCandidate')->get();
        return response()->json($candidates);
    }

    public function benefactors()
    {
        // Obtener los benefactores con las becas que han ofrecido
        $benefactors = UserScholarships::whereHas('scholarshipsAsBenefactor')->with('scholarshipsAsBenefactor')->get();
        return response()->json($benefactors);
    }


    // Devuelve la información detallada de un candidato.
    public function candidate($id)
    {
        $candidate = UserScholarships::with('scholarshipsAsCandidate')->findOrFail($id);
        return response()->json($candidate);
    }

    // Devuelve la información detallada de un benefactor.
    public function benefactor($id)
    {
        $benefactor = UserScholarships::with('scholarshipsAsBenefactor')->findOrFail($id);
        return response()->json($benefactor);
    }

    // Permite a los candidatos ver el estado de su solicitud específica.
    public function requestStatus($id)
    {
        $request = Scholarships::with('candidate', 'benefactor')->findOrFail($id);
        return response()->json($request);
    }

    // Permite a los candidatos y benefactores ver las notificaciones.
    public function notifications($id)
    {
        // Aquí puedes obtener las notificaciones según tu lógica
        // Por simplicidad, vamos a retornar un mensaje ficticio
        return response()->json(['message' => 'Notifications for ID: ' . $id]);
    }

    // Permite iniciar o ver la comunicación entre un candidato y un benefactor.
    public function communication($scholarshipId)
    {
        // Aquí puedes obtener la comunicación según tu lógica
        // Por simplicidad, vamos a retornar un mensaje ficticio
        return response()->json(['message' => 'Communication for Scholarship ID: ' . $scholarshipId]);
    }

    // Devuelve un listado de mensajes y seguimientos.
    public function communicationHistory($id)
    {
        // Aquí puedes obtener el historial de comunicación según tu lógica
        // Por simplicidad, vamos a retornar un mensaje ficticio
        return response()->json(['message' => 'Communication history for ID: ' . $id]);
    }
}
