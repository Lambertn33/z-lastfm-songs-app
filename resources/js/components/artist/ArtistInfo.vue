<template>
    <div class=" bg-black flex justify-center items-center py-8">
        <div class="flex-col items-center">
            <div class="flex justify-center">
                <fwb-avatar size="xl" v-if="artist.image && artist.image.length > 0" :img="artist.image[0]['#text']"
                    rounded />
            </div>
            <div class="flex mt-8 gap-8">
                <div class="flex items-center gap-2">
                    <v-icon name="fa-user-alt" fill="#76a9fa" />
                    <a :href="artist.url" target="_blank">
                        <span class="text-blue-400 font-semibold">{{ artist.name }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import { defineProps } from 'vue';

import { FwbAvatar } from 'flowbite-vue';

import { ArtistInterface } from '../../interfaces';

interface ArtistInfoInterface {
    artist: ArtistInterface
}

const { artist } = defineProps<ArtistInfoInterface>()
</script>