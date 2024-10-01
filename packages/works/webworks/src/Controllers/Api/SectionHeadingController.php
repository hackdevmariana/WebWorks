<?php

namespace Works\Webworks\Controllers\Api;



use App\Http\Controllers\Controller;
use Works\Webworks\Models\Website;
use Works\Webworks\Models\SectionHeading;
use Illuminate\Http\Request;

class SectionHeadingController extends Controller
{
    /**
     * Obtener todos los encabezados de una web.
     */
    public function index($name)
    {
        // Buscar el website por su nombre
        $website = Website::where('web', $name)->firstOrFail();

        // Obtener todos los encabezados asociados a esta web
        $headings = SectionHeading::where('website_id', $website->id)->get();

        return response()->json($headings);
    }

    /**
     * Obtener un encabezado específico de una web por nombre de encabezado.
     */
    public function show($name, $headingName)
    {
        // Buscar el website por su nombre
        $website = Website::where('web', $name)->firstOrFail();

        // Buscar el encabezado específico por nombre
        $heading = SectionHeading::where('website_id', $website->id)
            ->where('name', $headingName)
            ->firstOrFail();

        return response()->json($heading);
    }
}
