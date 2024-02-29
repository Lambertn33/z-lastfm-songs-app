<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FavouriteArtist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FavoritesArtistsController extends Controller
{
    public function index()
    {
        return Inertia::render('User/FavouriteArtists');
    }

    public function store(Request $request)
    {
        FavouriteArtist::create([
            'user_id' => Auth::user()->id,
            'artist_mbid' => $request->artist_mbid,
            'artist_name' => $request->artist_name,
            'artist_url' => $request->artist_url,
        ]);

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        FavouriteArtist::where('user_id', Auth::user()->id)->where('artist_mbid', $request->artist_mbid)->delete();

        return redirect()->back();
    }
}
