<?php

namespace Works\Eventworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Eventworks\Models\City;
use Illuminate\Support\Str; 

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = [
            'A Coruña', 'Álava', 'Albacete', 'Alicante', 'Almería', 'Asturias', 
            'Ávila', 'Badajoz', 'Baleares', 'Barcelona', 'Burgos', 'Cáceres', 
            'Cádiz', 'Cantabria', 'Castellón', 'Ciudad Real', 'Córdoba', 'Cuenca', 
            'Girona', 'Granada', 'Guadalajara', 'Guipúzcoa', 'Huelva', 'Huesca', 
            'Jaén', 'La Rioja', 'Las Palmas', 'León', 'Lleida', 'Lugo', 'Madrid', 
            'Málaga', 'Murcia', 'Navarra', 'Ourense', 'Palencia', 'Pontevedra', 
            'Salamanca', 'Santa Cruz de Tenerife', 'Segovia', 'Sevilla', 'Soria', 
            'Tarragona', 'Teruel', 'Toledo', 'Valencia', 'Valladolid', 'Vizcaya', 
            'Zamora', 'Zaragoza'
        ];

        foreach ($cities as $city) {
            City::create([
                'name' => $city,
                'slug' => Str::slug($city), 
                'country_id' => 9 
            ]);
        }
    }
}
