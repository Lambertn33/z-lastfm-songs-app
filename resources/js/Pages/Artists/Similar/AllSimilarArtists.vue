<template>
    <!--Header-->
    <the-header :backLink="route('artists.index', { artist })" :title="`All similar artists for ${artist}`"
        :total="`${artist_all_similar_artists.artist.length} artists`" />

    <div class="bg-[#262626] p-8">
        <!--Similar artists list-->
        <div class="grid grid-cols-2 lg:grid-cols-3">
            <div class="flex my-4 items-center gap-2" v-for="(artist, index) in artist_all_similar_artists.artist"
                :key="index">
                <span class="text-white font-bold">{{ index + 1 }}.</span>
                <div class="bg-black flex justify-center items-center rounded-md h-12 w-12">
                    <fwb-avatar size="md" v-if="artist.image && artist.image.length > 0" :img="artist.image[0]['#text']" />
                </div>
                <Link :href="route('artists.index', { 'artist': artist.name })"
                    class="text-md text-white hover:text-gray-600">{{ artist.name }}
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import { defineProps } from 'vue';

import { Link } from "@inertiajs/vue3";

import { FwbAvatar } from 'flowbite-vue';

import { SimilarArtistInterface } from "../../../interfaces";

interface AllSimilarArtistsProps {
    artist: string;
    artist_all_similar_artists: SimilarArtistInterface
}

const { artist, artist_all_similar_artists } = defineProps<AllSimilarArtistsProps>();

</script>