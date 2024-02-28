<template>
    <form @submit.prevent="submitForm" class="mt-20 mx-auto w-2/5">
        <fwb-input v-model="form.search" :placeholder="placeholder" size="lg">
            <template #suffix>
                <fwb-button type="submit">Search</fwb-button>
            </template>
        </fwb-input>
    </form>
</template>
  
<script setup lang="ts">

import { ref, defineProps } from 'vue';

import { useForm } from '@inertiajs/vue3';

import { FwbButton, FwbInput } from 'flowbite-vue';

interface SearchInputProps {
    placeholder: string;
    endpoint: string;
}

const { placeholder, endpoint } = defineProps<SearchInputProps>()

const form = useForm({
    search: ''
})

const submitForm = () => {
    form.get(endpoint)
}
</script>