<?php

namespace Works\Web\Seeders;


use Illuminate\Database\Seeder;
use Works\Web\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run()
    {
        Contact::create([
            'web_id' => 1,
            'name' => 'Delegación Zaragoza',
            'title' => 'Oficina Principal',
            'phone' => '+34 976 123 456',
            'email' => 'zaragoza@empresa.com',
            'address' => 'Calle Mayor, 1',
            'city' => 'Zaragoza',
            'country' => 'España',
            'other' => 'Horario: 9:00-18:00',
        ]);

        Contact::create([
            'web_id' => 1,
            'name' => 'Oficina Madrid',
            'title' => 'Sede Central',
            'phone' => '+34 915 654 321',
            'email' => 'madrid@empresa.com',
            'address' => 'Gran Vía, 45',
            'city' => 'Madrid',
            'country' => 'España',
            'other' => 'Atención: 8:00-17:00',
        ]);
    }
}
