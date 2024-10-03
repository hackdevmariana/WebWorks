<?php

namespace Works\Webworks\Controllers\Api;


use Works\Webworks\Models\Website; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    // Obtener los datos de la página web
    public function getHome($web)
    {
        // Buscar el sitio web por el campo 'web'
        $website = Website::where('web', $web)->firstOrFail();

        // Devolver los datos del sitio web
        return response()->json([
            'id' => $website->id,
            'web' => $website->web,
            'home' => $website->home,
            'title' => $website->title,
            'description' => $website->description,
            'keywords' => $website->keywords,
            'favicon' => $website->favicon,
            'created_at' => $website->created_at,
            'updated_at' => $website->updated_at,
        ]);
    }
}
