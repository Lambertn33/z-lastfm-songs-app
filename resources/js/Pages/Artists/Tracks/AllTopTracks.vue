<template>

    <!--Header-->
    <the-header :backLink="route('artists.index', { artist })" :title="`All top tracks for ${artist}`"
        :total="`${artist_all_top_tracks['@attr'].total} tracks`" />


    <div class="bg-[#262626] p-8">
        <!--Tracks List-->
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

        <!--Navigation-->
        <the-navigation :currentPage="artist_all_top_tracks['@attr'].page"
            :totalPages="artist_all_top_tracks['@attr'].totalPages" :pageCount="pageCount" :isFirstPage="pageCount < 2"
            :isLastPage="pageParams >= parseInt(artist_all_top_tracks['@attr'].totalPages)" @prev="prevPageHandler()"
            @next="nextPageHandler()" />
    </div>
</template>

<script setup lang="ts">

import { defineProps, ref, watch } from 'vue';

import { useForm } from "@inertiajs/vue3";

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