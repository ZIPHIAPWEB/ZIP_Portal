<template>
    <RouterView />
</template>

<style>
body {
    background-color: #d3d3d3;
}
</style>

<script setup lang="ts">
import Axios from 'axios';
import { onMounted } from 'vue';

onMounted(async () => {
    await Axios.get("/sanctum/csrf-cookie");
});
</script>