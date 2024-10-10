<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Works\Eventworks\Models\Event;
use Works\Eventworks\Models\Cycle;
use Works\Eventworks\Models\Location;
use Carbon\Carbon;

class EventController extends Controller
{
    // Lista todos los ciclos de eventos
    public function getCycles()
    {
        return Cycle::all();
    }

    // Devuelve información completa de un evento por su slug
    public function show($slug)
    {
        return Event::where('slug', $slug)->firstOrFail();
    }

    // Devuelve la descripción de un evento
    public function getDescription($slug)
    {
        return Event::where('slug', $slug)->firstOrFail()->description;
    }

    // Devuelve la fecha (día) de un evento
    public function getDate($slug)
    {
        return Event::where('slug', $slug)->firstOrFail()->days;
    }

    // Devuelve el precio de un evento
    public function getPrice($slug)
    {
        return Event::where('slug', $slug)->firstOrFail()->price;
    }

    // Devuelve los enlaces de un evento
    public function getUrls($slug)
    {
        return Event::where('slug', $slug)->firstOrFail()->links;
    }

    // Devuelve las etiquetas (tags) de un evento
    public function getTags($slug)
    {
        return Event::where('slug', $slug)->firstOrFail()->tags;
    }

    // Lista eventos por ciudad y país
    public function getByLocation($country, $city)
    {
        return Event::whereHas('locations', function ($query) use ($country, $city) {
            $query->where('country', $country)->where('city', $city);
        })->orderBy('days')->get();
    }

    // Lista eventos por organizador
    public function getByOrganizer($organizer)
    {
        return Event::where('organizer_id', $organizer)->orderBy('days')->get();
    }

    // Lista eventos por año
    public function getByYear($year)
    {
        return Event::whereYear('days', $year)->orderBy('days')->get();
    }

    // Lista eventos por mes y año
    public function getByMonth($year, $month)
    {
        return Event::whereYear('days', $year)->whereMonth('days', $month)->orderBy('days')->get();
    }

    // Lista eventos por día, mes y año
    public function getByDay($year, $month, $day)
    {
        return Event::whereYear('days', $year)->whereMonth('days', $month)->whereDay('days', $day)->orderBy('days')->get();
    }

    // Lista eventos por etiquetas
    public function getByTags(...$tags)
    {
        return Event::whereJsonContains('tags', $tags)->orderBy('days')->get();
    }

    // Descargar evento en formato Google Calendar
    public function downloadGoogleCalendar($slug)
    {
        // Aquí puedes generar un archivo ICS o Google Calendar
        $event = Event::where('slug', $slug)->firstOrFail();
        // Usar Spatie iCalendar o similar para crear el archivo
        // $ical = $event->toICalendar();
        // return response($ical)->header('Content-Type', 'text/calendar');
    }

    // Descargar evento en formato Apple Calendar
    public function downloadAppleCalendar($slug)
    {
        // Similar a Google Calendar, generar archivo ICS compatible con Apple
    }

    // Mostrar eventos por tipo
    public function getByType($type)
    {
        return Event::where('type', $type)->orderBy('days')->get();
    }

    // Mostrar eventos por categoría
    public function getByCategory($category)
    {
        return Event::where('category', $category)->orderBy('days')->get();
    }

    // Filtrar eventos por etiquetas
    public function filterByTags(...$tags)
    {
        return Event::whereJsonContains('tags', $tags)->orderBy('days')->get();
    }

    // Listar eventos por ubicación específica
    public function filterByLocation($country, $city)
    {
        return Event::whereHas('locations', function ($query) use ($country, $city) {
            $query->where('country', $country)->where('city', $city);
        })->orderBy('days')->get();
    }

    // Filtrar eventos por fecha
    public function filterByDate($year, $month)
    {
        return Event::whereYear('days', $year)->whereMonth('days', $month)->orderBy('days')->get();
    }

    // Filtrar eventos por rango de fechas
    public function filterByRange($start_date, $end_date)
    {
        return Event::whereBetween('days', [$start_date, $end_date])->orderBy('days')->get();
    }

    // Endpoint de búsqueda general
    public function search(Request $request)
    {
        $query = Event::query();

        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->has('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->has('tags')) {
            $tags = explode(',', $request->input('tags'));
            $query->whereJsonContains('tags', $tags);
        }

        if ($request->has('location')) {
            $location = explode(',', $request->input('location'));
            $query->whereHas('locations', function ($q) use ($location) {
                $q->where('country', $location[0])->where('city', $location[1]);
            });
        }

        if ($request->has('date')) {
            $query->whereDate('days', $request->input('date'));
        }

        return $query->orderBy('days')->get();
    }
}
