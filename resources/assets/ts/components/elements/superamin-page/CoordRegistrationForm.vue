<script setup lang="ts">
import { ICoord, useSuperadminCoord } from '../../../store/superadminCoords';
import { ref, onMounted, defineEmits } from 'vue';
import ProgramAPI from '../../../services/ProgramAPI';
import { IProgramCategory } from '../../../interfaces/IProgramCategory';
import { IProgram } from '../../../interfaces/IProgram';

const emits = defineEmits<{
    (e: 'submitSuccessEvent') : void
}>();

const superadminCoordStore = useSuperadminCoord();

const programs = ref<IProgram[]>([]);
const coordForm = ref<ICoord>({
    first_name: '',
    username: '',
    email: '',
    middle_name: '',
    last_name: '',
    program: '',
    position: '',
    contact: ''
});

onMounted(() => {
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

const submitCoordFormHandler = async () => {

    await superadminCoordStore.createSuperadminCoord(coordForm.value);
    emits('submitSuccessEvent');
}
</script>

<template>
    <form @submit.prevent="submitCoordFormHandler">
        <div class="row">
            <div class="form-group col-4">
                <label for="first-name">First name <span class="text-red">*</span></label>
                <input v-model="coordForm.first_name" type="text" class="form-control form-control-sm">
            </div>
            <div class="form-group col-4">
                <label for="middle-name">Middle name</label>
                <input v-model="coordForm.middle_name" type="text" class="form-control form-control-sm">
            </div>
            <div class="form-group col-4">
                <label for="last-name">Last name <span class="text-red">*</span></label>
                <input v-model="coordForm.last_name" type="text" class="form-control form-control-sm">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-4">
                <label for="program">Program <span class="text-red">*</span></label>
                <select v-model="coordForm.program" class="form-control form-control-sm">
                    <option>Select program</option>
                    <option v-for="(program, index) in programs" :key="index" :value="program.id">{{ program.display_name }}</option>
                </select>
            </div>
            <div class="form-group col-4">
                <label for="designation">Designation <span class="text-red">*</span></label>
                <input v-model="coordForm.position" type="text" class="form-control form-control-sm">
            </div>
            <div class="form-group col-4">
                <label for="contact-no">Contact no. <span class="text-red">*</span></label>
                <input v-model="coordForm.contact" type="text" class="form-control form-control-sm">
            </div>
        </div>
        <hr class="my-2">
        <div class="row">
            <div class="form-group col-6">
                <label for="username">Username <span class="text-red">*</span></label>
                <input v-model="coordForm.username" type="text" class="form-control form-control-sm">
            </div>
            <div class="form-group col-6">
                <label for="first-name">E-mail address <span class="text-red">*</span></label>
                <input v-model="coordForm.email" type="text" class="form-control form-control-sm">
            </div>
        </div>
        <div class="row" style="display: flex; justify-content: end;">
            <button type="submit" class="btn btn-primary btn-sm mr-2">Submit</button>
        </div>
    </form>
</template>