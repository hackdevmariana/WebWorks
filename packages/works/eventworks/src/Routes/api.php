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
use Works\Eventworks\Controllers\Api\EventController;




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

    // Events 
    Route::get('/events/cycles', [EventController::class, 'getCycles']);

    Route::prefix('events/{slug}')->group(function () {
        Route::get('/', [EventController::class, 'show']);
        Route::get('/description', [EventController::class, 'getDescription']);
        Route::get('/date', [EventController::class, 'getDate']);
        Route::get('/price', [EventController::class, 'getPrice']);
        Route::get('/urls', [EventController::class, 'getUrls']);
        Route::get('/tags', [EventController::class, 'getTags']);
        Route::get('/google-calendar', [EventController::class, 'downloadGoogleCalendar']);
        Route::get('/apple-calendar', [EventController::class, 'downloadAppleCalendar']);
    });

    Route::get('/events/{country}/{city}', [EventController::class, 'getByLocation']);
    Route::get('/events/{organizer}', [EventController::class, 'getByOrganizer']);
    Route::get('/events/{year}', [EventController::class, 'getByYear']);
    Route::get('/events/{year}/{month}', [EventController::class, 'getByMonth']);
    Route::get('/events/{year}/{month}/{day}', [EventController::class, 'getByDay']);
    
    Route::get('/events/tags/{tag1}/{tag2?}', [EventController::class, 'getByTags']);
    
    Route::get('/events/type/{type}', [EventController::class, 'getByType']);
    Route::get('/events/category/{category}', [EventController::class, 'getByCategory']);
    Route::get('/events/location/{country}/{city}', [EventController::class, 'filterByLocation']);
    Route::get('/events/date/{year}/{month}', [EventController::class, 'filterByDate']);
    Route::get('/events/range/{start_date}/{end_date}', [EventController::class, 'filterByRange']);

    Route::get('/events/search', [EventController::class, 'search']);

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