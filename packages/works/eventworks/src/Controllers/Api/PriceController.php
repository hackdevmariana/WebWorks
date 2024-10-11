<?php

namespace Works\Eventworks\Controllers\Api;

use App\Http\Controllers\Controller;
use Works\Eventworks\Models\Event;
use Works\Eventworks\Models\Price;

class PriceController extends Controller
{
    // Obtener precios de un evento
    public function getPricesByEvent($eventSlug)
    {
        $event = Event::where('slug', $eventSlug)->firstOrFail();
        $prices = $event->prices()->get();
        
        return response()->json($prices);
    }

    // Obtener precios de un evento si se compran hoy
    public function getTodayPricesByEvent($eventSlug)
    {
        $event = Event::where('slug', $eventSlug)->firstOrFail();
        $today = now();
        $prices = $event->prices()
            ->where('start', '<=', $today)
            ->where('end', '>=', $today)
            ->get();

        return response()->json($prices);
    }
}
