<?php

namespace Works\Socialcontentworks\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SocialContentSeeder extends Seeder
{
    public function run()
    {
        // Insertar usuarios
        DB::table('social_users')->insert([
            [
                'username' => 'johndoe',
                'name' => 'John',
                'surname' => 'Doe',
                'biography' => 'A passionate developer.',
                'photo' => 'https://example.com/photos/johndoe.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'username' => 'janedoe',
                'name' => 'Jane',
                'surname' => 'Doe',
                'biography' => 'A creative artist.',
                'photo' => 'https://example.com/photos/janedoe.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Insertar planetas sociales
        DB::table('social_planets')->insert([
            [
                'name' => 'Tech World',
                'slug' => Str::slug('Tech World'),
                'description' => 'A planet for tech enthusiasts.',
                'accounts' => json_encode(['Twitter', 'GitHub']),
                'privacy' => 'public',
                'social_user_id' => 1, // John Doe
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Art Haven',
                'slug' => Str::slug('Art Haven'),
                'description' => 'A planet for art lovers.',
                'accounts' => json_encode(['Instagram', 'Behance']),
                'privacy' => 'private',
                'social_user_id' => 2, // Jane Doe
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Insertar cuentas sociales
        DB::table('social_accounts')->insert([
            [
                'real_name' => 'John Doe',
                'username' => 'johntech',
                'platform' => 'Twitter',
                'link' => 'https://twitter.com/johntech',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'real_name' => 'Jane Doe',
                'username' => 'janeart',
                'platform' => 'Instagram',
                'link' => 'https://instagram.com/janeart',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Insertar contenidos sociales
        DB::table('social_contents')->insert([
            [
                'description' => 'Check out my latest GitHub project.',
                'platform' => 'GitHub',
                'url' => 'https://github.com/johndoe/project',
                'date' => Carbon::parse('2024-10-01'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'description' => 'New artwork uploaded to Behance!',
                'platform' => 'Behance',
                'url' => 'https://behance.com/janedoe/artwork',
                'date' => Carbon::parse('2024-09-15'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Insertar listas sociales
        DB::table('social_lists')->insert([
            [
                'name' => 'Tech Influencers',
                'slug' => Str::slug('Tech Influencers'),
                'description' => 'List of top tech influencers.',
                'contents' => json_encode(['johntech']),
                'platform' => 'Twitter',
                'privacy' => 'public',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Art Creators',
                'slug' => Str::slug('Art Creators'),
                'description' => 'List of prominent art creators.',
                'contents' => json_encode(['janeart']),
                'platform' => 'Instagram',
                'privacy' => 'private',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Insertar categorías
        DB::table('social_categories')->insert([
            ['name' => 'Technology', 'slug' => Str::slug('Technology'), 'description' => 'Everything related to technology.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Art', 'slug' => Str::slug('Art'), 'description' => 'All about art.', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Insertar etiquetas sociales
        DB::table('social_tags')->insert([
            ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Relacionar cuentas con categorías
        DB::table('social_account_category')->insert([
            ['account_id' => 1, 'category_id' => 1], // John Doe -> Technology
            ['account_id' => 2, 'category_id' => 2], // Jane Doe -> Art
        ]);

        // Relacionar contenidos con categorías
        DB::table('social_content_category')->insert([
            ['content_id' => 1, 'category_id' => 1], // GitHub Project -> Technology
            ['content_id' => 2, 'category_id' => 2], // Artwork -> Art
        ]);

        // Relacionar listas con categorías
        DB::table('social_list_category')->insert([
            ['list_id' => 1, 'category_id' => 1], // Tech Influencers -> Technology
            ['list_id' => 2, 'category_id' => 2], // Art Creators -> Art
        ]);
    }
}
