<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ArtistsTest extends TestCase
{

    protected $nameToSearch;

    protected $endpoint;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->nameToSearch = 'cher';

        $this->endpoint = "https://ws.audioscrobbler.com/2.0/";

        config(['lastfm.api_key' => 'test']);
    }
    /**
     * A basic feature test example.
     */
    public function test_user_can_search_artists_by_name(): void
    {
        $body = file_get_contents(base_path('tests/fixtures/artists/artist_search.json'));

        Http::fake([
            "$this->endpoint?method=artist.search&format=json&artist=$this->nameToSearch*" => Http::response($body, 200),
        ]);

        $this->assertEquals(
            $body,
            $body
        );
    }

    public function test_user_can_get_artist_info(): void
    {
        $body = file_get_contents(base_path('tests/fixtures/artists/artist_info.json'));

        Http::fake([
            "$this->endpoint?method=artist.getinfo&format=json&artist=$this->nameToSearch*" => Http::response($body, 200),
        ]);

        $this->assertEquals(
            $body,
            $body
        );
    }
    public function test_user_can_get_artist_top_albums(): void
    {
        $body = file_get_contents(base_path('tests/fixtures/artists/artist_top_albums.json'));

        Http::fake([
            "$this->endpoint?method=artist.gettopalbums&format=json&artist=$this->nameToSearch*" => Http::response($body, 200),
        ]);

        $this->assertEquals(
            $body,
            $body
        );
    }
    public function test_user_can_get_artist_similar_artists(): void
    {

        $body = file_get_contents(base_path('tests/fixtures/artists/artist_similar.json'));

        Http::fake([
            "$this->endpoint?method=artist.gettopalbums&format=json&artist=$this->nameToSearch*" => Http::response($body, 200),
        ]);

        $this->assertEquals(
            $body,
            $body
        );
    }
}
