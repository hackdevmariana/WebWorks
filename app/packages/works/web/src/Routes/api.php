<?php

use Illuminate\Support\Facades\Route;
use Works\Web\Controllers\Api\WebController;
use Works\Web\Controllers\Api\AuthorController;

Route::prefix('api/v1')->group(function () {
    Route::get('/webs', [WebController::class, 'index']);       
    Route::get('/webs/{webSlug}', [WebController::class, 'showBySlug']); 
    Route::get('/webs/{webSlug}/authors', [AuthorController::class, 'index']); 
    Route::get('/webs/{webSlug}/authors/{authorSlug}', [AuthorController::class, 'show']); 
});
