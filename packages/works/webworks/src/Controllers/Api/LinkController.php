<?php

namespace Works\Webworks\Controllers\Api;

use Works\Webworks\Models\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    public function index()
    {
        return Link::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'website_id' => 'required|exists:websites,id',
            'text' => 'required|string|max:255',
            'url' => 'required|url',
            'icon' => 'nullable|string|max:255',
        ]);

        return Link::create($request->all());
    }

    public function show($id)
    {
        return Link::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $link = Link::findOrFail($id);
        $link->update($request->all());
        return $link;
    }

    public function destroy($id)
    {
        Link::destroy($id);
        return response()->noContent();
    }
}
