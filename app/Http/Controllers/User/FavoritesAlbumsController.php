<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FavouriteAlbum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FavoritesAlbumsController extends Controller
{
    public function index()
    {
        return Inertia::render('User/FavouriteAlbums');
    }

    public function store(Request $request)
    {
        FavouriteAlbum::create([
            'user_id' => Auth::user()->id,
            'album_mbid' => $request->album_mbid,
            'album_name' => $request->album_name,
            'album_url' => $request->album_url,
            'number_of_tracks' => $request->number_of_tracks,
            'artist_name' => $request->artist_name,
            'release_date' => $request->release_date
        ]);

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        FavouriteAlbum::where('user_id', Auth::user()->id)->where('album_mbid', $request->album_mbid)->delete();

        return redirect()->back();
    }
}
