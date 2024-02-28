<template>
    <div v-if="top_albums.album.length" class="flex my-4 items-center gap-2" v-for="(album, index) in top_albums.album" :key="index">
        <div class="bg-black flex justify-center items-center rounded-md h-12 w-12">
            <fwb-avatar size="md" v-if="album.image && album.image.length > 0" :img="album.image[0]['#text']" />
        </div>
        <div class="flex-col py-1 gap-3">
            <p class="text-white font-bold">
                {{ album.name }}
            </p>
        </div>
    </div>

    <div v-else class="flex mt-4 text-white justify-center items-center">
        <v-icon name="hi-emoji-sad" scale="3"/>
        <span>{{ artist_name }} has no albums</span>
    </div>

    <button class="text-white bg-black py-2 px-4 rounded-md" v-show="top_albums.album.length > 0">
        <Link :href="route('artist.top_albums.index',
            { 'artist': artist_name }
        )">
        View More...
        </Link>
    </button>
</template>

<script lang="ts" setup>

import { defineProps } from 'vue';

import { Link } from '@inertiajs/vue3';

import { FwbAvatar } from 'flowbite-vue';

import { ArtistTopAlbumInterface } from '../../interfaces';

interface TopAlbumsInterface {
    top_albums: ArtistTopAlbumInterface,
    artist_name: string
}

const { top_albums, artist_name } = defineProps<TopAlbumsInterface>();
</script>