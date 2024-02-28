<template>
    <div class="flex-col mt-8">
        <div class="flex gap-3 justify-center">
            <button class="text-white bg-black py-2 px-4 rounded-md"
                :class="pageCount < 2 ? 'cursor-not-allowed' : 'cursor-pointer'" :disabled="isLastPage"
                @click="goToPrevPage">&lt&lt Prev</button>

            <button class="text-white bg-black py-2 px-4 rounded-md cursor-pointer" :disabled="isLastPage"
                @click="goToNextPage">Next >></button>
        </div>
        <div class="flex justify-center">
            <span class="text-white mt-2 justify-center">
                Showing page {{ currentPage }} of {{ totalPages }}
                pages
            </span>
        </div>
    </div>
</template>

<script setup lang="ts">
import { defineProps, defineEmits } from 'vue';

const { currentPage, totalPages, pageCount, isFirstPage, isLastPage } = defineProps<{
    pageCount: number
    currentPage: number;
    totalPages: number;
    isFirstPage: boolean;
    isLastPage: boolean;

}>();

const emit = defineEmits(['prev', 'next']);

const goToPrevPage = () => {
    if (!isFirstPage) {
        emit('prev');
    }
};

const goToNextPage = () => {
    if (!isLastPage) {
        emit('next');
    }
};

</script>