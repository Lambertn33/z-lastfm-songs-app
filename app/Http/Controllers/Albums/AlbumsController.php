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
        return Inertia::render('Albums/AlbumSearch');
    }
}
