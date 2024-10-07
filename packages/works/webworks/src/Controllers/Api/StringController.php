<?php

namespace Works\Webworks\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Works\Webworks\Models\Content;
use Works\Webworks\Models\Website;

class StringController extends Controller
{
    public function index($websiteName, Request $request)
    {
        $website = Website::where('web', $websiteName)->firstOrFail();

        // Obtener todos los contenidos de tipo 'string' sin paginación
        $strings = Content::where('website_id', $website->id)
                          ->where('content_type', 'string')
                          ->get(); // Usar get() en lugar de paginate()

        return response()->json($strings);
    }

    public function show($websiteName, $stringIdentifier)
    {
        $website = Website::where('web', $websiteName)->firstOrFail();

        // Buscar por nombre o slug
        $stringItem = Content::where('website_id', $website->id)
                             ->where(function($query) use ($stringIdentifier) {
                                 $query->where('name', $stringIdentifier)
                                       ->orWhere('slug', $stringIdentifier);
                             })
                             ->where('content_type', 'string')
                             ->firstOrFail();

        // Devolver solo el campo "text"
        return response()->json(['text' => $stringItem->text]);
    }
}
