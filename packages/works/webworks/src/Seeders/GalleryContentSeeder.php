<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentGallerySeeder extends Seeder
{
    public function run()
    {
        // Obtener el ID correcto de la galería en la tabla contents
        $galleryId = DB::table('contents')->where('name', 'homepage-gallery')->value('id');

        // Insertar las relaciones correctas en la tabla content_gallery
        DB::table('content_gallery')->insert([
            ['gallery_id' => $galleryId, 'content_id' => 21, 'created_at' => now(), 'updated_at' => now()],
            ['gallery_id' => $galleryId, 'content_id' => 22, 'created_at' => now(), 'updated_at' => now()],
            ['gallery_id' => $galleryId, 'content_id' => 23, 'created_at' => now(), 'updated_at' => now()],
            ['gallery_id' => $galleryId, 'content_id' => 24, 'created_at' => now(), 'updated_at' => now()],
            ['gallery_id' => $galleryId, 'content_id' => 25, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
