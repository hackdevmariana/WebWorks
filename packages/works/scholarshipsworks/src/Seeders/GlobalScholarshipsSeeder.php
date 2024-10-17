<?php

namespace Works\Scholarshipsworks\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Works\Scholarshipsworks\Models\Scholarships;
use Works\Scholarshipsworks\Models\ScholarshipsFollowUp;
use Works\Scholarshipsworks\Models\TypeScholarship;
use Works\Scholarshipsworks\Models\UserScholarships;

class GlobalScholarshipsSeeder extends Seeder
{
    public function run()
    {
        // Crear usuarios ficticios
        $user1 = UserScholarships::firstOrCreate([
            'name' => 'Juan',
            'surname' => 'Pérez',
            'username' => 'juanperez',
            'email' => 'juan.perez@example.com',
            'phone' => '123456789',
            'social_networks' => json_encode(['twitter' => '@juanperez']),
            'motivations' => 'Motivación para la beca',
            'what_it_offers' => 'Ofrecimientos del candidato',
            'what_it_asks_for' => 'Requerimientos del candidato',
        ]);

        $user2 = UserScholarships::firstOrCreate([
            'name' => 'María',
            'surname' => 'García',
            'username' => 'mariagarcia',
            'email' => 'maria.garcia@example.com',
            'phone' => '987654321',
            'social_networks' => json_encode(['linkedin' => 'mariagarcia']),
            'motivations' => 'Motivación para la beca',
            'what_it_offers' => 'Ofrecimientos del benefactor',
            'what_it_asks_for' => 'Requerimientos del benefactor',
        ]);

        // Crear tipos de becas ficticias
        $typeScholarship = TypeScholarship::firstOrCreate([
            'event' => 'Evento de Beca 2024',
            'name' => 'registration',
            'price' => 5000,
            'place_of_origin' => 'Madrid, España',
            'books_to_buy' => json_encode(['Libro 1', 'Libro 2']),
            'id_user_candidate' => $user1->id,
            'id_user_benefactor' => $user2->id,
        ]);

        // Crear becas ficticias
        $scholarship = Scholarships::firstOrCreate([
            'event' => 'Evento de Beca 2024',
            'status' => 'pending',
            'candidate' => $user1->id,
            'benefactor' => $user2->id,
            'type_scholarship' => $typeScholarship->id,
        ]);

        // Crear seguimientos ficticios
        ScholarshipsFollowUp::firstOrCreate([
            'title' => 'Seguimiento 1',
            'abstract' => 'Resumen del seguimiento 1',
            'text' => 'Texto completo del seguimiento 1',
            'link' => 'http://example.com/seguimiento1',
            'comments' => 'Comentarios del seguimiento 1',
            'status' => 'initial_notes',
        ]);
    }
}