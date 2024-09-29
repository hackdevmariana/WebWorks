<?php

namespace Works\Webworks\Controllers\Api;

use App\Http\Controllers\Controller;
use Works\Webworks\Models\Website;
use Works\Webworks\Models\ErrorPage;
use Illuminate\Http\Request;

class ErrorPageController extends Controller
{

    public function index($name)
    {
        // Buscar el website por su nombre
        $website = Website::where('web', $name)->firstOrFail();

        // Buscar todas las páginas de error asociadas a este sitio web
        $errorPages = ErrorPage::where('website_id', $website->id)->get();

        // Devolver las páginas de error
        if ($errorPages->isEmpty()) {
            return response()->json([
                'message' => 'No error pages found for this website.'
            ], 404);
        }

        return response()->json($errorPages);
    }

    /**
     * Obtener una página de error personalizada por número de error y nombre del sitio web.
     */
    public function show($name, $error_number)
    {
        // Buscar el website por su nombre
        $website = Website::where('web', $name)->firstOrFail();

        // Buscar la página de error correspondiente al número de error
        $errorPage = ErrorPage::where('website_id', $website->id)
            ->where('error_number', $error_number)
            ->first();

        // Si no se encuentra la página personalizada, devolver una respuesta predeterminada
        if (!$errorPage) {
            return response()->json([
                'error' => "Error page not found for error code {$error_number}."
            ], 404);
        }

        // Devolver la página de error encontrada
        return response()->json([
            'title' => $errorPage->title,
            'subtitle' => $errorPage->subtitle,
            'text' => $errorPage->text,
            'image' => $errorPage->image
        ]);
    }
}
