<script setup lang="ts">
import ProgramAPI from '../../../../services/ProgramAPI';
import { onMounted, ref } from 'vue';

const emit = defineEmits<{ (event: 'cancelEvent') : void, (event: 'updatedEvent') : void }>()

interface IProgram {
  id: number | string;
  name: string;
  display_name: string;
  description: string;
}

import { useCoordSelectedStudent } from '../../../../store/coordSelectedStudent';
const useCoordStudent = useCoordSelectedStudent();

const programs = ref<IProgram[]>([]);
const selectedProgram = ref<number | string>(0);

onMounted(async () => {
    await loadPrograms();
});

const loadPrograms = async () => {
    try {
        const response = await ProgramAPI.getPrograms();
        programs.value = response.data.data.programs;
    } catch (error: any) {
        console.log(error.response);
    }
};

const updateProgramHandler = async () => {
    if (selectedProgram.value == 0) {
        return;
    }

    await useCoordStudent.updateProgramInfo(selectedProgram.value)

    emit('updatedEvent');
}

const selectProgramHandler = (e: Event) => {
    const target = e.target as HTMLSelectElement;
    selectedProgram.value = target.value;
}

</script>

<template>
    <form>
        <div class="form-group-sm">
            <label for="program-input">Programs</label>
            <select @change="selectProgramHandler" class="form-control form-control-sm" name="program-input" id="program-input">
                <option selected>Select program</option>
                <option v-for="(program, index) in programs" :key="index" :value="program.id">{{ program.display_name }}</option>
            </select>
        </div>
        <div class="mt-4" style="display: flex; justify-content:space-evenly; gap: 2px;">
            <button @click="updateProgramHandler" class="btn btn-primary btn-sm" style="flex: 1;" type="button">Update</button>
            <button @click="emit('cancelEvent')" class="btn btn-primary btn-sm btn-danger" style="flex: 1;" type="button">Cancel</button>
        </div>
    </form>
</template>