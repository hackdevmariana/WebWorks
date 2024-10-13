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
use Works\Eventworks\Controllers\Api\ProgramController;
use Works\Eventworks\Controllers\Api\SpeakerController;
use Works\Eventworks\Controllers\Api\AttendanceController;
use Works\Eventworks\Controllers\Api\PriceController;
use Works\Eventworks\Controllers\Api\MessageController;
use Works\Eventworks\Controllers\Api\PreregistrationController;

Route::group(['prefix' => 'api/v1/events'], function () {
    Route::get('eventworks-test', function () {
        return response()->json(['message' => 'Congratulations! EventWorks is up and running!']);
    });
    Route::get('tags', [EventTagController::class, 'index']);
    Route::get('categories', [EventCategoryController::class, 'index']);
    Route::get('organizers', [OrganizerController::class, 'index']); 
    Route::get('organizers/{organizerSlug}', [OrganizerController::class, 'show']);

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
    Route::get('events', [EventController::class, 'getCycles']);

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

    Route::get('/country/{country}/', [EventController::class, 'getByCountry']);
    Route::get('/city/{country}/{city}', [EventController::class, 'getByLocation']);
    Route::get('/organizer/{organizer}', [EventController::class, 'getByOrganizer']);

    Route::get('/date/{year}', [EventController::class, 'getByYear']);
    Route::get('/date/{year}/{month}', [EventController::class, 'getByMonth']);
    Route::get('/date/{year}/{month}/{day}', [EventController::class, 'getByDay']);
    
    Route::get('tags/{tag1}/{tag2?}', [EventController::class, 'getByTags']);
    
    Route::get('type/{type?}', [EventController::class, 'getByType']);

    Route::get('category/{category?}', [EventController::class, 'getByCategory']);
    
    Route::get('/events/location/{country}/{city}', [EventController::class, 'filterByLocation']);
    Route::get('/events/date/{year}/{month}', [EventController::class, 'filterByDate']);
    Route::get('/events/range/{start_date}/{end_date}', [EventController::class, 'filterByRange']);

    Route::get('/events/search', [EventController::class, 'search']);

    // Programs
    Route::get('programs/{eventSlug}', [ProgramController::class, 'getProgramByEvent']);
    Route::get('programs/{eventSlug}/activities/{activitySlug}', [ProgramController::class, 'getActivityByName']);
    Route::get('programs/{eventSlug}/day/{day}', [ProgramController::class, 'getProgramByDay']);

    // Speakers

    Route::get('speakers/{speakerName}', [SpeakerController::class, 'getSpeakerByName']);
    Route::get('speakers', [SpeakerController::class, 'getAllSpeakers']);
    Route::get('{eventSlug}/speakers', [SpeakerController::class, 'getSpeakersByEvent']);

    // Attendance
    Route::get('events/{participantSlug}/attendance', [AttendanceController::class, 'getAttendanceByParticipant']);
    Route::get('events/{eventSlug}/participants', [AttendanceController::class, 'getParticipantsByEvent']);

    // Prices
    Route::get('events/{eventSlug}/prices', [PriceController::class, 'getPricesByEvent']);
    Route::get('events/{eventSlug}/prices-today', [PriceController::class, 'getTodayPricesByEvent']);

    // Pre-registration

    Route::get('events/{eventSlug}/pre-registered', [PreregistrationController::class, 'getPreRegisteredByEvent']);

    // Message 
    Route::get('events/{thread}/', [MessageController::class, 'getMessagesByThread']);

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