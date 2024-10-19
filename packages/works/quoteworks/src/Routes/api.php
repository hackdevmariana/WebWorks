<?php

use Works\Quoteworks\Controllers\QuoteAuthorController;
use Works\Quoteworks\Controllers\QuoteQuoteController;
use Works\Quoteworks\Controllers\QuoteBookController;
use Works\Quoteworks\Controllers\QuoteSchoolController;
use Works\Quoteworks\Controllers\QuoteDisciplineController;
use Works\Quoteworks\Controllers\QuoteSearchController;

Route::prefix('api/v1/quotes')->group(function () {

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

    Route::get('quote/', [QuoteQuoteController::class, 'randomQuote']);
    Route::get('quote/author/{author}/', [QuoteQuoteController::class, 'randomQuoteByAuthor']);
    Route::get('quote/slug/{slug}', [QuoteQuoteController::class, 'show']);
    Route::get('quotes/author/{author}/', [QuoteQuoteController::class, 'quotesByAuthor']);
    Route::get('quotes/tags/{tag}', [QuoteQuoteController::class, 'quotesByTag']);
    Route::get('top', [QuoteQuoteController::class, 'topQuotes']);

    Route::get('books/', [QuoteBookController::class, 'index']);
    Route::get('book/{book}', [QuoteBookController::class, 'show']);
    Route::get('book/{book}/author', [QuoteBookController::class, 'authors']);
    Route::get('book/{book}/quote', [QuoteBookController::class, 'randomQuote']);
    Route::get('book/{book}/quotes', [QuoteBookController::class, 'quotes']);

    Route::get('school/{school}/', [QuoteSchoolController::class, 'show']);
    Route::get('school/{school}/authors', [QuoteSchoolController::class, 'authors']);
    Route::get('school/{school}/books', [QuoteSchoolController::class, 'books']);

    Route::get('discipline/{area_of_study}', [QuoteDisciplineController::class, 'show']);
    Route::get('discipline/{area_of_study}/authors', [QuoteDisciplineController::class, 'authors']);
    Route::get('discipline/{area_of_study}/books', [QuoteDisciplineController::class, 'books']);

    Route::get('search/authors', [QuoteSearchController::class, 'searchAuthors']);
    Route::get('search/books', [QuoteSearchController::class, 'searchBooks']);

    Route::get('api-status/social-media', [QuoteController::class, 'socialMediaStatus']);
    Route::get('tags/', [QuoteController::class, 'tags']);
    Route::get('tags/{tag}', [QuoteController::class, 'tagDetails']);
    Route::get('books-tags/{tag}', [QuoteController::class, 'booksByTag']);
    Route::get('authors-tags/{tag}', [QuoteController::class, 'authorsByTag']);
    Route::get('quotes-tags/{tag}', [QuoteController::class, 'quotesByTag']);
});
