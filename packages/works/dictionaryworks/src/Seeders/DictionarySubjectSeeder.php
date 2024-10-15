<?php

namespace Works\Dictionaryworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Dictionaryworks\Models\DictionarySubject;
use Illuminate\Support\Str;

class DictionarySubjectSeeder extends Seeder
{
    public function run()
    {
        $subjects = [
            'Economía',
            'Filosofía',
            'Historia',
            'Sociología',
            'Antropología',
            'Derecho',
            'Literatura',
            'Lingüística',
            'Política',
            'Psicología'
        ];

        foreach ($subjects as $subject) {
            DictionarySubject::create([
                'name' => $subject,
                'slug' => Str::slug($subject),
                'description' => 'Descripción para la asignatura de ' . $subject,
            ]);
        }
    }
}
