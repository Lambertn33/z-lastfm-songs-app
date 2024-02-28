<?php

namespace App\Http\Controllers\Artists;

use App\Http\Controllers\Controller;

use App\Http\Services\ArtistsServices;

use Illuminate\Http\Request;

use Inertia\Inertia;

class ArtistTopAlbumsController extends Controller
{
    public function index(string $artist, Request $request)
    {

        $page = $request->query('page') ?? 1;

        $limit = 50;

        $artistServices = app(ArtistsServices::class);

        $artistAllToAlbums = $artistServices->getArtistTopAlbums($artist, $page, $limit);

        return Inertia::render('Artists/Albums/AllTopAlbums', [
            'artist_all_top_albums' => $artistAllToAlbums,
            'artist' => $artist,
            'page' => $page
        ]);
    }
}
