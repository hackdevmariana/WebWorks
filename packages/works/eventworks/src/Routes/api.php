<?php 

use Illuminate\Support\Facades\Route;
use Works\Eventworks\Controllers\Api\EventTagController;


Route::group(['prefix' => 'api/v1'], function () {
    Route::get('eventworks-test', function () {
        return response()->json(['message' => 'Congratulations! EventWorks is up and running!']);
    });
    Route::get('events/tags', [EventTagController::class, 'index']);
});
