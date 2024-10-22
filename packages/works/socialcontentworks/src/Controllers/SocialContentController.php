<?php

namespace Works\Socialcontentworks\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Works\Socialcontentworks\Models\SocialContent;

class SocialContentController extends Controller
{
    // Obtener todos los contenidos
    public function index()
    {
        return response()->json(SocialContent::all(), 200);
    }

    // Obtener un contenido por ID
    public function show($id)
    {
        $content = SocialContent::find($id);

        if (!$content) {
            return response()->json(['error' => 'Content not found'], 404);
        }

        return response()->json($content, 200);
    }

    // Crear un nuevo contenido
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            // Agrega otras validaciones necesarias
        ]);

        $content = SocialContent::create($validatedData);

        return response()->json($content, 201);
    }

    // Actualizar un contenido existente
    public function update(Request $request, $id)
    {
        $content = SocialContent::find($id);

        if (!$content) {
            return response()->json(['error' => 'Content not found'], 404);
        }

        $validatedData = $request->validate([
            'title' => 'sometimes|string|max:255',
            'body' => 'sometimes|string',
            // Agrega otras validaciones necesarias
        ]);

        $content->update($validatedData);

        return response()->json($content, 200);
    }

    // Eliminar un contenido
    public function destroy($id)
    {
        $content = SocialContent::find($id);

        if (!$content) {
            return response()->json(['error' => 'Content not found'], 404);
        }

        $content->delete();

        return response()->json(['message' => 'Content deleted successfully'], 200);
    }

    // Buscar contenidos por palabra clave
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json(['error' => 'Query parameter is required'], 400);
        }

        $contents = SocialContent::where('title', 'LIKE', "%{$query}%")
                                 ->orWhere('body', 'LIKE', "%{$query}%")
                                 ->get();

        return response()->json($contents, 200);
    }
}
