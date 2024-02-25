<template>
    <div v-for="(artist, index) in top_artists" :key="index" class="flex my-4 items-center gap-2">
        <div class="bg-black flex justify-center items-center rounded-md h-12 w-12">
            <fwb-avatar size="md" v-if="artist.image && artist.image.length > 0" :img="artist.image[1]['#text']" />
        </div>
        <div>
            <p class="text-white font-bold">
                {{ artist.name }}
            </p>
        </div>
    </div>
</template>

<script lang="ts" setup>

import { defineProps } from 'vue';

import { FwbAvatar } from 'flowbite-vue';

import { ArtistInterface } from '../../interfaces';

interface TopArtistsInterface {
    top_artists: ArtistInterface[]
}

const { top_artists } = defineProps<TopArtistsInterface>()

</script>