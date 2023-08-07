<script setup lang="ts">
import { storeToRefs } from 'pinia';
import { ref, onMounted } from 'vue';

import { useStudentPersonal, IStudentPersonalInfo } from '../../../../store/studentPersonal';
const studentPersonalStore = useStudentPersonal();
const { isLoading, isSuccess, personal } = storeToRefs(studentPersonalStore);

const personalIsEdit = ref<boolean>(false);
const personalFormData = ref<IStudentPersonalInfo>({
    first_name: '',
    middle_name: '',
    last_name: '',
    gender: '',
    birthdate: '',
    fb_email: '',
    skype_id: ''
});

onMounted(async () => {
    await studentPersonalStore.loadStudentPersonalDetails();
    personalFormData.value = personal.value;
})

const updatePersonalDetails = async () => {
    await studentPersonalStore.updateStudentPersonalDetails(personalFormData.value);
    personalIsEdit.value = false;
}
</script>

<template>
    <div class="card card-default">
        <div v-if="isLoading" class="overlay dark">
            <i class="fas fa-3x fa-spinner fa-spin"></i>
        </div>
        <div class="card-body">
            <div class="profile-header">
                <h5 class="profile-header__title">Personal Details</h5>
                <div class="profile-header__actions">
                    <button v-if="!personalIsEdit" @click="personalIsEdit = true" class="btn btn-primary btn-xs">Edit</button>
                    <button v-if="personalIsEdit" @click="updatePersonalDetails" class="btn btn-success btn-xs mr-1">Save</button>
                    <button v-if="personalIsEdit" @click="personalIsEdit = false" class="btn btn-danger btn-xs">Cancel</button>
                </div>
            </div>
            <table class="table table-striped table-sm">
                <tbody>
                    <tr>
                        <td style="width: 40%">First name</td>
                        <td v-if="!personalIsEdit">{{ personal.first_name}}</td>
                        <td v-if="personalIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="personalFormData.first_name">
                        </td>
                    </tr>
                    <tr>
                        <td>Middle name</td>
                        <td v-if="!personalIsEdit">{{ personal.middle_name }}</td>
                        <td v-if="personalIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="personalFormData.middle_name">
                        </td>
                    </tr>
                    <tr>
                        <td>Last name</td>
                        <td v-if="!personalIsEdit">{{ personal.last_name }}</td>
                        <td v-if="personalIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="personalFormData.last_name">
                        </td>
                    </tr>
                    <tr>
                        <td>Birthdate</td>
                        <td v-if="!personalIsEdit">{{ personal.birthdate}}</td>
                        <td v-if="personalIsEdit">
                            <input type="date" class="form-control form-control-sm" v-model="personalFormData.birthdate">
                        </td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td v-if="!personalIsEdit">{{ personal.gender }}</td>
                        <td v-if="personalIsEdit">
                            <select v-model="personalFormData.gender" class="form-control form-control-sm">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Skype ID</td>
                        <td v-if="!personalIsEdit">{{ personal.skype_id }}</td>
                        <td v-if="personalIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="personalFormData.skype_id">
                        </td>
                    </tr>
                    <tr>
                        <td>Facebook URL</td>
                        <td v-if="!personalIsEdit">{{ personal.fb_email }}</td>
                        <td v-if="personalIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="personalFormData.fb_email">
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