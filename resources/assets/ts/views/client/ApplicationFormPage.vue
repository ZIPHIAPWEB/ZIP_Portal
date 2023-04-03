<script setup lang="ts">
import AuthLayout from '../../components/layouts/AuthLayout.vue';
import OverlayLoading from '../../components/elements/OverlayLoading.vue';

import { ref, reactive, computed, onMounted } from 'vue';
import { useRouter } from 'vue-router';

import ProgramAPI from '../../services/ProgramAPI';
import { ProgramType } from '../../types/ProgramType';
import ApplicationFormAPI from '../../services/ApplicationFormAPI';
import {ApplicationFormType} from '../../types/ApplicationFormType';
import SchoolAPI from '../../services/SchoolAPI';
import { SchoolType } from '../../types/SchoolType';
import DegreeAPI from '../../services/DegreeAPI';
import { DegreeType } from '../../types/DegreeType';
import router from '../../router';

const isLoading = ref<Boolean>(false);
const errors = ref<string[]|any>([]);
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

const firstNameError = computed(() => {
    if (errors.value['firstName']) {
        return errors.value['firstName'][0];
    }

    return false;
});

const middleNameError = computed(() => {
    if (errors.value['middle_name']) {
        return errors.value['middle_name'][0];
    }

    return false;
});

const lastNameError = computed(() => {
    if (errors.value['lastName']) {
        return errors.value['lastName'][0];
    }

    return false;
});

const birthDateError = computed(() => {
    if (errors.value['birthDate']) {
        return errors.value['birthDate'][0];
    }

    return false;
});

const genderError = computed(() => {
    if (errors.value['gender']) {
        return errors.value['gender'][0];
    }

    return false;
});

const permanentAddressError = computed(() => {
    if (errors.value['permanentAddress']) {
        return errors.value['permanentAddress'][0];
    }

    return false;
});

const provincialAddressError = computed(() => {
    if (errors.value['provincialAddress']) {
        return errors.value['provincialAddress'][0];
    }

    return false;
});

const homeNumberError = computed(() => {
    if (errors.value['homeNumber']) {
        return errors.value['homeNumber'][0];
    }

    return false;
});

const mobileNumberError = computed(() => {
    if (errors.value['mobileNumber']) {
        return errors.value['mobileNumber'][0];
    }

    return false;
});

const programIdError = computed(() => {
    if (errors.value['programId']) {
        return errors.value['programId'][0];
    }

    return false;
});

const yearLevelError = computed(() => {
    if (errors.value['yearLevel']) {
        return errors.value['yearLevel'][0];
    }

    return false;
});

const schoolError = computed(() => {
    if (errors.value['schoolId']) {
        return errors.value['schoolId'][0];
    }

    return false;
});

const degreeError = computed(() => {
    if (errors.value['degree']) {
        return errors.value['degree'][0];
    }

    return false;
});

const addressError = computed(() => {
    if (errors.value['address']) {
        return errors.value['address'][0];
    }

    return false;
});

const startDateError = computed(() => {
    if (errors.value['startDate']) {
        return errors.value['startDate'][0];
    }

    return false;
});

const dateGraduateError = computed(() => {
    if (errors.value['dateGraduated']) {
        return errors.value['dateGraduated'][0];
    }

    return false;
});

const skypeIdError = computed(() => {
    if (errors.value['skypeId']) {
        return errors.value['skypeId'][0];
    }

    return false;
});

const fbLinkError = computed(() => {
    if (errors.value['fbLink']) {
        return errors.value['fbLink'][0];
    }

    return false;
});

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
    isLoading.value = true;

    try {
        applicationFormData.degree = isOtherDegreeShow.value ? otherDegree.value : applicationFormData.degree;

        await ApplicationFormAPI.submit(applicationFormData);

        router.push({ name: 'student-dashboard'});
    } catch (error: any) {
        console.log(error.response);
        errors.value = error.response.data.errors;
    }
    isLoading.value = false;
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
                            <input v-model="applicationFormData.firstName" :class="{ 'is-invalid' : firstNameError }" type="text" class="form-control" placeholder="Juan">
                        </div>
                        <div class="col-4">
                            <label for="middle-name">Middle Name</label>
                            <input v-model="applicationFormData.middleName" :class="{ 'is-invalid' : middleNameError}" type="text" class="form-control" placeholder="Dela Cruz">
                        </div>
                        <div class="col-4">
                            <label for="last-name">Last Name <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.lastName" :class="{ 'is-invalid' : lastNameError}" type="text" class="form-control" placeholder="Dela Cruz">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="birthdate">Birthdate <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.birthDate" :class="{ 'is-invalid' : birthDateError}" type="date" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="gender">Gender <span class="text-red">*</span></label>
                            <select v-model="applicationFormData.gender" :class="{ 'is-invalid' : genderError}" class="form-control">
                                <option selected value="">Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="permanent-address">Permanent address <span class="text-red">*</span></label>
                            <input type="text" v-model="applicationFormData.permanentAddress" :class="{ 'is-invalid' : permanentAddressError }" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="provincial-address">Provincial address <span class="text-red">*</span></label>
                            <input type="text" v-model="applicationFormData.provincialAddress" :class="{ 'is-invalid' : provincialAddressError }" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="home-number">Home Number <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.homeNumber" :class="{ 'is-invalid' : homeNumberError}" type="text" class="form-control" placeholder="123456789">
                        </div>
                        <div class="col-6">
                            <label for="mobile-number">Mobile Number <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.mobileNumber" :class="{ 'is-invalid' : mobileNumberError}" type="text" class="form-control" placeholder="123456789">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="program">Program <span class="text-red">*</span></label>
                            <select v-model="applicationFormData.programId" :class="{ 'is-invalid' : programIdError }" class="form-control">
                                <option selected value="0">Select program</option>
                                <option v-for="(program, index) in programs" :key="index" :value="program.id">{{ program.display_name }}</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="year-level">Year Level <span class="text-red">*</span></label>
                            <select v-model="applicationFormData.yearLevel" :class="{ 'is-invalid' : yearLevelError }" class="form-control">
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
                            <input v-model="applicationFormData.skypeId" :class="{ 'is-invalid' : skypeIdError }" type="text" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="fb-link">Facebook Link</label>
                            <input v-model="applicationFormData.fbLink" :class="{ 'is-invalid' : fbLinkError }" type="text" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-12">
                            <label for="school">School <span class="text-red">*</span></label>
                            <select v-model="applicationFormData.schoolId" :class="{ 'is-invalid' : schoolError }" class="form-control">
                                <option selected value="">Select school</option>
                                <option value="Test">Testing</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12">
                            <label for="degree">Degree <span class="text-red">*</span></label>
                            <select @change="isOtherDegree" v-model="applicationFormData.degree" :class="{ 'is-invalid' : degreeError }" class="form-control">
                                <option selected value="">Select degree</option>
                                <option v-for="(degree, index) in degrees" :key="index" :value="degree.id">{{ degree.display_name }}</option>
                                <option value="others">Other degree...</option>
                            </select>

                            <input v-if="isOtherDegreeShow" v-model="otherDegree" :class="{ 'is-invalid' : degreeError }" type="text" class="mt-2 form-control input-sm" placeholder="Enter other degree">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12">
                            <label for="address">Address <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.address" :class="{ 'is-invalid' : addressError }" type="text" class="form-control" placeholder="Address">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-6">
                            <label for="start-date">Start Date <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.startDate" :class="{ 'is-invalid' : startDateError }" type="date" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="date-graduate">Expected date of graduation <span class="text-red">*</span></label>
                            <input v-model="applicationFormData.dateGraduated" :class="{ 'is-invalid' : dateGraduateError }" type="date" class="form-control">
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