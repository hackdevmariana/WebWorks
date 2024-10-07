<?php

namespace Works\Webworks\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Works\Webworks\Models\Content;
use Works\Webworks\Models\Website;

class CarouselController extends Controller
{
    public function index($websiteName, Request $request)
    {
        $website = Website::where('web', $websiteName)->firstOrFail();

        // Consulta el contenido del tipo 'carousel'
        $carousels = Content::where('website_id', $website->id)
            ->where('content_type', 'carousel')
            ->get(); // Cambiamos paginate por get para obtener todos los carouseles

        // Mapea los resultados para obtener solo los campos deseados
        $formattedCarousels = $carousels->map(function ($carousel) {
            return [
                'name' => $carousel->name,
                'title' => $carousel->title,
                'slug' => $carousel->slug,
            ];
        });

        return response()->json($formattedCarousels);
    }

    public function show($websiteName, $carouselIdentifier)
{
    // Busca el sitio web por su nombre
    $website = Website::where('web', $websiteName)->firstOrFail();

    // Busca el carousel específico por su slug o name
    $carousel = $website->carousels()->where('name', $carouselIdentifier)->first();

    if (!$carousel) {
        return response()->json(['message' => 'Carousel not found'], 404);
    }

    // Obtener el contenido relacionado con este carousel
    $carouselContents = $carousel->contents() // Aquí cambias carouselContents a contents
        ->with('author') // Si necesitas incluir datos del autor, también puedes cargar la relación
        ->get();

    // Formatear el contenido para que solo incluya los campos deseados
    $formattedContents = $carouselContents->map(function ($content) {
        return [
            'name' => $content->name,
            'title' => $content->title,
            'slug' => $content->slug,
            'image' => $content->image,
            'url' => $content->url,
            // Otros campos que necesites...
        ];
    });

    return response()->json([
        'carousel' => [
            'name' => $carousel->name,
            'id' => $carousel->id,
            // Otros campos del carrusel si es necesario
        ],
        'contents' => $formattedContents,
    ]);
}


}
