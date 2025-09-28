<script setup lang="ts">
import { IWorkForm } from '@/interfaces/IWorkForm';
import ApplicationFormAPI from '@/services/ApplicationFormAPI';
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

onMounted(() => {
    workForms.push(workFormDefault);
})

const submitFormHandler = async () => {
    try {
        await ApplicationFormAPI.validate(workForms, 4);
        localStorage.setItem(appFormDataKey, JSON.stringify({ 'experience': workForms, step: 5 }))
    } catch (error) {
        alert('Oppps... Something went wrong')
    }
}

const addNewWorkForm = () => {
    workForms.push(workFormDefault);
}

</script>

<template>
    <div>
        <form @submit.prevent="submitFormHandler">
            <div v-for="(work, key) in workForms" :key="key" class="card-body">
                <div class="row">
                    <div class="col-12">
                        <label for="company_name">Company name</label>
                        <input v-model="work.companyName" type="text" name="company_name" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="company_address">Company address</label>
                        <input v-model="work.companyAddress" type="text" name="company_address" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="start_date">Start date</label>
                        <input v-model="work.startDate" type="date" name="start_date" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="end_date">End date</label>
                        <input v-model="work.endDate" type="date" name="end_date" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="job_description">Job description</label>
                        <textarea v-model="work.jobDescription" name="job_description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>