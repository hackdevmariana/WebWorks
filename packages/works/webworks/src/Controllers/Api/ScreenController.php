<?php

namespace Works\Webworks\Controllers\Api;

use Works\Webworks\Models\Screen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScreenController extends Controller
{
    public function index()
    {
        return Screen::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'website_id' => 'required|exists:websites,id',
            'screen' => 'required|string|max:255',
            'width' => 'required|integer',
        ]);

        return Screen::create($request->all());
    }

    public function show($id)
    {
        return Screen::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $screen = Screen::findOrFail($id);
        $screen->update($request->all());
        return $screen;
    }

    public function destroy($id)
    {
        Screen::destroy($id);
        return response()->noContent();
    }
}
