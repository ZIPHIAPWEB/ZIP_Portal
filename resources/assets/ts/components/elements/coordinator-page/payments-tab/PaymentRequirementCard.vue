<script setup lang="ts">
import { onMounted } from 'vue';
import { useCoordStudentPaymentRequirement } from '../../../../store/coordStudentPaymentRequirement';
import { storeToRefs } from 'pinia';
const coordStudentPaymentRequirementStore = useCoordStudentPaymentRequirement();
const { isLoading, paymentRequirements } = storeToRefs(coordStudentPaymentRequirementStore);

onMounted(async () => {
    await coordStudentPaymentRequirementStore.loadSelectedStudentAdditionalRequirement();
})

</script>

<template>
    <div class="card card-default">
        <div class="card-body p-0">
            <table class="table table-striped table-bordered table-sm">
                <thead>
                    <tr>
                        <th >Requirement</th>
                        <th class="text-center">Bank code</th>
                        <th class="text-center">Ref No.</th>
                        <th class="text-center">Date deposit</th>
                        <th class="text-center">Bank account no</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Verified</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in paymentRequirements">
                        <td class="text-left">{{ item.name }}</td>
                        <td class="text-center">{{ item.student_payment?.bank_code }}</td>
                        <td class="text-center">{{ item.student_payment?.reference_no }}</td>
                        <td class="text-center">{{ item.student_payment?.date_deposit }}</td>
                        <td class="text-center">{{ item.student_payment?.bank_account_no }}</td>
                        <td class="text-center">{{ item.student_payment?.amount}}</td>
                        <td class="text-center">
                            <span v-if="!item.student_payment?.status" class="fa fa-times text-red"></span>
                            <span v-else class="fa fa-check text-success"></span>
                        </td>
                        <td class="text-center">
                            <span v-if="!item.student_payment?.acknowledgement" class="fa fa-times text-red"></span>
                            <span v-else class="fa fa-check text-success"></span>
                        </td>
                        <td class="text-center">
                            <span v-if="!item.student_payment">Not uploaded yet</span>
                            <button v-if="item.student_payment" class="btn btn-primary btn-xs mr-1">Download</button>
                            <button v-if="item.student_payment" class="btn btn-danger btn-xs mr-1">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>