<template>
    <form class="mt-20 mx-auto w-2/5" @submit.prevent="searchAlbumHandler">
        <fwb-input v-model="form.search" placeholder="Search an album......" size="lg">
            <template #suffix>
                <fwb-button>Search</fwb-button>
            </template>
        </fwb-input>
    </form>
</template>

<script setup lang="ts">

import { useForm } from '@inertiajs/vue3'

import { FwbButton, FwbInput } from 'flowbite-vue'

const form = useForm({
    search: ''
})

const searchAlbumHandler = () => form.get('/albums');

</script>