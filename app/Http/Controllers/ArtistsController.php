<?php

namespace App\Http\Controllers;

use App\Http\Services\ArtistsServices;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArtistsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->query('artist')) {

            $artist = $request->query('artist');

            $artistServices = app(ArtistsServices::class);

            $artistBasicInfo = $artistServices->getArtistBasicInfo($artist);

            $artistToAlbums = $artistServices->getArtistTopAlbums($artist);

            $artistSimilarArtists = $artistServices->geArtistSimilarArtists($artist);

            $artistTopTracks = $artistServices->getArtistTopTracks($artist);

            return Inertia::render(
                'Artists/ArtistView',
                [
                    'info' => $artistBasicInfo,
                    'top_albums' => $artistToAlbums,
                    'similar_artists' => $artistSimilarArtists,
                    'top_tracks' => $artistTopTracks,
                    'query' => $artist
                ]
            );
        } else {

            return Inertia::render('Artists/ArtistSearch');
        }
    }
}
