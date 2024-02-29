<template>
    <div class=" bg-black flex-col justify-center items-center py-8">

        <div class="px-6 flex">
            <Link :href="route('albums.index')" class="text-white hover:text-gray-600 flex items-center gap-3">
            <v-icon name="fa-arrow-left" />
            Search again
            </Link>
        </div>

        <!--Album header-->
        <div class="flex-col items-center justify-center">
            <!--Album cover image-->
            <div class="flex justify-center">
                <fwb-avatar size="xl" v-if="album.image && album.image.length > 0" :img="album.image[0]['#text']" rounded />
            </div>

            <!--Album Info-->
            <div class="flex mt-8 gap-4 justify-center">
                <div class="flex items-center gap-2 text-blue-400">
                    <v-icon name="co-album" fill="#76a9fa" scale="1" />
                    <a :href="album.url" target="_blank">
                        <span class="text-blue-400 font-semibold">{{ album.name }}</span>
                    </a>
                </div>
                <div class="flex items-center gap-2 text-blue-400">
                    <v-icon name="fa-user-alt" fill="#76a9fa" scale="1" />
                    <Link :href="route('artists.index', { artist: album.artist })" target="_blank">
                    <span class="text-blue-400 font-semibold">{{ album.artist }}</span>
                    </Link>
                </div>
                <div class="flex items-center gap-1 text-white">
                    <v-icon name="co-headphones" fill="#76a9fa" scale="1" />
                    <span class="font-semibold">{{ album.listeners }}</span>

                </div>
                <div class="flex items-center gap-1 text-white">
                    <v-icon name="md-playarrow" scale="1" />
                    <span class="font-semibold">{{ album.tracks.track.length }}</span>
                </div>
                <div class="flex items-center gap-1 text-white">
                    <v-icon name="bi-calendar-date" scale="1" />
                    <span class="font-semibold">{{ album.wiki.published }}</span>
                </div>
            </div>

            <!--Album Tags-->
            <div class="flex justify-center mt-4">
                <fwb-badge type="green" v-for="tag in album.tags.tag">{{ tag.name }}</fwb-badge>
            </div>

            <!--Add/remove album to user favourite-->
            <div class="flex justify-center mt-4" v-if="user">
                <v-icon :name="isAlbumInFavorites ? 'md-favorite' : 'md-favoriteborder'" fill="#fff" scale="2"
                    class="cursor-pointer" @click="toggleFavourite" />
            </div>
        </div>
    </div>
    <div class="bg-[#262626] py-8 px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            <div class="flex my-4 items-center gap-2" v-for="(track, index) in album.tracks.track" :key="index">
                <!--  -->
                <div class="flex items-center py-1 gap-3 cursor-pointer text-white font-bold hover:text-gray-600">
                    <span>{{ index + 1 }}.</span>
                    <div class="bg-black flex justify-center items-center rounded-md h-12 w-12">
                        <v-icon name="md-playarrow" scale="2" fill="#fff" />
                    </div>
                    <a :href="track.url" target="_blank">
                        {{ track.name }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import { defineProps, ref } from 'vue';

import { Link, useForm } from '@inertiajs/vue3';

import { FwbAvatar, FwbBadge } from 'flowbite-vue';

import { AlbumDetails, UserInterface } from "../../interfaces";

interface AlbumViewProps {
    album: AlbumDetails,
    user: UserInterface
}

const { album, user } = defineProps<AlbumViewProps>();

const isAlbumInFavorites = ref(false);

const currentUrl = new URL(window.location.href);

const searchParams = new URLSearchParams(currentUrl.search);

const album_mbid = searchParams.get("album");

if (user && user.favourite_albums.some((favAlbum) => favAlbum.album_mbid === album_mbid)) {
    isAlbumInFavorites.value = true;
}

const addToFavouriteForm = useForm({
    album_mbid: album_mbid,
    album_name: album.name ?? '',
    release_date: album.wiki.published ?? '',
    number_of_tracks: album.tracks.track.length ?? '',
    artist_name: album.artist ?? '',
    album_url: album.url ?? ''
});

const removeFromFavouriteForm = useForm({
    album_mbid: album_mbid,
});

const toggleFavourite = () => {
    if (isAlbumInFavorites.value) {
        // Remove from favorites
        removeFromFavouriteForm.delete('/user/favourite_albums', {
            onSuccess: () => isAlbumInFavorites.value = false
        });
    } else {
        // Add to favorites
        addToFavouriteForm.post('/user/favourite_albums', {
            onSuccess: () => isAlbumInFavorites.value = true
        });
    }
};



</script>