<?php

namespace App\Http\Controllers;

use App\Http\Services\ArtistsServices;

use Illuminate\Http\Request;

use Inertia\Inertia;

class ArtistSimilarArtistsController extends Controller
{
    public function index(string $artist, Request $request)
    {

        $page = $request->query('page') ?? 1;

        $limit = 50;

        $artistServices = app(ArtistsServices::class);

        $artistAllSimilarArtists = $artistServices->getArtistSimilarArtists($artist, $page, $limit);

        return Inertia::render('Artists/Similar/AllSimilarArtists', [
            'artist_all_similar_artists' => $artistAllSimilarArtists,
            'artist' => $artist,
            'page' => $page
        ]);
    } 
}
