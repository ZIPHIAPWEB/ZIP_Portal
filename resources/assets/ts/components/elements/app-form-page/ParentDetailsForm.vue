<script setup lang="ts">
import { IParentsForm } from '../../../interfaces/IParentsForm';
import ApplicationFormAPI from '../../../services/ApplicationFormAPI';
import { reactive } from 'vue';

const appFormDataKey = 'APP_FORM_DATA';

const parentForm = reactive<IParentsForm>({
    fatherFirstName: '',
    fatherMiddleName: '',
    fatherLastName: '',
    fatherOccupation: '',
    fatherContactNo: '',
    motherFirstName: '',
    motherMiddleName: '',
    motherLastName: '',
    motherOccupation: '',
    motherContactNo: '',
    fatherCompany: '',
    motherCompany: ''
});

const errors = reactive<Record<string, string[]>>({});

const submitForm = async () => {
    try {
        Object.keys(errors).forEach(k => delete errors[k]);
        await ApplicationFormAPI.validate(parentForm, 3)
        localStorage.setItem(appFormDataKey, JSON.stringify({...parentForm, step: 4}));
    } catch (error) {
        const err: any = error;
        if (err?.response?.status === 422 && err.response.data?.errors) {
            const apiErrors = err.response.data.errors as Record<string, string[]>;
            Object.entries(apiErrors).forEach(([k, v]) => { errors[k] = v; });
            return;
        }
        alert('Oppps... Something went wrong');
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
            <h5 class="m-0 text-bold">Father details</h5>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <label for="father_first_name">First name <span class="text-red">*</span></label>
                <input v-model="parentForm.fatherFirstName" type="text" name="father_first_name" :class="['form-control', { 'is-invalid': !!errors.fatherFirstName }]" placeholder="Juan">
                <div v-if="errors.fatherFirstName" class="invalid-feedback">{{ errors.fatherFirstName[0] }}</div>
            </div>
            <div class="col-12 col-md-4">
                <label for="father_middle_name">Middle name</label>
                <input v-model="parentForm.fatherMiddleName" type="text" name="father_middle_name" :class="['form-control', { 'is-invalid': !!errors.fatherMiddleName }]" placeholder="Dela">
                <div v-if="errors.fatherMiddleName" class="invalid-feedback">{{ errors.fatherMiddleName[0] }}</div>
            </div>
            <div class="col-12 col-md-4">
                <label for="father_last_name">Last name <span class="text-red">*</span></label>
                <input v-model="parentForm.fatherLastName" type="text" name="father_last_name" :class="['form-control', { 'is-invalid': !!errors.fatherLastName }]" placeholder="Cruz">
                <div v-if="errors.fatherLastName" class="invalid-feedback">{{ errors.fatherLastName[0] }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="father_occupation">Occupation <span class="text-red">*</span></label>
                <input v-model="parentForm.fatherOccupation" type="text" name="father_occupation" :class="['form-control', { 'is-invalid': !!errors.fatherOccupation }]" placeholder="e.g., Engineer, Teacher, Business Owner">
                <div v-if="errors.fatherOccupation" class="invalid-feedback">{{ errors.fatherOccupation[0] }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="father_company">Company <span class="text-red">*</span></label>
                <input v-model="parentForm.fatherCompany" type="text" name="father_company" :class="['form-control', { 'is-invalid': !!errors.fatherCompany }]" placeholder="Enter company or business name">
                <div v-if="errors.fatherCompany" class="invalid-feedback">{{ errors.fatherCompany[0] }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="father_contact_no">Contact No. <span class="text-red">*</span></label>
                <input v-model="parentForm.fatherContactNo" type="text" name="father_company_no" :class="['form-control', { 'is-invalid': !!errors.fatherContactNo }]" placeholder="09XX-XXX-XXXX">
                <div v-if="errors.fatherContactNo" class="invalid-feedback">{{ errors.fatherContactNo[0] }}</div>
            </div>
        </div>
            <hr>
        <div class="row">
            <h5 class="m-0 text-bold">Mother details</h5>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <label for="mother_first_name">First name <span class="text-red">*</span></label>
                <input v-model="parentForm.motherFirstName" type="text" name="mother_first_name" :class="['form-control', { 'is-invalid': !!errors.motherFirstName }]" placeholder="Maria">
                <div v-if="errors.motherFirstName" class="invalid-feedback">{{ errors.motherFirstName[0] }}</div>
            </div>
            <div class="col-12 col-md-4">
                <label for="mother_middle_name">Middle name</label>
                <input v-model="parentForm.motherMiddleName" type="text" name="mother_middle_name" :class="['form-control', { 'is-invalid': !!errors.motherMiddleName }]" placeholder="Santos">
                <div v-if="errors.motherMiddleName" class="invalid-feedback">{{ errors.motherMiddleName[0] }}</div>
            </div>
            <div class="col-12 col-md-4">
                <label for="mother_last_name">Last name <span class="text-red">*</span></label>
                <input v-model="parentForm.motherLastName" type="text" name="mother_last_name" :class="['form-control', { 'is-invalid': !!errors.motherLastName }]" placeholder="Cruz">
                <div v-if="errors.motherLastName" class="invalid-feedback">{{ errors.motherLastName[0] }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="mother_occupation">Occupation <span class="text-red">*</span></label>
                <input v-model="parentForm.motherOccupation" type="text" name="mother_occupation" :class="['form-control', { 'is-invalid': !!errors.motherOccupation }]" placeholder="e.g., Nurse, Accountant, Homemaker">
                <div v-if="errors.motherOccupation" class="invalid-feedback">{{ errors.motherOccupation[0] }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="mother_company">Company <span class="text-red">*</span></label>
                <input v-model="parentForm.motherCompany" type="text" name="mother_company" :class="['form-control', { 'is-invalid': !!errors.motherCompany }]" placeholder="Enter company or business name">
                <div v-if="errors.motherCompany" class="invalid-feedback">{{ errors.motherCompany[0] }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="mother_contact_no">Contact No. <span class="text-red">*</span></label>
                <input v-model="parentForm.motherContactNo" type="text" name="mother_contact_no" :class="['form-control', { 'is-invalid': !!errors.motherContactNo }]" placeholder="09XX-XXX-XXXX">
                <div v-if="errors.motherContactNo" class="invalid-feedback">{{ errors.motherContactNo[0] }}</div>
            </div>
        </div>
    </div>    
</template>