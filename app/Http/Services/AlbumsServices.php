<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class AlbumsServices
{
    private $key;
    private $url;
    private $httpClient;

    public function __construct()
    {
        $this->key = env('LASTFM_API_KEY');
        $this->url = env('LASTFM_API_URL');
        $this->httpClient = Http::class;
    }

    private function sendRequest(string $method, string $album, int $perPage = 1, int $limit = 50, bool $isViewing = false): \Illuminate\Http\Client\Response
    {
        $queryParams = $isViewing ?
            http_build_query([
                'mbid' => $album,
                'api_key' => $this->key,
                'format' => 'json'
            ]) : http_build_query([
                'album' => $album,
                'api_key' => $this->key,
                'format' => 'json'
            ]);

        $url = "{$this->url}?method={$method}&{$queryParams}&page={$perPage}&limit={$limit}";

        return $this->httpClient::post($url);
    }

    public function searchAlbum(string $query, int $page = 1, int $limit = 30)
    {
        $response = $this->sendRequest('album.search', $query, $page, $limit);

        $data = $response->json();

        return $data['results'];
    }

    public function viewAlbum(string $mbid)
    {
        $response = $this->sendRequest('album.getinfo', $mbid, 1, 1, true);

        $data = $response->json();

        return $data['album'];
    }
}
