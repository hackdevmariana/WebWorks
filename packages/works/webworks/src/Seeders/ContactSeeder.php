<?php

namespace Works\Webworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Webworks\Models\Contact;
use Works\Webworks\Models\Website;

class ContactSeeder extends Seeder
{
    public function run()
    {
        $website = Website::first(); // Asumimos que ya existe un sitio web para asociar los contactos

        Contact::create([
            'website_id' => $website->id,
            'phone' => '+123456789',
            'email' => 'info@example.com',
            'address' => '123 Example St.',
            'city' => 'Example City',
            'country' => 'Example Country',
            'other' => 'Additional information or contact methods'
        ]);
    }
}
