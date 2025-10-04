<script lang="ts" setup>
import UploadButton from './UploadButton.vue';

import { onMounted } from 'vue';
import { useStudentAdditionalRequirement } from '../../../../store/studentAdditionalRequirement';
import { storeToRefs } from 'pinia';
import { IAdditionalRequirement } from '../../../../store/studentAdditionalRequirement';

import AlertService from '../../../../services/AlertService';

const studentAdditionalRequirementStore = useStudentAdditionalRequirement();
const { isLoading, isSuccess, requirements } = storeToRefs(studentAdditionalRequirementStore);

import { useAuthStore } from '../../../../store/auth';
const authStore = useAuthStore();
const { auth } = storeToRefs(authStore);

onMounted(async () => {
    const res = await studentAdditionalRequirementStore.loadStudentAdditionalRequirements();
    if (!res.success) {
        AlertService.error(res.message || 'Failed to load requirements');
    }
})

const uploadFileHander = async (file : File, requirementId : string | number | undefined) => {
    const res = await studentAdditionalRequirementStore.storeStudentAdditionalRequirement(requirementId, file);
    if (res.success) {
        AlertService.success('File uploaded', 'Success');
    } else if (res.errors) {
        AlertService.validation(res.errors);
    } else {
        AlertService.error(res.message || 'Failed to upload file');
    }
}

const deleteFileHandler = async (requirement : IAdditionalRequirement) => {
    const res = await studentAdditionalRequirementStore.removeStudentAdditionalRequirement(requirement);
    if (res.success) {
        AlertService.success('File deleted', 'Success');
    } else {
        AlertService.error(res.message || 'Failed to delete file');
    }
}

const downloadFileHandler = async (requirementId : string | number | undefined) => {
    const res = await studentAdditionalRequirementStore.downloadAdditionalRequirement(requirementId);
    if (!res.success) {
        AlertService.error(res.message || 'Failed to download file');
    }
}

</script>

<template>
    <table class="table table-striped table-sm">
        <thead>
            <th>Requirements</th>
            <th>Instruction</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        <tbody v-if="isLoading && !isSuccess">
            <tr>
                <td colspan="4" class="text-center">Loading...</td>
            </tr>
        </tbody>
        <tbody v-if="!isLoading && isSuccess && requirements.length == 0">
            <tr>
                <td colspan="4" class="text-center">No requirements</td>
            </tr>
        </tbody>
        <tbody v-if="!isLoading && isSuccess && requirements.length > 0">
            <tr v-for="(requirement, index) in requirements" :key="index">
                <td>{{ requirement.name }}</td>
                <td>{{ requirement.description  }}</td>
                <td>
                    <span v-if="requirement.student_additional?.status == true" class="fa fa-check text-success"></span>
                    <span v-else class="fa fa-times text-danger"></span>
                </td>
                <td>
                    <UploadButton v-if="!requirement.student_additional?.status" :requirementId="requirement.id" @getFile="uploadFileHander" />
                    <button v-if="requirement.path" @click="downloadFileHandler(requirement.id)" class="btn btn-primary btn-xs">Download File</button>
                    <button v-if="requirement.student_additional?.status" @click="deleteFileHandler(requirement)" class="btn btn-danger btn-xs">Delete File</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>