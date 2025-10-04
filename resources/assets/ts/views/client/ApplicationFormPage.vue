<script setup lang="ts">
import AuthLayout from '../../components/layouts/AuthLayout.vue';
import OverlayLoading from '../../components/elements/OverlayLoading.vue';
import PopUp from '../../components/elements/PopUp.vue';
import AppForm from '../../components/elements/app-form-page/AppForm.vue';
import BasicForm from '../../components/elements/app-form-page/BasicDetailsForm.vue';
import SchoolForm from '../../components/elements/app-form-page/SchoolDetailsForm.vue';
import ParentDetailsForm from '../../components/elements/app-form-page/ParentDetailsForm.vue';
import WorkExperienceForm from '../../components/elements/app-form-page/WorkExperienceForm.vue';

import { ref, reactive, onMounted, onUnmounted, computed } from 'vue';
import { storeToRefs } from 'pinia';
import {useStudentAppFormStore} from '../../store/studentAppForm';

const studentAppFormStore = useStudentAppFormStore();
const { isSuccess, isLoading, error } = storeToRefs(studentAppFormStore);

import {ApplicationFormType} from '../../types/ApplicationFormType';
import TermsAndConditionCard from '../../components/elements/TermsAndConditionCard.vue';
// Removed Program and Degree loading for stepper approach; subforms handle their own data

const appFormDataKey = 'APP_FORM_DATA';
const currentStep = ref<number>(1);
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

const isTermAndConditionOpen = ref<Boolean>(true);
const childFormRef = ref<any>(null);

onMounted(() => {
    loadCachedFormData();
    startStepSync();
})

const loadCachedFormData = () => {
    if (!localStorage.getItem(appFormDataKey)) {
        localStorage.setItem(appFormDataKey, JSON.stringify(applicationFormData));
        currentStep.value = 1;
        return;
    }

    const cached = JSON.parse(localStorage.getItem(appFormDataKey) || '{}') as any;
    Object.entries(cached).forEach(([key, value]) => {
        // @ts-ignore dynamic assign
        applicationFormData[key] = value as any;
    });
    currentStep.value = Number(cached.step || 1);
}

let stepSyncTimer: number | undefined;
const startStepSync = () => {
    stepSyncTimer = window.setInterval(() => {
        const cached = JSON.parse(localStorage.getItem(appFormDataKey) || '{}');
        const nextStep = Number(cached?.step || 1);
        if (nextStep !== currentStep.value) {
            currentStep.value = nextStep;
            // Refresh aggregate form data too
            Object.entries(cached || {}).forEach(([key, value]) => {
                // @ts-ignore dynamic assign
                applicationFormData[key] = value as any;
            });
        }
    }, 400);
}

onUnmounted(() => {
    if (stepSyncTimer) window.clearInterval(stepSyncTimer);
});

const submitApplicationForm = async () => {
    await studentAppFormStore.submitApplicationForm(applicationFormData);
}

const goBack = () => {
    const next = Math.max(1, Number(currentStep.value) - 1);
    currentStep.value = next;
    // Update only the step in cached data while preserving existing payload
    const cached = JSON.parse(localStorage.getItem(appFormDataKey) || '{}');
    localStorage.setItem(appFormDataKey, JSON.stringify({ ...cached, ...applicationFormData, step: next }));
}

const handleNext = () => {
    // Trigger form submission in child component
    if (childFormRef.value?.submitForm) {
        childFormRef.value.submitForm();
    }
}

const totalSteps = 4;
const isLastStep = computed(() => currentStep.value >= totalSteps);

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

        <AppForm>
            <OverlayLoading v-if="isLoading" />
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="mr-2 font-weight-bold">Step {{ currentStep }}</div>
                    <div class="text-muted">of {{ totalSteps }}</div>
                </div>

                <keep-alive>
                    <component 
                        :is="
                            currentStep === 1 ? BasicForm :
                            currentStep === 2 ? SchoolForm :
                            currentStep === 3 ? ParentDetailsForm :
                            WorkExperienceForm
                        "
                        ref="childFormRef"
                    />
                </keep-alive>

                <div class="d-flex justify-content-between mt-3">
                    <button
                        v-if="currentStep > 1"
                        type="button"
                        class="btn btn-secondary"
                        :disabled="isLoading"
                        @click="goBack"
                    >Back</button>
                    
                    <button
                        v-if="!isLastStep"
                        type="button"
                        class="btn btn-primary ml-auto"
                        :disabled="isLoading"
                        @click="handleNext"
                    >Next</button>
                    
                    <button
                        v-if="isLastStep"
                        type="button"
                        class="btn btn-primary ml-auto"
                        :disabled="isLoading"
                        @click="submitApplicationForm"
                    >
                        <span v-if="isLoading">
                            <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>
                            Submitting...
                        </span>
                        <span v-else>Submit Application</span>
                    </button>
                </div>
            </div>
        </AppForm>
    </AuthLayout>
</template>