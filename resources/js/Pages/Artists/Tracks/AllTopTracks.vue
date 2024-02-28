<template>
    <div class=" bg-black  py-8 px-6 flex h-[300px]">
        <div>
            <Link :href="route('artists.index', { 'artist': artist })" class="text-white flex items-center gap-3">
            <v-icon name="fa-arrow-left" fill="#fff" />
            Back
            </Link>
        </div>
        <div class="flex items-center justify-center w-full gap-4">
            <span class="text-white font-semibold text-3xl uppercase text-center">All top tracks for <span
                    class="underline">{{ artist }}</span></span>
            <span class="text-white">{{ artist_all_top_tracks['@attr'].total }} tracks</span>
        </div>
    </div>
    <div class="bg-[#262626] p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
            <div class="flex my-4 items-center gap-2" v-for="(track, index) in artist_all_top_tracks.track" :key="index">
                <span class="text-white font-bold">{{ index + 1 }}.</span>
                <div class="bg-black flex justify-center items-center rounded-md h-12 w-12">
                    <fwb-avatar size="md" v-if="track.image && track.image.length > 0" :img="track.image[0]['#text']" />
                </div>
                <div class="flex-col py-1 gap-3">
                    <a :href="track.url" target="_blank" class="text-white font-bold hover:text-gray-600">
                        {{ track.name }}
                    </a>
                    <div class="text-white flex gap-3 items-center">
                        <div>
                            <v-icon name="co-headphones" />
                            <span class="text-xs">{{ track.listeners }}</span>
                        </div>
                        <div>
                            <v-icon name="md-playarrow" />
                            <span class="text-xs">{{ track.playcount }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-col mt-8">
            <div class="flex gap-3 justify-center">
                <button class="text-white bg-black py-2 px-4 rounded-md"
                    :class="pageCount < 2 ? 'cursor-not-allowed' : 'cursor-pointer'" :disabled="(pageCount < 2)"
                    @click="prevPageHandler()">&lt&lt Prev</button>

                <button class="text-white bg-black py-2 px-4 rounded-md cursor-pointer"
                    :disabled="pageParams === parseInt(artist_all_top_tracks['@attr'].totalPages)"
                    @click="nextPageHandler()">Next >></button>
            </div>
            <div class="flex justify-center">
                <span class="text-white mt-2 justify-center">
                    Showing page {{ artist_all_top_tracks['@attr'].page }} of {{ artist_all_top_tracks['@attr'].totalPages
                    }}
                    pages
                </span>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import { defineProps, ref, watch } from 'vue';

import { useForm, Link } from "@inertiajs/vue3";

import { FwbAvatar } from 'flowbite-vue';

import { ArtistTopTrackInterface } from "../../../interfaces";

interface AllTopTracksProps {
    artist: string;
    artist_all_top_tracks: ArtistTopTrackInterface
}

const { artist, artist_all_top_tracks } = defineProps<AllTopTracksProps>();

const currentUrl = new URL(window.location.href);

const searchParams = new URLSearchParams(currentUrl.search);

const pageParams = parseInt(searchParams.get('page')!) || 1;

const pageCount = ref(pageParams);

const nextPageForm = useForm({
    page: pageCount.value + 1,
});

const prevPageForm = useForm({
    page: pageCount.value > 1 ? pageCount.value - 1 : 1,
});

watch(pageCount, (newValue) => {
    nextPageForm.page = newValue + 1;
    prevPageForm.page = newValue > 1 ? newValue - 1 : 1;
});

const nextPageHandler = () => {
    nextPageForm.get(`/artists/${artist}/top_tracks`);
};

const prevPageHandler = () => {
    prevPageForm.get(`/artists/${artist}/top_tracks`);
};

</script>