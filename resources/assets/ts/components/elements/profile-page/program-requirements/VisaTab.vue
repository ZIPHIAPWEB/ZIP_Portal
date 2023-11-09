<script lang="ts" setup>
import { onMounted } from 'vue';
import { IVisaSponsorRequirement, useStudentVisaSponsorRequirement } from '../../../../store/studentVisaSponsorRequirement';
import { storeToRefs } from 'pinia';
import UploadButton from './UploadButton.vue';

const studentVisaSponsorRequirementStore = useStudentVisaSponsorRequirement();
const { isLoading, isSuccess, requirements } = storeToRefs(studentVisaSponsorRequirementStore);

onMounted(async () => {
    await studentVisaSponsorRequirementStore.loadVisaSponsorRequirements();
})

const uploadFileHander = async (file : File, requirementId : string | number | undefined) => {
    await studentVisaSponsorRequirementStore.storeVisaSponsorRequirement(requirementId, file);
}

const deleteFileHandler = async (requirement : IVisaSponsorRequirement) => {
    await studentVisaSponsorRequirementStore.deleteVisaSponsorRequirement(requirement);
}

const downloadFileHandler = async (requirementId : string | number | undefined) => {
    await studentVisaSponsorRequirementStore.downloadVisaSponsorRequirement(requirementId);
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
                    <UploadButton v-if="!requirement.student_visa?.status" :requirementId="requirement.id" @getFile="uploadFileHander" />
                    <button v-if="requirement.path" @click="downloadFileHandler(requirement.id)" class="btn btn-primary btn-xs">Download File</button>
                    <button v-if="requirement.student_visa?.status" @click="deleteFileHandler(requirement)" class="btn btn-danger btn-xs">Delete File</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>