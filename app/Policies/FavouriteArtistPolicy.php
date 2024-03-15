<?php

namespace App\Policies;

use App\Models\FavouriteArtist;
use App\Models\User;

class FavouriteArtistPolicy
{
    // Authorize only authenticated users to store favourite artists
    public function store(User $user): bool
    {
        return $user !== null;
    }

    // Authorize the user to delete their own favourite artist
    public function destroy(User $user, FavouriteArtist $favouriteArtist, string $mbid): bool
    {
        return $user->id === $favouriteArtist->user_id && $favouriteArtist->artist_mbid === $mbid;
    }
}
