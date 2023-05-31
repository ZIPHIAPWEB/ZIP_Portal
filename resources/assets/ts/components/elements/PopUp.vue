<script setup lang="ts">
import { defineProps } from 'vue';

const props = defineProps({
    title: {
        type: String,
        required: true,
        default: 'Pop up title'
    },
    size: {
        type: String,
        default: 'md'
    }
})

</script>

<template>
    <div class="popup-wrapper">
        <div class="card card-primary card-outline" :class="`--${props.size}`">
            <div class="card-header">
                <h3>{{ props.title }}</h3>
            </div>
            <div class="card-body">
                <slot />
            </div>
        </div>
    </div>
</template>

<style scoped>
 .popup-wrapper {
    display: flex; 
    justify-content: center; 
    align-items: center; 
    width: 100%; 
    height: 100%; 
    top: 0; 
    left: 0; 
    position: absolute; 
    z-index: 99; 
    background-color: rgba(0, 0, 0, 0.19);
 }

 .--lg {
     width: 800px;
 }

 .--md {
     width: 500px;
 }

 .--sm {
     width: 300px;
}
</style>