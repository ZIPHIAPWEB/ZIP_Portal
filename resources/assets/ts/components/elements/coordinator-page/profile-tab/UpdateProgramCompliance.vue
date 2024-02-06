<script setup lang="ts">
import { ref } from 'vue';

const props = defineProps({
    status: {
        type: String,
        required: true
    }
});

import { useCoordSelectedStudent } from '../../../../store/coordSelectedStudent';
const useCoordStudent = useCoordSelectedStudent();

const isProgramStatusEdit = ref<boolean>(false);
const appStatus = ref<string[]>([
    'returnee',
    'overstay'
]);

const updateProgramComplianceHandler = async (payload : Event) => {
    const target = payload.target as HTMLSelectElement;
    const toUpdateStatus = target.value; 
        
    await useCoordStudent.updateProgramCompliance(toUpdateStatus);
    isProgramStatusEdit.value = false;
}
</script>

<template>
    <div v-if="!isProgramStatusEdit" style="display: flex; justify-content: space-between;">
        <span>{{ props.status }}</span>
        <a @click.prevent="isProgramStatusEdit = true" href="#">Edit</a>
    </div>
    <div style="display: flex; justify-content: space-between; align-items: center;" v-else>
        <select @change="updateProgramComplianceHandler" class="form-control form-control-sm" id="select-app-status">
            <option>Select status</option>
            <option v-for="(status, index) in appStatus" :key="index" :value="status">{{ status }}</option>
        </select>
        <a class="ml-2" @click.prevent="isProgramStatusEdit = false" href="#">Cancel</a>
    </div>
</template>