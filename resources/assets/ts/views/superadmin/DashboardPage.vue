<script setup lang="ts">
import { ref } from 'vue';

const title = ref<string>('Superadmin Page');
</script>

<template>
    <h1>{{ title }}</h1>
</template>