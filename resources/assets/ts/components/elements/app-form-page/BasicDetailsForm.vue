<script setup lang="ts">
import { IBasicForm } from '@/interfaces/IBasicForm';
import { ApplicationFormType } from '@/types/ApplicationFormType';
import ApplicationFormAPI from '../../../services/ApplicationFormAPI';
import { onMounted, reactive } from 'vue';
import { ProgramType } from '@/types/ProgramType';
import ProgramAPI from '../../../services/ProgramAPI';

const appFormDataKey = 'APP_FORM_DATA';
const basicForm = reactive<IBasicForm>({
    firstName: '',
    middleName: '',
    lastName: '',
    homeNumber: '',
    mobileNumber: '',
    birthDate: '',
    gender: '',
    permanentAddress: '',
    provincialAddress: '',
    fbLink: '',
    skypeId: '',
    programId: 0
});

const programs = reactive<ProgramType[]>([]);

// Holds validation errors from API
const errors = reactive<Record<string, string[]>>({});

onMounted(async () => {
    await loadBasicDetails();
    await loadPrograms();
});

const loadPrograms = async () => {
    try {
        const response = await ProgramAPI.getPrograms();
        programs.push(...response.data);
    } catch (error) {
        alert('Oppps... Something went wrong while loading programs');
    }
}

const loadBasicDetails = () => {
    if (localStorage.getItem(appFormDataKey)) {
        let appFormData = JSON.parse(localStorage.getItem(appFormDataKey)) as ApplicationFormType[];

        Object.entries(appFormData).forEach(([key, value]) => {
            basicForm[key] = value;
        });
    }
}

const submitForm = async () => {
    try {
        // clear previous errors
        Object.keys(errors).forEach(k => delete errors[k]);
        await ApplicationFormAPI.validate(basicForm, 1);
        localStorage.setItem(appFormDataKey, JSON.stringify({...basicForm, step: 2}))
    } catch (error) {
        const err: any = error;
        if (err?.response?.status === 422 && err.response.data?.errors) {
            const apiErrors = err.response.data.errors as Record<string, string[]>;
            Object.entries(apiErrors).forEach(([k, v]) => {
                errors[k] = v;
            });
            return;
        }
        alert('Oppps... Something went wrong!');
    }
}

// Expose submitForm to parent
defineExpose({
    submitForm
});

</script>

<template>
    <div>
        <div class="row">
            <div class="col-12">
                <label for="program_id">Program <span class="text-red">*</span></label>
                <select v-model="basicForm.programId" :class="['form-control', { 'is-invalid': !!errors.programId }]">
                    <option value="">Select a program</option>
                    <option v-for="program in programs" :key="program.id" :value="program.id">{{ program.name }} ({{ program.category?.display_name }})</option>
                </select>
                <div v-if="errors.programId" class="invalid-feedback">{{ errors.programId[0] }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <label for="first_name">First name <span class="text-red">*</span></label>
                <input v-model="basicForm.firstName" :class="['form-control', { 'is-invalid': !!errors.firstName }]" type="text" placeholder="Juan">
                <div v-if="errors.firstName" class="invalid-feedback">{{ errors.firstName[0] }}</div>
            </div>
            <div class="col-12 col-md-4">
                <label for="middle_name">Middle name </label>
                <input v-model="basicForm.middleName" :class="['form-control', { 'is-invalid': !!errors.middleName }]" type="text" placeholder="Dela">
                <div v-if="errors.middleName" class="invalid-feedback">{{ errors.middleName[0] }}</div>
            </div>
            <div class="col-12 col-md-4">
                <label for="last_name">Last name <span class="text-red">*</span></label>
                <input v-model="basicForm.lastName" :class="['form-control', { 'is-invalid': !!errors.lastName }]" type="text" placeholder="Cruz">
                <div v-if="errors.lastName" class="invalid-feedback">{{ errors.lastName[0] }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="birth_date">Birthdate <span class="text-red">*</span></label>
                <input v-model="basicForm.birthDate" :class="['form-control', { 'is-invalid': !!errors.birthDate }]" type="date">
                <div v-if="errors.birthDate" class="invalid-feedback">{{ errors.birthDate[0] }}</div>
            </div>
            <div class="col-12 col-md-6">
                <label for="gender">Gender <span class="text-red">*</span></label>
                <select v-model="basicForm.gender" name="gender" :class="['form-control', { 'is-invalid': !!errors.gender }]">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <div v-if="errors.gender" class="invalid-feedback">{{ errors.gender[0] }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="perma_address">Permanent address</label>
                <textarea v-model="basicForm.permanentAddress" name="perma_address" :class="['form-control', { 'is-invalid': !!errors.permanentAddress }]" placeholder="123 Main Street, Barangay, City, Province"></textarea>
                <div v-if="errors.permanentAddress" class="invalid-feedback">{{ errors.permanentAddress[0] }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="provincial_address">Provincial address</label>
                <textarea v-model="basicForm.provincialAddress" name="provincial_address" :class="['form-control', { 'is-invalid': !!errors.provincialAddress }]" placeholder="456 Provincial Road, Barangay, City, Province"></textarea>
                <div v-if="errors.provincialAddress" class="invalid-feedback">{{ errors.provincialAddress[0] }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="home_number">Home number</label>
                <input v-model="basicForm.homeNumber" :class="['form-control', { 'is-invalid': !!errors.homeNumber }]" type="text" placeholder="(02) 1234-5678">
                <div v-if="errors.homeNumber" class="invalid-feedback">{{ errors.homeNumber[0] }}</div>
            </div>
            <div class="col-12 col-md-6">
                <label for="mobile_number">Mobile number</label>
                <input v-model="basicForm.mobileNumber" :class="['form-control', { 'is-invalid': !!errors.mobileNumber }]" type="text" placeholder="09XX-XXX-XXXX">
                <div v-if="errors.mobileNumber" class="invalid-feedback">{{ errors.mobileNumber[0] }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="skype_id">Alternate email</label>
                <input v-model="basicForm.skypeId" :class="['form-control', { 'is-invalid': !!errors.skypeId }]" type="email" placeholder="example@email.com">
                <div v-if="errors.skypeId" class="invalid-feedback">The altername email is required.</div>
            </div>
            <div class="col-12 col-md-6">
                <label for="fb_link">Facebook link</label>
                <input v-model="basicForm.fbLink" :class="['form-control', { 'is-invalid': !!errors.fbLink }]" type="text" placeholder="https://facebook.com/yourprofile">
                <div v-if="errors.fbLink" class="invalid-feedback">{{ errors.fbLink[0] }}</div>
            </div>
        </div>
    </div>
</template>