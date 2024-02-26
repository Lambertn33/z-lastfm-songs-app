<template>
    <fwb-navbar class="bg-[#262626]">

        <template #logo>
            <fwb-navbar-logo alt="Flowbite logo" image-url="/images/logo.png" link="/">
                <span class="text-white">Songs app</span>
            </fwb-navbar-logo>
        </template>

        <template #default="{ isShowMenu }">
            <fwb-navbar-collapse :is-show-menu="isShowMenu">
                <fwb-navbar-link>
                    <Link href="/" class="text-white">Home</Link>
                </fwb-navbar-link>
                <fwb-navbar-link>
                    <Link href="/artists" class="text-white">Artists</Link>
                </fwb-navbar-link>
                <fwb-navbar-link>
                    <Link href="/albums" class="text-white">Albums</Link>
                </fwb-navbar-link>
            </fwb-navbar-collapse>
        </template>

        <template #right-side>
            <fwb-button v-if="!isAuthenticated">
                <Link href="/auth">Authenticate</Link>
            </fwb-button>
            <div v-else class="relative">
                <fwb-avatar :img="user?.avatar" rounded class="cursor-pointer" @click="toggleRightMenu" />
                <div class="absolute right-0" :class="!isRightMenuShown ? 'hidden' : ''">
                    <fwb-list-group>
                        <fwb-list-group-item hover @click="$emit('logout')">
                            Logout
                        </fwb-list-group-item>
                    </fwb-list-group>
                </div>
            </div>
        </template>

    </fwb-navbar>
</template>
  
<script setup lang="ts">

import { Link } from "@inertiajs/vue3";

import { ref, defineProps, defineEmits } from "vue";

import { UserInterface } from "../../interfaces";

import {
    FwbAvatar,
    FwbButton,
    FwbListGroup,
    FwbListGroupItem,
    FwbNavbar,
    FwbNavbarCollapse,
    FwbNavbarLink,
    FwbNavbarLogo,
} from 'flowbite-vue'


interface TheNavbarProps {
    user: UserInterface | null;
    isAuthenticated: boolean
}

const isRightMenuShown = ref<boolean>(false);

const { isAuthenticated, user } = defineProps<TheNavbarProps>();

// Function to toggle the right menu list
const toggleRightMenu = () => {
    isRightMenuShown.value = !isRightMenuShown.value;
}

// Define emits
const emits = defineEmits(['logout']);

</script>