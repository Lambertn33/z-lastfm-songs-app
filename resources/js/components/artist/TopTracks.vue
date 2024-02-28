<template>
    <div v-if="top_tracks.track.length" class="flex my-4 items-center gap-2" v-for="(track, index) in top_tracks.track" :key="index">
        <div class="bg-black flex justify-center items-center rounded-md h-12 w-12">
            <fwb-avatar size="md" v-if="track.image && track.image.length > 0" :img="track.image[0]['#text']" />
        </div>
        <div class="flex-col py-1">
            <p class="text-white font-bold text-sm">
                {{ track.name }}
            </p>
        </div>
    </div>

    <div v-else class="flex mt-4 text-white justify-center items-center">
        <v-icon name="hi-emoji-sad" scale="3"/>
        <span>{{ artist_name }} has no tracks</span>
    </div>

    <button class="text-white bg-black py-2 px-4 rounded-md" v-show="top_tracks.track.length > 0">
        <Link :href="route('artist.top_tracks.index',
            { 'artist': artist_name }
        )">
        View More...
        </Link>
    </button>
</template>

<script setup lang="ts">

import { defineProps } from 'vue';

import { Link } from '@inertiajs/vue3';

import { FwbAvatar } from 'flowbite-vue';

import { ArtistTopTrackInterface } from '../../interfaces';

interface RecentTracksInterface {
    top_tracks: ArtistTopTrackInterface;
    artist_name: string;
}

const { top_tracks, artist_name } = defineProps<RecentTracksInterface>()

</script>