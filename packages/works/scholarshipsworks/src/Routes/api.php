<?php

use Illuminate\Support\Facades\Route;

Route::get('/scholarships', function () {
    return response()->json(['message' => 'Hello from Scholarships Works!']);
});
