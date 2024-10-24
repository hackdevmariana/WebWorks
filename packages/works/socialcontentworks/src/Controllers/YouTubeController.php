<?php
namespace Works\Socialcontentworks\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class YouTubeController extends Controller
{

    const YOUTUBE_API_BASE_URL = 'https://www.googleapis.com/youtube/v3';
    /**
     * Realiza una solicitud a la API de YouTube.
     *
     * @param string $endpoint
     * @param array $params
     * @return mixed
     */

    protected function makeApiRequest($endpoint, $params = [])
    {
        $apiKey = env('YOUTUBE_API_KEY');
        $params['key'] = $apiKey; // Add the API key to the parameters
        $url = self::YOUTUBE_API_BASE_URL . $endpoint; // Construct the full URL
        $response = Http::get($url, $params);

        return $this->handleApiResponse($response);
    }



    /**
     * Formatea el nombre del canal, agregando "@" si es necesario.
     *
     * @param string $channel
     * @return string
     */
    private function formatChannelName($channel)
    {
        return strpos($channel, '@') !== 0 ? '@' . $channel : $channel;
    }


    /**
     * Verifica si un video es considerado un 'Short'.
     *
     * @param array $video
     * @return bool
     */
    private function isShort($video)
    {
        return (new \DateTime($video['duration']))->getTimestamp() <= 60;
    }


    /**
     * Maneja la respuesta de la API, retornando los datos o manejando los errores.
     *
     * @param \Illuminate\Http\Client\Response $response
     * @return mixed
     */
    protected function handleApiResponse($response)
    {
        if ($response->failed()) {
            // Verifica el estado y maneja el error
            $errorData = $response->json();

            if (isset($errorData['error']['code']) && $errorData['error']['code'] == 403) {
                // Manejo específico para el error de cuota
                return response()->json(['error' => 'Quota exceeded or API key invalid. Please check your API settings.'], 403);
            }

            // Manejo de otros errores
            return response()->json(['error' => 'An error occurred'], $response->status());
        }

        return $response->json();
    }



    /**
     * Procesa y filtra los videos según el tipo y límite.
     *
     * @param array $items
     * @param string|null $type
     * @param int|null $limit
     * @return array
     */
    private function processVideos($items, $type = null, $limit = null)
    {
        $videos = array_map(function ($item) {
            return [
                'videoId' => $item['id']['videoId'],
                'title' => $item['snippet']['title'],
                'description' => $item['snippet']['description'],
                'publishedAt' => $item['snippet']['publishedAt'],
                'thumbnails' => $item['snippet']['thumbnails'],
                'link' => 'https://www.youtube.com/watch?v=' . $item['id']['videoId'],
            ];
        }, $items);

        // Filtrar por tipo (Shorts o no-Shorts)
        if ($type === 'shorts') {
            $videos = array_filter($videos, fn($video) => $this->isShort($video));
        } elseif ($type === 'no-shorts') {
            $videos = array_filter($videos, fn($video) => !$this->isShort($video));
        }

        // Limitar el número de resultados si se especifica
        return $limit ? array_slice($videos, 0, $limit) : $videos;
    }


    /**
     * Consulta información de un canal basado en su nombre.
     *
     * @param string $channel
     * @return \Illuminate\Http\JsonResponse
     */
    public function testChannel($channel)
    {
        $channel = $this->formatChannelName($channel);
        return $this->makeApiRequest('/search', [
            'part' => 'snippet',
            'q' => $channel,
            'type' => 'channel',
            'maxResults' => 1,
        ]);
    }


    public function test()
    {
        return $this->makeApiRequest('https://www.googleapis.com/youtube/v3/search', [
            'part' => 'snippet',
            'q' => '@Derivando',  // Incluye el handle con el "@" al hacer la búsqueda
            'type' => 'channel',
            'maxResults' => 1  // Para limitar a un solo resultado
        ]);

    }

    /**
     * Convierte el nombre del canal a su ID.
     *
     * @param string $channel
     * @return \Illuminate\Http\JsonResponse
     */
    public function getId($channel)
    {

        $response = $this->testChannel($channel);

        // Convierte la respuesta JSON en un array
        $responseData = $response->getData(true);

        // Verifica si el ID del canal está en la respuesta
        return isset($responseData['items'][0]['id']['channelId'])
            ? response()->json(['channelId' => $responseData['items'][0]['id']['channelId']])
            : response()->json(['error' => 'Channel ID not found'], 404);
    }


    public function infoChannel($channel)
    {
        $apiKey = env('YOUTUBE_API_KEY');

        // Realiza una búsqueda del canal para obtener el ID
        $searchResponse = $this->makeApiRequest('/search', [
            'part' => 'snippet',
            'q' => $channel,
            'type' => 'channel',
            'maxResults' => 1,
            'key' => $apiKey
        ]);

        // Verifica la respuesta de búsqueda
        $searchData = $searchResponse; // La respuesta ya es un array

        if (isset($searchData['items'][0])) {
            $channelId = $searchData['items'][0]['id']['channelId'];

            // Usa el ID del canal para obtener la información detallada
            $response = $this->makeApiRequest('/channels', [
                'part' => 'snippet,contentDetails,statistics,brandingSettings',
                'id' => $channelId,
                'key' => $apiKey
            ]);

            // Verifica la respuesta del canal
            $data = $response; // La respuesta ya es un array

            if (isset($data['items'][0])) {
                $item = $data['items'][0];

                // Obtener la descripción completa
                $description = $item['snippet']['description'] ?? 'N/A';

                // Extraer enlaces de la descripción
                $links = [];
                preg_match_all('/https?:\/\/[^\s]+/', $description, $links);

                // Opcional: Extraer enlaces de redes sociales
                $socialLinks = $this->extractSocialLinks($description);

                // Convertir el ID del trailer en una URL completa
                $unsubscribedTrailerId = $item['brandingSettings']['channel']['unsubscribedTrailer'] ?? null;
                $unsubscribedTrailerUrl = $unsubscribedTrailerId ? "https://www.youtube.com/watch?v={$unsubscribedTrailerId}" : 'N/A';

                return response()->json([
                    'regionCode' => $data['regionCode'] ?? 'N/A',
                    'channelId' => $item['id'] ?? 'N/A',
                    'publishedAt' => $item['snippet']['publishedAt'] ?? 'N/A',
                    'title' => $item['snippet']['title'] ?? 'N/A',
                    'description' => $description, // Descripción completa
                    'localizedDescription' => $item['localized']['description'] ?? 'N/A',
                    'links' => $links[0] ?? [], // Enlaces encontrados
                    'socialLinks' => $socialLinks, // Enlaces a redes sociales
                    'thumbnails' => [
                        'default' => $item['snippet']['thumbnails']['default']['url'] ?? 'N/A',
                        'medium' => $item['snippet']['thumbnails']['medium']['url'] ?? 'N/A',
                        'high' => $item['snippet']['thumbnails']['high']['url'] ?? 'N/A'
                    ],
                    'customUrl' => $item['snippet']['customUrl'] ?? 'N/A',
                    'country' => $item['snippet']['country'] ?? 'N/A',
                    'viewCount' => $item['statistics']['viewCount'] ?? 'N/A',
                    'subscriberCount' => $item['statistics']['subscriberCount'] ?? 'N/A',
                    'videoCount' => $item['statistics']['videoCount'] ?? 'N/A',
                    'relatedPlaylists' => $item['contentDetails']['relatedPlaylists'] ?? [],
                    'brandingSettings' => $item['brandingSettings'] ?? [],
                    'unsubscribedTrailer' => $unsubscribedTrailerUrl // Devuelve la URL completa del trailer
                ]);
            } else {
                return response()->json(['error' => 'Channel information not found'], 404);
            }
        } else {
            return response()->json(['error' => 'Channel not found'], 404);
        }
    }



    private function extractSocialLinks($description)
    {
        $socialLinks = [];

        // Aquí puedes buscar enlaces que sean de redes sociales comunes
        $socialPatterns = [
            'twitter' => '/(https?:\/\/twitter\.com\/[^\s]+)/',
            'facebook' => '/(https?:\/\/facebook\.com\/[^\s]+)/',
            'instagram' => '/(https?:\/\/instagram\.com\/[^\s]+)/',
            // Agrega más patrones según sea necesario
        ];

        foreach ($socialPatterns as $key => $pattern) {
            if (preg_match($pattern, $description, $matches)) {
                $socialLinks[$key] = $matches[0]; // Almacena el primer enlace encontrado para cada red social
            }
        }

        return $socialLinks;
    }





    /**
     * Obtiene detalles de un canal basado en su ID.
     *
     * @param string $channelId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChannelDetails($channelId)
    {
        return $this->makeApiRequest('/channels', [
            'part' => 'snippet,contentDetails,statistics',
            'id' => $channelId,
        ]);
    }



    /**
     * Get the channel ID by username.
     *
     * @param string $username
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChannelIdByUsername($username)
    {
        $response = $this->makeApiRequest('https://www.googleapis.com/youtube/v3/channels', [
            'part' => 'id',
            'forUsername' => $username
        ]);

        if (!empty($response['items'])) {
            return response()->json([
                'channelId' => $response['items'][0]['id']
            ]);
        } else {
            return response()->json(['error' => 'Channel not found'], 404);
        }
    }


    public function getChannelIdByNameData($channelName)
    {
        // Hacer una petición a la API de YouTube para buscar el canal por nombre
        $response = $this->makeApiRequest('/search', [
            'part' => 'snippet',
            'type' => 'channel',
            'q' => $channelName,
            'maxResults' => 1,
        ]);

        // Para depuración: Log de la respuesta completa
        \Log::info('YouTube API Response', ['response' => $response]);

        // Verificar si encontramos el canal
        if (!isset($response['items']) || empty($response['items'])) {
            // Si no se encuentra el canal, devolvemos null
            return null;
        }

        // Devolver el ID del canal
        return $response['items'][0]['id']['channelId'] ?? null;
    }


    public function getChannelIdByName($channelName)
    {
        // Hacer una petición a la API de YouTube para buscar el canal por nombre
        $response = $this->makeApiRequest('/search', [
            'part' => 'snippet',
            'type' => 'channel',
            'q' => $channelName,
            'maxResults' => 1,
        ]);

        // Para depuración: Log de la respuesta completa
        \Log::info('YouTube API Response', ['response' => $response]);

        // Verificar si encontramos el canal
        if (!isset($response['items']) || empty($response['items'])) {
            return response()->json(['error' => 'Channel not found'], 404);
        }

        // Devolver el ID del canal como JSON
        $channelId = $response['items'][0]['id']['channelId'] ?? null;

        return response()->json(['channelId' => $channelId], 200);
    }




    public function getChannelVideosByName($channelName)
{
    $response = $this->getChannelIdByName($channelName);

    // Verificamos si la respuesta es un array y contiene un error
    if (is_array($response) && isset($response['error'])) {
        return response()->json(['error' => 'Channel not found'], 404);
    }

    // Si la respuesta es un objeto JsonResponse, obtenemos los datos
    if ($response instanceof \Illuminate\Http\JsonResponse) {
        $responseData = $response->getData(true);

        if (isset($responseData['error'])) {
            return response()->json(['error' => 'Channel not found'], 404);
        }

        $channelId = $responseData['channelId'];
    } else {
        // Si no es un JsonResponse, asumimos que es el channelId directamente
        $channelId = $response;
    }

    // Llamamos a getChannelVideos para obtener los videos del canal
    return $this->getChannelVideos($channelId);
}






    /**
     * Obtiene los videos de un canal.
     *
     * @param string $channelId
     * @param string|null $type
     * @param int|null $limit
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChannelVideos($channelIdentifier, $type = null, $limit = null)
{
    // Verificamos si el identificador es un ID de canal o un nombre
    if (preg_match('/^[UC][A-Za-z0-9_-]{22}$/', $channelIdentifier)) {
        // Si el identificador parece ser un channelId
        $channelId = $channelIdentifier;
    } else {
        // Si no es un channelId, intentamos buscar el ID por nombre
        $channelId = $this->getChannelIdByName($channelIdentifier);

        // Manejo de errores si no se encuentra el canal
        if (is_array($channelId) && isset($channelId['error'])) {
            return response()->json(['error' => 'Channel not found'], 404);
        } elseif ($channelId instanceof \Illuminate\Http\JsonResponse) {
            $responseData = $channelId->getData(true);
            if (isset($responseData['error'])) {
                return response()->json(['error' => 'Channel not found'], 404);
            }
            $channelId = $responseData['channelId'];
        }
    }

    // Hacemos la petición a la API para obtener los vídeos
    $response = $this->makeApiRequest('/search', [
        'part' => 'snippet',
        'channelId' => $channelId,
        'order' => 'date',
        'type' => 'video',
        'maxResults' => 50,
    ]);

    // Asegurarse de que la respuesta sea válida
    if (!is_array($response) || !isset($response['items'])) {
        return response()->json(['error' => 'No videos found'], 404);
    }

    // Procesar los videos
    $videos = $this->processVideos($response['items'], $type, $limit);

    // Añadir información del canal a los videos
    foreach ($videos as &$video) {
        $video['channelId'] = $channelId;
        $video['channelTitle'] = $response['items'][0]['snippet']['channelTitle'] ?? null;
    }

    return response()->json($videos);
}



    /**
     * Obtiene el último video de un canal utilizando el nombre del canal.
     *
     * @param string $channelName
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLastChannelVideoByName($channelName)
    {
        // Obtiene el ID del canal a partir del nombre
        $channelId = $this->getChannelIdByNameData($channelName);

        // Verifica si obtuvimos el ID del canal
        if ($channelId) {
            // Llama a la API para obtener los últimos videos del canal usando el channelId
            return $this->getLastChannelVideo($channelId);
        } else {
            // Si no se encuentra el canal, devuelve un mensaje de error
            return response()->json(['error' => 'Channel ID not found'], 404);
        }
    }




    public function getChannelDetailedInfo($channel)
    {
        $channelId = $this->getChannelId($channel);

        if (!$channelId) {
            return response()->json(['error' => 'Channel not found'], 404);
        }

        $response = $this->makeApiRequest('https://www.googleapis.com/youtube/v3/channels', [
            'part' => 'snippet,statistics',
            'id' => $channelId
        ]);

        if (isset($response['items'][0])) {
            $snippet = $response['items'][0]['snippet'];
            $statistics = $response['items'][0]['statistics'];

            $channelInfo = [
                'regionCode' => $response['regionCode'] ?? 'N/A',
                'channelId' => $channelId,
                'publishedAt' => $snippet['publishedAt'],
                'title' => $snippet['title'],
                'description' => $snippet['description'],
                'thumbnails' => [
                    'default' => $snippet['thumbnails']['default']['url'],
                    'medium' => $snippet['thumbnails']['medium']['url'],
                    'high' => $snippet['thumbnails']['high']['url'],
                ],
                'statistics' => [
                    'subscriberCount' => $statistics['subscriberCount'] ?? 'N/A',
                    'videoCount' => $statistics['videoCount'] ?? 'N/A',
                    'viewCount' => $statistics['viewCount'] ?? 'N/A',
                ],
            ];

            return response()->json($channelInfo);
        } else {
            return response()->json(['error' => 'Channel information not available'], 404);
        }
    }




    public function getLastsChannelVideosByName($channelName, $number = 10)
    {
        // Obtener el ID del canal por nombre
        $response = $this->getChannelIdByName($channelName);

        // Verificar si se obtuvo una respuesta válida
        if ($response instanceof \Illuminate\Http\JsonResponse) {
            $responseData = $response->getData(true);

            // Si hubo un error al obtener el canal, devolver un mensaje de error
            if (isset($responseData['error'])) {
                return response()->json(['error' => 'Channel not found'], 404);
            }

            // Obtener el ID del canal
            $channelId = $responseData['channelId'];

            // Obtener los videos del canal utilizando el ID
            return $this->getChannelVideos($channelId, null, $number);
        }

        // Si no se encontró el canal, devolver un error 404
        return response()->json(['error' => 'Channel not found'], 404);
    }



    /**
     * Obtiene el último video de un canal utilizando el ID del canal.
     *
     * @param string $channelId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLastChannelVideo($channelId)
{
    // Llama a la API para obtener los últimos videos del canal
    $response = $this->makeApiRequest('/search', [
        'part' => 'snippet',
        'channelId' => $channelId,
        'order' => 'date',
        'type' => 'video',
        'maxResults' => 1, // Solo queremos el video más reciente
    ]);

    // Verifica si la respuesta contiene videos
    if (isset($response['items'][0])) {
        $video = $response['items'][0];
        $videoId = $video['id']['videoId'];

        // Segunda llamada a la API para obtener detalles del video
        $videoDetailsResponse = $this->makeApiRequest('/videos', [
            'part' => 'snippet,statistics,contentDetails',
            'id' => $videoId,
        ]);

        // Verifica si la respuesta contiene detalles del video
        if (isset($videoDetailsResponse['items'][0])) {
            $videoDetails = $videoDetailsResponse['items'][0];

            // Devuelve la información del video más reciente
            return response()->json([
                'videoId' => $videoDetails['id'],
                'title' => $videoDetails['snippet']['title'],
                'description' => $videoDetails['snippet']['description'],
                'publishedAt' => $videoDetails['snippet']['publishedAt'],
                'thumbnails' => $videoDetails['snippet']['thumbnails'],
                'link' => 'https://www.youtube.com/watch?v=' . $videoDetails['id'],
                'viewCount' => $videoDetails['statistics']['viewCount'] ?? 0,
                'likeCount' => $videoDetails['statistics']['likeCount'] ?? 0,
                'duration' => $videoDetails['contentDetails']['duration'] ?? 'N/A',
                'keywords' => $videoDetails['snippet']['tags'] ?? [],
            ]);
        } else {
            // Si no se encuentra información detallada del video, devuelve un mensaje de error
            return response()->json(['error' => 'Video details not found'], 404);
        }
    } else {
        // Si no se encuentra ningún video, devuelve un mensaje de error
        return response()->json(['error' => 'No videos found'], 404);
    }
}

public function getVideoDetailsById($videoId)
{
    // Realiza una llamada a la API para obtener detalles del video
    $response = $this->makeApiRequest('/videos', [
        'part' => 'snippet,statistics,contentDetails',
        'id' => $videoId,
    ]);

    // Verifica si la respuesta contiene detalles del video
    if (isset($response['items'][0])) {
        $videoDetails = $response['items'][0];

        // Formatear la duración de ISO 8601 a HH:MM:SS
        $duration = $this->formatDuration($videoDetails['contentDetails']['duration'] ?? 'PT0S');

        // Devuelve la información del video
        return response()->json([
            'videoId' => $videoDetails['id'],
            'title' => $videoDetails['snippet']['title'],
            'description' => $videoDetails['snippet']['description'],
            'publishedAt' => $videoDetails['snippet']['publishedAt'],
            'thumbnails' => $videoDetails['snippet']['thumbnails'],
            'link' => 'https://www.youtube.com/watch?v=' . $videoDetails['id'],
            'viewCount' => $videoDetails['statistics']['viewCount'] ?? 0,
            'likeCount' => $videoDetails['statistics']['likeCount'] ?? 0,
            'duration' => $duration,
            'keywords' => $videoDetails['snippet']['tags'] ?? [],
        ]);
    } else {
        // Si no se encuentra información detallada del video, devuelve un mensaje de error
        return response()->json(['error' => 'Video details not found'], 404);
    }
}

// Función auxiliar para formatear la duración de ISO 8601 a HH:MM:SS
private function formatDuration($duration)
{
    // Ejemplo de duración en formato ISO 8601: PT1H2M30S
    preg_match('/PT(?:(\d+)H)?(?:(\d+)M)?(?:(\d+)S)?/', $duration, $matches);

    $hours = isset($matches[1]) ? str_pad($matches[1], 2, '0', STR_PAD_LEFT) : '00';
    $minutes = isset($matches[2]) ? str_pad($matches[2], 2, '0', STR_PAD_LEFT) : '00';
    $seconds = isset($matches[3]) ? str_pad($matches[3], 2, '0', STR_PAD_LEFT) : '00';

    return "{$hours}:{$minutes}:{$seconds}";
}





    public function getLastsChannelVideos($channelId, $number)
    {
        if (!is_numeric($number) || $number <= 0) {
            return response()->json(['error' => 'Invalid number provided'], 400);
        }

        $response = $this->makeApiRequest('https://www.googleapis.com/youtube/v3/search', [
            'part' => 'snippet',
            'channelId' => $channelId,
            'order' => 'date',
            'type' => 'video',
            'maxResults' => $number
        ]);

        if (isset($response['items'])) {
            $videoIds = array_map(function ($item) {
                return $item['id']['videoId'];
            }, $response['items']);

            return $this->getVideosDetails($videoIds);
        } else {
            return response()->json(['error' => 'No videos found'], 404);
        }
    }

    private function getVideoDetails($videoId)
    {
        $response = $this->makeApiRequest('/videos', [
            'part' => 'snippet,contentDetails,statistics',
            'id' => $videoId,
        ]);

        if (isset($response['items'][0])) {
            $video = $response['items'][0];
            return response()->json([
                'videoId' => $video['id'],
                'title' => $video['snippet']['title'],
                'description' => $video['snippet']['description'],
                'publishedAt' => $video['snippet']['publishedAt'],
                'duration' => $video['contentDetails']['duration'],
                'viewCount' => $video['statistics']['viewCount'] ?? 0,
                'likeCount' => $video['statistics']['likeCount'] ?? 0,
                'dislikeCount' => $video['statistics']['dislikeCount'] ?? 0,
                'commentCount' => $video['statistics']['commentCount'] ?? 0,
                'thumbnails' => $video['snippet']['thumbnails']
            ]);
        } else {
            return response()->json(['error' => 'Video details not found'], 404);
        }
    }


    private function getVideosDetails(array $videoIds)
    {
        $response = $this->makeApiRequest('/videos', [
            'part' => 'snippet,contentDetails,statistics',
            'id' => implode(',', $videoIds),
        ]);

        if (isset($response['items'])) {
            $videos = array_map(function ($video) {
                return [
                    'videoId' => $video['id'],
                    'title' => $video['snippet']['title'],
                    'description' => $video['snippet']['description'],
                    'publishedAt' => $video['snippet']['publishedAt'],
                    'duration' => $video['contentDetails']['duration'],
                    'viewCount' => $video['statistics']['viewCount'] ?? 0,
                    'likeCount' => $video['statistics']['likeCount'] ?? 0,
                    'dislikeCount' => $video['statistics']['dislikeCount'] ?? 0,
                    'commentCount' => $video['statistics']['commentCount'] ?? 0,
                    'thumbnails' => $video['snippet']['thumbnails']
                ];
            }, $response['items']);

            return response()->json($videos);
        } else {
            return response()->json(['error' => 'No video details found'], 404);
        }
    }


    /**
     * Search videos by topic.
     *
     * @param string $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchVideosByTopic($topic, $order = 'relevance', $maxResults = 10, $duration = null, $type = 'video')
    {
        // Configura los parámetros de búsqueda básicos
        $params = [
            'part' => 'snippet',
            'q' => $topic,
            'type' => $type,
            'order' => $order, // Añade el criterio de orden
            'maxResults' => $maxResults // Define el número máximo de resultados
        ];

        // Añade el filtro de duración si se proporciona
        if ($duration) {
            $params['videoDuration'] = $duration; // 'short', 'medium', 'long'
        }

        return $this->makeApiRequest('/search', $params);
    }


    /**
     * Get videos from a playlist.
     *
     * @param string $listId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVideosFromList($listId)
    {
        return $this->makeApiRequest('https://www.googleapis.com/youtube/v3/playlistItems', [
            'part' => 'snippet',
            'playlistId' => $listId
        ]);
    }

    /**
     * Get trending videos.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTrendingVideos($region = 'ES', $results = 10)
    {
        $response = $this->makeApiRequest('/videos', [
            'part' => 'snippet',
            'chart' => 'mostPopular',
            'regionCode' => $region,
            'maxResults' => $results
        ]);

        $responseData = json_decode($response->getContent(), true);

        $videos = $responseData['items'] ?? [];

        foreach ($videos as &$video) {
            if (isset($video['id']['videoId'])) {
                $video['url'] = 'https://www.youtube.com/watch?v=' . $video['id']['videoId'];
            }
        }

        return $videos;
    }


    public function searchVideosByRelevance($topic, $results = 10, $region = 'ES')
    {
        $response = $this->makeApiRequest('/search', [
            'part' => 'snippet',
            'q' => $topic,
            'order' => 'relevance',
            'type' => 'video',
            'regionCode' => $region,
            'maxResults' => $results
        ]);

        $responseData = json_decode($response->getContent(), true);

        $videos = $responseData['items'] ?? [];

        foreach ($videos as &$video) {
            if (isset($video['id']['videoId'])) {
                $video['url'] = 'https://www.youtube.com/watch?v=' . $video['id']['videoId'];
            }
        }

        return $videos;
    }


    public function searchVideosByDate($topic, $results = 10, $region = 'ES')
    {
        $response = $this->makeApiRequest('/search', [
            'part' => 'snippet',
            'q' => $topic,
            'order' => 'date',
            'type' => 'video',
            'regionCode' => $region,
            'maxResults' => $results
        ]);

        $responseData = json_decode($response->getContent(), true);

        $videos = $responseData['items'] ?? [];

        foreach ($videos as &$video) {
            if (isset($video['id']['videoId'])) {
                $video['url'] = 'https://www.youtube.com/watch?v=' . $video['id']['videoId'];
            }
        }

        return $videos;
    }

    public function searchVideosByViews($topic, $results = 10, $region = 'ES')
    {
        $response = $this->makeApiRequest('/search', [
            'part' => 'snippet',
            'q' => $topic,
            'order' => 'viewCount',
            'type' => 'video',
            'regionCode' => $region,
            'maxResults' => $results
        ]);

        $responseData = json_decode($response->getContent(), true);

        $videos = $responseData['items'] ?? [];

        foreach ($videos as &$video) {
            if (isset($video['id']['videoId'])) {
                $video['url'] = 'https://www.youtube.com/watch?v=' . $video['id']['videoId'];
            }
        }

        return $videos;
    }

    public function searchVideosByRating($topic, $results = 10, $region = 'ES')
    {
        $response = $this->makeApiRequest('/search', [
            'part' => 'snippet',
            'q' => $topic,
            'order' => 'viewCount',
            'type' => 'rating',
            'regionCode' => $region,
            'maxResults' => $results
        ]);

        $responseData = json_decode($response->getContent(), true);

        $videos = $responseData['items'] ?? [];

        foreach ($videos as &$video) {
            if (isset($video['id']['videoId'])) {
                $video['url'] = 'https://www.youtube.com/watch?v=' . $video['id']['videoId'];
            }
        }

        return $videos;
    }
    public function searchVideosByShort($topic, $results = 10, $region = 'ES')
    {
        $response = $this->makeApiRequest('/search', [
            'part' => 'snippet',
            'q' => $topic,
            'order' => 'viewCount',
            'type' => 'video',
            'duration' => 'short',
            'regionCode' => $region,
            'maxResults' => $results
        ]);

        $responseData = json_decode($response->getContent(), true);

        $videos = $responseData['items'] ?? [];

        foreach ($videos as &$video) {
            if (isset($video['id']['videoId'])) {
                $video['url'] = 'https://www.youtube.com/watch?v=' . $video['id']['videoId'];
            }
        }

        return $videos;
    }
    public function searchVideosByMedium($topic, $results = 10, $region = 'ES')
    {
        // Llamada a la API para obtener los vídeos relacionados con el tema
        $response = $this->makeApiRequest('/search', [
            'part' => 'snippet',
            'q' => $topic,
            'order' => 'viewCount',
            'type' => 'video',
            'duration' => 'medium',
            'regionCode' => $region,
            'maxResults' => $results
        ]);

        $responseData = json_decode($response->getContent(), true);

        $videos = $responseData['items'] ?? [];

        foreach ($videos as &$video) {
            if (isset($video['id']['videoId'])) {
                $video['url'] = 'https://www.youtube.com/watch?v=' . $video['id']['videoId'];
            }
        }

        return $videos;
    }

    public function searchVideosByLong($topic, $results = 10, $region = 'ES')
    {
        $response = $this->makeApiRequest('/search', [
            'part' => 'snippet',
            'q' => $topic,
            'order' => 'viewCount',
            'type' => 'video',
            'duration' => 'long',
            'regionCode' => $region,
            'maxResults' => $results
        ]);

        $responseData = json_decode($response->getContent(), true);

        $videos = $responseData['items'] ?? [];

        foreach ($videos as &$video) {
            if (isset($video['id']['videoId'])) {
                $video['url'] = 'https://www.youtube.com/watch?v=' . $video['id']['videoId'];
            }
        }

        return $videos;
    }

    public function searchVideosByChannel($topic, $results = 10, $region = 'ES')
    {
        // Llamada a la API para obtener los canales relacionados con el tema
        $response = $this->makeApiRequest('/search', [
            'part' => 'snippet',
            'q' => $topic,
            'order' => 'viewCount',
            'type' => 'channel',
            'regionCode' => $region,
            'maxResults' => $results
        ]);

        // Obtener el contenido de la respuesta y decodificarlo a un array
        $responseData = json_decode($response->getContent(), true);

        // Modificamos la respuesta para incluir la URL del canal
        $channels = $responseData['items'] ?? [];

        foreach ($channels as &$channel) {
            if (isset($channel['id']['channelId'])) {
                $channel['url'] = 'https://www.youtube.com/channel/' . $channel['id']['channelId'];
            }
        }

        // Retornar la respuesta modificada con la URL del canal
        return $channels;
    }

    public function searchVideosByPlaylist($topic, $results = 10, $region = 'ES')
    {
        // Llamada a la API para obtener las listas de reproducción relacionadas con el tema
        $response = $this->makeApiRequest('/search', [
            'part' => 'snippet',
            'q' => $topic,
            'order' => 'viewCount',
            'type' => 'playlist',
            'regionCode' => $region,
            'maxResults' => $results
        ]);

        // Obtener el contenido de la respuesta y decodificarlo a un array
        $responseData = json_decode($response->getContent(), true);

        // Modificamos la respuesta para incluir la URL de la lista de reproducción
        $playlists = $responseData['items'] ?? [];

        foreach ($playlists as &$playlist) {
            if (isset($playlist['id']['playlistId'])) {
                // Crear la URL de la lista de reproducción
                $playlist['url'] = 'https://www.youtube.com/playlist?list=' . $playlist['id']['playlistId'];
            }
        }

        // Retornar la respuesta modificada con las URLs de las listas de reproducción
        return $playlists;
    }

    protected function convertJsonResponseToArray($jsonResponse)
    {
        // Asegurarse de que el $jsonResponse sea realmente un JsonResponse
        if ($jsonResponse instanceof \Illuminate\Http\JsonResponse) {
            // Obtener los datos como array
            $responseData = $jsonResponse->getData(true);
            return $responseData;
        }

        return []; // Si no es un JsonResponse o está vacío, devuelve un array vacío
    }

    public function youtubePlanet($planet, $number = 50)
    {
        // Buscar el planeta en la base de datos
        $planetData = DB::table('social_planets')->where('slug', $planet)->first();

        if (!$planetData) {
            return response()->json(['error' => 'Planet not found.'], 404);
        }

        // Obtener cuentas de redes sociales
        $accounts = json_decode($planetData->accounts, true);
        $youtubeAccounts = [];

        // Buscar cuentas que contengan "youtube.com"
        foreach ($accounts as $account) {
            if (strpos($account, 'youtube.com') !== false) {
                $youtubeAccounts[] = $account;
            }
        }

        if (empty($youtubeAccounts)) {
            return response()->json(['error' => 'No YouTube accounts found for this planet.'], 404);
        }

        // Procesar URLs y extraer los nombres/IDs de canales
        $channels = [];
        foreach ($youtubeAccounts as $url) {
            // Si la URL contiene "channel"
            if (preg_match('/youtube\.com\/channel\/([^\/]+)/', $url, $matches)) {
                $channels[] = ['id' => $matches[1]];
            }
            // Si no contiene "channel", revisar otros patrones
            elseif (!preg_match('/watch|shorts/', $url)) {
                if (preg_match('/youtube\.com\/([^\/]+)/', $url, $matches)) {
                    $channelName = ltrim($matches[1], '@'); // Eliminar "@" si está presente
                    $channels[] = ['name' => $channelName];
                }
            }
        }

        $videos = [];

        // Obtener vídeos para cada canal
        foreach ($channels as $channel) {
            if (isset($channel['id'])) {
                $channelVideos = $this->getChannelVideos($channel['id'], null, $number);
            } elseif (isset($channel['name'])) {
                // Usamos getChannelVideosByName y convertimos el JSON en un array
                $jsonResponse = $this->getChannelVideosByName($channel['name']);
                $channelVideos = $this->convertJsonResponseToArray($jsonResponse);
            }

            // Si obtenemos un array de videos, lo combinamos
            if (is_array($channelVideos)) {
                $videos = array_merge($videos, $channelVideos);
            }
        }

        // Si no se encontraron vídeos
        if (empty($videos)) {
            return response()->json(['error' => 'No videos found for the provided planet.'], 404);
        }

        // Truncar el array de vídeos al número especificado
        $videos = array_slice($videos, 0, $number);

        // Devolver los vídeos encontrados
        return response()->json($videos);
    }



}

