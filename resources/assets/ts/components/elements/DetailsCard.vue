<script setup lang="ts">
import { defineProps } from 'vue';

const props = defineProps<{
    title: string
}>()
</script>

<template>
    <div class="card card-default">
        <div class="card-body">
            <div class="profile-header">
                <h5 class="profile-header__title">{{ props.title }}</h5>
                <div class="profile-header__actions">
                    
                </div>
            </div>
            
            <slot />
        </div>
    </div>
</template>

<style scoped>
    .profile-header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: 100%;
        margin: 5px 0;
        margin-bottom: 12px;
    }

    .profile-header__title {
        font-weight: bold;
        font-size: 15px;
        margin: 0;
    }
</style>