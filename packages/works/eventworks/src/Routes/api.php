<?php 

use Illuminate\Support\Facades\Route;
use Works\Eventworks\Controllers\Api\EventTagController;
use Works\Eventworks\Controllers\Api\EventCategoryController;
use Works\Eventworks\Controllers\Api\ParticipantController;



Route::group(['prefix' => 'api/v1'], function () {
    Route::get('eventworks-test', function () {
        return response()->json(['message' => 'Congratulations! EventWorks is up and running!']);
    });
    Route::get('events/tags', [EventTagController::class, 'index']);
    Route::get('events/categories', [EventCategoryController::class, 'index']);


    // Temporary routes without access token
    Route::get('events/participants', [ParticipantController::class, 'index']);
    Route::get('events/participants/{event}', [ParticipantController::class, 'showByEvent']);
    Route::get('events/participants/{participantUsername}', [ParticipantController::class, 'showByUsername']);
});


/*
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('events/participants', [ParticipantController::class, 'index']);
        Route::get('events/participants/{event}', [ParticipantController::class, 'showByEvent']);
        Route::get('events/participants/{participantUsername}', [ParticipantController::class, 'showByUsername']);
    });

*/