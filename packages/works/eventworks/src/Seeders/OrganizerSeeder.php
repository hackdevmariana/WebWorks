<?php

namespace Works\Eventworks\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Works\Eventworks\Models\Organizer;

class OrganizerSeeder extends Seeder
{
    public function run()
    {
        $organizers = [
            ['name' => 'Universidad Francisco Marroquín', 'phone' => '910 66 81 53', 'email' => 'academicomadrid@ufm.edu'],
            ['name' => 'Asociación Cultural Las Artes', 'phone' => '915000000', 'email' => 'contacto@culturalasartes.org'],
            ['name' => 'Universidad de las Hespérides', 'phone' => '928 31 13 00', 'email' => 'info@hesperides.edu.es'],
            ['name' => 'Fundación Científica Española', 'phone' => '911234567', 'email' => 'fundacion@cienciaes.org'],
        ];

        foreach ($organizers as $org) {
            Organizer::create([
                'name' => $org['name'],
                'slug' => Str::slug($org['name']),
                'phone' => $org['phone'],
                'email' => $org['email'],
            ]);
        }
    }
}
