<script setup lang="ts">
import AuthLayout from '../../components/layouts/AuthLayout.vue';
import OverlayLoading from '../../components/elements/OverlayLoading.vue';
import PopUp from '../../components/elements/PopUp.vue';
import AppForm from '../../components/elements/app-form-page/AppForm.vue';
import BasicForm from '../../components/elements/app-form-page/BasicDetailsForm.vue';
import SchoolForm from '../../components/elements/app-form-page/SchoolDetailsForm.vue';

import { ref, reactive, computed, onMounted } from 'vue';
import {useStudentAppFormStore} from '../../store/studentAppForm';

const studentAppFormStore = useStudentAppFormStore();
const { isSuccess, isLoading, error } = storeToRefs(studentAppFormStore);

import ProgramAPI from '../../services/ProgramAPI';
import {ApplicationFormType} from '../../types/ApplicationFormType';
import DegreeAPI from '../../services/DegreeAPI';
import { DegreeType } from '../../types/DegreeType';
import { storeToRefs } from 'pinia';
import TermsAndConditionCard from '../../components/elements/TermsAndConditionCard.vue';
import { IProgramCategory } from '../../interfaces/IProgramCategory';
import { IProgram } from '../../interfaces/IProgram';

const applicationFormData = reactive<ApplicationFormType>({
    step: 1,
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
    secondarySchool: '',
    secondaryAddress: '',
    secondaryStartDate: '',
    secondaryEndDate: '',
    
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

const otherDegree = ref<String>(''); 
const isOtherDegreeShow = ref<Boolean>(false);
const isTermAndConditionOpen = ref<Boolean>(true);
const programs = ref<IProgram[]>([]);
const degrees = ref<DegreeType[]>([]);

onMounted(() => {
    loadPrograms();
    loadDegrees();
    loadCachedFormData();
})

const loadCachedFormData = () => {
    const appFormDataKey = 'APP_FORM_DATA';

    if (!localStorage.getItem(appFormDataKey)) {

        localStorage.setItem(appFormDataKey, JSON.stringify(applicationFormData));

        return;
    }

    let cachedFormData = JSON.parse(localStorage.getItem(appFormDataKey)) as ApplicationFormType[] | null;

    Object.entries(cachedFormData).forEach(([key, value]) => {
        applicationFormData[key] = value;
    });

    console.log(applicationFormData);
}

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
        <PopUp 
            v-if="isTermAndConditionOpen"
            title="Terms and Conditions" 
            size="lg" 
            button-text="I accept"
            :with-buttons="true"
            :with-close="false"
            @trigger-button-event="isTermAndConditionOpen = false"
        >
            <TermsAndConditionCard />
        </PopUp>

        <SchoolForm />
        
        <div class="card card-primary" style="overflow-y: auto; height: 94vh;">
            <OverlayLoading v-if="isLoading" />
            
            <form @submit.prevent="submitApplicationForm">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-12 col-md-4">
                            <label for="first-name">First name <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.firstName" :class="{ 'is-invalid' : 'firstName' in error }" type="text" class="form-control" placeholder="Juan">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="middle-name">Middle name</label>
                            <input v-model="applicationFormData.middleName" :class="{ 'is-invalid' : 'middleName' in error }" type="text" class="form-control" placeholder="Dela Cruz">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="last-name">Last name <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.lastName" :class="{ 'is-invalid' : 'lastName' in error }" type="text" class="form-control" placeholder="Dela Cruz">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 col-md-6">
                            <label for="birthdate">Birthdate <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.birthDate" :class="{ 'is-invalid' : 'birthDate' in error }" type="date" class="form-control">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="gender">Gender <span class="text-red">*</span></label>
                            <select v-model="applicationFormData.gender" :class="{ 'is-invalid' : 'gender' in error }" class="form-control">
                                <option selected value="">Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 col-md-6">
                            <label for="permanent-address">Permanent address <span class="text-red">*</span></label>
                            <input type="text" v-model="applicationFormData.permanentAddress" :class="{ 'is-invalid' : 'permanentAddress' in error }" class="form-control">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="provincial-address">Provincial address</label>
                            <input type="text" v-model="applicationFormData.provincialAddress" :class="{ 'is-invalid' : 'provincialAddress' in error }" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 col-md-6">
                            <label for="home-number">Home Number</label>
                            <input v-model="applicationFormData.homeNumber" :class="{ 'is-invalid' : 'homeNumber' in error }" type="text" class="form-control" placeholder="123456789">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="mobile-number">Mobile Number <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.mobileNumber" :class="{ 'is-invalid' : 'mobileNumber' in error }" type="text" class="form-control" placeholder="123456789">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 col-md-6">
                            <label for="program">Program <span class="text-red">*</span></label>
                            <select v-model="applicationFormData.programId" :class="{ 'is-invalid' : 'programId' in error }" class="form-control">
                                <option selected value="0">Select program</option>
                                <option v-for="(program, index) in programs" :key="index" :value="program.id">{{ program.display_name }}</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="year-level">Year level <span class="text-red">*</span></label>
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
                        <div class="col-12 col-md-6">
                            <label for="skype-id">Skype ID</label>
                            <input v-model="applicationFormData.skypeId" :class="{ 'is-invalid' : 'skypeId' in error }" type="text" class="form-control">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="fb-link">Facebook link</label>
                            <input v-model="applicationFormData.fbLink" :class="{ 'is-invalid' : 'fbLink' in error }" type="text" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-12">
                            <label for="school">School <span class="text-red">*</span></label>
                            <select v-model="applicationFormData.schoolId" :class="{ 'is-invalid' : 'schoolId' in error }" class="form-control">
                                <option selected value="">Select school</option>
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
                            <label for="address">School address <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.address" :class="{ 'is-invalid' : 'address' in error }" type="text" class="form-control" placeholder="Address">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12 col-md-6">
                            <label for="start-date">School admission date <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.startDate" :class="{ 'is-invalid' : 'startDate' in error }" type="date" class="form-control">
                        </div>
                        <div class="col-12 col-md-6">
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