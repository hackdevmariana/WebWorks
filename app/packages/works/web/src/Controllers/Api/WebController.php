<?php

namespace Works\Web\Controllers\Api;

use Works\Web\Models\Web;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    /**
     * Display a listing of the websites.
     */
    public function index()
    {
        return response()->json(Web::all(), 200);
    }

    /**
     * Store a newly created website in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'url' => 'required|url|unique:webs,url',
            'home' => 'nullable|url',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string|max:255',
            'favicon' => 'nullable|url',
        ]);

        $web = Web::create($validatedData);

        return response()->json($web, 201);
    }

    /**
     * Display the specified website.
     */
    public function show($id)
    {
        $web = Web::findOrFail($id);

        return response()->json($web, 200);
    }

    /**
     * Update the specified website in storage.
     */
    public function update(Request $request, $id)
    {
        $web = Web::findOrFail($id);

        $validatedData = $request->validate([
            'url' => 'required|url|unique:webs,url,' . $id,
            'home' => 'nullable|url',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string|max:255',
            'favicon' => 'nullable|url',
        ]);

        $web->update($validatedData);

        return response()->json($web, 200);
    }

    /**
     * Remove the specified website from storage.
     */
    public function destroy($id)
    {
        $web = Web::findOrFail($id);
        $web->delete();

        return response()->json(['message' => 'Website deleted successfully'], 200);
    }
}
