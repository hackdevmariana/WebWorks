<?php

namespace Works\Eventworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Eventworks\Models\Speaker;
use Works\Eventworks\Models\Event;

class SpeakerSeeder extends Seeder
{
    public function run()
    {
        // Obtener el evento "book-fair"
        $event = Event::where('slug', 'book-fair')->firstOrFail();

        // Crear conferenciantes
        $speakers = [
            [
                'name' => 'Juan',
                'surname' => 'Pérez',
                'slug' => 'juan-perez',
                'biography' => 'Dr. Juan Pérez es un experto en literatura del Siglo de Oro.',
                'books' => 'Cervantes: Una vida, La poesía de Quevedo'
            ],
            [
                'name' => 'Ana',
                'surname' => 'García',
                'slug' => 'ana-garcia',
                'biography' => 'Prof. Ana García ha publicado extensamente sobre el teatro de Lope de Vega.',
                'books' => 'Teatro y vida en el Siglo de Oro'
            ],
            [
                'name' => 'María',
                'surname' => 'López',
                'slug' => 'maria-lopez',
                'biography' => 'Dra. María López es una reconocida experta en la obra de Quevedo.',
                'books' => 'Quevedo y el poder de la palabra'
            ]
        ];

        foreach ($speakers as $data) {
            $speaker = Speaker::create($data);
            // Asociar el speaker al evento
            $speaker->events()->attach($event->id);
        }
    }
}
