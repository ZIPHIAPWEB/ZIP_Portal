<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';

import { useStudentSecondaryStore, IStudentSecondary } from '../../../../store/studentSecondary';
const studentSecondaryStore = useStudentSecondaryStore();
const { isLoading, isSuccess, secondary } = storeToRefs(studentSecondaryStore);

import { useAuthStore } from '../../../../store/auth';
const authStore = useAuthStore();
const { auth } = storeToRefs(authStore);

import AlertService from '../../../../services/AlertService';

const secondaryIsEdit = ref<boolean>(false);
const secondaryFormData = ref<IStudentSecondary>({
    school: '',
    address: '',
    start_date: '',
    date_graduated: ''
});

onMounted(async () => {
    const res = await studentSecondaryStore.loadStudentSecondaryDetails();
    if (!res.success) {
        AlertService.error(res.message || 'Failed to load secondary details');
    }

    secondaryFormData.value = {...secondary.value};
})

const updateSecondaryDetails = async () => {
    const res = await studentSecondaryStore.updateSecondaryDetails(secondaryFormData.value);
    if (res.success) {
        secondaryIsEdit.value = false;
        AlertService.success('Secondary details updated', 'Success');
    } else if (res.errors) {
        AlertService.validation(res.errors);
    } else {
        AlertService.error(res.message || 'Failed to update secondary details');
    }
}
</script>

<template>
    <div class="card card-default">
        <div class="card-body">
            <div class="profile-header">
                <h5 class="profile-header__title">Secondary</h5>
                <div class="profile-header__actions">
                    <button v-if="!secondaryIsEdit && !(auth.application_status == 'Program Proper' || auth.application_status == 'Program Compliance')" @click="secondaryIsEdit = true" class="btn btn-primary btn-xs">Edit</button>
                    <button v-if="secondaryIsEdit" @click="updateSecondaryDetails" class="btn btn-success btn-xs mr-1">Save</button>
                    <button v-if="secondaryIsEdit" @click="secondaryIsEdit = false" class="btn btn-danger btn-xs">Cancel</button>
                </div>
            </div>
            <table class="table table-striped table-sm">
                <tbody>
                    <tr>
                        <td style="width: 40%">School</td>
                        <td v-if="!secondaryIsEdit">{{ secondary.school }}</td>
                        <td v-if="secondaryIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="secondaryFormData.school">
                        </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td v-if="!secondaryIsEdit">{{ secondary.address }}</td>
                        <td v-if="secondaryIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="secondaryFormData.address">
                        </td>
                    </tr>
                    <tr>
                        <td>Start date</td>
                        <td v-if="!secondaryIsEdit">{{ secondary.start_date }}</td>
                        <td v-if="secondaryIsEdit">
                            <input type="date" class="form-control form-control-sm" v-model="secondaryFormData.start_date">
                        </td>
                    </tr>
                    <tr>
                        <td>Date Graduated (expected)</td>
                        <td v-if="!secondaryIsEdit">{{ secondary.date_graduated }}</td>
                        <td v-if="secondaryIsEdit">
                            <input type="date" class="form-control form-control-sm" v-model="secondaryFormData.date_graduated">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped>
    .profile-header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: 100%;
        margin: 5px 0;
    }

    .profile-header__title {
        font-weight: bold;
        font-size: 15px;
        margin: 0;
    }
</style>