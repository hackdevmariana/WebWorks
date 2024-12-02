<?php

use Illuminate\Support\Facades\Route;
use Filament\Facades\Filament;

use Works\Web\Models\Web;

Route::get('/css/{webSlug}/custom-values.css', function ($webSlug) {
    $web = Web::where('slug', $webSlug)->firstOrFail();
    $variables = $web->cssVariables; // Relación que almacenará las variables de CSS

    return response()
        ->view('css.variables', compact('variables'))
        ->header('Content-Type', 'text/css');
})->name('css.custom-values');



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
