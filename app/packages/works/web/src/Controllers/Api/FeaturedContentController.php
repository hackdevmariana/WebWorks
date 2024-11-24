<?php

namespace Works\Web\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Works\Web\Models\FeaturedContent;
use Works\Web\Models\Web;

class FeaturedContentController
{
    /**
     * List all featured contents for a given web.
     */
    public function index($webSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        $now = Carbon::now();

        $featuredContents = FeaturedContent::with(['content', 'publicationPeriod', 'publicationPattern'])
            ->whereHas('content', fn($query) => $query->where('web_id', $web->id))
            ->get()
            ->filter(function ($featuredContent) use ($now) {
                $period = $featuredContent->publicationPeriod;

                // Verificar si el contenido está dentro del período de publicación
                $isWithinPeriod = (!$period->start_date || $now->greaterThanOrEqualTo($period->start_date))
                    && (!$period->end_date || $now->lessThanOrEqualTo($period->end_date));

                // Verificar si el contenido cumple con el patrón de publicación
                $pattern = $featuredContent->publicationPattern->pattern ?? null;
                $isWithinPattern = $this->checkPattern($pattern, $now);

                return $isWithinPeriod && $isWithinPattern;
            });

        return response()->json($featuredContents->isEmpty() ? null : $featuredContents);
    }

    /**
     * Show a specific featured content by web and content slug.
     */
    public function show($webSlug, $contentSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();

        $featuredContent = FeaturedContent::with(['content', 'publicationPeriod', 'publicationPattern'])
            ->whereHas('content', function ($query) use ($web, $contentSlug) {
                $query->where('web_id', $web->id)->where('slug', $contentSlug);
            })
            ->firstOrFail();

        return response()->json($featuredContent);
    }

    /**
     * Validate a pattern against the current date.
     */
    private function checkPattern($pattern, Carbon $now)
    {
        // Ejemplo básico de patrones. Aquí puedes expandir lógica según los requerimientos.
        if ($pattern === 'every Monday and Thursday') {
            return in_array($now->dayOfWeek, [Carbon::MONDAY, Carbon::THURSDAY]);
        }

        return true; // Default para patrones desconocidos.
    }
}
