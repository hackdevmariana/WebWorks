<?php

use Illuminate\Support\Facades\Route;
use Filament\Facades\Filament;

use Works\Web\Models\Web;

use Works\Web\Controllers\Api\CssController;

Route::get('/css/{webSlug}/custom-values.css', [CssController::class, 'customValues'])->name('css.custom-values');


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
