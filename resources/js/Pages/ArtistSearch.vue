<template>
    <div class="mt-20 mx-auto w-2/5">
        <fwb-input v-model="query" placeholder="Search an artist......" size="lg">
            <template #suffix>
                <fwb-button class="">Search</fwb-button>
            </template>
        </fwb-input>
    </div>
    <!--display this div when the user already made a search-->
    <div>

    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { FwbButton, FwbInput } from 'flowbite-vue'

const query = ref('')
</script>