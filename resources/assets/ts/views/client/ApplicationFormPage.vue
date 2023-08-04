<script setup lang="ts">
import AuthLayout from '../../components/layouts/AuthLayout.vue';
import OverlayLoading from '../../components/elements/OverlayLoading.vue';

import { ref, reactive, computed, onMounted } from 'vue';
import {useStudentAppFormStore} from '../../store/studentAppForm';

const studentAppFormStore = useStudentAppFormStore();
const { isSuccess, isLoading, error } = storeToRefs(studentAppFormStore);

import ProgramAPI from '../../services/ProgramAPI';
import { ProgramType } from '../../types/ProgramType';
import {ApplicationFormType} from '../../types/ApplicationFormType';
import SchoolAPI from '../../services/SchoolAPI';
import { SchoolType } from '../../types/SchoolType';
import DegreeAPI from '../../services/DegreeAPI';
import { DegreeType } from '../../types/DegreeType';
import { storeToRefs } from 'pinia';

const applicationFormData = reactive<ApplicationFormType>({
    firstName: '',
    middleName: '',
    lastName: '',
    birthDate: '',
    gender: '',
    permanentAddress: '',
    provincialAddress: '',
    homeNumber: '',
    mobileNumber: '',
    programId: '',
    yearLevel: '',
    schoolId: '',
    degree: '',
    address: '',
    startDate: '',
    dateGraduated: '',
    fbLink: '',
    skypeId: '',
});

const otherDegree = ref<String>(''); 
const isOtherDegreeShow = ref<Boolean>(false);
const programs = ref<ProgramType[]>([]);
const schools = ref<SchoolType[]>([]);
const degrees = ref<DegreeType[]>([]);

onMounted(() => {
    loadPrograms();
    loadSchools();
    loadDegrees();
})

const loadPrograms = async () => {
    try {
        const response = await ProgramAPI.getPrograms();
        programs.value = response.data.data.programs;
    } catch (error: any) {
        console.log(error.response);
    }
};

const loadSchools = async () => {
    try {
        const response = await SchoolAPI.getSchools();
        schools.value = response.data.data.schools;
    } catch (error: any) {
        console.log(error.response);
    }
}

const loadDegrees = async () => {
    try {
        const response = await DegreeAPI.getDegrees();
        degrees.value = response.data.data.degrees;
    } catch (error: any) {
        console.log(error.response);
    }
}

const isOtherDegree = (e : Event) => {
    const target = e.target as HTMLSelectElement;
    
    if (target.value == 'others') {
        isOtherDegreeShow.value = true;

        return;
    } 

    isOtherDegreeShow.value = false;
}

const submitApplicationForm = async () => {
    
    await studentAppFormStore.submitApplicationForm(applicationFormData);
}

</script>

<template>
    <AuthLayout>
        <div class="card card-primary">
            <OverlayLoading v-if="isLoading" />
            <form @submit.prevent="submitApplicationForm">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-4">
                            <label for="first-name">First Name <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.firstName" :class="{ 'is-invalid' : 'firstName' in error }" type="text" class="form-control" placeholder="Juan">
                        </div>
                        <div class="col-4">
                            <label for="middle-name">Middle Name</label>
                            <input v-model="applicationFormData.middleName" :class="{ 'is-invalid' : 'middleName' in error }" type="text" class="form-control" placeholder="Dela Cruz">
                        </div>
                        <div class="col-4">
                            <label for="last-name">Last Name <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.lastName" :class="{ 'is-invalid' : 'lastName' in error }" type="text" class="form-control" placeholder="Dela Cruz">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="birthdate">Birthdate <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.birthDate" :class="{ 'is-invalid' : 'birthDate' in error }" type="date" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="gender">Gender <span class="text-red">*</span></label>
                            <select v-model="applicationFormData.gender" :class="{ 'is-invalid' : 'gender' in error }" class="form-control">
                                <option selected value="">Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="permanent-address">Permanent address <span class="text-red">*</span></label>
                            <input type="text" v-model="applicationFormData.permanentAddress" :class="{ 'is-invalid' : 'permanentAddress' in error }" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="provincial-address">Provincial address <span class="text-red">*</span></label>
                            <input type="text" v-model="applicationFormData.provincialAddress" :class="{ 'is-invalid' : 'provincialAddress' in error }" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="home-number">Home Number <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.homeNumber" :class="{ 'is-invalid' : 'homeNumber' in error }" type="text" class="form-control" placeholder="123456789">
                        </div>
                        <div class="col-6">
                            <label for="mobile-number">Mobile Number <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.mobileNumber" :class="{ 'is-invalid' : 'mobileNumber' in error }" type="text" class="form-control" placeholder="123456789">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="program">Program <span class="text-red">*</span></label>
                            <select v-model="applicationFormData.programId" :class="{ 'is-invalid' : 'programId' in error }" class="form-control">
                                <option selected value="0">Select program</option>
                                <option v-for="(program, index) in programs" :key="index" :value="program.id">{{ program.display_name }}</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="year-level">Year Level <span class="text-red">*</span></label>
                            <select v-model="applicationFormData.yearLevel" :class="{ 'is-invalid' : 'yearLevel' in error }" class="form-control">
                                <option value="">Select year level</option>
                                <option value="First Year">First Year</option>
                                <option value="Second Year">Second Year</option>
                                <option value="Third Year">Third Year</option>
                                <option value="Fourth Year">Fourth Year</option>
                                <option value="Graduated">Graduated</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="skype-id">Skype ID</label>
                            <input v-model="applicationFormData.skypeId" :class="{ 'is-invalid' : 'skypeId' in error }" type="text" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="fb-link">Facebook Link</label>
                            <input v-model="applicationFormData.fbLink" :class="{ 'is-invalid' : 'fbLink' in error }" type="text" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-12">
                            <label for="school">School <span class="text-red">*</span></label>
                            <select v-model="applicationFormData.schoolId" :class="{ 'is-invalid' : 'schoolId' in error }" class="form-control">
                                <option selected value="">Select school</option>
                                <option v-for="school in schools" :value="school.id">{{ school.display_name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12">
                            <label for="degree">Degree <span class="text-red">*</span></label>
                            <select @change="isOtherDegree" v-model="applicationFormData.degree" :class="{ 'is-invalid' : 'degree' in error }" class="form-control">
                                <option selected value="">Select degree</option>
                                <option v-for="(degree, index) in degrees" :key="index" :value="degree.id">{{ degree.display_name }}</option>
                                <option value="others">Other degree...</option>
                            </select>

                            <input v-if="isOtherDegreeShow" v-model="otherDegree" :class="{ 'is-invalid' : 'degree' in error }" type="text" class="mt-2 form-control input-sm" placeholder="Enter other degree">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12">
                            <label for="address">Address <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.address" :class="{ 'is-invalid' : 'address' in error }" type="text" class="form-control" placeholder="Address">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-6">
                            <label for="start-date">Start Date <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.startDate" :class="{ 'is-invalid' : 'startDate' in error }" type="date" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="date-graduate">Expected date of graduation <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.dateGraduated" :class="{ 'is-invalid' : 'dateGraduated' in error }" type="date" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-block btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </AuthLayout>
</template>