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

            $limit = 10;

            $artistServices = app(ArtistsServices::class);

            $artistBasicInfo = $artistServices->getArtistBasicInfo($artist);

            $artistToAlbums = $artistServices->getArtistTopAlbums($artist, 1, $limit);

            $artistSimilarArtists = $artistServices->getArtistSimilarArtists($artist, 1, $limit);

            $artistTopTracks = $artistServices->getArtistTopTracks($artist, 1, $limit);

            return Inertia::render(
                'Artists/ArtistView',
                [
                    'info' => $artistBasicInfo,
                    'top_albums' => $artistToAlbums,
                    'similar_artists' => $artistSimilarArtists,
                    'top_tracks' => $artistTopTracks,
                    'artist_name' => $artist
                ]
            );
        } else {

            return Inertia::render('Artists/ArtistSearch');
        }
    }
}
