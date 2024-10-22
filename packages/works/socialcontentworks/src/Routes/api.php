<?php

use Works\Socialcontentworks\Controllers\SocialContentController;
use Works\Socialcontentworks\Controllers\SocialUserController;
use Works\Socialcontentworks\Controllers\YouTubeController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/v1/')->group(function () {
    // Ruta para obtener todos los contenidos
    Route::get('social-contents/', [SocialContentController::class, 'index']);

    // Ruta para obtener un contenido específico
    Route::get('social-contents/{id}', [SocialContentController::class, 'show']);

    // Ruta para crear un nuevo contenido
    Route::post('social-contents/', [SocialContentController::class, 'store']);

    // Ruta para actualizar un contenido existente
    Route::put('social-contents/{id}', [SocialContentController::class, 'update']);

    // Ruta para eliminar un contenido
    Route::delete('social-contents/{id}', [SocialContentController::class, 'destroy']);

    // Ruta para buscar contenidos por palabra clave
    Route::get('social-contents/search', [SocialContentController::class, 'search']);


    Route::get('social-users/', [SocialUserController::class, 'index']);
    Route::get('social-users/{id}', [SocialUserController::class, 'show']);
    Route::post('social-users/', [SocialUserController::class, 'store']);
    Route::put('social-users/{id}', [SocialUserController::class, 'update']);
    Route::delete('social-users/{id}', [SocialUserController::class, 'destroy']);

    // *******************  YouTube

    Route::get('youtube/channel/{channel}', [YouTubeController::class, 'infoChannel']);
    
    // Obtener el ID del canal por nombre de usuario
    Route::get('youtube/channel-id/username/{username}', [YouTubeController::class, 'getChannelIdByUsername']);
    
    // Obtener el ID del canal por nombre del canal
    Route::get('youtube/channel-id/{channelName}', [YouTubeController::class, 'getChannelIdByName']);
    
    // Obtener videos del canal por nombre
    Route::get('youtube/channel/videos/{channelName}', [YouTubeController::class, 'getChannelVideosByName']);
    
    // Obtener el último video del canal por nombre
    Route::get('/last-video/name/{channelName}', [YouTubeController::class, 'getLastChannelVideoByName']);
    
    // Obtener los últimos N videos del canal por nombre
    Route::get('/last-videos/name/{channelName}/{number}', [YouTubeController::class, 'getLastsChannelVideosByName']);
    
    // Obtener videos del canal por ID
    Route::get('/channel-videos/{channelId}', [YouTubeController::class, 'getChannelVideos']);
    
    // Obtener el último video del canal por ID
    Route::get('/last-video/{channelId}', [YouTubeController::class, 'getLastChannelVideo']);
    
    // Obtener los últimos N videos del canal por ID
    Route::get('/last-videos/{channelId}/{number}', [YouTubeController::class, 'getLastsChannelVideos']);
    
    // Obtener detalles del canal por ID
    Route::get('/channel-details/{channelId}', [YouTubeController::class, 'getChannelDetails']);
    
    // Testear la búsqueda de un canal
    Route::get('/test-channel/{channel}', [YouTubeController::class, 'testChannel']);
    
    // Ruta de prueba general
    Route::get('/test', [YouTubeController::class, 'test']);

    /*
    Route::get('youtube/test/', [YouTubeController::class, 'test']);
    Route::get('youtube/test/{channel}', [YouTubeController::class, 'testChannel']);


    // Recibir el ID de un canal
    Route::get('youtube/get-id/{channel}', [YouTubeController::class, 'getId']);

    Route::get('youtube/info/{channel}', [YouTubeController::class, 'infoChannel']);
    Route::get('youtube/details/{channel}', [YouTubeController::class, 'getChannelDetails']);


    // Listado de vídeos de un canal por nombre
    Route::get('youtube/videos/{channel}', [YouTubeController::class, 'getChannelVideosByName']);
    
    // Último vídeo de un canal por nombre
    Route::get('youtube/videos/{channel}/last', [YouTubeController::class, 'getLastChannelVideoByName']);
    
    // Últimos {number} vídeos de un canal por nombre
    Route::get('youtube/videos/{channel}/lasts/{number}', [YouTubeController::class, 'getLastsChannelVideosByName']);
        
    
    // Búsqueda en YouTube por tema
    Route::get('youtube/topic/{topic}', [YouTubeController::class, 'searchVideosByTopic']);
    
    // Lista de vídeos creada por un usuario
    Route::get('youtube/list/{list}', [YouTubeController::class, 'getVideosFromList']);
    
    // Vídeos de una categoría
    Route::get('youtube/category/{category}', [YouTubeController::class, 'getVideosByCategory']);
    
    // Vídeos por etiqueta
    Route::get('youtube/tag/{tag}', [YouTubeController::class, 'getVideosByTag']);
    
    // Lista de los últimos vídeos de una lista de canales
    Route::get('youtube/{planet}', [YouTubeController::class, 'getPlanetVideos']);
    
    // Tendencias de YouTube
    Route::get('youtube/trending', [YouTubeController::class, 'getTrendingVideos']);
*/

});

