<template>
    <div class=" bg-black  py-8 flex">
        <div>
            <span class="text-white">Back</span>
        </div>
        <div class="flex-col items-center">
            <div class="flex mt-8 gap-8">
                <div class="flex items-center  gap-2">
                    <span class="text-white font-semibold text-3xl uppercase">All top albums for {{ artist }}</span>
                </div>
                <span class="text-white"></span>
            </div>
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
        <div class="flex mt-8 justify-center">
            <div class="flex gap-3">

                <button class="text-white bg-black py-2 px-4 rounded-md"
                    :class="pageCount < 2 ? 'cursor-not-allowed' : 'cursor-pointer'" :disabled="(pageCount < 2)"
                    @click="prevPageHandler()">Prev</button>

                <button class="text-white bg-black py-2 px-4 rounded-md cursor-pointer"
                    :disabled="pageParams === parseInt(artist_all_top_albums['@attr'].totalPages)"
                    @click="nextPageHandler()">Next</button>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import { defineProps, ref, watch } from 'vue';

import { useForm } from "@inertiajs/vue3";

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
    page: pageCount.value + 1
});

const prevPageForm = useForm({
    page: pageCount.value > 1 ? pageCount.value - 1 : 1
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