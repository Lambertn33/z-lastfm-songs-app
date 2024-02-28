<template>
    <div class="flex my-4 items-center gap-2" v-for="(track, index) in top_tracks.track" :key="index">
        <div class="bg-black flex justify-center items-center rounded-md h-12 w-12">
            <fwb-avatar size="md" v-if="track.image && track.image.length > 0" :img="track.image[0]['#text']" />
        </div>
        <div class="flex-col py-1">
            <p class="text-white font-bold text-sm">
                {{ track.name }}
            </p>
            <div class="text-white flex gap-3 mt-2 items-center">
                <div class="flex gap-1">
                    <v-icon name="co-album" />
                    <span class="text-xs">{{ track.artist.name }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import { defineProps } from 'vue';

import { FwbAvatar } from 'flowbite-vue';

import { ArtistTopTrackInterface } from '../../interfaces';

interface RecentTracksInterface {
    top_tracks: ArtistTopTrackInterface
}

const { top_tracks } = defineProps<RecentTracksInterface>()

</script>