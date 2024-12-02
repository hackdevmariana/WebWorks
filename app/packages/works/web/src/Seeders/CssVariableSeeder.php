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

        $variables = [
            ['key' => '--font-size-small', 'value' => '0.875rem'],
            ['key' => '--font-size-medium', 'value' => '1rem'],
            ['key' => '--font-size-large', 'value' => '1.25rem'],
            ['key' => '--line-height', 'value' => '1.5'],
            ['key' => '--color-accent', 'value' => '#f00'],
            ['key' => '--color-success', 'value' => '#0f0'],
            ['key' => '--color-warning', 'value' => '#ff0'],
            ['key' => '--color-error', 'value' => '#f00'],
            ['key' => '--color-text', 'value' => '#333'],
            ['key' => '--color-background', 'value' => '#fff'],
            ['key' => '--spacing-small', 'value' => '4px'],
            ['key' => '--spacing-medium', 'value' => '8px'],
            ['key' => '--spacing-large', 'value' => '16px'],
            ['key' => '--border-radius', 'value' => '4px'],
            ['key' => '--border-width', 'value' => '1px'],
            ['key' => '--box-shadow', 'value' => '0px 4px 6px rgba(0, 0, 0, 0.1)'],
            ['key' => '--text-shadow', 'value' => '1px 1px 2px rgba(0, 0, 0, 0.2)'],
        ];

        foreach ($variables as $variable) {
            CssVariable::create(array_merge($variable, ['web_id' => $web->id]));
        }
    }
}
