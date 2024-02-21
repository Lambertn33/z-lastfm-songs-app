<template>
    <TheNavbar :user="user" :isAuthenticated="isAuthenticated" />
    <div class="h-screen">
        <slot></slot>
    </div>
</template>

<script setup lang="ts">
import { defineProps, computed } from "vue";
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

const props = defineProps<UserProps>();

// Access user prop
const user = computed(() => props.user);
const isAuthenticated = user.value !== null;
console.log(isAuthenticated);
</script>