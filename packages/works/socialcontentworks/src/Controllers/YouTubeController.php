<?php
namespace Works\Socialcontentworks\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

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
    private function handleApiResponse($response)
    {
        if ($response->successful()) {
            return response()->json($response->json());
        }

        $error = match ($response->status()) {
            403 => 'API key is invalid or quota exceeded',
            404 => 'Resource not found',
            default => 'Failed to fetch data from YouTube API',
        };

        return response()->json([
            'error' => $error,
            'status' => $response->status(),
            'message' => $response->body(),
        ], $response->status());
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
        // Llamada a la API para obtener información del canal
        $response = $this->testChannel($channel);

        // Convierte la respuesta JSON en un array
        $responseData = $response->getData(true); // true convierte el objeto a array

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
        $searchData = $searchResponse->getData(true);
        if (isset($searchData['items'][0])) {
            $channelId = $searchData['items'][0]['id']['channelId'];

            // Usa el ID del canal para obtener la información detallada
            $response = $this->makeApiRequest('/channels', [
                'part' => 'snippet,contentDetails,statistics,brandingSettings',
                'id' => $channelId,
                'key' => $apiKey
            ]);

            // Verifica la respuesta del canal
            $data = $response->getData(true);
            if (isset($data['items'][0])) {
                $item = $data['items'][0];

                // Obtener la descripción completa
                $description = $item['snippet']['description'] ?? 'N/A';

                // Extraer enlaces de la descripción
                $links = [];
                preg_match_all('/https?:\/\/[^\s]+/', $description, $links);

                // Opcional: Si la información de redes sociales está en la descripción,
                // puedes extraerlas usando un método diferente, dependiendo del formato.
                $socialLinks = $this->extractSocialLinks($description);

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
                    'brandingSettings' => $item['brandingSettings'] ?? []
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


    public function getChannelIdByName($channelName)
    {
        $response = $this->makeApiRequest('/search', [
            'part' => 'snippet',
            'q' => $channelName,
            'type' => 'channel',
            'maxResults' => 1,
            'key' => env('YOUTUBE_API_KEY') // Asegúrate de incluir la clave API
        ]);

        // Extraer los datos de la respuesta JSON
        $responseData = $response->getData(true);

        if (isset($responseData['items'][0]['id']['channelId'])) {
            // Devolver el channelId en formato JSON
            return response()->json([
                'channelId' => $responseData['items'][0]['id']['channelId']
            ]);
        } else {
            // Devolver un mensaje de error en formato JSON
            return response()->json(['error' => 'Channel not found'], 404);
        }
    }



    public function getChannelVideosByName($channelName)
    {
        $response = $this->getChannelIdByName($channelName);

        if ($response instanceof \Illuminate\Http\JsonResponse) {
            $responseData = $response->getData(true);

            if (isset($responseData['error'])) {
                return response()->json(['error' => 'Channel not found'], 404);
            }

            $channelId = $responseData['channelId'];
            return $this->getChannelVideos($channelId);
        }

        return response()->json(['error' => 'Unexpected response'], 500);
    }





    /**
     * Obtiene los videos de un canal.
     *
     * @param string $channelId
     * @param string|null $type
     * @param int|null $limit
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChannelVideos($channelId, $type = null, $limit = null)
    {
        $response = $this->makeApiRequest('/search', [
            'part' => 'snippet',
            'channelId' => $channelId,
            'order' => 'date',
            'type' => 'video',
            'maxResults' => 50,
        ]);

        // Extraer los datos de la respuesta JSON
        $responseData = $response->getData(true);

        if (!isset($responseData['items'])) {
            return response()->json(['error' => 'No videos found'], 404);
        }

        $videos = $this->processVideos($responseData['items'], $type, $limit);

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
        $channelIdResponse = $this->getId($channelName);
        $channelIdData = $channelIdResponse->getData(true);

        if (isset($channelIdData['channelId'])) {
            $channelId = $channelIdData['channelId'];

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
        $responseData = $response->getData(true);

        if (isset($responseData['items'][0])) {
            $video = $responseData['items'][0];

            // Devuelve la información del video más reciente
            return response()->json([
                'videoId' => $video['id']['videoId'],
                'title' => $video['snippet']['title'],
                'description' => $video['snippet']['description'],
                'publishedAt' => $video['snippet']['publishedAt'],
                'thumbnails' => $video['snippet']['thumbnails'],
                'link' => 'https://www.youtube.com/watch?v=' . $video['id']['videoId'],
            ]);
        } else {
            // Si no se encuentra un video, devuelve un mensaje de error
            return response()->json(['error' => 'No videos found for this channel'], 404);
        }
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
    public function searchVideosByTopic($topic)
    {
        return $this->makeApiRequest('https://www.googleapis.com/youtube/v3/search', [
            'part' => 'snippet',
            'q' => $topic,
            'type' => 'video'
        ]);
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
    public function getTrendingVideos()
    {
        return $this->makeApiRequest('https://www.googleapis.com/youtube/v3/videos', [
            'part' => 'snippet',
            'chart' => 'mostPopular',
            'regionCode' => 'ES',
            'maxResults' => 10
        ]);
    }



}

