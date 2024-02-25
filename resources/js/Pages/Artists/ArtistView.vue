<template>
    <!--Artist Info-->
    <ArtistInfo :artist="info" />

    <div class="grid grid-cols-1  md:grid-cols-3 bg-[#262626] py-8 px-6">

        <!--top artists-->
        <div class="flex-col">
            <h3 class="text-center text-white text-2xl font-bold">Top Artists</h3>
            <TopArtists :top_artists="top_artists" />
        </div>

        <div class="flex-col justify-center items-center">
            <h3 class="text-center text-white text-2xl font-bold">Top Albums</h3>
            <TopAlbums :top_albums="top_albums" />

        </div>
        <div class="">
            <h3 class="text-center text-white text-2xl font-bold">Recent Tracks</h3>
            <RecentTracks :recent_tracks="recent_tracks" />
        </div>
    </div>
</template>

<script setup lang="ts">

import { defineProps } from 'vue';

import { ArtistInterface, ArtistRecentTrackInterface, ArtistTopAlbumInterface } from '../../interfaces';

import TopAlbums from '../../components/artist/TopAlbums.vue';

import ArtistInfo from '../../components/artist/ArtistInfo.vue';

import TopArtists from "../../components/artist/TopArtists.vue";

import RecentTracks from '../../components/artist/RecentTracks.vue';

interface ArtistViewProps {
    query: string;
    recent_tracks: ArtistRecentTrackInterface[],
    top_albums: ArtistTopAlbumInterface[],
    top_artists: ArtistInterface[],
    info: ArtistInterface
}

const { info, recent_tracks, top_albums, top_artists } = defineProps<ArtistViewProps>()


</script>