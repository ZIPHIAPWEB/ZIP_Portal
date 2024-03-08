<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';

import SuperadminLayout from '../../../components/layouts/SuperadminLayout.vue';
import PopUp from '../../../components/elements/PopUp.vue';

import { ISuperadminPaymentRequirement, useSuperadminPaymentRequirementStore } from '../../../store/superadminPaymentRequirement';
const superadminPaymentRequirementStore = useSuperadminPaymentRequirementStore();
const { paymentReqs, isLoading, isSuccess, links } = storeToRefs(superadminPaymentRequirementStore);

import { useSuperadminProgram } from '../../../store/superadminProgram';
const superadminProgramStore = useSuperadminProgram();
const { programs } = storeToRefs(superadminProgramStore);

const isPaymentReqFormOpen = ref<boolean>(false);
const isPaymentForEdit = ref<boolean>(false);
const paymentForm = ref<ISuperadminPaymentRequirement>({
    id: '',
    description: '',
    is_active: false,
    name: '',
    program_id: ''
})

onMounted(async () => {
    await superadminPaymentRequirementStore.loadSuperadminPaymentRequirements();
    await superadminProgramStore.loadSuperadminPrograms();
})

const openPaymentRequirementForm = (payment?: ISuperadminPaymentRequirement) => {

    isPaymentReqFormOpen.value = true;

    if (payment) {

        paymentForm.value = {...payment}

        isPaymentForEdit.value = true;

        return;
    }

    isPaymentForEdit.value = false;
}

const submitActionHandler = async () => {

    if (!isPaymentForEdit.value) {

        await superadminPaymentRequirementStore.storeSuperadminPaymentRequirement(paymentForm.value);
    } else {

        await superadminPaymentRequirementStore.updateSuperadminPaymentRequirement(paymentForm.value, paymentForm.value.id);
    }

    if (isSuccess.value) {

        isPaymentReqFormOpen.value = false;
        resetFormHandler();
    }
}

const closePaymentRequirementFormHandler = () => {

    isPaymentReqFormOpen.value = false;
    resetFormHandler();
}


const resetFormHandler = () => {
    paymentForm.value.description = '';
    paymentForm.value.is_active = false;
    paymentForm.value.program_id = '';
    paymentForm.value.name = '';
    paymentForm.value.id = '';
}

</script>

<template>
    <SuperadminLayout>

        <Teleport to="body">
            <PopUp 
                @trigger-close-event="closePaymentRequirementFormHandler()"
                @trigger-button-event="submitActionHandler"
                v-if="isPaymentReqFormOpen" 
                title="Payment requirement" 
                size="md"
                with-buttons
                :button-text="isPaymentForEdit ? 'Update requirement' : 'Add requirement'"
            >    
                <div class="row">
                    <div class="form-group col-12">
                        <label for="name">Name</label>
                        <input v-model="paymentForm.name" type="text" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="description">Description</label>
                        <input v-model="paymentForm.description" type="text" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="description">Program</label>
                        <select v-model="paymentForm.program_id" class="form-control">
                            <option value="">Select program</option>
                            <option v-for="(program, index) in programs" :key="index" :value="program.id">{{ program.display_name }}</option>
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label for="description">Is Active?</label>
                        <select v-model="paymentForm.is_active" class="form-control">
                            <option value="">Select</option>
                            <option value="true">Yes</option>
                            <option value="false">No</option>
                        </select>
                    </div>
                </div>
            </PopUp>
        </Teleport>

        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <span><b>Payment Requirements</b></span>
                    <div class="card-tools">
                        <div>
                            <button @click="openPaymentRequirementForm()" class="btn btn-primary btn-xs">Add requirement</button>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0" style="height: 75vh">
                    <table class="table table-head-fixed text-nowrap table-sm">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Program</th>
                                <th>Active?</th>
                                <th>Date created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(req, index) in paymentReqs" :key="index">
                                <td>{{ req.id }}</td>
                                <td>{{ req.name }}</td>
                                <td>{{ req.description }}</td>
                                <td>{{ req.program }}</td>
                                <td>
                                    <i v-if="req.is_active" class="fas fa-check text-green"></i>
                                    <i v-if="!req.is_active" class="fas fa-times text-red"></i>
                                </td>
                                <td>{{ req.created_at }}</td>
                                <td>
                                    <button @click="openPaymentRequirementForm(req)" class="btn btn-success btn-xs mr-1">Edit</button>
                                    <button @click="superadminPaymentRequirementStore.deleteSuperadminPaymentRequirement(req.id)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </SuperadminLayout>
</template>