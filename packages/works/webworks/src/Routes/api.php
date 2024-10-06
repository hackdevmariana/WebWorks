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
use Works\Webworks\Controllers\Api\NewsController;
use Works\Webworks\Controllers\Api\PostsController;
use Works\Webworks\Controllers\Api\HeroController;
use Works\Webworks\Controllers\Api\CarouselController;
use Works\Webworks\Controllers\Api\GalleryController;
use Works\Webworks\Controllers\Api\CallToActionController;
use Works\Webworks\Controllers\Api\ImageController;
use Works\Webworks\Controllers\Api\StringController;
use Works\Webworks\Controllers\Api\ContentController;

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

    // New routes for Hero, News and Posts
    Route::prefix('websites/{websiteName}/hero')->group(function () {
        Route::get('/', [HeroController::class, 'index']);
        Route::get('/{heroItemName}', [HeroController::class, 'show']);
    });

    Route::prefix('websites/{websiteName}/news')->group(function () {
        Route::get('/', [NewsController::class, 'index']);
        Route::get('/{slug}', [NewsController::class, 'show']);
        Route::get('/tag/{tag}', [NewsController::class, 'filterByTag']);
        Route::get('/filter', [NewsController::class, 'index']); // To handle filtering by date
    });

    Route::prefix('websites/{websiteName}/posts')->group(function () {
        Route::get('/', [PostsController::class, 'index']);
        Route::get('/{slug}', [PostsController::class, 'show']);
        Route::get('/tag/{tag}', [PostsController::class, 'filterByTag']);
        Route::get('/filter', [PostsController::class, 'index']); // To handle filtering by date
    });

    // Routes for sections repeated several times on a website
    Route::prefix('websites/{websiteName}/contents')->group(function () {
        Route::get('/', [ContentController::class, 'index']);
        Route::get('/{contentName}', [ContentController::class, 'show']);
        Route::get('/item/{contentItemName}', [ContentController::class, 'showItem']);
        Route::get('/filter', [ContentController::class, 'index']); // To handle generic filtering 
    });

    Route::prefix('websites/{websiteName}/galleries')->group(function () {
        Route::get('/', [GalleryController::class, 'index']);
        Route::get('/{galleryName}', [GalleryController::class, 'show']);
        Route::get('/item/{galleryItemName}', [GalleryController::class, 'showItem']);
    });

    Route::prefix('websites/{websiteName}/carousels')->group(function () {
        Route::get('/', [CarouselController::class, 'index']);
        Route::get('/{carouselName}', [CarouselController::class, 'show']);
        Route::get('/item/{carouselItemName}', [CarouselController::class, 'showItem']);
    });

    Route::prefix('websites/{websiteName}/calltoaction')->group(function () {
        Route::get('/', [CallToActionController::class, 'index']);
        Route::get('/{calltoactionName}', [CallToActionController::class, 'show']);
    });

    Route::prefix('websites/{websiteName}/strings')->group(function () {
        Route::get('/', [StringController::class, 'index']);
        Route::get('/{stringName}', [StringController::class, 'show']);
    });

    Route::prefix('websites/{websiteName}/images')->group(function () {
        Route::get('/', [ImageController::class, 'index']);
        Route::get('/{imageName}', [ImageController::class, 'show']);
    });

    // Generic endpoint for 'contents'
    Route::get('websites/{websiteName}/contents/filter', [ContentController::class, 'filterByType']);
});
