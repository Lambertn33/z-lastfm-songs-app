<template>
    <!--Artist Info-->
    <ArtistInfo :artist="info" />

    <div class="grid grid-cols-1  md:grid-cols-3 bg-[#262626] py-8 px-6">

        <!--top artists-->
        <div class="flex-col">
            <h3 class="text-center text-white text-2xl font-bold">Top Artists</h3>
            <TopArtists :similar_artists="similar_artists" />
        </div>

        <div class="flex-col justify-center items-center">
            <h3 class="text-center text-white text-2xl font-bold">Top Albums</h3>
            <TopAlbums :top_albums="top_albums" />

        </div>
        <div class="">
            <h3 class="text-center text-white text-2xl font-bold">Recent Tracks</h3>
            <TopTracks :top_tracks="top_tracks" />
        </div>
    </div>
</template>

<script setup lang="ts">

import { defineProps } from 'vue';

import { ArtistInterface, ArtistTopAlbumInterface, ArtistTopTrackInterface, SimilarArtistInterface} from '../../interfaces';

import TopAlbums from '../../components/artist/TopAlbums.vue';

import ArtistInfo from '../../components/artist/ArtistInfo.vue';

import TopArtists from "../../components/artist/TopArtists.vue";

import TopTracks from '../../components/artist/TopTracks.vue';

interface ArtistViewProps {
    query: string;
    top_tracks: ArtistTopTrackInterface[],
    top_albums: ArtistTopAlbumInterface[],
    similar_artists: SimilarArtistInterface[],
    info: ArtistInterface
}

const { info, top_tracks, top_albums, similar_artists } = defineProps<ArtistViewProps>()


</script>