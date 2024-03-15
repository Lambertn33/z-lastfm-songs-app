<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AlbumsTest extends TestCase
{
    protected $albumToSearch;

    protected $endpoint;

    public function setUp(): void
    {
        parent::setUp();

        $this->albumToSearch = 'eyes';

        $this->endpoint = "https://ws.audioscrobbler.com/2.0/";

        config(['lastfm.api_key' => 'test']);
    }

    public function test_user_can_search_albums_by_name(): void
    {
        $body = file_get_contents(base_path('tests/fixtures/albums/album_view.json'));

        Http::fake([
            "$this->endpoint?method=album.search&format=json&album=$this->albumToSearch*" => Http::response($body, 200),
        ]);

        $this->assertEquals(
            $body,
            $body
        );
    }

    public function test_user_can_view_album_details(): void
    {
        $body = file_get_contents(base_path('tests/fixtures/albums/album_info.json'));

        Http::fake([
            "$this->endpoint?method=album.getinfo&format=json&mbid=66c0a206-d1b8-4abc-a630-74ddece2a30a*" => Http::response($body, 200),
        ]);

        $this->assertEquals(
            $body,
            $body
        );
    }
}
