<script lang="ts" setup>
import { ref, defineEmits, defineProps } from 'vue';

const fileInputRef = ref<HTMLInputElement | null>(null);
const emit = defineEmits<{ (event: 'getFile', file: File, requirementId: string | number | undefined) : void }>();
const props = defineProps<{ requirementId?: string | number }>();

const fileHandler = (event: Event) => {
    const target = event.target as HTMLInputElement;
    const files = target.files as FileList;

    emit('getFile', files[0], props.requirementId);
}

const browseFileHandler = () => {
    fileInputRef.value?.click();
}

</script>

<template>
    <input ref="fileInputRef" @change="fileHandler" type="file" class="d-none" />
    <button @click="browseFileHandler" class="btn btn-default btn-xs mr-1">Browse File</button>
</template>