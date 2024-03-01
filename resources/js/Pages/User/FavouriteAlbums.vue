<template>
    <div class="p-24 flex-col gap-3">
        <h2 class="text-white text-2xl font-bold text-center">My Favourite Albums</h2>
        <div class="mt-8">
            <fwb-table v-if="albums.length">
                <fwb-table-head>
                    <fwb-table-head-cell>Album name</fwb-table-head-cell>
                    <fwb-table-head-cell>Artist</fwb-table-head-cell>
                    <fwb-table-head-cell>Number of tracks</fwb-table-head-cell>
                    <fwb-table-head-cell>Release date</fwb-table-head-cell>
                    <fwb-table-head-cell>
                        <span class="sr-only">Edit</span>
                    </fwb-table-head-cell>
                </fwb-table-head>
                <fwb-table-body>
                    <fwb-table-row v-for="album in albums">
                        <fwb-table-cell><a :href="album.album_url" target="_blank" class="text-blue-500">{{ album.album_name
                        }}</a></fwb-table-cell>
                        <fwb-table-cell>{{ album.artist_name }}</fwb-table-cell>
                        <fwb-table-cell>{{ album.number_of_tracks }} tracks</fwb-table-cell>
                        <fwb-table-cell>{{ album.release_date }}</fwb-table-cell>
                        <fwb-table-cell>
                            <button class="bg-black text-white py-2 px-4 rounded-md"
                                @click="deleteFavourite(album.album_mbid)">Remove</button>
                        </fwb-table-cell>
                    </fwb-table-row>
                </fwb-table-body>
            </fwb-table>
            <div v-else class="text-center">
                <span class="text-white text-md font-light text-center">
                    You don't have any favourite albums
                </span>
            </div>
        </div>
    </div>
</template>
  
<script setup lang="ts">
import { defineProps, ref, watch } from 'vue';

import { useForm } from '@inertiajs/vue3';

import { UserInterface, UserFavouriteAlbumInterface } from "../../interfaces";

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

const { favourite_albums } = user;

const albums = ref<UserFavouriteAlbumInterface[]>(favourite_albums);

const removeFromFavouriteForm = useForm({
    album_mbid: '',
});

const deleteFavourite = (albumId: string) => {
    removeFromFavouriteForm.album_mbid = albumId;

    removeFromFavouriteForm.delete(`/user/favourite_albums/${albumId}`, {

        onSuccess: () => {
            albums.value = albums.value.filter(album => album.album_mbid !== albumId);

            Swal.fire({
                title: 'Success',
                text: "Album removed from favourites successfully",
                icon: "success",
            });
        }
    });
};
</script>