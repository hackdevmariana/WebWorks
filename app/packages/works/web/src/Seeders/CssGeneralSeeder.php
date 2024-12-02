<?php
namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\CssGeneral;
use Works\Web\Models\Web;

class CssGeneralSeeder extends Seeder
{
    public function run()
    {
        $web = Web::firstOrCreate(['slug' => 'example-website'], ['name' => 'Example Website']);

        $generalValues = [
            ['key' => '--border-radius', 'value' => '4px'],
            ['key' => '--border-width', 'value' => '1px'],
            ['key' => '--box-shadow', 'value' => '0px 4px 6px rgba(0, 0, 0, 0.1)'],
            ['key' => '--text-shadow', 'value' => '1px 1px 2px rgba(0, 0, 0, 0.2)'],
        ];

        foreach ($generalValues as $value) {
            CssGeneral::create(array_merge($value, ['web_id' => $web->id]));
        }
    }
}
