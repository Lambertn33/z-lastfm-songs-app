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

            $user = $request->query('artist');

            $artistServices = app(ArtistsServices::class);
    
            $userBasicInfo = $artistServices->getUserBasicInfo($user);
    
            $userToAlbums = $artistServices->getUserTopAlbums($user);
    
            $userTopArtists = $artistServices->getUserTopArtists($user);
    
            $userRecentTracks = $artistServices->getUserRecentTracks($user);
    
            return Inertia::render('Artists/ArtistView', [
                'info' => $userBasicInfo,
                'top_albums' => $userToAlbums,
                'top_artists' => $userTopArtists,
                'recent_tracks' => $userRecentTracks,
                'query' => $user
            ]);
        } else {

            return Inertia::render('Artists/ArtistSearch');
        }

    }
}
