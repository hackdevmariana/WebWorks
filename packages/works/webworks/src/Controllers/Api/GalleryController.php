<?php
namespace Works\Webworks\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Works\Webworks\Models\Content;
use Works\Webworks\Models\Website;
use Works\Webworks\Models\Gallery;

class GalleryController extends Controller
{
    public function index($websiteName, Request $request)
    {
        $website = Website::where('web', $websiteName)->firstOrFail();

        // Obtener todas las galerías asociadas al sitio web
        $galleries = Content::where('website_id', $website->id)
            ->where('content_type', 'gallery')
            ->get();

        return response()->json($galleries);
    }

    public function show($websiteName, $galleryIdentifier)
    {
        $website = Website::where('web', $websiteName)->firstOrFail();

        // Buscar la galería por nombre o slug
        $gallery = Gallery::where('name', $galleryIdentifier)
            ->where('website_id', $website->id)
            ->with([
                'contents' => function ($query) {
                    $query->select(
                        'contents.name',
                        'contents.title',
                        'contents.slug',
                        'contents.subtitle',
                        'contents.text',
                        'contents.image',
                        'contents.url',
                        'contents.alt'
                    )->where('draft', 0);
                }
            ])->first();

        if (!$gallery) {
            return response()->json(['error' => 'Gallery not found'], 404);
        }

        // Ocultar los campos 'pivot' de la relación
        $contents = $gallery->contents->makeHidden(['pivot']);

        return response()->json($contents);
    }
}
