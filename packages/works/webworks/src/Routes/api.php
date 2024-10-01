<?php

use Illuminate\Support\Facades\Route;
use Works\Webworks\Controllers\Api\WebsiteController;
use Works\Webworks\Controllers\Api\CustomMenuController;
use Works\Webworks\Controllers\Api\ErrorPageController;
use Works\Webworks\Controllers\Api\SectionHeadingController;
use Works\Webworks\Controllers\Api\SocialNetworkController;

Route::group(['prefix' => 'api/v1'], function () {
    Route::get('webworks-test', function () {
        return response()->json(['message' => 'Congratulations! WebWorks is up and running!']);
    });

    Route::get('websites/{name}/data', [WebsiteController::class, 'getHome']);

    Route::prefix('websites/{name}/menus')->group(function () {
        Route::get('/', [CustomMenuController::class, 'index']);
        Route::get('/{menu_id}', [CustomMenuController::class, 'show']);
    });

    Route::prefix('websites/{name}/error')->group(function () {
        Route::get('/', [ErrorPageController::class, 'index']);
        Route::get('/{error_number}', [ErrorPageController::class, 'show']);
    });
    
    Route::prefix('websites/{name}/heading')->group(function () {
        Route::get('/', [SectionHeadingController::class, 'index']);
        Route::get('/{headingName}', [SectionHeadingController::class, 'show']);
    });

    Route::prefix('websites/{name}/socialnetworks')->group(function () {
        Route::get('/', [SocialNetworkController::class, 'index']);
        Route::get('/{socialnetwork}', [SocialNetworkController::class, 'show']);
    });
});
