<?php

namespace Works\Webworks\Controllers\Api;

use Illuminate\Http\Request;
use Works\Webworks\Models\Website;
use Works\Webworks\Models\Developed;
use App\Http\Controllers\Controller;

class DevelopedController extends Controller
{
    public function index($websiteName)
    {
        // Busca el sitio web utilizando el nombre
        $website = Website::where('web', $websiteName)->firstOrFail();

        // Obtiene los desarrollos asociados al sitio web
        $developments = Developed::where('website_id', $website->id)->get();

        // Retorna los datos de desarrollo en formato JSON
        return response()->json($developments);
    }

    public function show($websiteName, $developedName)
    {
        // Busca el sitio web utilizando el nombre
        $website = Website::where('web', $websiteName)->firstOrFail();

        // Busca el desarrollo por nombre y sitio web
        $development = Developed::where('website_id', $website->id)
                        ->where('name', $developedName)
                        ->firstOrFail();

        // Retorna los datos del desarrollo específico
        return response()->json($development);
    }
}
