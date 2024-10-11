<?php

namespace Works\Eventworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Eventworks\Models\Event;
use Works\Eventworks\Models\Program;
use Works\Eventworks\Models\Activity;

class ProgramSeeder extends Seeder
{
    public function run()
    {
        // Obtén el evento Book Fair
        $event = Event::where('slug', 'book-fair')->firstOrFail();

        // Día 1
        $programDay1 = Program::create([
            'time' => '09:00:00',
            'day' => 1,
            'activity' => 'Siglo de Oro Conferencias',
            'event_id' => $event->id,
        ]);

        // Actividades para el Día 1
        Activity::create([
            'title' => 'La influencia de Cervantes',
            'slug' => 'influencia-cervantes',
            'description' => 'Una conferencia sobre la influencia de Miguel de Cervantes en la literatura moderna.',
            'speaker' => 'Dr. Juan Pérez',
            'program_id' => $programDay1->id,
        ]);

        Activity::create([
            'title' => 'Teatro en el Siglo de Oro',
            'slug' => 'teatro-siglo-oro',
            'description' => 'Análisis del teatro durante el Siglo de Oro, con un enfoque en Lope de Vega.',
            'speaker' => 'Prof. Ana García',
            'program_id' => $programDay1->id,
        ]);

        // Día 2
        $programDay2 = Program::create([
            'time' => '10:00:00',
            'day' => 2,
            'activity' => 'Siglo de Oro Conferencias',
            'event_id' => $event->id,
        ]);

        // Actividades para el Día 2
        Activity::create([
            'title' => 'El impacto de Quevedo',
            'slug' => 'impacto-quevedo',
            'description' => 'Estudio de la poesía y los escritos satíricos de Quevedo.',
            'speaker' => 'Dra. María López',
            'program_id' => $programDay2->id,
        ]);

        Activity::create([
            'title' => 'El concepto de honor en el Siglo de Oro',
            'slug' => 'honor-siglo-oro',
            'description' => 'Una discusión sobre el concepto de honor en la literatura y sociedad del Siglo de Oro.',
            'speaker' => 'Dr. Pedro Gómez',
            'program_id' => $programDay2->id,
        ]);

        // Día 3
        $programDay3 = Program::create([
            'time' => '11:00:00',
            'day' => 3,
            'activity' => 'Siglo de Oro Conferencias',
            'event_id' => $event->id,
        ]);

        // Actividades para el Día 3
        Activity::create([
            'title' => 'La obra de Calderón de la Barca',
            'slug' => 'calderon-barca',
            'description' => 'Una exploración de las obras más importantes de Calderón de la Barca.',
            'speaker' => 'Prof. Luis Hernández',
            'program_id' => $programDay3->id,
        ]);
    }
}
