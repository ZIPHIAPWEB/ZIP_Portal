<script setup lang="ts">
import { defineProps, ref } from 'vue';

const props = defineProps({
    status: {
        type: String,
        required: true
    }
});

const emits = defineEmits<{
    (e: 'cancelEventTrigger') : void
}>();

import { useCoordSelectedStudent } from '../../../../store/coordSelectedStudent';
const useCoordStudent = useCoordSelectedStudent();

const isAppStatusEdit = ref<boolean>(false);
const appStatus = ref<string[]>([
    'New Applicant',
    'Confirmed',
    'Hired',
    'Visa Status',
    'For PDOS & CFO',
    'Program Proper',
    'Program Compliance'
]);

const updateApplicationStatus = async (payload : Event) => {

    const target = payload.target as HTMLSelectElement;
    const nextStatus = target.value;

    if (nextStatus == props.status) {

        isAppStatusEdit.value = false;

        return;
    }

    if (confirm(`Tag student to ${nextStatus}`)) {

        await useCoordStudent.updateProgramStatus(nextStatus);

        isAppStatusEdit.value = false;
    }
}
</script>

<template>
    <div v-if="!isAppStatusEdit" style="display: flex; justify-content: space-between;">
        <span>{{ props.status }}</span>
        <div>
            <a @click.prevent="isAppStatusEdit = true" href="#">Edit</a>
            <a @click.prevent="emits('cancelEventTrigger')" class="ml-2 text-red" href="#">Cancel student</a>
        </div>
    </div>
    <div style="display: flex; justify-content: space-between; align-items: center;" v-else>
        <select @change="updateApplicationStatus" class="form-control form-control-sm" id="select-app-status">
            <option>Select status</option>
            <option v-for="(status, index) in appStatus" :key="index" :value="status">{{ status }}</option>
        </select>
        <a class="ml-2" @click.prevent="isAppStatusEdit = false" href="#">Cancel</a>
    </div>
</template>