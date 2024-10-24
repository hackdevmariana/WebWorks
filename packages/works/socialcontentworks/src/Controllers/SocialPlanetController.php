<?php
namespace Works\Socialcontentworks\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Works\Socialcontentworks\Models\SocialPlanet;
use Works\Socialcontentworks\Controllers\YouTubeController;

class SocialPlanetController extends Controller
{
    protected $youtubeController;

    public function __construct(YouTubeController $youtubeController)
    {
        $this->youtubeController = $youtubeController;
    }

    public function show($slug)
    {
        // Obtener el planeta social por el slug
        $planet = SocialPlanet::where('slug', $slug)->firstOrFail();

        // Filtrar cuentas por plataforma
        $youtubeAccounts = $this->filterAccountsByPlatform($planet->accounts, 'youtube.com');
        $twitterAccounts = $this->filterAccountsByPlatform($planet->accounts, 'x.com');
        $instagramAccounts = $this->filterAccountsByPlatform($planet->accounts, 'instagram.com');

        // Obtener datos de YouTube
        $youtubeData = $this->youtubeController->fetchContent($youtubeAccounts);

        // Placeholder para futuras integraciones
        $twitterData = [];
        $instagramData = [];

        // Combinar todos los resultados
        $allContent = array_merge($youtubeData, $twitterData, $instagramData);

        // Ordenar por fecha de publicación o relevancia
        usort($allContent, function ($a, $b) {
            return strtotime($b['published_at']) - strtotime($a['published_at']);
        });

        // Devolver la respuesta con el contenido combinado
        return response()->json($allContent);
    }

    private function filterAccountsByPlatform($accounts, $platform)
    {
        return array_filter($accounts, function ($account) use ($platform) {
            return strpos($account, $platform) !== false;
        });
    }
}
