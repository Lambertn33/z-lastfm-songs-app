<template>
    <div class="bg-black py-8 px-6 flex h-[300px]">
        <div>
            <Link :href="backLink" class="text-white flex items-center gap-3">
            <v-icon name="fa-arrow-left" fill="#fff" />
            Back
            </Link>
        </div>
        <div class="flex items-center justify-center w-full gap-4">
            <span class="text-white font-semibold text-3xl uppercase text-center">{{ title }}</span>
            <span class="text-white">{{ total }}</span>
        </div>
    </div>
</template>

<script setup lang="ts">

import { defineProps } from 'vue';

import { Link } from "@inertiajs/vue3";

const { backLink, title, total } = defineProps<{
    backLink: string;
    title: string;
    total: number;
}>();

</script>