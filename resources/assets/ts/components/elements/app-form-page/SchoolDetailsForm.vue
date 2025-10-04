<script setup lang="ts">
import ApplicationFormAPI from '../../../services/ApplicationFormAPI';
import SchoolAPI from '../../../services/SchoolAPI';
import { ISchoolForm } from '@/interfaces/ISchoolForm';
import DegreeAPI from '../../../services/DegreeAPI';
import { DegreeType } from '@/types/DegreeType';
import { SchoolType } from '@/types/SchoolType';
import { onMounted, reactive, ref } from 'vue';

const appFormDataKey = 'APP_FORM_DATA';

const schools = ref<SchoolType[]>([]);
const degrees = ref<DegreeType[]>([]);
const isDegreeOther = ref<boolean>(false);
const customDegree = ref<string>('');

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

const errors = reactive<Record<string, string[]>>({});

const handleDegreeChange = (value: string) => {
    if (value === 'Others') {
        isDegreeOther.value = true;
        schoolForm.degree = '';
        customDegree.value = '';
    } else {
        isDegreeOther.value = false;
        schoolForm.degree = value;
    }
}

const handleCustomDegreeInput = (value: string) => {
    customDegree.value = value;
    schoolForm.degree = value;
}

onMounted(async () => {
    await loadSchools();
    await loadDegrees();
    await loadCachedData();
})

const loadDegrees = async () => {
    try {
        const response = await DegreeAPI.getDegrees();
        degrees.value = response.data as DegreeType[];
    } catch (error: any) {
        console.log(error.response);
    }
}

const loadSchools = async () => {
    try {
        const response = await SchoolAPI.getSchools();
        schools.value = response.data;
    } catch (error: any) {
        console.log(error.response);
    }
}

const loadCachedData = async () => {
    const cached = localStorage.getItem(appFormDataKey);
    if (!cached) return;
    
    try {
        const data = JSON.parse(cached);
        
        // Load school form data
        Object.keys(schoolForm).forEach(key => {
            if (data[key] !== undefined) {
                schoolForm[key] = data[key];
            }
        });
        
        // Check if degree is a custom value (not in the predefined list)
        if (schoolForm.degree) {
            const isPreDefined = degrees.value.some(d => d.name === schoolForm.degree);
            if (!isPreDefined && schoolForm.degree !== 'Others') {
                isDegreeOther.value = true;
                customDegree.value = schoolForm.degree;
            }
        }
    } catch (error) {
        console.error('Error loading cached data:', error);
    }
}

const submitForm = async () => {
    try {
        Object.keys(errors).forEach(k => delete errors[k]);
        await ApplicationFormAPI.validate(schoolForm, 2);
        localStorage.setItem(appFormDataKey, JSON.stringify({...schoolForm, step: 3}));
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

// Expose submitForm to parent
defineExpose({
    submitForm
});

</script>

<template>
    <div>
        <div class="row">
            <h5 class="m-0 text-bold">Tertiary</h5>
        </div>
        <hr class="my-1">
        <div class="row">
            <div class="col-12">
                <label for="school">School <span class="text-red">*</span></label>
                <select v-model="schoolForm.schoolId" name="school" :class="['form-control', { 'is-invalid': !!errors.schoolId }]">
                    <option v-for="school in schools" :value="school.id">{{ school.display_name }}</option>
                </select>
                <div v-if="errors.schoolId" class="invalid-feedback">{{ errors.schoolId[0] }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="school_address">School address <span class="text-red">*</span></label>
                <input v-model="schoolForm.address" type="text" :class="['form-control', { 'is-invalid': !!errors.address }]" placeholder="Enter complete school address">
                <div v-if="errors.address" class="invalid-feedback">{{ errors.address[0] }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="degree">Degree <span class="text-red">*</span></label>
                <select 
                    v-if="!isDegreeOther"
                    :value="schoolForm.degree" 
                    @change="handleDegreeChange(($event.target as HTMLSelectElement).value)"
                    name="degree" 
                    :class="['form-control', { 'is-invalid': !!errors.degree }]"
                >
                    <option value="" disabled selected>Select a degree</option>
                    <option v-for="degree in degrees" :key="degree.id.toString()" :value="degree.name">{{ degree.display_name }}</option>
                    <option value="Others">Others</option>
                </select>
                <div v-else class="input-group">
                    <input 
                        v-model="customDegree"
                        @input="handleCustomDegreeInput(($event.target as HTMLInputElement).value)"
                        type="text" 
                        name="degree"
                        :class="['form-control', { 'is-invalid': !!errors.degree }]"
                        placeholder="Enter your degree"
                    >
                    <div class="input-group-append">
                        <button 
                            type="button" 
                            class="btn btn-outline-secondary" 
                            @click="isDegreeOther = false; schoolForm.degree = ''"
                            title="Back to dropdown"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div v-if="errors.degree" class="invalid-feedback">{{ errors.degree[0] }}</div>
            </div>
            <div class="col-12 col-md-6">
                <label for="year_level">Year Level <span class="text-red">*</span></label>
                <select v-model="schoolForm.yearLevel" name="year_level" :class="['form-control', { 'is-invalid': !!errors.yearLevel }]">
                    <option value="" disabled selected>Select year level</option>
                    <option value="First Year">First Year</option>
                    <option value="Second Year">Second Year</option>
                    <option value="Third Year">Third Year</option>
                    <option value="Fourth Year">Fourth Year</option>
                    <option value="Graduated">Graduated</option>
                </select>
                <div v-if="errors.yearLevel" class="invalid-feedback">{{ errors.yearLevel[0] }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="school_admission">School admission date <span class="text-red">*</span></label>
                <input v-model="schoolForm.startDate" type="date" name="school_admission" :class="['form-control', { 'is-invalid': !!errors.startDate }]">
                <div v-if="errors.startDate" class="invalid-feedback">{{ errors.startDate[0] }}</div>
            </div>
            <div class="col-12 col-md-6">
                <label for="graduation_date">Expected date of graduation <span class="text-red">*</span></label>
                <input v-model="schoolForm.dateGraduated" type="date" name="graduation_date" :class="['form-control', { 'is-invalid': !!errors.dateGraduated }]">
                <div v-if="errors.dateGraduated" class="invalid-feedback">{{ errors.dateGraduated[0] }}</div>
            </div>
        </div>
        <div class="row my-2">
            <h5 class="m-0 text-bold">Secondary</h5>
        </div>
        <hr class="my-1">
        <div class="row">
            <div class="col-12">
                <label for="secondary_school">School <span class="text-red">*</span></label>
                <input v-model="schoolForm.secondarySchool" type="text" name="secondary_school" :class="['form-control', { 'is-invalid': !!errors.secondarySchool }]" placeholder="Enter your high school name">
                <div v-if="errors.secondarySchool" class="invalid-feedback">{{ errors.secondarySchool[0] }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="secondary_address">Address <span class="text-red">*</span></label>
                <input v-model="schoolForm.secondaryAddress" type="text" name="secondary_address" :class="['form-control', { 'is-invalid': !!errors.secondaryAddress }]" placeholder="Enter complete school address">
                <div v-if="errors.secondaryAddress" class="invalid-feedback">{{ errors.secondaryAddress[0] }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label for="secondary_start">Start date <span class="text-red">*</span></label>
                <input v-model="schoolForm.secondaryStartDate" name="secondary_start" type="date" :class="['form-control', { 'is-invalid': !!errors.secondaryStartDate }]">
                <div v-if="errors.secondaryStartDate" class="invalid-feedback">{{ errors.secondaryStartDate[0] }}</div>
            </div>
            <div class="col-12 col-md-6">
                <label for="secondary_end">Date gradudated <span class="text-red">*</span></label>
                <input v-model="schoolForm.secondaryEndDate" name="secondary_end" type="date" :class="['form-control', { 'is-invalid': !!errors.secondaryEndDate }]">
                <div v-if="errors.secondaryEndDate" class="invalid-feedback">{{ errors.secondaryEndDate[0] }}</div>
            </div>
        </div>
    </div>
</template>