<script setup lang="ts">
import UploadButton from './UploadButton.vue';

import { onMounted } from 'vue';

import { useStudentBasicRequirement, IBasicRequirement } from '../../../../store/basicRequirement';
import { storeToRefs } from 'pinia';

const studentBasicRequirementStore = useStudentBasicRequirement();
const { isLoading, isSuccess, requirements } = storeToRefs(studentBasicRequirementStore);

import { useAuthStore } from '../../../../store/auth';
const authStore = useAuthStore();
const { auth } = storeToRefs(authStore);

onMounted(async () => {
    await studentBasicRequirementStore.loadStudentBasicRequirements();
});

const uploadFileHander = async (file: File, requirementId : string | number | undefined) => {
    await studentBasicRequirementStore.storeStudentBasicRequirement(requirementId, file)
}

const deleteFileHandler = async (requirement : IBasicRequirement) => {
    await studentBasicRequirementStore.removeStudentBasicRequirement(requirement);
}

const downloadFileHandler = async (requirementId : string | number | undefined) => {
    await studentBasicRequirementStore.downloadBasicRequirement(requirementId);
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
                    <UploadButton v-if="!requirement.student_preliminary?.status && !(auth.application_status == 'Program Proper' || auth.application_status == 'Program Compliance')" :requirementId="requirement.id" @getFile="uploadFileHander" />
                    <button v-if="requirement.path && !(auth.application_status == 'Program Proper' || auth.application_status == 'Program Compliance')" @click="downloadFileHandler(requirement.id)" class="btn btn-primary btn-xs">Download File</button>
                    <button v-if="requirement.student_preliminary?.status && !(auth.application_status == 'Program Proper' || auth.application_status == 'Program Compliance')" @click="deleteFileHandler(requirement)" class="btn btn-danger btn-xs">Delete File</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>