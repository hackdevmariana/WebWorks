<?php

namespace Works\Web\Controllers\Api;


use Illuminate\Http\Request;
use Works\Web\Models\Web;
use App\Http\Controllers\Controller;
class CssController extends Controller
{
    public function customValues($webSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();

        // Obtenemos las variables de las relaciones
        $cssVariables = $web->cssVariables()->get(['key', 'value']);
        $cssFonts = $web->cssFonts()->get(['variable_name', 'import_url']);
        $cssGenerals = $web->cssGenerals()->get(['key', 'value']);

        return response()
            ->view('css.variables', compact('cssVariables', 'cssFonts', 'cssGenerals'))
            ->header('Content-Type', 'text/css');
    }

}