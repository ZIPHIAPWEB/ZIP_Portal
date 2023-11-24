<script setup lang="ts">
import { onMounted } from 'vue';
import { userCoordStudentAdditionalRequirement } from '../../../../store/coordStudentAdditionalRequirement';
import { storeToRefs } from 'pinia';
import { useAuthStore } from '../../../../store/auth';

const authStore = useAuthStore();

const coordStudentAdditionalRequirementStore = userCoordStudentAdditionalRequirement();
const { isLoading, additionalRequirement } = storeToRefs(coordStudentAdditionalRequirementStore);

onMounted(async () => {
    await coordStudentAdditionalRequirementStore.loadSelectedStudentAdditionalRequirement();
})

</script>

<template>
    <div class="card card-default">
        <div class="card-body p-0">
            <table class="table table-striped table-bordered table-sm">
                <thead>
                    <tr>
                        <th style="width: 50%">Requirement</th>
                        <th class="text-center">
                            Status
                        </th>
                        <th class="text-center">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in additionalRequirement">
                        <td>{{ item.name }}</td>
                        <td class="text-center">
                            <span v-if="!item.student_additional" class="fa fa-times text-red"></span>
                            <span v-else class="fa fa-check text-success"></span>
                        </td>
                        <td v-if="authStore.getAuthRole == 'coordinator' || authStore.getAuthRole == 'superadmin'" class="text-center">
                            <button v-if="!item.student_additional" class="btn btn-success btn-xs mr-1">Upload</button>
                            <button v-if="item.student_additional" @click="coordStudentAdditionalRequirementStore.downloadSelectedStudentAdditionalRequirement(item.id)" class="btn btn-primary btn-xs mr-1">Download</button>
                            <button v-if="item.student_additional" @click="coordStudentAdditionalRequirementStore.removeSelectedStudentAdditionalRequirement(item.id)" class="btn btn-danger btn-xs mr-1">Delete</button>
                        </td>
                        <td v-if="authStore.getAuthRole == 'accounting'" class="text-center">
                            <span>Not Applicable</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>