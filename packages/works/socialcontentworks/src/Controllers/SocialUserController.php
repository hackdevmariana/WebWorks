<?php


namespace Works\Socialcontentworks\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Works\Socialcontentworks\Models\SocialUser;


class SocialUserController extends Controller
{
    // Obtener todos los usuarios
    public function index()
    {
        return response()->json(SocialUser::all(), 200);
    }

    // Obtener un usuario específico por ID
    public function show($id)
    {
        $user = SocialUser::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user, 200);
    }

    // Crear un nuevo usuario
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:social_users',
            // Agrega más validaciones
        ]);

        $user = SocialUser::create($validatedData);

        return response()->json($user, 201);
    }

    // Actualizar un usuario existente
    public function update(Request $request, $id)
    {
        $user = SocialUser::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:social_users,email,' . $id,
            // Otras validaciones
        ]);

        $user->update($validatedData);

        return response()->json($user, 200);
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $user = SocialUser::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
