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
    // Route::get('youtube/channel-id/username/{username}', [YouTubeController::class, 'getChannelIdByUsername']);

    // Obtener el ID del canal por nombre del canal
    Route::get('youtube/channel-id/{channelName}', [YouTubeController::class, 'getChannelIdByName']);

    // Obtener videos del canal por nombre
    Route::get('youtube/videos/{channelName}', [YouTubeController::class, 'getChannelVideosByName']);

    // Obtener el último video del canal por nombre
    Route::get('youtube/last-video/{channelName}', [YouTubeController::class, 'getLastChannelVideoByName']);

    // Obtener los últimos N videos del canal por nombre
    Route::get('youtube/latest-videos/{channelName}/', [YouTubeController::class, 'getLastsChannelVideosByName']);
    Route::get('youtube/latest-videos/{channelName}/{number}', [YouTubeController::class, 'getLastsChannelVideosByName']);

    // Obtener videos del canal por ID
    Route::get('youtube/videos-id/{channelId}', [YouTubeController::class, 'getChannelVideos']);

    // Obtener el último video del canal por ID
    Route::get('youtube/last-video-id/{channelId}', [YouTubeController::class, 'getLastChannelVideo']);

    // Obtener los últimos N videos del canal por ID
    Route::get('youtube/lastest-videos-id/{channelId}/{number}', [YouTubeController::class, 'getLastsChannelVideos']);

    // Obtener detalles del canal por ID
    Route::get('youtube/channel-details/{channelId}', [YouTubeController::class, 'getChannelDetails']);

    // Testear la búsqueda de un canal
    Route::get('youtube/test-channel/{channel}', [YouTubeController::class, 'testChannel']);

    // Información de un vídeo
    Route::get('youtube/video/{videoId}', [YouTubeController::class, 'getVideoDetailsById']);


    // Ruta de prueba general
    Route::get('youtube/test', [YouTubeController::class, 'test']);

    // Tendencias de YouTube
    Route::get('youtube/trending', [YouTubeController::class, 'getTrendingVideos']);
    Route::get('youtube/trending/{region}', [YouTubeController::class, 'getTrendingVideos']);
    Route::get('youtube/trending/{region}/{number}', [YouTubeController::class, 'getTrendingVideos']);

    // Búsqueda en YouTube por tema
    Route::get('youtube/topic/{topic}', [YouTubeController::class, 'searchVideosByTopic']);


    Route::prefix('youtube/topic/{topic}')->group(function () {
        Route::get('/relevance/{number?}/{region?}', [YouTubeController::class, 'searchVideosByRelevance']);
        Route::get('/date/{number?}/{region?}', [YouTubeController::class, 'searchVideosByDate']);
        Route::get('/views/{number?}/{region?}', [YouTubeController::class, 'searchVideosByViews']);
        Route::get('/rating/{number?}/{region?}', [YouTubeController::class, 'searchVideosByRating']);
        Route::get('/short/{number?}/{region?}', [YouTubeController::class, 'searchVideosByShort']);
        Route::get('/medium/{number?}/{region?}', [YouTubeController::class, 'searchVideosByMedium']);
        Route::get('/long/{number?}/{region?}', [YouTubeController::class, 'searchVideosByLong']);
        Route::get('/channel/{number?}/{region?}', [YouTubeController::class, 'searchVideosByChannel']);
        Route::get('/playlist/{number?}/{region?}', [YouTubeController::class, 'searchVideosByPlaylist']);
    });

    // Lista de los últimos vídeos de una lista de canales
    Route::get('youtube/planet/{planet}', [YouTubeController::class, 'youtubePlanet']);
    Route::get('youtube/planet/{planet}/{number}', [YouTubeController::class, 'youtubePlanet']);
});


/*
Route::get('youtube/topic/{topic}/relevance', [YouTubeController::class, 'searchVideosByRelevance']);
Route::get('youtube/topic/{topic}/date', [YouTubeController::class, 'searchVideosByDate']);
Route::get('youtube/topic/{topic}/views', [YouTubeController::class, 'searchVideosByViews']);
Route::get('youtube/topic/{topic}/rating', [YouTubeController::class, 'searchVideosByRating']);
Route::get('youtube/topic/{topic}/short', [YouTubeController::class, 'searchVideosByShort']);
Route::get('youtube/topic/{topic}/medium', [YouTubeController::class, 'searchVideosByMedium']);
Route::get('youtube/topic/{topic}/long', [YouTubeController::class, 'searchVideosByLong']);
Route::get('youtube/topic/{topic}/channel', [YouTubeController::class, 'searchVideosByChannel']);
Route::get('youtube/topic/{topic}/playlist', [YouTubeController::class, 'searchVideosByPlaylist']);

Route::get('youtube/topic/{topic}/relevance/{number}', [YouTubeController::class, 'searchVideosByRelevance']);
Route::get('youtube/topic/{topic}/date/{number}', [YouTubeController::class, 'searchVideosByDate']);
Route::get('youtube/topic/{topic}/views/{number}', [YouTubeController::class, 'searchVideosByViews']);
Route::get('youtube/topic/{topic}/rating/{number}', [YouTubeController::class, 'searchVideosByRating']);
Route::get('youtube/topic/{topic}/short/{number}', [YouTubeController::class, 'searchVideosByShort']);
Route::get('youtube/topic/{topic}/medium/{number}', [YouTubeController::class, 'searchVideosByMedium']);
Route::get('youtube/topic/{topic}/long/{number}', [YouTubeController::class, 'searchVideosByLong']);
Route::get('youtube/topic/{topic}/channel/{number}', [YouTubeController::class, 'searchVideosByChannel']);
Route::get('youtube/topic/{topic}/playlist/{number}', [YouTubeController::class, 'searchVideosByPlaylist']);

Route::get('youtube/topic/{topic}/relevance/{number}/{region}', [YouTubeController::class, 'searchVideosByRelevance']);
Route::get('youtube/topic/{topic}/date/{number}/{region}', [YouTubeController::class, 'searchVideosByDate']);
Route::get('youtube/topic/{topic}/views/{number}/{region}', [YouTubeController::class, 'searchVideosByViews']);
Route::get('youtube/topic/{topic}/rating/{number}/{region}', [YouTubeController::class, 'searchVideosByRating']);
Route::get('youtube/topic/{topic}/short/{number}/{region}', [YouTubeController::class, 'searchVideosByShort']);
Route::get('youtube/topic/{topic}/medium/{number}/{region}', [YouTubeController::class, 'searchVideosByMedium']);
Route::get('youtube/topic/{topic}/long/{number}/{region}', [YouTubeController::class, 'searchVideosByLong']);
Route::get('youtube/topic/{topic}/channel/{number}/{region}', [YouTubeController::class, 'searchVideosByChannel']);
Route::get('youtube/topic/{topic}/playlist/{number}/{region}', [YouTubeController::class, 'searchVideosByPlaylist']);
*/

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
    



// Lista de vídeos creada por un usuario
Route::get('youtube/list/{list}', [YouTubeController::class, 'getVideosFromList']);

// Vídeos de una categoría
Route::get('youtube/category/{category}', [YouTubeController::class, 'getVideosByCategory']);

// Vídeos por etiqueta
Route::get('youtube/tag/{tag}', [YouTubeController::class, 'getVideosByTag']);




*/



