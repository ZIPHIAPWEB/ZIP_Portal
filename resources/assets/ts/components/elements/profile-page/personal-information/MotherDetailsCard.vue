<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';

import { useStudentMotherStore, IStudentMother } from '../../../../store/studentMother';
const studentMotherStore = useStudentMotherStore();
const { isLoading, isSuccess, mother } = storeToRefs(studentMotherStore);
import AlertService from '../../../../services/AlertService';

import { useAuthStore } from '../../../../store/auth';
const authStore = useAuthStore();
const { auth } = storeToRefs(authStore);

const motherIsEdit = ref<boolean>(false);
const motherFormData = ref<IStudentMother>({
    first_name: '',
    middle_name: '',
    last_name: '',
    occupation: '',
    company: '',
    contact_no: ''
});

onMounted(async () => {
    const res = await studentMotherStore.loadStudentMotherDetails();
    if (!res.success) {
        await AlertService.error(res.message || 'Failed to load mother details');
        return;
    }

    motherFormData.value = {...mother.value};
})

const updateMotherDetails = async () => {
    const res = await studentMotherStore.updateMotherDetails(motherFormData.value);
    if (res.success) {
        motherIsEdit.value = false;
        await AlertService.success('Mother details updated successfully.');
    } else {
        if (res.errors) await AlertService.validation(res.errors);
        else await AlertService.error(res.message || 'Failed to update mother details');
    }
}
</script>

<template>
    <div class="card card-default">
        <div class="card-body">
            <div class="profile-header">
                <h5 class="profile-header__title">Mother Details</h5>
                <div class="profile-header__actions">
                    <button v-if="!motherIsEdit && !(auth.application_status == 'Program Proper' || auth.application_status == 'Program Compliance')" @click="motherIsEdit = true" class="btn btn-primary btn-xs">Edit</button>
                    <button v-if="motherIsEdit" @click="updateMotherDetails" class="btn btn-success btn-xs mr-1">Save</button>
                    <button v-if="motherIsEdit" @click="motherIsEdit = false" class="btn btn-danger btn-xs">Cancel</button>
                </div>
            </div>
            <table class="table table-sm table-striped">
                <tbody>
                    <tr>
                        <td style="width: 40%">First name</td>
                        <td v-if="!motherIsEdit">{{ mother.first_name }}</td>
                        <td v-if="motherIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="motherFormData.first_name">
                        </td>
                    </tr>
                    <tr>
                        <td>Middle name</td>
                        <td v-if="!motherIsEdit">{{ mother.middle_name }}</td>
                        <td v-if="motherIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="motherFormData.middle_name">
                        </td>
                    </tr>
                    <tr>
                        <td>Last name</td>
                        <td v-if="!motherIsEdit">{{ mother.last_name }}</td>
                        <td v-if="motherIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="motherFormData.last_name">
                        </td>
                    </tr>
                    <tr>
                        <td>Occupation</td>
                        <td v-if="!motherIsEdit">{{ mother.occupation }}</td>
                        <td v-if="motherIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="motherFormData.occupation">
                        </td>
                    </tr>
                    <tr>
                        <td>Company</td>
                        <td v-if="!motherIsEdit">{{ mother.company }}</td>
                        <td v-if="motherIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="motherFormData.company">
                        </td>
                    </tr>
                    <tr>
                        <td>Contact No.</td>
                        <td v-if="!motherIsEdit">{{ mother.contact_no }}</td>
                        <td v-if="motherIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="motherFormData.contact_no">
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