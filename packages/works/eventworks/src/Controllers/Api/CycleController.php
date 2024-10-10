<?php

namespace Works\Eventworks\Controllers\Api;


use Works\Eventworks\Models\Cycle;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;



class CycleController extends Controller
{
    // Listado de todos los ciclos
    public function index()
    {
        return Cycle::all();
    }

    // Datos de un ciclo específico por nombre
    public function show($cycleName)
    {
        $cycle = Cycle::where('slug', $cycleName)->firstOrFail();
        return response()->json($cycle);
    }
}
