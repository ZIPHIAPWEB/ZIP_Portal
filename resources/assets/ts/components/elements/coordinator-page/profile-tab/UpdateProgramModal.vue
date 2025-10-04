<script setup lang="ts">
import ProgramAPI from '../../../../services/ProgramAPI';
import { IProgram } from '../../../../interfaces/IProgram';
import { IProgramCategory } from '../../../../interfaces/IProgramCategory';

import { onMounted, ref } from 'vue';

const emit = defineEmits<{ (event: 'cancelEvent') : void, (event: 'updatedEvent') : void }>()

import { useCoordSelectedStudent } from '../../../../store/coordSelectedStudent';
import AlertService from '../../../../services/AlertService';

const useCoordStudent = useCoordSelectedStudent();

const programs = ref<IProgram[]>([]);
const selectedProgram = ref<number | string>(0);

onMounted(async () => {
    loadPrograms();
});

const loadPrograms = async () => {
    try {
        const response = await ProgramAPI.getPrograms();

        response.data.data.programs.forEach((p : IProgramCategory) => {

            p.programs.forEach(prog => {

                programs.value.push(prog);
            });
        });
    } catch (error: any) {
        console.log(error.response);
    }
};

const updateProgramHandler = async () => {
    if (selectedProgram.value == 0) {
        return;
    }

    const res = await useCoordStudent.updateProgramInfo(selectedProgram.value)

    if (res.success) {
        emit('updatedEvent');
        AlertService.success('Program updated', 'Success');
    } else {
        if (res.errors) AlertService.validation(res.errors);
        else AlertService.error(res.message || 'Failed to update program');
    }
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