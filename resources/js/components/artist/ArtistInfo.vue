<template>
    <div class=" bg-black  py-8">
        <div class="px-6 flex">
            <Link :href="route('artists.index')" class="text-white hover:text-gray-600 flex items-center gap-3 cursor-pointer">
            <v-icon name="fa-arrow-left" />
            Search again
            </Link>
        </div>
        <div class="flex items-center justify-center">
            <div class="flex-col justify-end">
                <fwb-avatar size="xl" v-if="artist.image && artist.image.length > 0" :img="artist.image[0]['#text']"
                    rounded />
                <div class="mt-8 gap-8 text-center">
                    <div class="flex items-center gap-2">
                        <v-icon name="fa-user-alt" fill="#76a9fa" />
                        <a :href="artist.url" target="_blank">
                            <span class="text-blue-400 font-semibold">{{ artist.name }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import { defineProps } from 'vue';

import { FwbAvatar } from 'flowbite-vue';

import { ArtistInterface } from '../../interfaces';
import { Link } from '@inertiajs/vue3';

interface ArtistInfoInterface {
    artist: ArtistInterface
}

const { artist } = defineProps<ArtistInfoInterface>()
</script>