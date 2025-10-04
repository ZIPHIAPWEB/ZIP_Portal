<script lang="ts" setup>
import { onMounted } from 'vue';
import AlertService from '../../../../services/AlertService';
import { IVisaSponsorRequirement, useStudentVisaSponsorRequirement } from '../../../../store/studentVisaSponsorRequirement';
import { storeToRefs } from 'pinia';
import UploadButton from './UploadButton.vue';

const studentVisaSponsorRequirementStore = useStudentVisaSponsorRequirement();
const { isLoading, isSuccess, requirements } = storeToRefs(studentVisaSponsorRequirementStore);

import { useAuthStore } from '../../../../store/auth';
const authStore = useAuthStore();
const { auth } = storeToRefs(authStore);

onMounted(async () => {
    const res = await studentVisaSponsorRequirementStore.loadVisaSponsorRequirements();
    if (!res.success) await AlertService.error(res.message || 'Failed to load requirements');
})

const uploadFileHander = async (file : File, requirementId : string | number | undefined) => {
    const res = await studentVisaSponsorRequirementStore.storeVisaSponsorRequirement(requirementId, file);
    if (res.success) {
        await AlertService.success('File uploaded', 'Success');
    } else if (res.errors) {
        await AlertService.validation(res.errors);
    } else {
        await AlertService.error(res.message || 'Failed to upload file');
    }
}

const deleteFileHandler = async (requirement : IVisaSponsorRequirement) => {
    const res = await studentVisaSponsorRequirementStore.deleteVisaSponsorRequirement(requirement);
    if (res.success) {
        await AlertService.success('File deleted', 'Success');
    } else {
        await AlertService.error(res.message || 'Failed to delete file');
    }
}

const downloadFileHandler = async (requirementId : string | number | undefined) => {
    const res = await studentVisaSponsorRequirementStore.downloadVisaSponsorRequirement(requirementId);
    if (!res.success) await AlertService.error(res.message || 'Failed to download file');
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
                    <span v-if="requirement.student_visa?.status == true" class="fa fa-check text-success"></span>
                    <span v-else class="fa fa-times text-danger"></span>
                </td>
                <td>
                    <UploadButton v-if="!requirement.student_visa?.status && !(auth.application_status == 'Program Proper' || auth.application_status == 'Program Compliance')" :requirementId="requirement.id" @getFile="uploadFileHander" />
                    <button v-if="requirement.path && !(auth.application_status == 'Program Proper' || auth.application_status == 'Program Compliance')" @click="downloadFileHandler(requirement.id)" class="btn btn-primary btn-xs">Download File</button>
                    <button v-if="requirement.student_visa?.status && !(auth.application_status == 'Program Proper' || auth.application_status == 'Program Compliance')" @click="deleteFileHandler(requirement)" class="btn btn-danger btn-xs">Delete File</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>