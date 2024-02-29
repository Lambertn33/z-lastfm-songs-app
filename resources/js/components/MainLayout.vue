<template>
    <TheNavbar :user="user" :isAuthenticated="isAuthenticated" @logout="logoutHandler" />
    <div class="h-screen">
        <slot></slot>
    </div>
</template>

<script setup lang="ts">

import { defineProps, computed } from "vue";

import { router } from '@inertiajs/vue3';

import TheNavbar from "./UI/TheNavbar.vue";

import { UserInterface } from "../interfaces";


interface UserProps {
    user: UserInterface | null;
}

const props = defineProps<UserProps>();

// Access user prop
const user = computed(() => props.user);

const isAuthenticated = user.value !== null;

const logoutHandler = () => {
    router.post('/auth/logout');
    location.reload();
}

</script>