<?php

use Works\Quoteworks\Controllers\QuoteAuthorController;
use Works\Biolinkworks\Controllers\BioLinkController;

Route::prefix('api/v1/biolinks')->group(function () {
    Route::get('/users', [BioLinkController::class, 'listUsers']);
    Route::get('/user/{username}', [BioLinkController::class, 'getUser']);
    Route::get('/tops', [BioLinkController::class, 'topUsers']);
    Route::get('/categories', [BioLinkController::class, 'listCategories']);
    Route::get('/category/{categorySlug}', [BioLinkController::class, 'getCategoryUsers']);
    Route::get('/subcategories', [BioLinkController::class, 'listSubcategories']);
    Route::get('/subcategory/{subcategorySlug}', [BioLinkController::class, 'getSubcategoryUsers']);
    Route::get('/tags', [BioLinkController::class, 'listTags']);
    Route::get('/tag/{tagSlug}', [BioLinkController::class, 'getTagUsers']);
    Route::get('/top-tag/{tagSlug}', [BioLinkController::class, 'topTagUsers']);
    Route::get('/top-category/{categorySlug}', [BioLinkController::class, 'topCategoryUsers']);
    Route::get('/top-subcategory/{subcategorySlug}', [BioLinkController::class, 'topSubcategoryUsers']);
});
