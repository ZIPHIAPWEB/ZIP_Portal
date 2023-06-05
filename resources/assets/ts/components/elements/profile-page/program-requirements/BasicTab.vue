<script setup lang="ts">
import { onMounted } from 'vue';

import { useStudentBasicRequirement } from '../../../../store/basicRequirement';
import { storeToRefs } from 'pinia';

const studentBasicRequirementStore = useStudentBasicRequirement();
const { isLoading, isSuccess, requirements } = storeToRefs(studentBasicRequirementStore);

onMounted(async () => {
    await studentBasicRequirementStore.loadStudentBasicRequirements();
});

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
                    <button class="btn btn-default btn-xs mr-1">Upload</button>
                    <button class="btn btn-primary btn-xs">Download File</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>