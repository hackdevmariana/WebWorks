<?php

use Illuminate\Support\Facades\Route;
use Works\Web\Controllers\Api\WebController;
use Works\Web\Controllers\Api\AuthorController;
use Works\Web\Controllers\Api\ContactController;
use Works\Web\Controllers\Api\ContentController;
use Works\Web\Controllers\Api\CopyController;
use Works\Web\Controllers\Api\DevelopedController;
use Works\Web\Controllers\Api\ErrorPageController;
use Works\Web\Controllers\Api\LinkController;
use Works\Web\Controllers\Api\LogoController;
use Works\Web\Controllers\Api\HeadlineController;
use Works\Web\Controllers\Api\SocialNetworkController;
use Works\Web\Controllers\Api\VideoController;
use Works\Web\Controllers\Api\PlaylistController;
use Works\Web\Controllers\Api\QuestionAnswerController;
use Works\Web\Controllers\Api\FAQController;
use Works\Web\Controllers\Api\CustomMenuController;
use Works\Web\Controllers\Api\CarouselController;
use Works\Web\Controllers\Api\GalleryController;
use Works\Web\Controllers\Api\FeaturedContentController;




Route::prefix('api/v1')->group(function () {
    // Global endpoints
    Route::get('webs', [WebController::class, 'index']);
    Route::get('webs/{webSlug}', [WebController::class, 'showBySlug']);

    Route::prefix('webs/{webSlug}')->group(function () {
        // Authors
        Route::get('authors', [AuthorController::class, 'index']);
        Route::get('authors/{authorSlug}', [AuthorController::class, 'show']);

        // Contacts
        Route::get('contact', [ContactController::class, 'show']);
        Route::get('contact/{contactSlug}', [ContactController::class, 'showContact']);

        // Contents
        Route::get('content', [ContentController::class, 'index']);
        Route::get('content/{contentSlug}', [ContentController::class, 'show']);
    });


    
    Route::get('/webs/{webSlug}/copy', [CopyController::class, 'index']);
    Route::get('/webs/{webSlug}/copy/{copySlug}', [CopyController::class, 'show']);
    Route::get('/webs/{webSlug}/developed', [DevelopedController::class, 'index']);
    Route::get('/webs/{webSlug}/developed/{developedSlug}', [DevelopedController::class, 'show']);
    Route::get('/webs/{webSlug}/errorpages', [ErrorPageController::class, 'index']);
    Route::get('/webs/{webSlug}/errorpages/{errorNumber}', [ErrorPageController::class, 'show']);
    Route::get('/webs/{webSlug}/links', [LinkController::class, 'index']);
    Route::get('/webs/{webSlug}/links/{linkSlug}', [LinkController::class, 'show']);
    Route::get('/webs/{webSlug}/logos', [LogoController::class, 'index']);
    Route::get('/webs/{webSlug}/logos/{logoSlug}', [LogoController::class, 'show']);
    Route::get('/webs/{webSlug}/headlines', [HeadlineController::class, 'index']);
    Route::get('/webs/{webSlug}/headlines/{headlineSlug}', [HeadlineController::class, 'show']);
    Route::get('/webs/{webSlug}/videos', [VideoController::class, 'index']);
    Route::get('/webs/{webSlug}/videos/{videoSlug}', [VideoController::class, 'show']);
    Route::get('/webs/{webSlug}/playlists', [PlaylistController::class, 'index']);
    Route::get('/webs/{webSlug}/playlists/{playlistSlug}', [PlaylistController::class, 'show']);
    Route::get('/webs/{webSlug}/questions', [QuestionAnswerController::class, 'index']);
    Route::get('/webs/{webSlug}/questions/categories', [QuestionAnswerController::class, 'categories']);
    Route::get('/webs/{webSlug}/questions/categories/{category}', [QuestionAnswerController::class, 'questionsByCategory']);
    Route::get('/webs/{webSlug}/questions/{questionanswerSlug}', [QuestionAnswerController::class, 'show']);
    Route::get('/webs/{webSlug}/faqs', [FAQController::class, 'index']);
    Route::get('/webs/{webSlug}/faqs/{faqSlug}', [FAQController::class, 'show']);
    Route::get('/webs/{webSlug}/menus', [CustomMenuController::class, 'index']);
    Route::get('/webs/{webSlug}/menus/{menuSlug}', [CustomMenuController::class, 'show']);
    Route::get('/webs/{webSlug}/carousels', [CarouselController::class, 'index']);
    Route::get('/webs/{webSlug}/carousels/{carouselSlug}', [CarouselController::class, 'show']);
    Route::get('/webs/{webSlug}/galleries', [GalleryController::class, 'index']);
    Route::get('/webs/{webSlug}/galleries/{gallerySlug}', [GalleryController::class, 'show']);
    Route::get('/webs/{webSlug}/featured-contents', [FeaturedContentController::class, 'index']);
    Route::get('/webs/{webSlug}/featured-contents/{contentSlug}', [FeaturedContentController::class, 'show']);

});
