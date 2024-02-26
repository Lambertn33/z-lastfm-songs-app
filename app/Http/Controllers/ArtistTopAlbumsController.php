<?php

namespace App\Http\Controllers;

use App\Http\Services\ArtistsServices;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArtistTopAlbumsController extends Controller
{
    public function index(string $artist, Request $request)
    {

        $page = $request->query('page') ?? 1;

        $artistServices = app(ArtistsServices::class);

        $artistAllToAlbums = $artistServices->getArtistTopAlbums($artist, $page);

        return Inertia::render('Artists/Albums/AllTopAlbums', [
            'artist_all_top_albums' => $artistAllToAlbums,
            'artist' => $artist,
            'page' => $page
        ]);
    }
}
