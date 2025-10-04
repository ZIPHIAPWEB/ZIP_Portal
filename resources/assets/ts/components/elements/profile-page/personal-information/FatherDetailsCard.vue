<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';

import { useStudentFatherStore, IStudentFather } from '../../../../store/studentFather';
const studentFatherStore = useStudentFatherStore();
const { isLoading, isSuccess, father } = storeToRefs(studentFatherStore);
import AlertService from '../../../../services/AlertService';

import { useAuthStore } from '../../../../store/auth';
const authStore = useAuthStore();
const { auth } = storeToRefs(authStore);

const fatherIsEdit = ref<boolean>(false);
const fatherFormData = ref<IStudentFather>({
    first_name: '',
    middle_name: '',
    last_name: '',
    occupation: '',
    company: '',
    contact_no: ''
});

onMounted(async () => {
    const res = await studentFatherStore.loadStudentFatherDetails();
    if (!res.success) {
        await AlertService.error(res.message || 'Failed to load father details');
        return;
    }

    fatherFormData.value = {...father.value};
})

const updateFatherDetails = async () => {
    const res = await studentFatherStore.updateFatherDetails(fatherFormData.value);
    if (res.success) {
        fatherIsEdit.value = false;
        await AlertService.success('Father details updated successfully.');
    } else {
        if (res.errors) await AlertService.validation(res.errors);
        else await AlertService.error(res.message || 'Failed to update father details');
    }
}
</script>

<template>
    <div class="card card-default">
        <div class="card-body">
            <div class="profile-header">
                <h5 class="profile-header__title">Father Details</h5>
                <div class="profile-header__actions">
                    <button v-if="!fatherIsEdit && !(auth.application_status == 'Program Proper' || auth.application_status == 'Program Compliance')" @click="fatherIsEdit = true" class="btn btn-primary btn-xs">Edit</button>
                    <button v-if="fatherIsEdit" @click="updateFatherDetails" class="btn btn-success btn-xs mr-1">Save</button>
                    <button v-if="fatherIsEdit" @click="fatherIsEdit = false" class="btn btn-danger btn-xs">Cancel</button>
                </div>
            </div>
            <table class="table table-sm table-striped">
                <tbody>
                    <tr>
                        <td style="width: 40%">First name</td>
                        <td v-if="!fatherIsEdit">{{ father.first_name }}</td>
                        <td v-if="fatherIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="fatherFormData.first_name">
                        </td>
                    </tr>
                    <tr>
                        <td>Middle name</td>
                        <td v-if="!fatherIsEdit">{{ father.middle_name }}</td>
                        <td v-if="fatherIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="fatherFormData.middle_name">
                        </td>
                    </tr>
                    <tr>
                        <td>Last name</td>
                        <td v-if="!fatherIsEdit">{{ father.last_name }}</td>
                        <td v-if="fatherIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="fatherFormData.last_name">
                        </td>
                    </tr>
                    <tr>
                        <td>Occupation</td>
                        <td v-if="!fatherIsEdit">{{ father.occupation }}</td>
                        <td v-if="fatherIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="fatherFormData.occupation">
                        </td>
                    </tr>
                    <tr>
                        <td>Company</td>
                        <td v-if="!fatherIsEdit">{{ father.company }}</td>
                        <td v-if="fatherIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="fatherFormData.company">
                        </td>
                    </tr>
                    <tr>
                        <td>Contact No.</td>
                        <td v-if="!fatherIsEdit">{{ father.contact_no }}</td>
                        <td v-if="fatherIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="fatherFormData.contact_no">
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