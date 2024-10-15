<?php

namespace Works\Scholarshipsworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Scholarshipsworks\Models\UserScholarships;

class UserScholarshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Carlos',
                'surname' => 'García',
                'username' => 'cgarcia',
                'email' => 'carlos.garcia@example.com',
                'phone' => '123456789',
                'social_networks' => json_encode(['twitter' => '@carlos_g', 'linkedin' => 'carlos-garcia']),
                'motivations' => 'Apasionado por la tecnología y el aprendizaje.',
                'what_it_offers' => 'Conocimientos en programación y diseño web.',
                'what_it_asks_for' => 'Beca para asistir a una conferencia de tecnología.',
            ],
            [
                'name' => 'María',
                'surname' => 'Fernández',
                'username' => 'mfernandez',
                'email' => 'maria.fernandez@example.com',
                'phone' => '987654321',
                'social_networks' => json_encode(['instagram' => '@maria_f', 'linkedin' => 'maria-fernandez']),
                'motivations' => 'Interesada en el desarrollo sostenible.',
                'what_it_offers' => 'Experiencia en proyectos ecológicos.',
                'what_it_asks_for' => 'Beca para un curso sobre energías renovables.',
            ],
            
            [
                'name' => 'Juan',
                'surname' => 'López',
                'username' => 'jlopez',
                'email' => 'juan.lopez@example.com',
                'phone' => '654321987',
                'social_networks' => json_encode(['twitter' => '@juan_l', 'facebook' => 'juan.lopez']),
                'motivations' => 'Quiero aprender más sobre inteligencia artificial.',
                'what_it_offers' => 'Conocimientos en machine learning.',
                'what_it_asks_for' => 'Beca para una certificación en IA.',
            ],
            
        ];

        foreach ($users as $user) {
            UserScholarships::create($user);
        }
    }
}
