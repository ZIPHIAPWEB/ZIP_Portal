<script setup lang="ts">
import { ref, onMounted } from 'vue';

import PopUp from '../PopUp.vue';

import { useStudentPaymentRequirement, IPaymentRequirement, IStudentPaymentRequirement } from '../../../store/paymentRequirement';
import { storeToRefs } from 'pinia';

const studentPaymentRequirementStore = useStudentPaymentRequirement();
const { isLoading, isSuccess, requirements } = storeToRefs(studentPaymentRequirementStore);

const selectedRequirement = ref<IPaymentRequirement>();
const isPopUpOpen = ref(false);
const isDeletePopUpOpen = ref(false);
const requirement = ref<IStudentPaymentRequirement>({
    bank_code: '',
    reference_no: '',
    date_deposit: '',
    bank_account_no: '',
    amount: '',
    file_path: ''
});

onMounted(async () => {
    await studentPaymentRequirementStore.loadStudentPaymentRequirements();
})

const submitRequirement = async () => {
    await studentPaymentRequirementStore.storePaymentRequirement(selectedRequirement.value?.id, requirement.value);
    isPopUpOpen.value = false;
    alert('Requirement submitted!');
}

const removeRequirement = async () => {
    await studentPaymentRequirementStore.removePaymentRequirement(selectedRequirement.value?.id);
    isDeletePopUpOpen.value = false;
    alert('Requirement removed!');
}

const openRequirement = (requirement : IPaymentRequirement) => {
    selectedRequirement.value = requirement;
    isPopUpOpen.value = true;
}

const openDeletePopUp = (requirement : IPaymentRequirement) => {
    selectedRequirement.value = requirement;
    isDeletePopUpOpen.value = true;
}

</script>

<template>
    <Teleport to="body">
        <PopUp v-if="isPopUpOpen" :title="selectedRequirement?.name" size="md">
            <form @submit.prevent="submitRequirement">
                <div class="form-group">
                    <label>Bank code</label>
                    <input v-model="requirement.bank_code" type="text" class="form-control" placeholder="Enter bank code">
                </div>
                <div class="form-group">
                    <label>Reference No.</label>
                    <input v-model="requirement.reference_no" type="text" class="form-control" placeholder="Enter reference no.">
                </div>
                <div class="form-group">
                    <label>Date deposit</label>
                    <input v-model="requirement.date_deposit" type="date" class="form-control" placeholder="Enter date deposit">
                </div>
                <div class="form-group">
                    <label>Bank account no.</label>
                    <input v-model="requirement.bank_account_no" type="text" class="form-control" placeholder="Enter bank account no.">
                </div>
                <div class="form-group">
                    <label>Amount</label>
                    <input v-model="requirement.amount" type="number" class="form-control" placeholder="Enter amount">
                </div>
                <div class="form-group">
                    <input type="file">
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
        <div v-if="isLoading && !isSuccess" class="overlay dark">
            <i class="fas fa-3x fa-spinner fa-spin"></i>
        </div>
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
                <tbody>
                    <tr v-for="(requirement, index) in requirements" :key="index">
                        <td>{{ requirement.name }}</td>
                        <td>{{ requirement.student_payment?.bank_code }}</td>
                        <td>{{ requirement.student_payment?.reference_no }}</td>
                        <td>{{ requirement.student_payment?.date_deposit }}</td>
                        <td>{{ requirement.student_payment?.bank_account_no }}</td>
                        <td>{{ requirement.student_payment?.amount }}</td>
                        <td>
                            <button v-if="!requirement.student_payment" @click="openRequirement(requirement)" class="btn btn-success btn-xs">Upload File</button>
                            <button v-else @click="openDeletePopUp(requirement)" class="btn btn-danger btn-xs">Delete File</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>