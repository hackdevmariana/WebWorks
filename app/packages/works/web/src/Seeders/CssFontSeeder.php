<?php

namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\CssFont;

class CssFontSeeder extends Seeder
{
    public function run()
    {
        CssFont::create([
            'name' => 'Poppins',
            'import_url' => "https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap",
            'variable_name' => '--font-primary',
            'web_id' => 1,
        ]);

        CssFont::create([
            'name' => 'Lato',
            'import_url' => "https://fonts.googleapis.com/css?family=Lato:100;200;300;400;500;600;700;800;900&display=swap",
            'variable_name' => '--font-secondary',
            'web_id' => 1, 
        ]);
    }
}
