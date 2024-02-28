<template>
    <form class="mt-20 mx-auto w-2/5" @submit.prevent="searchArtistHandler">
        <fwb-input v-model="form.search" placeholder="Search an artist......" size="lg">
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

const searchArtistHandler = () => form.get('/artists');

</script>