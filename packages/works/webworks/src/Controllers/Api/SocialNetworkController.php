<?php

namespace Works\Webworks\Controllers\Api;


use App\Http\Controllers\Controller;
use Works\Webworks\Models\Website;
use Works\Webworks\Models\SocialNetwork;
use Illuminate\Http\JsonResponse;

class SocialNetworkController extends Controller
{
    /**
     * Obtener todas las redes sociales de un website por nombre de web.
     */
    public function index($name): JsonResponse
    {
        // Encontrar el website por nombre
        $website = Website::where('web', $name)->first();

        if (!$website) {
            return response()->json(['error' => 'Website not found'], 404);
        }

        // Obtener todas las redes sociales asociadas
        $socialNetworks = SocialNetwork::where('website_id', $website->id)->get();

        return response()->json($socialNetworks, 200);
    }

    /**
     * Obtener una red social específica por nombre del website y la red social.
     */
    public function show($name, $socialnetwork): JsonResponse
    {
        // Encontrar el website por nombre
        $website = Website::where('web', $name)->first();

        if (!$website) {
            return response()->json(['error' => 'Website not found'], 404);
        }

        // Encontrar la red social específica por website_id y nombre de red social
        $socialNetwork = SocialNetwork::where([
            ['website_id', $website->id],
            ['socialnetwork', $socialnetwork]
        ])->first();

        if (!$socialNetwork) {
            return response()->json(['error' => 'Social network not found'], 404);
        }

        return response()->json($socialNetwork, 200);
    }
}
