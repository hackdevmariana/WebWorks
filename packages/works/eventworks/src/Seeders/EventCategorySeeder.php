<?php

namespace Works\Eventworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Eventworks\Models\EventCategory;
use Illuminate\Support\Str; 


class EventCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Economía',
            'Filosofía',
            'Historia',
            'Política',
            'Sociología',
            'Antropología',
            'Psicología',
            'Literatura',
            'Derecho',
            'Arte',
            'Teología',
        ];

        foreach ($categories as $category) {
            EventCategory::create([
                'name' => $category,
                'slug' => Str::slug($category), 
            ]);
        }
    }
}
