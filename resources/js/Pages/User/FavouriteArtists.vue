<template>
    <div class="p-24 flex-col gap-3">
        <h2 class="text-white text-2xl font-bold text-center">My Favourite Artists</h2>
        <div class="mt-8">
            <fwb-table v-if="artists.length">
                <fwb-table-head>
                    <fwb-table-head-cell>Artist name</fwb-table-head-cell>
                    <fwb-table-head-cell>
                        <span class="sr-only">Edit</span>
                    </fwb-table-head-cell>
                </fwb-table-head>
                <fwb-table-body>
                    <fwb-table-row v-for="artist in artists">
                        <fwb-table-cell><a :href="artist.artist_url" target="_blank" class="text-blue-500">{{
                            artist.artist_name }}</a></fwb-table-cell>
                        <fwb-table-cell>
                            <button @click="deleteFavourite(artist.artist_mbid)"
                                class="bg-black text-white py-2 px-4 rounded-md">Remove</button>
                        </fwb-table-cell>
                    </fwb-table-row>
                </fwb-table-body>
            </fwb-table>
            <div v-else class="text-center">
                <span class="text-white text-md font-light text-center">
                    You don't have any favourite artist
                </span>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { defineProps, ref } from 'vue';

import { useForm } from '@inertiajs/vue3';

import { UserFavouriteArtistInterface, UserInterface } from "../../interfaces";

import {
    FwbTable,
    FwbTableBody,
    FwbTableCell,
    FwbTableHead,
    FwbTableHeadCell,
    FwbTableRow,
} from 'flowbite-vue';

interface FavouriteAlbumsProps {
    user: UserInterface
}

const { user } = defineProps<FavouriteAlbumsProps>();

const { favourite_artists } = user;

const artists = ref<UserFavouriteArtistInterface[]>(favourite_artists);

const removeFromFavouriteForm = useForm({
    artist_mbid: '',
});

const deleteFavourite = (artistId: string) => {
    removeFromFavouriteForm.artist_mbid = artistId;

    removeFromFavouriteForm.delete(`/user/favourite_artists/${artistId}`, {

        onSuccess: () => {
            artists.value = artists.value.filter(artist => artist.artist_mbid !== artistId);
            
            Swal.fire({
                title: 'Success',
                text: "Artist removed from favourites successfully",
                icon: "success",
            });
        }
    });
};

</script>