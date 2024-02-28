<template>
    <!--Header-->
    <the-header :backLink="route('albums.index')" :title="`All search results for ${results['@attr'].for}`"
        :total="`${results['opensearch:totalResults']} results`" />

    <div class="bg-[#262626] p-8">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            <div class="flex my-4 items-center gap-2" v-for="(album, index) in results.albummatches.album" :key="index">
                <span class="text-white font-bold">{{ index + 1 }}.</span>
                <div class="bg-black flex justify-center items-center rounded-md h-12 w-12">
                    <fwb-avatar size="md" v-if="album.image && album.image.length > 0" :img="album.image[0]['#text']" />
                </div>
                <div class="flex-col py-1 gap-3">
                    <Link v-if="album.mbid !== ''" :href="route('albums.index', { album: album.mbid })"
                        class="text-white font-bold hover:text-gray-600">
                    {{ album.name }}
                    </Link>
                    <span v-else class="cursor-not-allowed text-white font-bold">
                        {{ album.name }}
                    </span>
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

import { FwbAvatar } from 'flowbite-vue';

import { AlbumSearchResultInterface } from "../../interfaces";

interface AlbumSearchResultProps {
    results: AlbumSearchResultInterface;
    search: string;
}

const { results } = defineProps<AlbumSearchResultProps>();

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
    nextPageForm.get(`/albums`);
};

const prevPageHandler = () => {
    prevPageForm.get(`/albums`);
};

</script>