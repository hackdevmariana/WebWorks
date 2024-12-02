<?php
namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\CssVariable;
use Works\Web\Models\Web;

class CssVariableSeeder extends Seeder
{
    public function run()
    {
        $web = Web::firstOrCreate(['slug' => 'example-website'], ['name' => 'Example Website']);

        $colorAndFontVariables = [
            ['key' => '--font-size-small', 'value' => '0.875rem'],
            ['key' => '--font-size-medium', 'value' => '1rem'],
            ['key' => '--font-size-large', 'value' => '1.25rem'],
            ['key' => '--color-accent', 'value' => '#f00'],
            ['key' => '--color-success', 'value' => '#0f0'],
            ['key' => '--color-warning', 'value' => '#ff0'],
            ['key' => '--color-error', 'value' => '#f00'],
            ['key' => '--color-text', 'value' => '#333'],
            ['key' => '--color-background', 'value' => '#fff'],
        ];

        foreach ($colorAndFontVariables as $variable) {
            CssVariable::create(array_merge($variable, ['web_id' => $web->id]));
        }
    }
}
