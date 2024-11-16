<?php

namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        Author::factory()->count(10)->create();
    }
}
