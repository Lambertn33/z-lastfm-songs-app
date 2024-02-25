export interface UserInterface {
    id: number;
    name: string;
    email: string;
    avatar: string;
}

export interface ArtistInterface {
    name?: string;
    mbid?: string;
    url?: string;
    image?: {
        size: string;
        "#text": string;
    }[];
    country?: string;
}

export interface ArtistTopAlbumInterface {
    image?: {
        size: string;
        "#text": string;
    }[];
    name: string;
    artist: ArtistInterface;
    "@attr"?: {
        rank: string;
    };
}

export interface ArtistRecentTrackInterface {
    artist: ArtistInterface;
    image?: {
        size: string;
        "#text": string;
    }[];
    album?: {
        "#text": string;
    };
    name: string;
    url: string;
}
