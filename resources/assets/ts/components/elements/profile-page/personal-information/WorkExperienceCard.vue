<script setup lang="ts">
import WorkExperienceItem from '../WorkExperienceItem.vue';

import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';
import { useStudentWorkExperienceStore, IStudentWorkExperience } from '../../../../store/studentWorkExperience';

const studentWorkExperienceStore = useStudentWorkExperienceStore();
const { isLoading, isSuccess, experiences } = storeToRefs(studentWorkExperienceStore)

import { useAuthStore } from '../../../../store/auth';
const authStore = useAuthStore();
const { auth } = storeToRefs(authStore);
import AlertService from '../../../../services/AlertService';

const experiencesIsAdd = ref<boolean>(false);
const experienceFormData = ref<IStudentWorkExperience>({
    company: '',
    address: '',
    start_date: '',
    end_date: '',
    description: ''
});

onMounted(async () => {
    const res = await studentWorkExperienceStore.loadWorkExperiences();
    if (!res.success) await AlertService.error(res.message || 'Failed to load work experiences');
})

const addWorkExperience = async () => {
    const res = await studentWorkExperienceStore.storeWorkExperience(experienceFormData.value);
    if (res.success) {
        experiencesIsAdd.value = false;
        await AlertService.success('Work experience added successfully.');
    } else {
        if (res.errors) await AlertService.validation(res.errors);
        else await AlertService.error(res.message || 'Failed to add work experience');
    }
}

const updateWorkExperience = async (experience: IStudentWorkExperience) => {
    const res = await studentWorkExperienceStore.updateWorkExperience(experience)
    if (!res.success) await AlertService.error(res.message || 'Failed to update experience');
}

const removeWorkExperience = async (experience: IStudentWorkExperience) => {
    const res = await studentWorkExperienceStore.deleteWorkExperience(experience)
    if (!res.success) await AlertService.error(res.message || 'Failed to delete experience');
}
</script>

<template>
    <div class="card card-default">
        <div class="card-body" id="work-experience">
            <div class="profile-header">
                <h5 class="profile-header__title">Work Experience/On-the-Job Training</h5>
                <div class="profile-header__actions">
                    <button v-if="!experiencesIsAdd && !(auth.application_status == 'Program Proper' || auth.application_status == 'Program Compliance')" @click="experiencesIsAdd =  true" class="btn btn-success btn-xs ">Add</button>
                    <button v-if="experiencesIsAdd" @click="addWorkExperience" class="btn btn-primary btn-xs mr-1">Save</button>
                    <button v-if="experiencesIsAdd" @click="experiencesIsAdd =  false" class="btn btn-danger btn-xs">Cancel</button>
                </div>
            </div>
            <div v-if="experiencesIsAdd == true">
                <table class="table table-sm table-striped">
                    <tbody>
                        <tr>
                            <td>Company Name</td>
                            <td>
                                <input v-model="experienceFormData.company" type="text" class="form-control form-control-sm">
                            </td>
                        </tr>
                        <tr>
                            <td>Company Address</td>
                            <td>
                                <input v-model="experienceFormData.address" type="text" class="form-control form-control-sm">
                            </td>
                        </tr>
                        <tr>
                            <td>Start Date</td>
                            <td>
                                <input v-model="experienceFormData.start_date" type="date" class="form-control form-control-sm">
                            </td>
                        </tr>
                        <tr>
                            <td>End Date</td>
                            <td>
                                <input v-model="experienceFormData.end_date" type="date" class="form-control form-control-sm">
                            </td>
                        </tr>
                        <tr>
                            <td>Job Description</td>
                            <td>
                                <input v-model="experienceFormData.description" type="text" class="form-control form-control-sm">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-if="experiences.length > 0 && !experiencesIsAdd">
                <WorkExperienceItem 
                    v-for="(exp, index) in experiences" 
                    :key="index" 
                    :experienceProps="exp"
                    @updateExperienceEvent="updateWorkExperience"
                    @deleteExperienceEvent="removeWorkExperience"
                />
            </div>
            <div v-if="experiences.length == 0 && !experiencesIsAdd">
                <p class="text-center">No work experience yet.</p>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .profile-header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: 100%;
        margin: 5px 0;
    }

    .profile-header__title {
        font-weight: bold;
        font-size: 15px;
        margin: 0;
    }
</style>