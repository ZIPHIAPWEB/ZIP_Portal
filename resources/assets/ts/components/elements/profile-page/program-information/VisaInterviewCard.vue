<script setup lang="ts">
import DetailsCard from '../../DetailsCard.vue';
import { storeToRefs } from 'pinia';
import { useStudentVisaInterview } from '../../../../store/studentVisaInterview';
import { onMounted } from 'vue';
import { useAuthStore } from '../../../../store/auth';

const studentVisaInterviewStore = useStudentVisaInterview();
const { isLoading, isSuccess, visaInterview } = storeToRefs(studentVisaInterviewStore);

const authStore = useAuthStore();
const { auth } = storeToRefs(authStore);

onMounted(async () => {
    await studentVisaInterviewStore.loadVisaInterview();
});

</script>

<template>
    <DetailsCard title="Visa Interview Details">
        <table class="table table-striped table-sm">
            <tbody>
                <tr>
                    <td style="width: 40%">Visa Interview Status</td>
                    <td>
                        <b>{{ visaInterview?.visa_interview_status }}</b>
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Program ID Number</td>
                    <td>{{ visaInterview?.program_id_number }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">SEVIS ID</td>
                    <td>{{ visaInterview?.sevis_id }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Visa Interview Schedule</td>
                    <td>{{ visaInterview?.visa_interview_schedule }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Visa Interview Time</td>
                    <td>{{ visaInterview?.visa_interview_time }}</td>
                </tr>
                <tr v-if="auth.program != 'Internship Program' && auth.program != 'Career Training'">
                    <td style="width: 40%">Trial Interview Schedule</td>
                    <td>{{ visaInterview?.trial_interview_schedule }}</td>
                </tr>
                <tr v-if="auth.program != 'Internship Program' && auth.program != 'Career Training'">
                    <td style="width: 40%">Trial Interview Time</td>
                    <td>{{ visaInterview?.trial_interview_time }}</td>
                </tr>
            </tbody>
        </table>
    </DetailsCard>
</template>