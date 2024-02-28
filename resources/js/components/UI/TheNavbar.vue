<template>
    <fwb-navbar class="bg-[#262626]">

        <template #logo>
            <fwb-navbar-logo alt="Flowbite logo" image-url="/images/logo.png" link="/">
                <span class="text-white">Songs app</span>
            </fwb-navbar-logo>
        </template>

        <template #default="{ isShowMenu }">
            <fwb-navbar-collapse :is-show-menu="isShowMenu">
                <div class="border-b md:border-none p-3 md:p-0">
                    <Link href="/" class="text-black lg:text-white">Home</Link>
                </div>
                <div class="border-b md:border-none p-3 md:p-0">
                    <Link href="/artists" class="text-black lg:text-white">Artists</Link>
                </div>
                <div class="border-b md:border-none p-3 md:p-0">
                    <Link href="/albums" class="text-black lg:text-white">Albums</Link>
                </div>
            </fwb-navbar-collapse>
        </template>

        <template #right-side>
            <button class="bg-black text-white py-2 px-4 rounded-md" v-if="!isAuthenticated">
                <Link href="/auth">Authenticate</Link>
            </button>
            <div v-else class="relative">
                <fwb-avatar :img="user?.avatar" rounded class="cursor-pointer" @click="toggleRightMenu" />
                <div class="absolute right-0" :class="!isRightMenuShown ? 'hidden' : ''">
                    <fwb-list-group>
                        <fwb-list-group-item>
                            <span class="font-bold">{{ user?.name }}</span>
                        </fwb-list-group-item>
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
    FwbListGroup,
    FwbListGroupItem,
    FwbNavbar,
    FwbNavbarCollapse,
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