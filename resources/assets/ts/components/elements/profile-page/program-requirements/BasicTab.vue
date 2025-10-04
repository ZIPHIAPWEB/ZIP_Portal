<script setup lang="ts">
import UploadButton from './UploadButton.vue';

import { onMounted } from 'vue';

import { useStudentBasicRequirement, IBasicRequirement } from '../../../../store/basicRequirement';
import { storeToRefs } from 'pinia';

import AlertService from '../../../../services/AlertService';

const studentBasicRequirementStore = useStudentBasicRequirement();
const { isLoading, isSuccess, requirements } = storeToRefs(studentBasicRequirementStore);

import { useAuthStore } from '../../../../store/auth';
const authStore = useAuthStore();
const { auth } = storeToRefs(authStore);

onMounted(async () => {
    const res = await studentBasicRequirementStore.loadStudentBasicRequirements();
    if (!res.success) {
        AlertService.error(res.message || 'Failed to load requirements');
    }
});

const uploadFileHander = async (file: File, requirementId : string | number | undefined) => {
    const res = await studentBasicRequirementStore.storeStudentBasicRequirement(requirementId, file);
    if (res.success) {
        AlertService.success('File uploaded', 'Success');
    } else if (res.errors) {
        AlertService.validation(res.errors);
    } else {
        AlertService.error(res.message || 'Failed to upload file');
    }
}

const deleteFileHandler = async (requirement : IBasicRequirement) => {
    const res = await studentBasicRequirementStore.removeStudentBasicRequirement(requirement);
    if (res.success) {
        AlertService.success('File deleted', 'Success');
    } else {
        AlertService.error(res.message || 'Failed to delete file');
    }
}

const downloadFileHandler = async (requirementId : string | number | undefined) => {
    const res = await studentBasicRequirementStore.downloadBasicRequirement(requirementId);
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
                <td>{{ requirement.description }}</td>
                <td>
                    <span v-if="requirement.student_preliminary?.status == true" class="fa fa-check text-success"></span>
                    <span v-else class="fa fa-times text-danger"></span>
                </td>
                <td>
                    <UploadButton v-if="!requirement.student_preliminary?.status" :requirementId="requirement.id" @getFile="uploadFileHander" />
                    <button v-if="requirement.path" @click="downloadFileHandler(requirement.id)" class="btn btn-primary btn-xs">Download File</button>
                    <button v-if="requirement.student_preliminary?.status" @click="deleteFileHandler(requirement)" class="btn btn-danger btn-xs">Delete File</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>