// authenticated user interface
export interface UserInterface {
    id: number;
    name: string;
    email: string;
    avatar: string;
    favourite_albums: UserFavouriteAlbumInterface[];
    favourite_artists: UserFavouriteArtistInterface[];
}

export interface UserFavouriteAlbumInterface {
    id: number;
    album_mbid: string;
    album_name: string;
    user_id: number;
    release_date: string;
    number_of_tracks: string;
    album_url: string;
    artist_name: string;
}

export interface UserFavouriteArtistInterface {
    id: number;
    artist_mbid: string;
    artist_name: string;
    artist_url: string;
    user_id: number;
}
