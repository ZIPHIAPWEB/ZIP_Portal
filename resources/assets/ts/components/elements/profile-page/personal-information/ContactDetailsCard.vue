<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';

import { useStudentContactStore, IStudentContactInfo } from '../../../../store/studentContact';
const studentContactStore = useStudentContactStore();
const { isLoading, isSuccess, contact } = storeToRefs(studentContactStore);

const contactIsEdit = ref<boolean>(false);
const contactFormData = ref<IStudentContactInfo>({
    permanent_address: '',
    provincial_address: '',
    home_number: '',
    mobile_number: ''
});

onMounted(async () => {
    await studentContactStore.loadStudentContactDetails();
    contactFormData.value = contact.value;
})

const updateContactDetails = async () => {
    await studentContactStore.updateStudentContactDetails(contactFormData.value);
    contactIsEdit.value = false;
};
</script>

<template>
    <div class="card card-default">
        <div v-if="isLoading" class="overlay dark">
            <i class="fas fa-3x fa-spinner fa-spin"></i>
        </div>
        <div class="card-body">
            <div class="profile-header">
                <h5 class="profile-header__title">Contact Details</h5>
                <div class="profile-header__actions">
                    <button v-if="!contactIsEdit" @click="contactIsEdit = true" class="btn btn-primary btn-xs">Edit</button>
                    <button v-if="contactIsEdit" @click="updateContactDetails" class="btn btn-success btn-xs mr-1">Save</button>
                    <button v-if="contactIsEdit" @click="contactIsEdit = false" class="btn btn-danger btn-xs">Cancel</button>
                </div>
            </div>
            <table class="table table-sm table-striped">
                <tbody>
                    <tr>
                        <td style="width: 40%">Present Address</td>
                        <td v-if="!contactIsEdit">{{ contact.provincial_address }}</td>
                        <td v-if="contactIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="contactFormData.provincial_address">
                        </td>
                    </tr>
                    <tr>
                        <td>Permanent Address</td>
                        <td v-if="!contactIsEdit">{{ contact.permanent_address}}</td>
                        <td v-if="contactIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="contactFormData.permanent_address">
                        </td>
                    </tr>
                    <tr>
                        <td>Home number</td>
                        <td v-if="!contactIsEdit">{{ contact.home_number }}</td>
                        <td v-if="contactIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="contactFormData.home_number">
                        </td>
                    </tr>
                    <tr>
                        <td>Mobile number</td>
                        <td v-if="!contactIsEdit">{{ contact.mobile_number }}</td>
                        <td v-if="contactIsEdit">
                            <input type="text" class="form-control form-control-sm" v-model="contactFormData.mobile_number">
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