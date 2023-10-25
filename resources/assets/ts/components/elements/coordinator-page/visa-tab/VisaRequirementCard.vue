<script setup lang="ts">
import { onMounted } from 'vue';
import { userCoordStudentVisaSponsorRequirement } from '../../../../store/coordStudentSponsorRequirement';
import { storeToRefs } from 'pinia';
const coordStudentVisaSponsorRequirementStore = userCoordStudentVisaSponsorRequirement();
const { isLoading, sponsorRequirements } = storeToRefs(coordStudentVisaSponsorRequirementStore);

onMounted(async () => {
    await coordStudentVisaSponsorRequirementStore.loadSelectedStudentAdditionalRequirement();
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
                    <tr v-for="item in sponsorRequirements">
                        <td>{{ item.name }}</td>
                        <td class="text-center">
                            <span v-if="!item.student_visa" class="fa fa-times text-red"></span>
                            <span v-else class="fa fa-check text-success"></span>
                        </td>
                        <td class="text-center">
                            <button v-if="!item.student_visa" class="btn btn-success btn-xs mr-1">Upload</button>
                            <button v-if="item.student_visa" @click="coordStudentVisaSponsorRequirementStore.downloadSelectedStudentAdditionalRequirement(item.id)" class="btn btn-primary btn-xs mr-1">Download</button>
                            <button v-if="item.student_visa" @click="coordStudentVisaSponsorRequirementStore.removeSelectedStudentAdditionalRequirement(item.id)" class="btn btn-danger btn-xs mr-1">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>