<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';

import { useStudentTertiaryStore, IStudentTertiary } from '../../../../store/studentTertiary';
import SchoolAPI from '../../../../services/SchoolAPI';
import { SchoolType } from '../../../../types/SchoolType';
import DegreeAPI from '../../../../services/DegreeAPI';
import { DegreeType } from '../../../../types/DegreeType';

const studentTertiaryStore = useStudentTertiaryStore();
const { isLoading, isSuccess, tertiary } = storeToRefs(studentTertiaryStore)
import AlertService from '../../../../services/AlertService';

import { useAuthStore } from '../../../../store/auth';
const authStore = useAuthStore();
const { auth } = storeToRefs(authStore);

const schools = ref<SchoolType[]>([]);
const degrees = ref<DegreeType[]>([]);
const tertiaryIsEdit = ref<boolean>(false);
const tertiaryFormData = ref<IStudentTertiary>({
    school: '',
    address: '',
    degree: '',
    start_date: '',
    date_graduated: '',
    school_id: ''
});

onMounted(async () => {
    const res = await studentTertiaryStore.loadStudentTertiaryDetails();
    if (!res.success) {
        await AlertService.error(res.message || 'Failed to load tertiary details');
        return;
    }

    await loadSchool();
    await loadDegree();
    tertiaryFormData.value = {...tertiary.value};
})

const loadSchool = async () => {
    try {
        const response = await SchoolAPI.getSchools();
        schools.value = response.data;
    } catch (error: any) {
        console.log(error);
    }
}

const loadDegree = async () => {
    try {
        const response = await DegreeAPI.getDegrees();
        degrees.value = response.data;
    } catch (error: any) {
        console.log(error);
    }
}

const updateTertiaryDetails = async () => {
    tertiaryFormData.value.school = ''+schools.value.find((school: SchoolType) => school.id === tertiaryFormData.value.school_id)?.name;

    const res = await studentTertiaryStore.updateStudentTertiaryDetails(tertiaryFormData.value);
    if (res.success) {
        tertiaryIsEdit.value = false;
        await AlertService.success('Tertiary details updated successfully.');
    } else {
        if (res.errors) await AlertService.validation(res.errors);
        else await AlertService.error(res.message || 'Failed to update tertiary details');
    }
}
</script>

<template>
    <div class="card card-default">
        <div v-if="isLoading" class="overlay dark">
            <i class="fas fa-3x fa-spinner fa-spin"></i>
        </div>
        <div class="card-body">
            <div class="profile-header">
                <h5 class="profile-header__title">Tertiary</h5>
                <div class="profile-header__actions">
                    <button v-if="!tertiaryIsEdit && !(auth.application_status == 'Program Proper' || auth.application_status == 'Program Compliance')" @click="tertiaryIsEdit = true" class="btn btn-primary btn-xs">Edit</button>
                    <button v-if="tertiaryIsEdit" @click="updateTertiaryDetails" class="btn btn-success btn-xs mr-1">Save</button>
                    <button v-if="tertiaryIsEdit" @click="tertiaryIsEdit = false" class="btn btn-danger btn-xs">Cancel</button>
                </div>
            </div>
            <table class="table table-striped table-sm">
                <tbody>
                    <tr>
                        <td style="width: 40%">School</td>
                        <td v-if="!tertiaryIsEdit">{{ tertiary.school }}</td>
                        <td v-if="tertiaryIsEdit">
                            <select class="form-control form-control-sm" v-model="tertiaryFormData.school_id">
                                <option selected>{{ tertiaryFormData.school }}</option>
                                <option v-for="(school, index) in schools" :key="index" :value="school.id">{{ school.name }}</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td v-if="!tertiaryIsEdit">{{ tertiary.address }}</td>
                        <td v-if="tertiaryIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="tertiaryFormData.address">
                        </td>
                    </tr>
                    <tr>
                        <td>Degree</td>
                        <td v-if="!tertiaryIsEdit">{{ tertiary.degree }}</td>
                        <td v-if="tertiaryIsEdit">
                            <select class="form-control form-control-sm" v-model="tertiaryFormData.degree">
                                <option :value="tertiaryFormData.degree">{{ tertiaryFormData.degree }}</option>
                                <option v-for="(degree, index) in degrees" :key="index" :value="degree.display_name">{{ degree.display_name }}</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Start date</td>
                        <td v-if="!tertiaryIsEdit">{{ tertiary.start_date }}</td>
                        <td v-if="tertiaryIsEdit">
                            <input type="date" class="form-control form-control-sm" v-model="tertiaryFormData.start_date">
                        </td>
                    </tr>
                    <tr>
                        <td>Date Graduated (expected)</td>
                        <td v-if="!tertiaryIsEdit">{{ tertiary.date_graduated }}</td>
                        <td v-if="tertiaryIsEdit">
                            <input type="date" class="form-control form-control-sm" v-model="tertiaryFormData.date_graduated">
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