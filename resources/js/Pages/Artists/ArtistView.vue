<template>
    <!--Artist Info-->
    <div class=" bg-black flex justify-center items-center py-8">
        <div class="flex-col items-center">
            <div class="flex justify-center">
                <fwb-avatar size="xl" v-if="info.image && info.image.length > 0" :img="info.image[0]['#text']" rounded />
            </div>
            <div class="flex mt-8 gap-8">
                <div class="flex items-center gap-2">
                    <v-icon name="fa-user-alt" fill="#76a9fa"  />
                    <a :href="info.url" target="_blank">
                        <span class="text-blue-400 font-semibold">{{ info.name }}</span>
                    </a>
                </div>
                <div v-if="info.country" class="flex items-center gap-2">
                    <v-icon name="fa-location-arrow" fill="white"/>
                    <span class="text-white font-semibold">{{ info.country }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 bg-[#262626] py-8">
        <div class="">
            <h3 class="text-center text-white text-2xl font-bold">Top Artists</h3>
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

import { FwbAvatar } from 'flowbite-vue'

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