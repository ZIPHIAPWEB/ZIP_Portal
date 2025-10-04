<script setup lang="ts">
import { ref, onMounted } from 'vue';

import PopUp from '../PopUp.vue';

import { useStudentPaymentRequirement, IPaymentRequirement, IStudentPaymentRequirementForm } from '../../../store/paymentRequirement';
import { storeToRefs } from 'pinia';

import AlertService from '../../../services/AlertService';

const studentPaymentRequirementStore = useStudentPaymentRequirement();
const { isLoading, isSuccess, requirements, errors } = storeToRefs(studentPaymentRequirementStore);

import { useAuthStore } from '../../../store/auth';
const authStore = useAuthStore();
const { auth } = storeToRefs(authStore);

const selectedRequirement = ref<IPaymentRequirement>();
const isPopUpOpen = ref(false);
const isDeletePopUpOpen = ref(false);
const requirement = ref<IStudentPaymentRequirementForm>({
    bank_code: '',
    reference_no: '',
    date_deposit: '',
    bank_account_no: '',
    amount: '',
    file: undefined
});

onMounted(async () => {
    const res = await studentPaymentRequirementStore.loadStudentPaymentRequirements();
    if (!res.success) {
        AlertService.error(res.message || 'Failed to load requirements');
    }
})

const submitRequirement = async () => {
    const res = await studentPaymentRequirementStore.storePaymentRequirement(selectedRequirement.value?.id, requirement.value);
    if (res.success) {
        isPopUpOpen.value = false;
        AlertService.success('Requirement uploaded successfully', 'Success');
    } else if (res.errors) {
        AlertService.validation(res.errors);
    } else {
        AlertService.error(res.message || 'Failed to upload requirement');
    }
}

const removeRequirement = async () => {
    const res = await studentPaymentRequirementStore.removePaymentRequirement(selectedRequirement.value?.id);
    isDeletePopUpOpen.value = false;
    if (res.success) {
        AlertService.success('Requirement removed', 'Success');
    } else {
        AlertService.error(res.message || 'Failed to remove requirement');
    }
}

const openRequirement = (requirement : IPaymentRequirement) => {
    selectedRequirement.value = requirement;
    isPopUpOpen.value = true;
}

const openDeletePopUp = (requirement : IPaymentRequirement) => {
    selectedRequirement.value = requirement;
    isDeletePopUpOpen.value = true;
}

const fileUploadHandler = (e : Event) => {
    let target = e.target as HTMLInputElement
    const files = target.files as FileList;

    requirement.value.file = files[0];
}

</script>

<template>
    <Teleport to="body">
        <PopUp v-if="isPopUpOpen" :title="selectedRequirement?.name" :with-close="false" size="md">
            <form @submit.prevent="submitRequirement">
                <div class="form-group">
                    <label>Bank name</label>
                    <input v-model="requirement.bank_code" type="text" class="form-control" :class="{ 'is-invalid' : 'bank_code' in errors }" placeholder="Enter bank name">
                </div>
                <div class="form-group">
                    <label>Reference No.</label>
                    <input v-model="requirement.reference_no" type="text" class="form-control" :class="{ 'is-invalid' : 'reference_no' in errors }" placeholder="Enter reference no.">
                </div>
                <div class="form-group">
                    <label>Date deposit</label>
                    <input v-model="requirement.date_deposit" type="date" class="form-control" :class="{ 'is-invalid' : 'date_deposit' in errors }" placeholder="Enter date deposit">
                </div>
                <div class="form-group">
                    <label>Bank account no.</label>
                    <input v-model="requirement.bank_account_no" type="text" class="form-control" :class="{ 'is-invalid' : 'bank_account_no' in errors }" placeholder="Enter bank account no.">
                </div>
                <div class="form-group">
                    <label>Amount</label>
                    <input v-model="requirement.amount" type="number" class="form-control" :class="{ 'is-invalid' : 'amount' in errors }" placeholder="Enter amount">
                </div>
                <div class="form-group">
                    <input @change="fileUploadHandler" type="file">
                </div>

                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button @click="isPopUpOpen = false" class="btn btn-danger ml-1">Cancel</button>
                </div>
            </form>
        </PopUp>

        <PopUp v-if="isDeletePopUpOpen" title="Delete file?" size="sm">
            <div style="width: 100%; display: flex; gap: 2px; justify-content: space-evenly;">
                <button @click="removeRequirement" class="btn btn-danger btn-sm">Delete!</button>
                <button @click="isDeletePopUpOpen = false" class="btn btn-primary btn-sm">Cancel</button>
            </div>
        </PopUp>
    </Teleport>

    <div class="card card-primary card-outline">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item mx-3">
                    <a class="nav-link active">Payments</a>
                </li>
            </ul>
        </div>
        <div class="card-body p-3">
            <table class="table table-striped table-sm">
                <thead>
                    <th>Requirements</th>
                    <th>Bank code</th>
                    <th>Reference No.</th>
                    <th>Date deposit</th>
                    <th>Bank account no.</th>
                    <th>Amount</th>
                    <th>Action</th>
                </thead>
                <tbody v-if="!isLoading && isSuccess && requirements.length > 0" >
                    <tr v-for="(requirement, index) in requirements" :key="index">
                        <td>{{ requirement.name }}</td>
                        <td>{{ requirement.student_payment?.bank_code }}</td>
                        <td>{{ requirement.student_payment?.reference_no }}</td>
                        <td>{{ requirement.student_payment?.date_deposit }}</td>
                        <td>{{ requirement.student_payment?.bank_account_no }}</td>
                        <td>{{ requirement.student_payment?.amount }}</td>
                        <td>
                            <button v-if="!requirement.student_payment && !(auth.application_status == 'Program Proper' || auth.application_status == 'Program Compliance')" @click="openRequirement(requirement)" class="btn btn-success btn-xs">Upload File</button>
                            <button v-if="requirement.student_payment && !(auth.application_status == 'Program Proper' || auth.application_status == 'Program Compliance')" @click="openDeletePopUp(requirement)" class="btn btn-danger btn-xs">Delete File</button>
                        </td>
                    </tr>
                </tbody>
                <tbody v-if="isLoading && !isSuccess">
                    <tr>
                        <td colspan="7" class="text-center">Loading...</td>
                    </tr>
                </tbody>
                <tbody v-if="!isLoading && isSuccess && requirements.length == 0">
                    <tr>
                        <td colspan="7" class="text-center">No requirements</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>