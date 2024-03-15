<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use App\Models\User;

use Tests\TestCase;

class FavouriteArtistsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_and_remove_favourite_artist()
    {
        $randomArtistMbid = Str::uuid()->toString();
        $user = User::factory()->create();

        // adding a favourite artist
        $response = $this->actingAs($user)
            ->post('/user/favourite_artists', [
                'user_id' => $user->id,
                'artist_mbid' => $randomArtistMbid,
                'artist_name' => 'Test Artist',
                'artist_url' => 'randomUrl',
            ]);

        $response->assertStatus(302);

        // removing a favourite artist
        $response = $this->actingAs($user)
            ->delete("/user/favourite_artists/$randomArtistMbid");

        $response->assertStatus(302);
    }
}
