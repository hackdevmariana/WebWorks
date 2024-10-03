<?php

use Illuminate\Support\Facades\Route;
use Works\Webworks\Controllers\Api\WebsiteController;
use Works\Webworks\Controllers\Api\CustomMenuController;
use Works\Webworks\Controllers\Api\ErrorPageController;
use Works\Webworks\Controllers\Api\SectionHeadingController;
use Works\Webworks\Controllers\Api\SocialNetworkController;
use Works\Webworks\Controllers\Api\CopyController;
use Works\Webworks\Controllers\Api\ContactController;
use Works\Webworks\Controllers\Api\DevelopedController;
use Works\Webworks\Controllers\Api\VideoController;



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

    Route::prefix('websites/{name}/copy')->group(function () {
        Route::get('/', [CopyController::class, 'index']);
        Route::get('/{copyName}', [CopyController::class, 'show']);
    });

    Route::prefix('websites/{websiteName}/contact')->group(function () {
        Route::get('/', [ContactController::class, 'index']);
    });

    Route::prefix('websites/{websiteName}/developed')->group(function () {
        Route::get('/', [DevelopedController::class, 'index']);
        Route::get('/{developedName}', [DevelopedController::class, 'show']);
    });
    

    Route::prefix('websites/{websiteName}/video')->group(function () {
        Route::get('/', [VideoController::class, 'index']);
        Route::get('/{videoName}', [VideoController::class, 'show']);
    });


});
