// searched album interface

export interface SearchedAlbum {
    artist: string;
    url: string;
    mbid: string;
    image?: {
        size: string;
        "#text": string;
    }[];
    name: string;
}

// artist search result response interface
export interface AlbumSearchResultInterface {
    albummatches: {
        album: SearchedAlbum[];
    };
    "opensearch:totalResults": string;
    "opensearch:Query": {
        startPage: string;
    };
    "@attr": {
        for: string;
    };
}
