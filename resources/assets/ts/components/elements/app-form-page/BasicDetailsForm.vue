<script setup lang="ts">
import { IBasicForm } from '@/interfaces/IBasicForm';
import { ApplicationFormType } from '@/types/ApplicationFormType';
import ApplicationFormAPI from '../../../services/ApplicationFormAPI';
import { onMounted, reactive } from 'vue';

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
    skypeId: ''
});

onMounted(async () => {
    await loadBasicDetails();
});

const loadBasicDetails = () => {
    let appFormData = JSON.parse(localStorage.getItem(appFormDataKey)) as ApplicationFormType[];

    Object.entries(appFormData).forEach(([key, value]) => {
        basicForm[key] = value;
    });
}

const submitFormHandler = async () => {
    try {
        await ApplicationFormAPI.validate(basicForm, 1);
        localStorage.setItem(appFormDataKey, JSON.stringify({...basicForm, step: 2}))
    } catch (error) {
        alert('Oppps... Something went wrong!');
    }
}

</script>

<template>
    <div>
        <form @submit.prevent="submitFormHandler">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label for="first_name">First name <span class="text-red">*</span></label>
                        <input v-model="basicForm.firstName" type="text" class="form-control" placeholder="Juan">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="middle_name">Middle name </label>
                        <input v-model="basicForm.middleName" type="text" class="form-control" placeholder="Dela">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="last_name">Last name <span class="text-red">*</span></label>
                        <input v-model="basicForm.lastName" type="text" class="form-control" placeholder="Cruz">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="birth_date">Birthdate <span class="text-red">*</span></label>
                        <input v-model="basicForm.birthDate" type="date" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="gender">Gender <span class="text-red">*</span></label>
                        <select v-model="basicForm.gender" name="gender" class="form-control">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="perma_address">Permanent address</label>
                        <textarea v-model="basicForm.permanentAddress" name="perma_address" class="form-control" placeholder="Permanent address"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="provincial_address">Provincial address</label>
                        <textarea v-model="basicForm.provincialAddress" name="provincial_address" class="form-control" placeholder="Provincial address"></textarea>2
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="home_number">Home number</label>
                        <input v-model="basicForm.homeNumber" type="text" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="mobile_number">Mobile number</label>
                        <input v-model="basicForm.mobileNumber" type="text" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="skype_id">Alternate email</label>
                        <input v-model="basicForm.skypeId" type="email" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="fb_link">Facebook link</label>
                        <input v-model="basicForm.fbLink" type="text" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Next</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>