<?php

namespace App\Http\Services;

use Barryvanveen\Lastfm\Lastfm;

class ArtistsServices
{
    private $lastFm;

    public function __construct(Lastfm $lastFm)
    {
        $this->lastFm = $lastFm;
    }

    public function getUserBasicInfo(string $username)
    {
        $userBasicInfo = $this->lastFm->userInfo($username)->get();

        return $userBasicInfo;
    }

    public function getUserTopAlbums(string $username)
    {
        $userTopAlbums = $this->lastFm->userTopAlbums($username)->limit(10)->page(2)->get();

        return $userTopAlbums;
    }

    public function getUserTopArtists(string $username)
    {
        $userTopArtists = $this->lastFm->userTopArtists($username)->limit(10)->page(2)->get();

        return $userTopArtists;
    }

    public function getUserRecentTracks(string $username)
    {
        $userRecentTracks = $this->lastFm->userRecentTracks($username)->limit(10)->page(2)->get();

        return $userRecentTracks;
    }
}
