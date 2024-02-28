<template>
    <div class="h-full bg-black pt-20 mx-auto">
        <form @submit.prevent="submitForm" class="w-4/5 lg:w-2/5 mx-auto">
            <div class="bg-gray-500 p-8 rounded-md">
                <div class="mb-6 text-center">
                    <span class="text-3xl font-bold">{{ title }}</span>
                </div>
                <fwb-input v-model="form.search" :placeholder="placeholder" size="lg">
                    <template #suffix>
                        <button class="bg-black text-white py-2 px-4 rounded-md" type="submit"
                            :disabled="form.search === ''">Search</button>
                    </template>
                </fwb-input>
            </div>
        </form>
    </div>
</template>
  
<script setup lang="ts">

import { defineProps } from 'vue';

import { useForm } from '@inertiajs/vue3';

import { FwbInput } from 'flowbite-vue';

interface SearchInputProps {
    placeholder: string;
    endpoint: string;
    title: string;
}

const { placeholder, endpoint, title } = defineProps<SearchInputProps>()

const form = useForm({
    search: ''
});

const submitForm = () => {
    form.get(endpoint)
}
</script>