<?php

namespace Works\Eventworks\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Works\Eventworks\Models\Participant;
use Works\Eventworks\Models\Country;
use Works\Eventworks\Models\EventTag; // Asegúrate de incluir este modelo
use Works\Eventworks\Models\EventCategory; // Asegúrate de incluir este modelo
use Illuminate\Support\Arr; // Para utilizar Arr::random()

class ParticipantSeeder extends Seeder
{
    public function run()
    {
        // Configurar Faker para español
        $faker = Faker::create('es_ES'); // Crear un generador de Faker en español
        $countryId = Country::where('name', 'España')->first()->id; // Para asignar a España

        for ($i = 0; $i < 50; $i++) {
            // Obtener tres intereses aleatorios de las tablas Tag y Category
            $tags = EventTag::pluck('name')->toArray(); // Obtener todos los nombres de las etiquetas
            $categories = EventCategory::pluck('name')->toArray(); // Obtener todos los nombres de las categorías

            // Combinar ambas listas
            $allInterests = array_merge($tags, $categories);

            // Seleccionar tres intereses aleatorios
            $randomInterests = Arr::random($allInterests, 3);

            Participant::create([
                'name' => $faker->firstName, // Nombre en español
                'surname' => $faker->lastName, // Apellido en español
                'username' => $faker->unique()->userName,
                'email' => $faker->unique()->safeEmail,
                'interests' => implode(', ', $randomInterests), // Intereses aleatorios
                'country_id' => $countryId,
            ]);
        }
    }
}
