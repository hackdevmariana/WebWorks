<?php

use Works\Dictionaryworks\Controllers\DictionaryTermController;
use Works\Dictionaryworks\Controllers\DictionarySubjectController;

Route::prefix('api/v1')->group(function () {
    Route::get('/list/subjects', [DictionarySubjectController::class, 'index']);
    Route::get('/subjects/{subject}/populars', [DictionarySubjectController::class, 'populars']);
    Route::get('/subjects/{subject}/latest', [DictionarySubjectController::class, 'latest']);
});



Route::prefix('api/v1/terms')->group(function () {
    Route::get('/terms', [DictionaryTermController::class, 'index']);
    Route::get('/approved', [DictionaryTermController::class, 'approved']);
    Route::get('/pending', [DictionaryTermController::class, 'pending']);
    Route::get('/rejected', [DictionaryTermController::class, 'rejected']);
    Route::get('/initial/{letter}', [DictionaryTermController::class, 'getByInitial']);
    Route::get('/populars', [DictionaryTermController::class, 'populars']);
    Route::get('/latest', [DictionaryTermController::class, 'latest']);
    
    // Las rutas que usan `{term}` deben ir al final
    Route::get('definition/{term}', [DictionaryTermController::class, 'show']);
    Route::get('definition/{term}/synonyms', [DictionaryTermController::class, 'synonyms']);
    Route::get('definition/{term}/antonyms', [DictionaryTermController::class, 'antonyms']);
    Route::get('definition/{term}/hyponyms', [DictionaryTermController::class, 'hyponyms']);
    Route::get('definition/{term}/hypernyms', [DictionaryTermController::class, 'hypernyms']);
    Route::get('definition/{term}/related-terms', [DictionaryTermController::class, 'relatedTerms']);
    Route::get('definition/{term}/history', [DictionaryTermController::class, 'history']);
    Route::get('definition/{term}/suggestions', [DictionaryTermController::class, 'suggestions']);
});
