<?php

namespace App\Http\Controllers\Artists;

use App\Http\Controllers\Controller;

use App\Http\Services\ArtistsServices;

use Illuminate\Http\Request;

use Inertia\Inertia;

class ArtistsController extends Controller
{
    public $artistServices;

    public function __construct()
    {
        $this->artistServices = app(ArtistsServices::class);
    }

    public function index(Request $request)
    {
        // if we already have an artist
        if ($request->query('artist')) {

            $artist = $request->query('artist');

            $limit = 10;

            $artistBasicInfo = $this->artistServices->getArtistBasicInfo($artist);

            $artistToAlbums = $this->artistServices->getArtistTopAlbums($artist, 1, $limit);

            $artistSimilarArtists = $this->artistServices->getArtistSimilarArtists($artist, 1, $limit);

            $artistTopTracks = $this->artistServices->getArtistTopTracks($artist, 1, $limit);

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

            // if we are searching
        } else if ($request->query('search')) {
            $query = $request->query('search');

            $page = $request->query('page') ?? 1;

            $searchResults = $this->artistServices->searchArtist($query, $page, 30);

            return Inertia::render('Artists/ArtistSearchResults', [
                'results' => $searchResults,
                'query' => $query
            ]);
        }
        // go search results
        else {

            return Inertia::render('Artists/ArtistSearch');
        }
    }
}
