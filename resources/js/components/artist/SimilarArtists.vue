<template>
    <div v-if="similar_artists.artist.length" v-for="(artist, index) in similar_artists.artist" :key="index" class="flex my-4 items-center gap-2">
        <div class="bg-black flex justify-center items-center rounded-md h-12 w-12">
            <fwb-avatar size="md" v-if="artist.image && artist.image.length > 0" :img="artist.image[1]['#text']" />
        </div>
        <div>
            <p class="text-white font-bold">
                {{ artist.name }}
            </p>
        </div>
    </div>

    <div v-else class="flex mt-4 text-white justify-center items-center">
        <v-icon name="hi-emoji-sad" scale="3"/>
        <span>{{ artist_name }} has no similar artists</span>
    </div>

    <button class="text-white bg-black py-2 px-4 rounded-md" v-show="similar_artists.artist.length > 0">
        <Link :href="route('artist.similar.index',
            { 'artist': artist_name }
        )">
        View More...
        </Link>
    </button>
    
</template>

<script lang="ts" setup>

import { defineProps } from 'vue';

import { Link } from '@inertiajs/vue3'

import { FwbAvatar } from 'flowbite-vue';

import { SimilarArtistInterface } from '../../interfaces';

interface TopArtistsInterface {
    similar_artists: SimilarArtistInterface,
    artist_name: string
}

const { similar_artists, artist_name } = defineProps<TopArtistsInterface>()

</script>