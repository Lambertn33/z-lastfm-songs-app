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

// single Album

interface AlbumTag {
    url: string;
    name: string;
}

interface AlbumTrack {
    streamable: {
        fulltrack: string;
        "#text": string;
    };
    duration: number;
    url: string;
    name: string;
    "@attr": {
        rank: number;
    };
    artist: {
        url: string;
        name: string;
        mbid: string;
    };
}

export interface AlbumDetails {
    artist: string;
    tags: {
        tag: AlbumTag[];
    };
    name: string;
    image: {
        size: string;
        "#text": string;
    }[];
    tracks: {
        track: AlbumTrack[];
    };
    listeners: string;
    playcount: string;
    url: string;
    wiki: {
        published: string;
        summary: string;
        content: string;
    };
}
