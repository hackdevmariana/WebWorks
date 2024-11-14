<?php

use Illuminate\Support\Facades\Route;
use Works\Web\Controllers\Api\WebController;

Route::prefix('api')->group(function () {
    Route::get('/webs', [WebController::class, 'index']);       // Listar todos los websites
    Route::post('/webs', [WebController::class, 'store']);      // Crear un nuevo website
    Route::get('/webs/{id}', [WebController::class, 'show']);    // Mostrar un website específico
    Route::put('/webs/{id}', [WebController::class, 'update']);  // Actualizar un website específico
    Route::delete('/webs/{id}', [WebController::class, 'destroy']); // Eliminar un website específico
});
