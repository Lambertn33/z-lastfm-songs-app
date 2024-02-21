<template>
    <TheNavbar />
    <div>
        <slot></slot>
    </div>
</template>

<script setup lang="ts">
import TheNavbar from './UI/TheNavbar.vue';
</script>