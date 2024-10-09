<?php

namespace Works\Eventworks\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Works\Eventworks\Models\Location;
use Works\Eventworks\Models\City;
use Works\Eventworks\Models\Country;

class LocationSeeder extends Seeder
{
    public function run()
    {
        $city = City::where('name', 'Madrid')->first();
        $country = Country::where('name', 'España')->first();

        $locations = [
            ['name' => 'Universidad Francisco Marroquín', 'address' => 'Calle Arturo Soria, 245', 'zip' => '28033', 'phone' => '910 66 81 53'],
            ['name' => 'Ateneo de Madrid', 'address' => 'Calle del Prado, 21', 'zip' => '28014', 'phone' => '914 29 17 50'],
            ['name' => 'Casino de Madrid', 'address' => 'Calle de Alcalá, 15', 'zip' => '28014', 'phone' => '915 21 87 00'],
        ];

        foreach ($locations as $location) {
            Location::create([
                'name' => $location['name'],
                'slug' => Str::slug($location['name']),
                'address' => $location['address'],
                'city_id' => $city->id,
                'country_id' => $country->id,
                'zip' => $location['zip'],
                'phone' => $location['phone']
            ]);
        }
    }
}
