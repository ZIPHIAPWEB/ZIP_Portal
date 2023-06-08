<script lang="ts" setup>
import UploadButton from './UploadButton.vue';

import { onMounted } from 'vue';
import { useStudentAdditionalRequirement } from '../../../../store/studentAdditionalRequirement';
import { storeToRefs } from 'pinia';

const studentAdditionalRequirementStore = useStudentAdditionalRequirement();
const { isLoading, isSuccess, requirements } = storeToRefs(studentAdditionalRequirementStore);

onMounted(async () => {
    await studentAdditionalRequirementStore.loadStudentAdditionalRequirements();
})

const uploadFileHander = (file : File, requirementId : string | number | undefined) => {
    console.log(file, requirementId);
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
        <tbody>
            <tr v-for="(requirement, index) in requirements" :key="index">
                <td>{{ requirement.name }}</td>
                <td>{{ requirement.description  }}</td>
                <td>
                    <span v-if="requirement.student_additional?.status == true" class="fa fa-check text-success"></span>
                    <span v-else class="fa fa-times text-danger"></span>
                </td>
                <td>
                    <UploadButton :requirementId="requirement.id" @getFile="uploadFileHander" />
                    <button class="btn btn-primary btn-xs">Download File</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>