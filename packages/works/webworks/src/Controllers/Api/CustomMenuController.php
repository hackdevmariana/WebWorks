<?php
namespace Works\Webworks\Controllers\Api;


use Works\Webworks\Models\CustomMenu;
use Works\Webworks\Models\Website; // Asegúrate de importar el modelo Website
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomMenuController extends Controller
{
    // Obtener todos los menús de una página web
    public function index($web)
    {
        // Obtener el sitio web por el campo 'web'
        $website = Website::where('web', $web)->firstOrFail();

        // Obtener todos los menús asociados a la website
        $menus = CustomMenu::where('website_id', $website->id)
            ->with('links') // Carga los enlaces relacionados
            ->get();

        return response()->json($menus);
    }

    // Obtener un menú específico por ID
    public function show($web, $menu_id)
    {
        // Obtener el sitio web por el campo 'web'
        $website = Website::where('web', $web)->firstOrFail();

        // Obtener el menú específico junto con sus enlaces
        $menu = CustomMenu::where('website_id', $website->id)
            ->with('links') // Carga los enlaces relacionados
            ->findOrFail($menu_id);

        return response()->json($menu);
    }
}
