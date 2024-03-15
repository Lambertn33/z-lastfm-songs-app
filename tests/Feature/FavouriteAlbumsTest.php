<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class FavouriteAlbumsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_and_remove_favourite_album()
    {
        $randomAlbumMbid = Str::uuid()->toString();
        $user = User::factory()->create();

        // adding a favourite album
        $response = $this->actingAs($user)
            ->post('/user/favourite_albums', [
                'user_id' => $user->id,
                'album_mbid' => $randomAlbumMbid,
                'album_name' => 'Test Album',
                'album_url' => 'http://randomAlbumUrl',
                'artist_name' => 'Random artist',
                'release_date' => '23-04-2012 00:38',
                'number_of_tracks' => '12'
            ]);

        $response->assertStatus(302);

        // removing a favourite album
        $response = $this->actingAs($user)
            ->delete("/user/favourite_albums/$randomAlbumMbid");

        $response->assertStatus(302);
    }
}
