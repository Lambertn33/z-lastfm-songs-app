// authenticated user interface
export interface UserInterface {
    id: number;
    name: string;
    email: string;
    avatar: string;
    favourite_albums: {
        id: number;
        album_mbid: string;
        album_name: string;
        user_id: number;
    }[];
    favourite_artists: {
        id: number;
        artist_mbid: string;
        artist_name: string;
        user_id: number;
    }[];

}
