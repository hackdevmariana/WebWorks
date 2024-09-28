<?php

use Illuminate\Support\Facades\Route;
use Works\Webworks\Http\Controllers\WebsiteController;

Route::group(['namespace' => 'Works\Webworks\Http\Controllers'], function () {
    Route::get('website/{id}/home', [WebsiteController::class, 'getHome']);
});
