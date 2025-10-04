<script setup lang="ts">
import { IWorkForm } from '../../../interfaces/IWorkForm';
import ApplicationFormAPI from '../../../services/ApplicationFormAPI';
import { onMounted, reactive } from 'vue';

const appFormDataKey = 'APP_FORM_DATA';
const workFormDefault = {
    companyName: '',
    companyAddress: '',
    startDate: '',
    endDate: '',
    jobDescription: ''
} as IWorkForm;

const workForms = reactive<IWorkForm[]>([]);
const errors = reactive<Record<string, string[]>>({});

onMounted(() => {
    workForms.push({ ...workFormDefault });
})

const submitForm = async () => {
    try {
        Object.keys(errors).forEach(k => delete errors[k]);
        await ApplicationFormAPI.validate(workForms, 4);
        localStorage.setItem(appFormDataKey, JSON.stringify({ 'experience': workForms, step: 5 }))
    } catch (error) {
        const err: any = error;
        if (err?.response?.status === 422 && err.response.data?.errors) {
            const apiErrors = err.response.data.errors as Record<string, string[]>;
            Object.entries(apiErrors).forEach(([k, v]) => { errors[k] = v; });
            return;
        }
        alert('Oppps... Something went wrong')
    }
}

const addNewWorkForm = () => {
    workForms.push({ ...workFormDefault });
}

// Expose submitForm and addNewWorkForm to parent
defineExpose({
    submitForm,
    addNewWorkForm
});

</script>

<template>
    <div>
        <div v-for="(work, key) in workForms" :key="key" class="mb-3">
            <div v-if="key > 0" class="row">
                <div class="col-12"><hr class="my-3"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="company_name">Company name</label>
                    <input v-model="work.companyName" type="text" name="company_name" :class="['form-control', { 'is-invalid': !!errors[`${key}.companyName`] }]" placeholder="Enter company name">
                    <div v-if="errors[`${key}.companyName`]" class="invalid-feedback">{{ errors[`${key}.companyName`][0] }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="company_address">Company address</label>
                    <input v-model="work.companyAddress" type="text" name="company_address" :class="['form-control', { 'is-invalid': !!errors[`${key}.companyAddress`] }]" placeholder="Enter complete company address">
                    <div v-if="errors[`${key}.companyAddress`]" class="invalid-feedback">{{ errors[`${key}.companyAddress`][0] }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <label for="start_date">Start date</label>
                    <input v-model="work.startDate" type="date" name="start_date" :class="['form-control', { 'is-invalid': !!errors[`${key}.startDate`] }]">
                    <div v-if="errors[`${key}.startDate`]" class="invalid-feedback">{{ errors[`${key}.startDate`][0] }}</div>
                </div>
                <div class="col-12 col-md-6">
                    <label for="end_date">End date</label>
                    <input v-model="work.endDate" type="date" name="end_date" :class="['form-control', { 'is-invalid': !!errors[`${key}.endDate`] }]">
                    <div v-if="errors[`${key}.endDate`]" class="invalid-feedback">{{ errors[`${key}.endDate`][0] }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="job_description">Job description</label>
                    <textarea v-model="work.jobDescription" name="job_description" :class="['form-control', { 'is-invalid': !!errors[`${key}.jobDescription`] }]" placeholder="Describe your role and responsibilities" rows="3"></textarea>
                    <div v-if="errors[`${key}.jobDescription`]" class="invalid-feedback">{{ errors[`${key}.jobDescription`][0] }}</div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <button type="button" class="btn btn-outline-primary" @click="addNewWorkForm">Add another work experience</button>
            </div>
        </div>
    </div>
</template>