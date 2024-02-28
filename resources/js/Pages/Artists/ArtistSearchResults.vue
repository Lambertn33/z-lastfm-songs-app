<template>
    <!--Header-->
    <the-header :backLink="route('artists.index')" :title="`All search results for ${results['@attr'].for}`"
        :total="`${results['opensearch:totalResults']} results`" />

    <!--search results-->
    <div class="bg-[#262626] p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
            <div class="flex my-4 items-center gap-2" v-for="(artist, index) in results.artistmatches.artist" :key="index">
                <span class="text-white font-bold">{{ index + 1 }}.</span>
                <div class="bg-black flex justify-center items-center rounded-md h-12 w-12">
                    <fwb-avatar size="md" v-if="artist.image && artist.image.length > 0" :img="artist.image[0]['#text']" />
                </div>
                <div class="flex-col py-1 gap-3">
                    <Link :href="route('artists.index', {artist: artist.name })" class="text-white font-bold hover:text-gray-600">
                        {{ artist.name }}
                    </Link>
                    <div class="text-white flex gap-3 items-center">
                        <div>
                            <v-icon name="co-headphones" />
                            <span class="text-xs">{{ artist.listeners }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Navigation-->
        <the-navigation :currentPage="parseInt(results['opensearch:Query'].startPage)"
            :totalPages="parseInt(results['opensearch:totalResults'])" :pageCount="pageCount" :isFirstPage="pageCount < 2"
            :isLastPage="pageParams >= parseInt(results['opensearch:totalResults'])" @prev="prevPageHandler()"
            @next="nextPageHandler()" />
    </div>
</template>

<script setup lang="ts">

import { defineProps, ref, watch } from 'vue';

import { Link, useForm } from "@inertiajs/vue3";

import { FwbAvatar } from 'flowbite-vue'

import { ArtistSearchResultInterface } from "../../interfaces";

interface ArtistSearchResultProps {
    results: ArtistSearchResultInterface;
    search: string;
}

const { results } = defineProps<ArtistSearchResultProps>();

const currentUrl = new URL(window.location.href);

const searchParams = new URLSearchParams(currentUrl.search);

const pageParams = parseInt(searchParams.get('page')!) || 1;

const searchParam = searchParams.get("search");

const pageCount = ref(pageParams);

const nextPageForm = useForm({
    search: searchParam,
    page: pageCount.value + 1,
});

const prevPageForm = useForm({
    search: searchParam,
    page: pageCount.value > 1 ? pageCount.value - 1 : 1,
});

watch(pageCount, (newValue) => {
    nextPageForm.page = newValue + 1;
    prevPageForm.page = newValue > 1 ? newValue - 1 : 1;
});

const nextPageHandler = () => {
    nextPageForm.get(`/artists`);
};

const prevPageHandler = () => {
    prevPageForm.get(`/artists`);
};

</script>