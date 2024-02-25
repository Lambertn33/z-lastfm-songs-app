<template>
    <!--Artist Info-->
    <ArtistInfo :artist="info" />

    <div class="grid grid-cols-1  md:grid-cols-3 bg-[#262626] py-8 px-6">
        
        <!--top artists-->
        <div class="flex-col">
            <h3 class="text-center text-white text-2xl font-bold">Top Artists</h3>
            <TopArtists :top_artists="top_artists" />
        </div>

        <div class="">
            <h3 class="text-center text-white text-2xl font-bold">Top Albums</h3>
        </div>
        <div class="">
            <h3 class="text-center text-white text-2xl font-bold">Recent Tracks</h3>
        </div>
    </div>
</template>

<script setup lang="ts">

import { defineProps } from 'vue';

import ArtistInfo from '../../components/artist/ArtistInfo.vue';

import TopArtists from "../../components/artist/TopArtists.vue";

import { FwbAvatar } from 'flowbite-vue';

import { ArtistInterface, ArtistRecentTrackInterface, ArtistTopAlbumInterface } from '../../interfaces';

interface ArtistViewProps {
    query: string;
    recent_tracks: ArtistRecentTrackInterface[],
    top_albums: ArtistTopAlbumInterface[],
    top_artists: ArtistInterface[],
    info: ArtistInterface
}

const { info, query, recent_tracks, top_albums, top_artists } = defineProps<ArtistViewProps>()


</script>