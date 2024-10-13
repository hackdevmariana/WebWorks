<?php
namespace Works\Eventworks\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Works\Eventworks\Models\Event;
use Works\Eventworks\Models\EventCategory;
use Works\Eventworks\Models\City;
use Works\Eventworks\Models\Location;

class EventController extends Controller
{
    // Lista todos los ciclos de eventos
    public function getCycles()
    {
        return response()->json(Event::all());
    }

    // Devuelve información completa de un evento por su slug
    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return response()->json($event);
    }

    // Devuelve la descripción de un evento
    public function getDescription($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return response()->json(['description' => $event->description]);
    }

    // Devuelve la fecha (día) de un evento
    public function getDate($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return response()->json(['days' => $event->days]);
    }

    // Devuelve el precio de un evento
    public function getPrice($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return response()->json(['price' => $event->price]);
    }

    // Devuelve los enlaces de un evento
    public function getUrls($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return response()->json(['links' => $event->links]);
    }

    // Devuelve las etiquetas (tags) de un evento
    public function getTags($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return response()->json(['tags' => $event->tags]);
    }

    public function getByLocation($country, $city)
    {
        // Buscar la ciudad por su nombre o slug
        $city = City::where('slug', $city)->orWhere('name', $city)->first();

        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }

        // Buscar las localizaciones que coinciden con la ciudad
        $locations = Location::where('city_id', $city->id)->get()->pluck('id');

        // Obtener los eventos que tienen alguna de estas localizaciones
        $events = Event::whereHas('locations', function ($query) use ($locations) {
            $query->whereIn('location_id', $locations);
        })->get();

        return response()->json($events);
    }


    // Lista eventos por país
    public function getByCountry($countrySlug)
    {
        // Obtener el ID del país a través del slug
        $countryId = \DB::table('countries')->where('slug', $countrySlug)->value('id');

        if (!$countryId) {
            return response()->json(['message' => 'Country not found'], 404);
        }

        // Obtener eventos relacionados con las ubicaciones que están en las ciudades de ese país
        $events = Event::whereHas('locations.city', function ($query) use ($countryId) {
            $query->where('country_id', $countryId);
        })->get();

        return response()->json($events);
    }




    // Lista eventos por organizador
    public function getByOrganizer($organizer)
    {
        $events = Event::where('organizer_id', $organizer)->orderBy('days')->get();
        return response()->json($events);
    }

    public function getByYear($year)
    {
        // Buscar actividades por año y obtener los eventos relacionados
        $events = Event::whereHas('activities', function ($query) use ($year) {
            $query->whereYear('date', $year);
        })->orderBy('days')->get();

        return response()->json($events);
    }


    public function getByMonth($year, $month)
    {
        // Buscar actividades por año y mes, y obtener los eventos relacionados
        $events = Event::whereHas('activities', function ($query) use ($year, $month) {
            $query->whereYear('date', $year)->whereMonth('date', $month);
        })->orderBy('days')->get();

        return response()->json($events);
    }


    public function getByDay($year, $month, $day)
    {
        // Buscar actividades por año, mes y día, y obtener los eventos relacionados
        $events = Event::whereHas('activities', function ($query) use ($year, $month, $day) {
            $query->whereYear('date', $year)->whereMonth('date', $month)->whereDay('date', $day);
        })->orderBy('days')->get();

        return response()->json($events);
    }


    public function getByTags($tag1, $tag2 = null)
    {
        // Obtener los IDs de las etiquetas (tags) proporcionadas
        $tagIds = [$tag1];
        if ($tag2) {
            $tagIds[] = $tag2;
        }

        // Buscar los eventos que tengan al menos una de esas etiquetas
        $events = Event::whereHas('tags', function ($query) use ($tagIds) {
            $query->whereIn('event_tags.slug', $tagIds);
        })->get();

        return response()->json($events);
    }


    public function getByType($type = null)
    {
        if ($type === null) {
            // Devuelve todos los tipos de eventos sin repetidos
            $types = Event::select('type')->distinct()->get();
            return response()->json($types);
        } else {
            // Si se pasa un parámetro $type, filtramos por ese tipo
            $events = Event::where('type', $type)->orderBy('days')->get();
            return response()->json($events);
        }
    }
    



    // Mostrar eventos por categoría
    public function getByCategory($category = null)
{
    if ($category === null) {
        // Devuelve todas las categorías si no se pasa una categoría específica
        $categories = EventCategory::select('name', 'slug')->distinct()->get();
        return response()->json($categories);
    } else {
        // Busca eventos por categoría si se pasa un nombre de categoría
        $events = EventCategory::where('name', $category)->firstOrFail()->events()->orderBy('days')->get();
        return response()->json($events);
    }
}


    // Filtrar eventos por etiquetas
    public function filterByTags(...$tags)
    {
        $events = Event::whereJsonContains('tags', $tags)->orderBy('days')->get();
        return response()->json($events);
    }

    // Listar eventos por ubicación específica
    public function filterByLocation($country, $city)
    {
        $events = Event::whereHas('locations', function ($query) use ($country, $city) {
            $query->where('country', $country)->where('city', $city);
        })->orderBy('days')->get();

        return response()->json($events);
    }

    // Filtrar eventos por fecha
    public function filterByDate($year, $month)
    {
        $events = Event::whereYear('days', $year)->whereMonth('days', $month)->orderBy('days')->get();
        return response()->json($events);
    }

    // Filtrar eventos por rango de fechas
    public function filterByRange($start_date, $end_date)
    {
        $events = Event::whereBetween('days', [$start_date, $end_date])->orderBy('days')->get();
        return response()->json($events);
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

        return response()->json($query->orderBy('days')->get());
    }
}
