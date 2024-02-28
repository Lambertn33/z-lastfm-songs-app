<?php

namespace App\Http\Controllers\Albums;

use App\Http\Controllers\Controller;

use App\Http\Services\AlbumsServices;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AlbumsController extends Controller
{
    public $albumsServices;

    public function __construct()
    {
        $this->albumsServices = app(AlbumsServices::class);
    }

    public function index(Request $request)
    {
        // if we are searching
        if ($request->query('search')) {

            $query = $request->query('search');

            $page = $request->query('page') ?? 1;

            $searchResults = $this->albumsServices->searchAlbum($query, $page, 30);

            return Inertia::render('Albums/AlbumSearchResults', [
                'results' => $searchResults,
                'query' => $query
            ]);
        } else {
            return Inertia::render('Albums/AlbumSearch');
        }
    }
}
