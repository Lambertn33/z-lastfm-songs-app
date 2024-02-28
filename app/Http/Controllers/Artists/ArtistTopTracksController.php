<?php

namespace App\Http\Controllers\Artists;

use App\Http\Controllers\Controller;

use App\Http\Services\ArtistsServices;

use Illuminate\Http\Request;

use Inertia\Inertia;

class ArtistTopTracksController extends Controller
{
    public function index(string $artist, Request $request)
    {

        $page = $request->query('page') ?? 1;

        $limit = 50;

        $artistServices = app(ArtistsServices::class);

        $artistAllTopTracks = $artistServices->getArtistTopTracks($artist, $page, $limit);

        return Inertia::render('Artists/Tracks/AllTopTracks', [
            'artist_all_top_tracks' => $artistAllTopTracks,
            'artist' => $artist,
            'page' => $page
        ]);
    }
}
