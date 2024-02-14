<template>
    <div>
        <h2>Hello world</h2>
    </div>
</template>

<script lang="ts" setup>
const props = defineProps<{message: string}>()

console.log(props.message);
</script>