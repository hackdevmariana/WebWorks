<?php

namespace Works\Web\Seeders;

use Illuminate\Database\Seeder;
use Works\Web\Models\Playlist;
use Works\Web\Models\Video;

class PlaylistSeeder extends Seeder
{
    public function run()
    {
        // Crear una Playlist
        $playlist = Playlist::create([
            'web_id' => 1,
            'name' => 'Laravel y Nuxt Clases',
            'slug' => 'laravel-nuxt-clases',
            'description' => 'Una colección de vídeos sobre Laravel y Nuxt.js.',
        ]);

        // Obtener los vídeos existentes
        $videos = Video::whereIn('id', [1, 2])->get();

        // Relacionar vídeos con orden
        foreach ($videos as $index => $video) {
            $playlist->videos()->attach($video->id, ['order' => $index + 1]);
        }
    }
}
