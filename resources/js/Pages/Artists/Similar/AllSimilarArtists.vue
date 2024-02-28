<template>
    <div class=" bg-black  py-8 px-6 flex h-[300px]">
        <div>
            <Link :href="route('artists.index', { 'artist': artist })" class="text-white flex items-center gap-3">
            <v-icon name="fa-arrow-left" fill="#fff" />
            Back
            </Link>
        </div>
        <div class="flex items-center justify-center w-full gap-4">
            <span class="text-white font-semibold text-3xl uppercase text-center">All similar artists for {{ artist
            }}</span>
        </div>
    </div>
    <div class="bg-[#262626] p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            <div class="flex my-4 items-center gap-2" v-for="(artist, index) in artist_all_similar_artists.artist" :key="index">
                <div class="bg-black flex justify-center items-center rounded-md h-12 w-12">
                    <fwb-avatar size="md" v-if="artist.image && artist.image.length > 0" :img="artist.image[0]['#text']" />
                </div>
                <div class="flex-col py-1 gap-3">
                    <div class="text-white flex gap-1 items-center">
                        <span class="text-md">{{ artist.name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import { defineProps, ref, watch } from 'vue';

import { useForm, Link } from "@inertiajs/vue3";

import { FwbAvatar } from 'flowbite-vue';

import { SimilarArtistInterface } from "../../../interfaces";

interface AllSimilarArtistsProps {
    artist: string;
    artist_all_similar_artists: SimilarArtistInterface
}

const { artist, artist_all_similar_artists } = defineProps<AllSimilarArtistsProps>();

</script>