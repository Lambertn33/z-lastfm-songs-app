<?php

namespace App\Policies;

use App\Models\FavouriteAlbum;
use App\Models\User;

class FavouriteAlbumPolicy
{
      // Authorize only authenticated users to store favourite artists
      public function store(User $user): bool
      {
          return $user !== null;
      }
  
      // Authorize the user to delete their own favourite album
      public function destroy(User $user, FavouriteAlbum $favouriteAlbum): bool
      {
          return $user->id === $favouriteAlbum->user_id;
      }
}
