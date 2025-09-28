<script setup lang="ts">
import ApplicationFormAPI from '../../../services/ApplicationFormAPI';
import SchoolAPI from '../../../services/SchoolAPI';
import { ISchoolForm } from '@/interfaces/ISchoolForm';
import { DegreeType } from '@/types/DegreeType';
import { SchoolType } from '@/types/SchoolType';
import { onMounted, reactive, ref } from 'vue';

const appFormDataKey = 'APP_FORM_DATA';

const schools = ref<SchoolType[]>([]);
const degrees = ref<DegreeType[]>([]);
const schoolForm = reactive<ISchoolForm>({
    schoolId: 0,
    degree: '',
    dateGraduated: '',
    address: '',
    startDate: '',
    yearLevel: '',

    secondarySchool: '',
    secondaryAddress: '',
    secondaryEndDate: '',
    secondaryStartDate: ''
})

onMounted(async () => {
    await loadSchools();
})

const loadSchools = async () => {
    try {
        const response = await SchoolAPI.getSchools();
        schools.value = response.data;
    } catch (error: any) {
        console.log(error.response);
    }
}

const submitFormHandler = async () => {
    try {
        await ApplicationFormAPI.validate(schoolForm, 2);
        localStorage.setItem(appFormDataKey, JSON.stringify({...schoolForm, step: 3}));
    } catch (error) {
        alert('Oppps... Something went wrong')
    }
}

</script>

<template>
    <div>
        <form @submit.prevent="submitFormHandler">
            <div class="card-body">
                <div class="row">
                    <h5 class="m-0">Tertiary</h5>
                </div>
                <hr class="my-1">
                <div class="row">
                    <div class="col-12">
                        <label for="school">School <span class="text-red">*</span></label>
                        <select v-model="schoolForm.schoolId" name="school" class="form-control">
                            <option v-for="school in schools" :value="school.id">{{ school.display_name }}</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="school_address">School address <span class="text-red">*</span></label>
                        <input v-model="schoolForm.address" type="text" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="degree">Degree <span class="text-red">*</span></label>
                        <select v-model="schoolForm.degree" name="degree" class="form-control">
                            <option v-for="degree in degrees" :value="degree.id">{{ degree.display_name }}</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="year_level">Year Level <span class="text-red">*</span></label>
                        <select v-model="schoolForm.yearLevel" name="year_level" class="form-control">
                            <option value="First Year">First Year</option>
                            <option value="Second Year">Second Year</option>
                            <option value="Third Year">Third Year</option>
                            <option value="Fourth Year">Fourth Year</option>
                            <option value="Graduated">Graduated</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="school_admission">School admission date <span class="text-red">*</span></label>
                        <input v-model="schoolForm.startDate" type="date" name="school_admission" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="graduation_date">Expected date of graduation <span class="text-red">*</span></label>
                        <input type="date" name="graduation_date" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <h5 class="m-0">Secondary</h5>
                </div>
                <hr class="my-1">
                <div class="row">
                    <div class="col-12">
                        <label for="secondary_school">School <span class="text-red">*</span></label>
                        <input v-model="schoolForm.secondarySchool" type="text" name="secondary_school" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="secondary_address">Address <span class="text-red">*</span></label>
                        <input v-model="schoolForm.secondaryAddress" type="text" name="secondary_address" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="secondary_start">Start date <span class="text-red">*</span></label>
                        <input v-model="schoolForm.secondaryStartDate" name="secondary_start" type="date" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="secondary_end">Date gradudated <span class="text-red">*</span></label>
                        <input v-model="schoolForm.secondaryEndDate" name="secondary_end" type="date" class="form-control">
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