<?php

namespace Works\Biolinkworks\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BioLinkSeeder extends Seeder
{

    public function run()
    {
        // Crear algunos usuarios de biografía
        DB::table('bio_users')->insert([
            [
                'username' => 'johndoe',
                'name' => 'John',
                'surname' => 'Doe',
                'biography' => 'A passionate developer.',
                'photo' => 'https://example.com/photos/johndoe.jpg',
                'alt' => 'John Doe Photo',
                'background' => '#f0f0f0',
                'calltoaction' => 'Check out my projects!',
                'views' => 123,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'username' => 'janedoe',
                'name' => 'Jane',
                'surname' => 'Doe',
                'biography' => 'A creative artist.',
                'photo' => 'https://example.com/photos/janedoe.jpg',
                'alt' => 'Jane Doe Photo',
                'background' => '#e0e0e0',
                'calltoaction' => 'See my portfolio!',
                'views' => 456,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Crear algunos enlaces asociados a bio_users
        DB::table('bio_links')->insert([
            [
                'text' => 'My GitHub',
                'url' => 'https://github.com/johndoe',
                'name' => 'GitHub',
                'slug' => Str::slug('My GitHub'),
                'bio_user_id' => 1, // Asociado a John Doe
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'text' => 'My Website',
                'url' => 'https://janedoe.com',
                'name' => 'Website',
                'slug' => Str::slug('My Website'),
                'bio_user_id' => 2, // Asociado a Jane Doe
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Crear algunos textos temporales asociados a bio_users
        DB::table('bio_temporal_texts')->insert([
            [
                'name' => 'Holiday Sale',
                'slug' => Str::slug('Holiday Sale'),
                'title' => 'Special Offer',
                'text' => 'Get 20% off on all items!',
                'start' => Carbon::parse('2024-12-01'),
                'end' => Carbon::parse('2024-12-31'),
                'bio_user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Exhibition',
                'slug' => Str::slug('Exhibition'),
                'title' => 'Art Gallery',
                'text' => 'Come see my latest art collection.',
                'start' => Carbon::parse('2024-11-15'),
                'end' => Carbon::parse('2024-11-30'),
                'bio_user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Crear algunas categorías
        DB::table('bio_categories')->insert([
            ['name' => 'Developer', 'slug' => Str::slug('Developer'), 'description' => 'People who develop software.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Artist', 'slug' => Str::slug('Artist'), 'description' => 'People who create art.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Crear algunas subcategorías
        DB::table('bio_subcategories')->insert([
            ['name' => 'Web Developer', 'slug' => Str::slug('Web Developer'), 'description' => 'Developers specializing in web technologies.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Painter', 'slug' => Str::slug('Painter'), 'description' => 'Artists specializing in painting.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Crear algunas etiquetas
        DB::table('bio_tags')->insert([
            ['name' => 'PHP', 'slug' => Str::slug('PHP'), 'description' => 'PHP developers.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Laravel', 'slug' => Str::slug('Laravel'), 'description' => 'Laravel developers.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Painting', 'slug' => Str::slug('Painting'), 'description' => 'Artists who paint.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Relacionar usuarios con categorías
        DB::table('bio_category_user')->insert([
            ['bio_user_id' => 1, 'bio_category_id' => 1], // John Doe -> Developer
            ['bio_user_id' => 2, 'bio_category_id' => 2], // Jane Doe -> Artist
        ]);

        // Relacionar usuarios con subcategorías
        DB::table('bio_subcategory_user')->insert([
            ['bio_user_id' => 1, 'bio_subcategory_id' => 1], // John Doe -> Web Developer
            ['bio_user_id' => 2, 'bio_subcategory_id' => 2], // Jane Doe -> Painter
        ]);

        // Relacionar usuarios con etiquetas
        DB::table('bio_tag_user')->insert([
            ['bio_user_id' => 1, 'bio_tag_id' => 1], // John Doe -> PHP
            ['bio_user_id' => 1, 'bio_tag_id' => 2], // John Doe -> Laravel
            ['bio_user_id' => 2, 'bio_tag_id' => 3], // Jane Doe -> Painting
        ]);
    }
}
