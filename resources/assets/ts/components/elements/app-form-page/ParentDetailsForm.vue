<script setup lang="ts">
import { IParentsForm } from '@/interfaces/IParentsForm';
import ApplicationFormAPI from '@/services/ApplicationFormAPI';
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

const submitFormHandler = async () => {
    try {
        await ApplicationFormAPI.validate(parentForm, 3)
        localStorage.setItem(appFormDataKey, JSON.stringify({...parentForm, step: 4}));
    } catch (error) {
        alert('Oppps... Something went wrong');
    }
}

</script>

<template>
    <div>
        <form @submit.prevent="submitFormHandler">
            <div class="card-body">
                <div class="row">
                    <h5 class="m-0">Father details</h5>
                </div>
                <hr class="my-1">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label for="father_first_name">First name</label>
                        <input v-model="parentForm.fatherFirstName" type="text" name="father_first_name" class="form-control">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="father_middle_name">Middle name</label>
                        <input v-model="parentForm.fatherMiddleName" type="text" name="father_middle_name" class="form-control">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="father_last_name">Last name</label>
                        <input v-model="parentForm.fatherLastName" type="text" name="father_last_name" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="father_occupation">Occupation</label>
                        <input v-model="parentForm.fatherOccupation" type="text" name="father_occupation" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="father_company">Company</label>
                        <input v-model="parentForm.fatherCompany" type="text" name="father_company" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="father_contact_no">Contact No.</label>
                        <input v-model="parentForm.fatherContactNo" type="text" name="father_company_no" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <h5 class="m-0">Mother details</h5>
                </div>
                <hr class="my-1">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label for="mother_first_name">First name</label>
                        <input v-model="parentForm.motherFirstName" type="text" name="mother_first_name" class="form-control">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="mother_middle_name">Middle name</label>
                        <input v-model="parentForm.motherMiddleName" type="text" name="mother_middle_name" class="form-control">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="mother_last_name">Last name</label>
                        <input v-model="parentForm.motherLastName" type="text" name="mother_last_name" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="mother_occupation">Occupation</label>
                        <input v-model="parentForm.motherOccupation" type="text" name="mother_occupation" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="mother_company">Company</label>
                        <input v-model="parentForm.motherCompany" type="text" name="mother_company" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="mother_contact_no">Contact No.</label>
                        <input v-model="parentForm.motherContactNo" type="text" name="mother_contact_no" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </div>
            </div>
        </form>
    </div>    
</template>