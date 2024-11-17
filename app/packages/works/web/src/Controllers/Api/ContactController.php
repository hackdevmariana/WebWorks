<?php

namespace Works\Web\Controllers\Api;


use Works\Web\Models\Web;
use Works\Web\Models\Contact;
use App\Http\Controllers\Controller;


class ContactController extends Controller
{
    public function show($webSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        $contacts = $web->contacts;

        return response()->json($contacts);
    }

    public function showContact($webSlug, $contactSlug)
    {
        $web = Web::where('slug', $webSlug)->firstOrFail();
        $contact = $web->contacts()->where('slug', $contactSlug)->firstOrFail();

        return response()->json($contact);
    }
}
