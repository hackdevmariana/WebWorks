<?php
namespace Works\Webworks\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Works\Webworks\Models\Content;
use Works\Webworks\Models\Website;

class HeroController extends Controller
{
    public function index($websiteName)
    {
        // Obtener el sitio web por nombre
        $website = Website::where('web', $websiteName)->firstOrFail();

        // Obtener los héroes asociados al sitio web
        $heros = Content::where('website_id', $website->id) // Usar el id del sitio web
                        ->where('content_type', 'hero')
                        ->get();

        return response()->json($heros);
    }

    public function show($websiteName, $heroItemName)
    {
        // Obtener el sitio web por nombre
        $website = Website::where('web', $websiteName)->firstOrFail();

        // Buscar el héroe por nombre
        $heroItem = Content::where('website_id', $website->id) // Usar el id del sitio web
                           ->where('name', $heroItemName)
                           ->where('content_type', 'hero')
                           ->firstOrFail();

        return response()->json($heroItem);
    }
}
