<?php

use Works\Scholarshipsworks\Controllers\ScholarshipsController;


Route::prefix('api/v1/scholarships')->group(function () {
    Route::get('/events', [ScholarshipsController::class, 'events']);
    Route::get('/events/{event-slug}', [ScholarshipsController::class, 'scholarshipsByEvent']);
    Route::get('/candidates', [ScholarshipsController::class, 'candidates']);
    Route::get('/benefactors', [ScholarshipsController::class, 'benefactors']);
    Route::get('/candidate/{id}', [ScholarshipsController::class, 'candidate']);
    Route::get('/benefactor/{id}', [ScholarshipsController::class, 'benefactor']);
    Route::get('/requests/{id}', [ScholarshipsController::class, 'requestStatus']);
    Route::get('/notifications/{id}', [ScholarshipsController::class, 'notifications']);
    Route::get('/communication/{scholarship_id}', [ScholarshipsController::class, 'communication']);
    Route::get('/communication/history/{id}', [ScholarshipsController::class, 'communicationHistory']);
});