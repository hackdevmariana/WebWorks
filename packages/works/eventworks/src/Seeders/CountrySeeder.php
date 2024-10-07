<?php

namespace Works\Eventworks\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str; 
use Works\Eventworks\Models\Country;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $countries = [
            'Argentina',
            'Bolivia',
            'Chile',
            'Colombia',
            'Costa Rica',
            'Cuba',
            'Ecuador',
            'El Salvador',
            'España',
            'Estados Unidos',
            'Guatemala',
            'Honduras',
            'México',
            'Nicaragua',
            'Panamá',
            'Paraguay',
            'Perú',
            'República Dominicana',
            'Uruguay',
            'Venezuela'
        ];

        foreach ($countries as $country) {
            Country::create([
                'name' => $country,
                'slug' => Str::slug($country) 
            ]);
        }
    }
}
