<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class ArtistsServices
{
    private $key;
    private $url;
    private $httpClient;

    public function __construct()
    {
        $this->key = Config::get('lastfm.api_key');
        $this->url = Config::get('lastfm.api_url');
        $this->httpClient = Http::class;
    }

    private function sendRequest(string $method, string $username, int $perPage = 1, int $limit = 50): \Illuminate\Http\Client\Response
    {
        $queryParams = http_build_query([
            'artist' => $username,
            'api_key' => $this->key,
            'format' => 'json'
        ]);

        $url = "{$this->url}?method={$method}&{$queryParams}&page={$perPage}&limit={$limit}";

        return $this->httpClient::post($url);
    }

    public function searchArtist(string $query, int $page = 1, int $limit = 30)
    {
        $response = $this->sendRequest('artist.search', $query, $page, $limit);

        $data = $response->json();

        return $data['results'];
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

        return $data['topalbums'];
    }

    public function getArtistSimilarArtists(string $username, int $page = 1, int $limit = 10)
    {
        $response = $this->sendRequest('artist.getsimilar', $username, $page, $limit);

        $data = $response->json();

        return $data['similarartists'];
    }

    public function getArtistTopTracks(string $username, int $page = 1, int $limit = 10)
    {
      $response = $this->sendRequest('artist.gettoptracks', $username, $page, $limit);

      $data = $response->json();

      return $data['toptracks'];
    }
}
