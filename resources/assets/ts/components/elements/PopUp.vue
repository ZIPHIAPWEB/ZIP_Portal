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
    },
    withClose: {
        type: Boolean,
        default: true
    },
    withButtons: {
        type: Boolean,
        default: false
    },
    buttonText: {
        type: String
    }
})

const emits = defineEmits<{
    (e: 'triggerCloseEvent') : void,
    (e: 'triggerButtonEvent') : void
}>();

</script>

<template>
    <div class="popup-wrapper">
        <div class="card card-primary card-outline" :class="`--${props.size}`">
            <div class="card-header" style="display: flex">
                <h3 style="flex: 1;">{{ props.title }}</h3>
                <button v-if="props.withClose" @click="emits('triggerCloseEvent')" class="close">
                    <span>x</span>
                </button>
            </div>
            <div class="card-body">
                <slot />
            </div>
            <div v-if="props.withButtons" class="card-footer">
                <button @click="emits('triggerButtonEvent')" class="btn btn-success btn-sm">{{ props.buttonText ?? "Ok" }}</button>
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