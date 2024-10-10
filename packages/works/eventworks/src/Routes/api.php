<?php 

use Illuminate\Support\Facades\Route;
use Works\Eventworks\Controllers\Api\EventTagController;
use Works\Eventworks\Controllers\Api\EventCategoryController;
use Works\Eventworks\Controllers\Api\ParticipantController;
use Works\Eventworks\Controllers\Api\OrganizerController;
use Works\Eventworks\Controllers\Api\LocationController;
use Works\Eventworks\Controllers\Api\MediaController;
use Works\Eventworks\Controllers\Api\EventLinkController;
use Works\Eventworks\Controllers\Api\CycleController;




Route::group(['prefix' => 'api/v1/events'], function () {
    Route::get('eventworks-test', function () {
        return response()->json(['message' => 'Congratulations! EventWorks is up and running!']);
    });
    Route::get('events/tags', [EventTagController::class, 'index']);
    Route::get('events/categories', [EventCategoryController::class, 'index']);
    Route::get('/organizers', [OrganizerController::class, 'index']); 
    Route::get('/organizers/{organizerSlug}', [OrganizerController::class, 'show']);

    // Locations
    Route::get('locations', [LocationController::class, 'index']);
    Route::get('locations/{slug}', [LocationController::class, 'show']);

    // Media
    Route::get('media', [MediaController::class, 'index']); 
    Route::get('media/{slug}', [MediaController::class, 'show']); 

    // Links
    Route::get('links', [EventLinkController::class, 'index']);
    Route::get('links/{linkName}', [EventLinkController::class, 'show']);

    // Cycles
    Route::get('cycles', [CycleController::class, 'index']);
    Route::get('cycles/{cycleName}', [CycleController::class, 'show']);

    // Temporary routes without access token
    Route::get('events/participants', [ParticipantController::class, 'index']);
    Route::get('events/participants/{participantUsername}', [ParticipantController::class, 'showByUsername']);
    Route::get('events/participants/{event}', [ParticipantController::class, 'showByEvent']);

});


/*
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('events/participants', [ParticipantController::class, 'index']);
        Route::get('events/participants/{event}', [ParticipantController::class, 'showByEvent']);
        Route::get('events/participants/{participantUsername}', [ParticipantController::class, 'showByUsername']);
    });

*/