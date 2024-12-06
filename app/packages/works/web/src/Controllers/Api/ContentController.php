<?php
namespace Works\Web\Controllers\Api;

use App\Http\Controllers\Controller;
use Works\Web\Models\Web;
use Works\Web\Models\Content;

class ContentController extends Controller
{
    /**
     * Get all contents for a given web slug.
     *
     * @param string $webSlug
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($webSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();

        // Obtener contenidos con los campos específicos y los datos del autor
        $contents = $web->contents()
            ->select([
                'id', 'name', 'slug', 'title', 'subtitle', 'text', 
                'image', 'url', 'alt', 'content_type', 
                'is_default', 'draft', 'author_id'
            ])
            ->with([
                'author' => function ($query) {
                    $query->select(['id', 'name', 'surname', 'username', 'slug']);
                }
            ])
            ->get();

        // Formatear la respuesta
        $formattedContents = $contents->map(function ($content) {
            return [
                'name' => $content->name,
                'slug' => $content->slug,
                'title' => $content->title,
                'subtitle' => $content->subtitle,
                'text' => $content->text,
                'image' => $content->image,
                'url' => $content->url,
                'alt' => $content->alt,
                'content_type' => $content->content_type,
                'is_default' => $content->is_default,
                'draft' => $content->draft,
                'author' => [
                    'name' => $content->author->name ?? null,
                    'surname' => $content->author->surname ?? null,
                    'username' => $content->author->username ?? null,
                    'slug' => $content->author->slug ?? null,
                ],
            ];
        });

        return response()->json($formattedContents);
    }

    /**
     * Get a specific content for a given web slug and content slug.
     *
     * @param string $webSlug
     * @param string $contentSlug
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($webSlug, $contentSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();

        // Obtener contenido con los campos específicos y los datos del autor
        $content = $web->contents()
            ->select([
                'id', 'name', 'slug', 'title', 'subtitle', 'text', 
                'image', 'url', 'alt', 'content_type', 
                'is_default', 'draft', 'author_id'
            ])
            ->with([
                'author' => function ($query) {
                    $query->select(['id', 'name', 'surname', 'username', 'slug']);
                }
            ])
            ->where('slug', $contentSlug)
            ->firstOrFail();

        // Formatear la respuesta
        $formattedContent = [
            'name' => $content->name,
            'slug' => $content->slug,
            'title' => $content->title,
            'subtitle' => $content->subtitle,
            'text' => $content->text,
            'image' => $content->image,
            'url' => $content->url,
            'alt' => $content->alt,
            'content_type' => $content->content_type,
            'is_default' => $content->is_default,
            'draft' => $content->draft,
            'author' => [
                'name' => $content->author->name ?? null,
                'surname' => $content->author->surname ?? null,
                'username' => $content->author->username ?? null,
                'slug' => $content->author->slug ?? null,
            ],
        ];

        return response()->json($formattedContent);
    }
}
