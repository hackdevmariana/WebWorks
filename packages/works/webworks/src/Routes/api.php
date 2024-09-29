<?php

use Illuminate\Support\Facades\Route;
use Works\Webworks\Http\Controllers\Api\WebsiteController;
use Works\Webworks\Http\Controllers\Api\CustomMenuController;
use Works\Webworks\Http\Controllers\Api\ErrorPageController;


Route::group(['prefix' => 'api/v1', 'namespace' => 'Works\Webworks\Http\Controllers'], function () {
    Route::get('webworks-test', function () {
        return response()->json(['message' => 'Congratulations! WebWorks is up and running!']);
    });

    Route::get('websites/{name}/data', [WebsiteController::class, 'getHome']);

    Route::prefix('websites/{name}/menus')->group(function () {
        // Obtener todos los menús de una página web
        Route::get('/', [CustomMenuController::class, 'index']);
        // Obtener un menú específico por ID
        Route::get('/{menu_id}', [CustomMenuController::class, 'show']);
    });
    Route::prefix('websites/{name}/error')->group(function () {
        // Obtener una página de error personalizada por número de error
        Route::get('/{error_number}', [ErrorPageController::class, 'show']);
    });
});


