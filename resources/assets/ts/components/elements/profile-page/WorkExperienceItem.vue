<script lang="ts" setup>
import { storeToRefs } from 'pinia';

import { ref } from 'vue';
import { IStudentWorkExperience } from '../../../store/studentWorkExperience';

import { useAuthStore } from '../../../store/auth';
const authStore = useAuthStore();
const { auth } = storeToRefs(authStore);

const props = defineProps<{
    experienceProps: IStudentWorkExperience
}>();

const emits = defineEmits<{
  (e: 'deleteExperienceEvent', updatedExperience: IStudentWorkExperience): void
  (e: 'updateExperienceEvent', updatedExperience: IStudentWorkExperience): void
}>()

const experienceIsEdit = ref<boolean>(false);
const compExperience = ref<IStudentWorkExperience>(props.experienceProps);

const editWorkExperience = () => {
    experienceIsEdit.value = true;
}

const updateWorkExperience = async () => {
    emits('updateExperienceEvent', compExperience.value);
    experienceIsEdit.value = false;
}

const cancelEditWorkExperience = () => {
    experienceIsEdit.value = false;
}

const deleteWorkExperience = async () => {
    emits('deleteExperienceEvent', compExperience.value);
}
</script>

<template>
    <table class="table table-sm table-striped">
        <tbody>
            <tr>
                <td colspan="2" class="text-right">
                    <button v-if="!experienceIsEdit && !(auth.application_status == 'Program Proper' || auth.application_status == 'Program Compliance')" @click="editWorkExperience" class="btn btn-primary btn-xs mr-1">Edit</button>
                    <button v-if="experienceIsEdit" @click="updateWorkExperience" class="btn btn-success btn-xs mr-1">Update</button>
                    <button v-if="!experienceIsEdit && !(auth.application_status == 'Program Proper' || auth.application_status == 'Program Compliance')" @click="deleteWorkExperience" class="btn btn-danger btn-xs">Remove</button>
                    <button v-if="experienceIsEdit" @click="cancelEditWorkExperience" class="btn btn-danger btn-xs">Cancel</button>
                </td>
            </tr>
            <tr>
                <td style="width: 40%">Company Name</td>
                <td v-if="!experienceIsEdit">{{ compExperience.company }}</td>
                <td v-if="experienceIsEdit">
                    <input v-model="compExperience.company" type="text" class="form-control form-control-sm" />
                </td>
            </tr>
            <tr>
                <td>Company Address</td>
                <td v-if="!experienceIsEdit">{{ compExperience.address}}</td>
                <td v-if="experienceIsEdit">
                    <input v-model="compExperience.address" type="text" class="form-control form-control-sm" />
                </td>
            </tr>
            <tr>
                <td>Start Date</td>
                <td v-if="!experienceIsEdit">{{ compExperience.start_date }}</td>
                <td v-if="experienceIsEdit">
                    <input v-model="compExperience.start_date" type="date" class="form-control form-control-sm" />
                </td>
            </tr>
            <tr>
                <td>End Date</td>
                <td v-if="!experienceIsEdit">{{ compExperience.end_date }}</td>
                <td v-if="experienceIsEdit">
                    <input v-model="compExperience.end_date" type="date" class="form-control form-control-sm" />
                </td>
            </tr>
            <tr>
                <td>Job Description</td>
                <td v-if="!experienceIsEdit">{{ compExperience.description }}</td>
                <td v-if="experienceIsEdit">
                    <input v-model="compExperience.description" class="form-control form-control-sm">
                </td>
            </tr>
        </tbody>
    </table>
</template>