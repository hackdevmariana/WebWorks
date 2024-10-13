<?php

namespace Works\Eventworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Eventworks\Models\Event;
use Works\Eventworks\Models\Activity;
use Works\Eventworks\Models\Attendance;
use Works\Eventworks\Models\City;
use Works\Eventworks\Models\Country;
use Works\Eventworks\Models\Location;
use Works\Eventworks\Models\Organizer;
use Works\Eventworks\Models\Speaker;
use Works\Eventworks\Models\EventCategory;
use Works\Eventworks\Models\EventTag;
use Works\Eventworks\Models\EventLink;
use Carbon\Carbon;
use Illuminate\Support\Str;

class GlobalSeeder extends Seeder
{
    public function run()
    {
        $country = Country::firstOrCreate(
            ['slug' => Str::slug('España')],
            ['name' => 'España']
        );

        // Crear ciudad
        $city = City::firstOrCreate(
            ['slug' => Str::slug('Zaragoza')],
            [
                'name' => 'Zaragoza',
                'country_id' => $country->id,
            ]
        );

        $locationName = 'Hotel Reino de Aragón';
        $slug = Str::slug($locationName);

        // Verificar si ya existe un registro con el mismo slug
        $location = Location::where('slug', $slug)->first();

        if (!$location) {
            // Si no existe, crear la ubicación y asignarla a la variable $location
            $location = Location::create([
                'name' => $locationName,
                'address' => 'Calle Coso, 80, 50001 Zaragoza',
                'city_id' => $city->id, // Usa el id de la ciudad creada
                'country_id' => $country->id, // Usa el id del país creado
                'zip' => '50001',
                'phone' => '976 46 82 00',
                'slug' => $slug,
            ]);
        } else {
            echo "La ubicación con el slug '{$slug}' ya existe. No se ha insertado.\n";
        }

        $slug = Str::slug('Pizza Day 2025: Software Libre y Bitcoin');

        $event = Event::firstOrCreate([
            'slug' => $slug,
        ], [
            'title' => 'Pizza Day 2025: Software Libre y Bitcoin',
            'description' => 'Un evento para celebrar el software libre y Bitcoin con charlas y actividades.',
            'days' => 2,
            'type' => 'presencial', // o el valor que desees
        ]);

        // Asociar el evento con la ubicación
        $event->locations()->attach($location->id);

        $categoryName = 'Tecnología';
        $categorySlug = Str::slug($categoryName);

        // Verificar si la categoría ya existe
        $category = EventCategory::firstOrCreate(
            ['slug' => $categorySlug], // Verifica si existe por el slug
            ['name' => $categoryName, 'slug' => $categorySlug] // Asigna el nombre y el slug
        );

        $name = 'Bitcoin';
        $slug = Str::slug($name);

        // Verificar si la etiqueta ya existe
        $tag = EventTag::firstOrCreate(
            ['slug' => $slug], // Aquí verificas si existe por el slug
            ['name' => $name, 'slug' => $slug] // Aquí asignas el nombre y el slug
        );

        $event->categories()->attach($category->id);
        $event->tags()->attach($tag->id);

        // Crear actividades
        $activities = [
            [
                'title' => 'Inauguración y Bienvenida',
                'description' => 'Ceremonia de apertura del evento.',
                'date' => Carbon::create(2025, 5, 23, 10, 0),
            ],
            [
                'title' => 'Charlas sobre Software Libre',
                'description' => 'Presentaciones sobre el impacto del software libre en la sociedad.',
                'date' => Carbon::create(2025, 5, 23, 11, 0),
            ],
            [
                'title' => 'Taller: Introducción a Bitcoin',
                'description' => 'Aprende sobre Bitcoin y cómo utilizarlo.',
                'date' => Carbon::create(2025, 5, 23, 14, 0),
            ],
            [
                'title' => 'Panel de Discusión: El Futuro del Software Libre',
                'description' => 'Un debate sobre el futuro del software libre y su importancia.',
                'date' => Carbon::create(2025, 5, 23, 16, 0),
            ],
            [
                'title' => 'Noche de Pizza y Networking',
                'description' => 'Conéctate con otros participantes mientras disfrutas de pizza.',
                'date' => Carbon::create(2025, 5, 23, 19, 0),
            ],
            [
                'title' => 'Charlas sobre Bitcoin y Criptomonedas',
                'description' => 'Explora el mundo de las criptomonedas.',
                'date' => Carbon::create(2025, 5, 24, 10, 0),
            ],
            [
                'title' => 'Taller: Desarrollo de Software Libre',
                'description' => 'Un taller práctico sobre cómo contribuir al software libre.',
                'date' => Carbon::create(2025, 5, 24, 14, 0),
            ],
            [
                'title' => 'Cierre del Día y Pizza',
                'description' => 'Cierre del segundo día con pizza y reflexiones.',
                'date' => Carbon::create(2025, 5, 24, 18, 0),
            ],
            [
                'title' => 'Mesa Redonda: Retos del Software Libre',
                'description' => 'Discusión sobre los desafíos que enfrenta el software libre.',
                'date' => Carbon::create(2025, 5, 25, 10, 0),
            ],
            [
                'title' => 'Cierre y Agradecimientos',
                'description' => 'Ceremonia de clausura del evento con agradecimientos.',
                'date' => Carbon::create(2025, 5, 25, 13, 0),
            ],
        ];

        foreach ($activities as $activityData) {
            // Generar el slug basado en el título
            $activitySlug = Str::slug($activityData['title']);

            // Intentar encontrar la actividad existente o crear una nueva
            $activity = Activity::firstOrCreate(
                ['slug' => $activitySlug],
                array_merge($activityData, [
                    'event_id' => $event->id,
                    'program_id' => 1,
                ])
            );

            // Si la actividad se ha creado, crear ponentes y asociarlos
            if (!$activity->wasRecentlyCreated) {
                echo "La actividad '{$activity->title}' ya existe. No se ha insertado.\n";
            } else {
                // Crear ponentes y asociar a la actividad
                $speakerName = 'Ponente ' . $activity->title;
                $speakerSurname = 'Apellido ' . $activity->title;

                // Generar el slug basado en el nombre y apellido
                $speakerSlug = Str::slug($speakerName . ' ' . $speakerSurname);

                $speaker = Speaker::firstOrCreate([
                    'slug' => $speakerSlug,
                ], [
                    'name' => $speakerName,
                    'surname' => $speakerSurname,
                    'biography' => 'Biografía de ' . $activity->title,
                ]);

                // Asegúrate de que la relación se está creando correctamente
                $activity->speakers()->attach($speaker->id);
            }
        }

        // Crear asistencias
        foreach (range(1, 50) as $i) {
            Attendance::create([
                'event_id' => $event->id,
                'participant_id' => $i,
                'status' => 'registered',
                'registration_date' => Carbon::now(),
            ]);
        }

        // Crear enlaces del evento
        foreach (['Página del evento', 'Registro', 'Información adicional'] as $linkName) {
            EventLink::create([
                'name' => $linkName,
                'url' => 'https://example.com/' . strtolower(str_replace(' ', '-', $linkName)),
                'event_id' => $event->id,
            ]);
        }
    }
}
