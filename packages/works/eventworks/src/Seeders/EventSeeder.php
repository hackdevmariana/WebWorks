<?php

namespace Works\Eventworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Eventworks\Models\Event;
use Works\Eventworks\Models\Cycle;

class EventSeeder extends Seeder
{
    public function run()
    {
        $cycle = Cycle::where('slug', 'spring-educational-conference')->first();

        $events = [
            [
                'title' => 'Feria del Libro',
                'slug' => 'book-fair',
                'description' => 'Un evento para los amantes de la literatura.',
                'days' => 3,
                'time' => '10:00',
                'price' => 0,
                'organizer_id' => 1,
                'tags' => json_encode(['libros', 'educación']),
                'status' => 'active',
                'type' => 'presencial',
                'virtual' => false,
            ],
            [
                'title' => 'Universidad de Verano',
                'slug' => 'summer-university',
                'description' => 'Cursos de verano en diversas áreas académicas.',
                'days' => 7,
                'time' => '09:00',
                'price' => 100.00,
                'organizer_id' => 2,
                'tags' => json_encode(['educación', 'verano']),
                'status' => 'active',
                'type' => 'híbrido',
                'virtual' => true,
            ],
            [
                'title' => 'Conferencias de Primavera',
                'slug' => 'spring-conference',
                'description' => 'Serie de conferencias académicas.',
                'days' => 5,
                'time' => '11:00',
                'price' => 50.00,
                'cycle_id' => $cycle->id,
                'organizer_id' => 3,
                'tags' => json_encode(['conferencias', 'educación']),
                'status' => 'active',
                'type' => 'virtual',
                'virtual' => true,
            ]
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
