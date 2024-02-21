<template>
    <fwb-navbar class="border-b-2 border-gray-200">
        <template #logo>
            <fwb-navbar-logo alt="Flowbite logo" image-url="/images/logo.png" link="#">
                Songs app
            </fwb-navbar-logo>
        </template>
        <template #default="{ isShowMenu }">
            <fwb-navbar-collapse :is-show-menu="isShowMenu">
                <fwb-navbar-link>
                    <Link href="/">Home</Link>
                </fwb-navbar-link>
                <fwb-navbar-link>
                    <Link href="/">Search</Link>
                </fwb-navbar-link>
            </fwb-navbar-collapse>
        </template>
        <template #right-side>
            <fwb-button>
                <Link href="/auth">Authenticate</Link>
            </fwb-button>
        </template>
    </fwb-navbar>
</template>
  
<script setup>
import {
    FwbButton,
    FwbNavbar,
    FwbNavbarCollapse,
    FwbNavbarLink,
    FwbNavbarLogo,
} from 'flowbite-vue'
import { Link } from "@inertiajs/vue3";
</script>