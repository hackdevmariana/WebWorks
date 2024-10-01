<?php

namespace Works\Webworks\Controllers\Api;

use Illuminate\Http\Request;
use Works\Webworks\Models\Website;
use Works\Webworks\Models\Contact;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index($websiteName)
    {
        // Busca el sitio web utilizando el nombre
        $website = Website::where('web', $websiteName)->firstOrFail();

        // Obtiene los contactos asociados al sitio web
        $contact = Contact::where('website_id', $website->id)->firstOrFail();

        // Retorna los datos del contacto en formato JSON
        return response()->json($contact);
    }
}
