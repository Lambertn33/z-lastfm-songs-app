<template>
    <div class=" bg-black  py-8">
        <div class="px-6 flex">
            <Link :href="route('artists.index')"
                class="text-white hover:text-gray-600 flex items-center gap-3 cursor-pointer">
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
                <div class="flex justify-center mt-4" v-if="user">
                    <v-icon :name="isArtistInFavorites ? 'md-favorite' : 'md-favoriteborder'" fill="#fff" scale="2"
                        class="cursor-pointer" @click="toggleFavourite" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import { defineProps, ref } from 'vue';

import { FwbAvatar } from 'flowbite-vue';

import { ArtistInterface, UserInterface } from '../../interfaces';

import { Link, useForm } from '@inertiajs/vue3';

interface ArtistInfoInterface {
    artist: ArtistInterface,
    user: UserInterface
}

const isArtistInFavorites = ref(false);

const { artist, user } = defineProps<ArtistInfoInterface>();

if (user && user.favourite_artists.some((favArtist) => favArtist.artist_mbid === artist.mbid)) {
    isArtistInFavorites.value = true;
}

const addToFavouriteForm = useForm({
    artist_mbid: artist.mbid,
    artist_name: artist.name ?? '',
    artist_url: artist.url ?? ''
});

const removeFromFavouriteForm = useForm({
    artist_mbid: artist.mbid,
});

const toggleFavourite = () => {
    const endpoint = isArtistInFavorites.value ? `/user/favourite_artists/${artist.mbid}` : '/user/favourite_artists';
    const onSuccessMessage = isArtistInFavorites.value ? 'Artist removed from favourites' : 'Artist added to favourites';
    const onSuccessIcon = 'success';

    const requestData = {
        onSuccess: () => {
            isArtistInFavorites.value = !isArtistInFavorites.value;
            Swal.fire({
                title: 'Success',
                text: onSuccessMessage,
                icon: onSuccessIcon,
            });
        },
    };

    if (isArtistInFavorites.value) {
        removeFromFavouriteForm.delete(endpoint, requestData);
    } else {
        addToFavouriteForm.post(endpoint, requestData);
    }
};

</script>