<template>
    <TheNavbar :user="user" :isAuthenticated="isAuthenticated" @logout="logoutHandler" />
    <div class="h-screen">
        <slot></slot>
    </div>
</template>

<script setup lang="ts">

import { defineProps, computed } from "vue";

import { router, usePage } from '@inertiajs/vue3'

import TheNavbar from "./UI/TheNavbar.vue";

interface UserInterface {
    id: number;
    name: string;
    email: string;
    avatar: string;
}

interface UserProps {
    user: UserInterface | null;
}

const page = usePage();

const props = defineProps<UserProps>();

// Access user prop
const user = computed(() => props.user);

const isAuthenticated = user.value !== null;


const logoutHandler = () => {
    router.post('/auth/logout');
    location.reload();
}

</script>