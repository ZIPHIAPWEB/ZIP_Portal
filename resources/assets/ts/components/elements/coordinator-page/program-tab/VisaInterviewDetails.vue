<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useCoordStudentInterviewInfo } from '../../../../store/coordStudentInterviewInfo';
import { storeToRefs } from 'pinia';
import { IVisaInterview } from '../../../../store/studentVisaInterview';
import { useCoordSelectedStudent } from '../../../../store/coordSelectedStudent';

const coordStudentInterviewInfoStore = useCoordStudentInterviewInfo();
const { isLoading, visaInterview } = storeToRefs(coordStudentInterviewInfoStore);

const coordSelectedStudentStore = useCoordSelectedStudent();
const { userInfo } = storeToRefs(coordSelectedStudentStore);

const visaInterviewIsEdit = ref<boolean>(false);
const visaInterviewForm = ref<IVisaInterview>({
    visa_interview_status: '',
    program_id_number: '',
    sevis_id: '',
    trial_interview_schedule: '',
    formatted_trial_interview_schedule: '',
    trial_interview_time: '',
    visa_interview_schedule: '',
    formatted_visa_interview_schedule: '',
    visa_interview_time: ''
})

onMounted(async () => {
    await coordStudentInterviewInfoStore.loadCoordStudentInterviewInfo();
    visaInterviewForm.value = {...visaInterview.value};
})

const updateVisaInterviewDetails = async () => {
    await coordStudentInterviewInfoStore.updateCoordStudentInterviewInfo(visaInterviewForm.value)
    visaInterviewIsEdit.value = false;
    alert('Interview info updated!');
}

</script>

<template>
    <section id="visa-interview-details">
        <div class="ml-2 mt-2 mr-2" style="display: flex; justify-content:space-between;">
            <label class="control-label">Visa interview details</label>
            <a v-if="!visaInterviewIsEdit" @click.prevent="visaInterviewIsEdit = true" href="#">Edit</a>
            <div v-if="visaInterviewIsEdit">
                <a @click.prevent="updateVisaInterviewDetails" href="#" class="mr-1">Update</a>
                <a @click.prevent="visaInterviewIsEdit = false" href="#">Cancel</a>
            </div>
        </div>
        <table class="table table-striped table-bordered table-sm">
            <tbody>
                <tr>
                    <td style="width: 40%">Visa Interview Status</td>
                    <td v-if="!visaInterviewIsEdit">{{ visaInterview.visa_interview_status }}</td>
                    <td v-if="visaInterviewIsEdit">
                        <select v-model="visaInterviewForm.visa_interview_status" class="form-control form-control-sm">
                            <option>{{ visaInterview.visa_interview_status }}</option>
                            <option value="approved">Approved</option>
                            <option value="denied">Denied</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Program ID Number</td>
                    <td v-if="!visaInterviewIsEdit">{{ visaInterview.program_id_number }}</td>
                    <td v-if="visaInterviewIsEdit">
                        <input v-model="visaInterviewForm.program_id_number" type="text" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">SEVIS ID</td>
                    <td v-if="!visaInterviewIsEdit">{{ visaInterview.sevis_id }}</td>
                    <td v-if="visaInterviewIsEdit">
                        <input v-model="visaInterviewForm.sevis_id" type="text" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Visa Interview Schedule</td>
                    <td v-if="!visaInterviewIsEdit">{{ visaInterview.formatted_visa_interview_schedule }}</td>
                    <td v-if="visaInterviewIsEdit">
                        <input v-model="visaInterviewForm.visa_interview_schedule" type="date" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Visa Interview Time</td>
                    <td v-if="!visaInterviewIsEdit">{{ visaInterview.visa_interview_time }}</td>
                    <td v-if="visaInterviewIsEdit">
                        <input v-model="visaInterviewForm.visa_interview_time" type="text" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr v-if="userInfo.program != 'Internship Program' && userInfo.program != 'Career Training'">
                    <td style="width: 40%">Trial Interview Schedule</td>
                    <td v-if="!visaInterviewIsEdit">{{ visaInterview.formatted_trial_interview_schedule }}</td>
                    <td v-if="visaInterviewIsEdit">
                        <input v-model="visaInterviewForm.trial_interview_schedule" type="date" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr v-if="userInfo.program != 'Internship Program' && userInfo.program != 'Career Training'">
                    <td style="width: 40%">Trial Interview Time</td>
                    <td v-if="!visaInterviewIsEdit">{{ visaInterview.trial_interview_time }}</td>
                    <td v-if="visaInterviewIsEdit">
                        <input v-model="visaInterviewForm.trial_interview_time" type="text" class="form-control form-control-sm">
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</template>