<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\ArtistSimilarArtistsController;
use App\Http\Controllers\ArtistTopAlbumsController;

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
    $message = "Hi from vuex";
    return Inertia::render('Index', [
        'message' => $message
    ]);
});

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::get('/', 'index')->name('auth.index');
    Route::get('/redirect', 'redirect')->name('auth.redirect');
    Route::get('/google/callback', 'callback')->name('auth.callback');
    Route::post('/logout', 'logout')->name('auth.logout');
});


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
    });
});
