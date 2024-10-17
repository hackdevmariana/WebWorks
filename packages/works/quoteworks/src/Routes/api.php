<?php

use Works\Quoteworks\Controllers\QuoteAuthorController;

Route::prefix('api/v1')->group(function () {
    Route::get('authors', [QuoteAuthorController::class, 'index']); 
    Route::get('author/{slug}', [QuoteAuthorController::class, 'show']);
    Route::get('author/{slug}/books', [QuoteAuthorController::class, 'books']);
    Route::get('author/{slug}/social-media', [QuoteAuthorController::class, 'socialMedia']);
    Route::get('author/{slug}/birth', [QuoteAuthorController::class, 'birth']);
    Route::get('author/{slug}/death', [QuoteAuthorController::class, 'death']);
    Route::get('author/{slug}/relations', [QuoteAuthorController::class, 'relations']);
    Route::get('author/{slug}/collaborations', [QuoteAuthorController::class, 'collaborations']);
    Route::get('author/{slug}/related-authors', [QuoteAuthorController::class, 'relatedAuthors']);
    Route::get('author/{slug}/tags', [QuoteAuthorController::class, 'tags']);
    Route::get('author/{slug}/school', [QuoteAuthorController::class, 'school']);
});
