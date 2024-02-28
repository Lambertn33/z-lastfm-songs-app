interface ArtistTagInterface {
    tag: {
        name: string;
        url: string;
    };
}

// searched artist interface

export interface SearchedArtist {
    name: string;
    url: string;
    image?: {
        size: string;
        "#text": string;
    }[];
    mbid: string;
    listeners: number;
}

// artist search result response interface
export interface ArtistSearchResultInterface {
    artistmatches: {
        artist: SearchedArtist[];
    };
    "opensearch:totalResults": string;
    "opensearch:Query": {
        startPage: string;
    }
    "@attr": {
        for: string;
    };
}

// artist interface
export interface ArtistInterface {
    name: string;
    url: string;
    image?: {
        size: string;
        "#text": string;
    }[];
    tags: ArtistTagInterface[];
    stats: {
        listeners: string;
        playcount: string;
    };
    bio: {
        published: string;
    };
}

// artist similar artists interface
export interface SimilarArtistInterface {
    artist: {
        name: string;
        mbid: string;
        url: string;
        image?: {
            size: string;
            "#text": string;
        }[];
    }[];
    "@attr": {
        artist: string;
    };
}

// artist top albums interface
export interface ArtistTopAlbumInterface {
    album: {
        name: string;
        playcount: number;
        mbid: string;
        url: string;
        artist: {
            name: string;
            url: string;
            mbid: string;
        };
        image: {
            "#text": string;
            size: string;
        }[];
    }[];
    "@attr": {
        artist: string;
        page: string;
        total: string;
        perPage: string;
        totalPages: string;
    };
}

// artist top tracks interface
export interface ArtistTopTrackInterface {
    track: {
        name: string;
        listeners: string;
        playcount: string;
        mbid: string;
        url: string;
        artist: {
            name: string;
            url: string;
            mbid: string;
        };
        image: {
            "#text": string;
            size: string;
        }[];
    }[];
    "@attr": {
        artist: string;
        page: string;
        total: string;
        perPage: string;
        totalPages: string;
    };
}