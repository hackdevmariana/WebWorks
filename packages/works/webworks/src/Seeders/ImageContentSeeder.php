<?php

namespace Works\Webworks\Seeders;

use Illuminate\Database\Seeder;
use Works\Webworks\Models\Content;
use Works\Webworks\Models\Gallery;
use Works\Webworks\Models\Website;

class ImageContentSeeder extends Seeder
{
    public function run()
    {
        // Obtener el sitio web por su nombre
        $website = Website::where('web', 'example.com')->firstOrFail();

        // Crear imágenes individuales
        $individualImages = [
            ['name' => 'Logo Image', 'image' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/logo.png', 'content_type' => 'image', 'slug' => 'logo-image'],
            ['name' => 'Banner Image', 'image' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/banner.png', 'content_type' => 'image', 'slug' => 'banner-image'],
        ];

        // Almacenar los contenidos creados para más tarde
        $createdContentIds = [];

        foreach ($individualImages as $imageData) {
            // Verificar si el contenido ya existe
            $content = Content::where('slug', $imageData['slug'])->first();
            if (!$content) {
                // Si no existe, lo creamos
                $content = Content::create([
                    'website_id' => $website->id,
                    'name' => $imageData['name'],
                    'image' => $imageData['image'],
                    'content_type' => $imageData['content_type'],
                    'is_default' => false,
                    'slug' => $imageData['slug'],
                    'draft' => false,
                ]);
            }
            // Almacenar el ID del contenido creado
            $createdContentIds[] = $content->id; // Guardamos el ID
        }

        // Crear una galería de imágenes
        // Asignar el ID del primer contenido como content_id de la galería
        $gallery = Gallery::create([
            'website_id' => $website->id,
            'name' => 'Example Gallery',
            'content_id' => $createdContentIds[0] // Asigna el content_id del primer contenido
        ]);

        // Imágenes de la galería
        $galleryImages = [
            ['image' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/image_01.png', 'slug' => 'image-01'],
            ['image' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/image_02.png', 'slug' => 'image-02'],
            ['image' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/image_03.png', 'slug' => 'image-03'],
            ['image' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/image_04.png', 'slug' => 'image-04'],
            ['image' => 'https://raw.githubusercontent.com/hackdevmariana/works-images/refs/heads/master/image_05.png', 'slug' => 'image-05'],
        ];

        foreach ($galleryImages as $url) {
            // Verificar si el contenido de la galería ya existe
            $galleryContent = Content::where('slug', $url['slug'])->first();
            if (!$galleryContent) {
                // Si no existe, lo creamos
                Content::create([
                    'website_id' => $website->id,
                    'name' => 'Gallery Image',
                    'image' => $url['image'],
                    'content_type' => 'gallery_item',
                    'is_default' => false,
                    'draft' => false,
                    'slug' => $url['slug'],
                    // Elimina gallery_id de aquí
                ]);
            }
        }
        

        $this->command->info('Images added successfully');
    }
}
