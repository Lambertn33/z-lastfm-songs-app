<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Barryvanveen\Lastfm\Lastfm;

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
    Route::get('/redirect', 'redirect')->name('auth.redirect');
    Route::get('/google/callback', 'callback')->name('auth.callback');
});

Route::get("/albums", function (Lastfm $lastfm) {
    $albums = $lastfm->userTopAlbums('Rihanna')->get();

    return $albums;
});
