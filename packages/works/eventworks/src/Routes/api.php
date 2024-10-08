<?php 

use Illuminate\Support\Facades\Route;
use Works\Eventworks\Controllers\Api\EventTagController;
use Works\Eventworks\Controllers\Api\EventCategoryController;



Route::group(['prefix' => 'api/v1'], function () {
    Route::get('eventworks-test', function () {
        return response()->json(['message' => 'Congratulations! EventWorks is up and running!']);
    });
    Route::get('events/tags', [EventTagController::class, 'index']);
    Route::get('events/categories', [EventCategoryController::class, 'index']);
});
