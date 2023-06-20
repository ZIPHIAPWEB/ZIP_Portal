<script setup lang="ts">
import { onMounted, onUnmounted } from 'vue';

onMounted(() => {
    document.body.classList.add('layout-top-nav');
});

onUnmounted(() => {
    document.body.classList.remove('layout-top-nav');
});

</script>

<template>
    <div class="client-wrapper">
       <div style="flex: 1; overflow: hidden; padding: 15px 0;">
            <slot />
       </div>
       <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
</template>

<style scoped>
    .client-wrapper {
        height: 100vh;
        overflow-y: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
</style>