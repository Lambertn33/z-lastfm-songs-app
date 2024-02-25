<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class ArtistsServices
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

    private function sendRequest(string $method, string $username, int $perPage = 1, int $limit = 20): \Illuminate\Http\Client\Response
    {
        $queryParams = http_build_query([
            'artist' => $username,
            'api_key' => $this->key,
            'format' => 'json'
        ]);

        $url = "{$this->url}?method={$method}&{$queryParams}&page={$perPage}&limit={$limit}";

        return $this->httpClient::post($url);
    }

    public function getArtistBasicInfo(string $username)
    {
        $response = $this->sendRequest('artist.getinfo', $username);

        $data = $response->json();

        return $data['artist'];
    }

    public function getArtistTopAlbums(string $username, int $page = 1, int $limit = 10)
    {
        $response = $this->sendRequest('artist.gettopalbums', $username, $page, $limit);

        $data = $response->json();

        return $data['topalbums']['album'];
    }

    public function geArtistSimilarArtists(string $username, int $page = 1, int $limit = 10)
    {
        $response = $this->sendRequest('artist.getsimilar', $username, $page, $limit);

        $data = $response->json();

        return $data['similarartists']['artist'];
    }

    public function getArtistTopTracks(string $username, int $page = 1, int $limit = 10)
    {
      $response = $this->sendRequest('artist.gettoptracks', $username, $page, $limit);

      $data = $response->json();

      return $data['toptracks']['track'];
    }
}
