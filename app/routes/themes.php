<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::get('/theme/{theme}', function ($theme) {
        // Cambia la lógica de selección de tema según tu implementación
        session(['theme' => $theme]);
        return back()->with('message', "Theme changed to {$theme}");
    })->name('theme.change');
});
