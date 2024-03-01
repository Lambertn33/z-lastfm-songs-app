<?php

use App\Http\Controllers\Albums\AlbumsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Artists\ArtistsController;
use App\Http\Controllers\Artists\ArtistSimilarArtistsController;
use App\Http\Controllers\Artists\ArtistTopAlbumsController;
use App\Http\Controllers\Artists\ArtistTopTracksController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\FavoritesAlbumsController;
use App\Http\Controllers\User\FavoritesArtistsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Index');
});

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::get('/', 'index')->name('auth.index');
    Route::get('/redirect', 'redirect')->name('auth.redirect');
    Route::get('/google/callback', 'callback')->name('auth.callback');
    Route::post('/logout', 'logout')->name('auth.logout');
});

// Artists
Route::prefix('artists')->group(function () {
    // search artist and get some few similar artists, top albums and recent tracks
    Route::controller(ArtistsController::class)->group(function () {
        Route::get('/', 'index')->name('artists.index');
    });

    Route::prefix('{artist}')->group(function () {

        // get all searched artist top albums
        Route::controller(ArtistTopAlbumsController::class)->prefix('top_albums')->group(function () {
            Route::get('/', 'index')->name('artist.top_albums.index');
        });

        // get all searched artist similar artists
        Route::controller(ArtistSimilarArtistsController::class)->prefix('similar_artists')->group(function () {
            Route::get('/', 'index')->name('artist.similar.index');
        });

        //get all searched artist top tracks
        Route::controller(ArtistTopTracksController::class)->prefix('top_tracks')->group(function () {
            Route::get('/', 'index')->name('artist.top_tracks.index');
        });
    });
});

//Albums

Route::prefix('albums')->group(function () {
    //search and album
    Route::controller(AlbumsController::class)->group(function () {
        Route::get('/', 'index')->name('albums.index');
    });
});

// user favourites
Route::middleware('auth')->prefix('user')->group(function () {

    // favourite albums
    Route::resource('favourite_albums', FavoritesAlbumsController::class)->only(['index', 'store', 'destroy'])
        ->names([
            'index' => 'user.favourite_albums.index',
            'store' => 'user.favourite_albums.store',
            'destroy' => 'user.favourite_albums.destroy',
        ]);

    // favourite artists
    Route::resource('favourite_artists', FavoritesArtistsController::class)->only(['index', 'store', 'destroy'])
        ->names([
            'index' => 'user.favourite_artists.index',
            'store' => 'user.favourite_artists.store',
            'destroy' => 'user.favourite_artists.destroy',
        ]);
});
