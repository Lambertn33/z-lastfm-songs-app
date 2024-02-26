<template>
    <div class="flex my-4 items-center gap-2" v-for="(album, index) in top_albums" :key="index">
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
    <fwb-button>
        <Link :href="route('artist.top_albums.index',
            { 'artist': artist_name }
        )">
        View More...
        </Link>
    </fwb-button>
</template>

<script lang="ts" setup>

import { defineProps } from 'vue';

import { Link } from '@inertiajs/vue3'

import { FwbAvatar, FwbButton } from 'flowbite-vue';

import { ArtistTopAlbumInterface } from '../../interfaces';

interface TopAlbumsInterface {
    top_albums: ArtistTopAlbumInterface[],
    artist_name: string
}

const { top_albums, artist_name } = defineProps<TopAlbumsInterface>();
</script>