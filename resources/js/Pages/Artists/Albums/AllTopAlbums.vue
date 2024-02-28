<template>
    <!--Header-->
    <the-header :backLink="route('artists.index', { artist })" :title="`All top albums for ${artist}`"
        :total="`${artist_all_top_albums['@attr'].total} albums`" />

      
    <div class="bg-[#262626] p-8">
        <!--Albums list-->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
            <div class="flex my-4 items-center gap-2" v-for="(album, index) in artist_all_top_albums.album" :key="index">
                <span class="text-white font-bold">{{ index + 1 }}.</span>
                <div class="bg-black flex justify-center items-center rounded-md h-12 w-12">
                    <fwb-avatar size="md" v-if="album.image && album.image.length > 0" :img="album.image[0]['#text']" />
                </div>
                <div class="flex-col py-1 gap-3 text-white">
                    <a :href="album.url" target="_blank" class="font-bold hover:text-gray-600">
                        {{ album.name }}
                    </a>
                    <div>
                        <v-icon name="md-playarrow" />
                        <span class="text-xs">{{ album.playcount }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!--Navigation-->
        <the-navigation :currentPage="artist_all_top_albums['@attr'].page"
            :totalPages="artist_all_top_albums['@attr'].totalPages" :pageCount="pageCount" :isFirstPage="pageCount < 2"
            :isLastPage="pageParams >= parseInt(artist_all_top_albums['@attr'].totalPages)" @prev="prevPageHandler()"
            @next="nextPageHandler()" />
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
    nextPageForm.get(`/artists/${artist}/top_albums`);
};

const prevPageHandler = () => {
    prevPageForm.get(`/artists/${artist}/top_albums`);
};

</script>