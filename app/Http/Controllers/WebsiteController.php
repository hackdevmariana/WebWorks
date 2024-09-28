<?php

namespace App\Http\Controllers;

use App\Models\Website; // Importar el modelo Website
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function getHome($id)
    {
        $website = Website::findOrFail($id); // Utiliza el modelo Website correctamente
        return response()->json(['home' => $website->home]);
    }
}

