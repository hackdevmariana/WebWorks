<?php 

use Illuminate\Support\Facades\Route;
use Works\Eventworks\Controllers\Api\EventTagController;
use Works\Eventworks\Controllers\Api\EventCategoryController;
use Works\Eventworks\Controllers\Api\ParticipantController;
use Works\Eventworks\Controllers\Api\OrganizerController;





Route::group(['prefix' => 'api/v1/events'], function () {
    Route::get('eventworks-test', function () {
        return response()->json(['message' => 'Congratulations! EventWorks is up and running!']);
    });
    Route::get('events/tags', [EventTagController::class, 'index']);
    Route::get('events/categories', [EventCategoryController::class, 'index']);
    Route::get('/organizers', [OrganizerController::class, 'index']); // Listado de todas las organizaciones
    Route::get('/organizers/{organizerSlug}', [OrganizerController::class, 'show']);


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