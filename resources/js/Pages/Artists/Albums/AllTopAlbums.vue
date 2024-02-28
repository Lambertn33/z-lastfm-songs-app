<template>
    <div class=" bg-black  py-8 px-6 flex h-[300px]">
        <!-- <div>
            <span class="text-white">Back</span>
        </div> -->
        <Link :href="route('artists.index', { 'artist': artist })" class="text-white">
        Backd
        </Link>
        <div class="flex items-center justify-center w-full gap-4">
            <span class="text-white font-semibold text-3xl uppercase text-center">All top albums for {{ artist }}</span>
            <span class="text-white">{{ artist_all_top_albums['@attr'].total }} Albums</span>
        </div>
    </div>
    <div class="bg-[#262626] p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
            <div class="flex my-4 items-center gap-2" v-for="(album, index) in artist_all_top_albums.album" :key="index">
                <div class="bg-black flex justify-center items-center rounded-md h-12 w-12">
                    <fwb-avatar size="md" v-if="album.image && album.image.length > 0" :img="album.image[0]['#text']" />
                </div>
                <div class="flex-col py-1 gap-3">
                    <p class="text-white font-bold">
                        {{ album.name }}
                    </p>
                    <div class="text-white flex gap-1">
                        <v-icon name="fa-user-alt" />
                        <span class="text-xs">{{ album.artist.name }}</span>
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
                    :disabled="pageParams === parseInt(artist_all_top_albums['@attr'].totalPages)"
                    @click="nextPageHandler()">Next >></button>
            </div>
            <div class="flex justify-center">
                <span class="text-white mt-2 justify-center">
                    Showing page {{ artist_all_top_albums['@attr'].page }} of {{ artist_all_top_albums['@attr'].totalPages
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

import { ArtistTopAlbumInterface } from "../../../interfaces";

interface AllTopAlbumsProps {
    artist: string;
    artist_all_top_albums: ArtistTopAlbumInterface
}

const { artist, artist_all_top_albums } = defineProps<AllTopAlbumsProps>();

const currentUrl = new URL(window.location.href);

const searchParams = new URLSearchParams(currentUrl.search);

const pageParams = parseInt(searchParams.get('page')!) || 1;

const pageCount = ref(pageParams);

const nextPageForm = useForm({
    page: pageCount.value + 1,
    limit: 20
});

const prevPageForm = useForm({
    page: pageCount.value > 1 ? pageCount.value - 1 : 1,
    limit: 20
});

watch(pageCount, (newValue) => {
    nextPageForm.page = newValue + 1;
    prevPageForm.page = newValue > 1 ? newValue - 1 : 1;
});

const nextPageHandler = () => {
    nextPageForm.get(`/artists/${artist}/top_albums`);
};

const prevPageHandler = () => {
    prevPageForm.get(`/artists/${artist}/top_albums`);
};

</script>