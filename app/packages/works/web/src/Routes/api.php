<?php

use Illuminate\Support\Facades\Route;
use Works\Web\Controllers\Api\WebController;

Route::prefix('api/v1')->group(function () {
    Route::get('/webs', [WebController::class, 'index']);       // Listar todos los websites
    Route::get('/webs/{slug}', [WebController::class, 'showBySlug']); // Mostrar website por slug
});
