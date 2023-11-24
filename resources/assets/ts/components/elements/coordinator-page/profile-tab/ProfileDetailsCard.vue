<script setup lang="ts">
import UpdateProgramModal from './UpdateProgramModal.vue';
import UpdateProgramStatus from './UpdateProgramStatus.vue';
import CancelProgramModal from './CancelProgramModal.vue';

import { ref, onMounted, Teleport } from 'vue';

import { useRoute } from 'vue-router';
const route = useRoute();

import { useCoordSelectedStudent } from '../../../../store/coordSelectedStudent';
import { storeToRefs } from 'pinia';
import PopUp from '../../PopUp.vue';

const useCoordStudent = useCoordSelectedStudent();
const { 
    isLoading,
    userInfo,
    personal, 
    contact,
    father,
    mother,
    tertiary,
    secondary,
    experiences
} = storeToRefs(useCoordStudent);

const isProgramEditOpen = ref<boolean>(false);
const isCancelOpen = ref<boolean>(false);

const editProgramToggle = () => {
    isProgramEditOpen.value = !isProgramEditOpen.value;
}

const setStatusToCancelled = () => {
    isCancelOpen.value = !isCancelOpen.value;
}
</script>

<template>
    <Teleport to="body">
        <PopUp v-if="isProgramEditOpen" title="Update program" size="md">
            <UpdateProgramModal
                @updatedEvent="isProgramEditOpen = false"
                @cancelEvent="isProgramEditOpen = false"
            />
        </PopUp>

        <PopUp v-if="isCancelOpen" @trigger-close-event="isCancelOpen = false" title="Cancel program" size="md">
            <CancelProgramModal
                @submitEventTrigger="isCancelOpen = false"
            />
        </PopUp>
    </Teleport>
    <div class="card card-default">
        <div class="card-body p-0">
            <table class="table table-striped table-bordered table-sm" style="margin-bottom: 20px;">
                <tbody>
                    <tr>
                        <td>Application status</td>
                        <td>
                            <UpdateProgramStatus 
                                :status="userInfo.application_status" 
                                @cancelEventTrigger="setStatusToCancelled"
                            />
                        </td>
                    </tr>
                    <tr v-if="userInfo.application_status == 'New Applicant' || userInfo.application_status == 'Assessed'">
                        <td>
                            <span>Program</span>
                        </td>
                        <td>
                            <div style="display: flex; justify-content: space-between;">
                                <b>{{ userInfo.program }}</b>
                                <a v-if="!isProgramEditOpen" @click.prevent="editProgramToggle()" href="#" style="font-style: normal; font-weight: normal;">Edit</a>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="!(userInfo.application_status == 'New Applicant' || userInfo.application_status == 'Assessed')">
                        <td>Applicaton ID</td>
                        <td>{{ userInfo.application_id }}</td>
                    </tr>
                </tbody>
            </table>

            <section id="personal-section">
                <label class="control-label ml-2">Personal details</label>
                <table class="table table-striped table-bordered table-sm">
                    <tbody>
                        <tr>
                            <td style="width: 30%">
                                <span>Full name</span>
                            </td>
                            <td>
                                {{ `${personal.first_name} ${personal.middle_name} ${personal.last_name}` }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Birth date</span>
                            </td>
                            <td>
                                {{ personal.birthdate }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Gender</span>
                            </td>
                            <td>
                                {{  personal.gender }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Present address</span>
                            </td>
                            <td>
                                {{ contact.permanent_address }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Permanent address</span>
                            </td>
                            <td>
                                {{ contact.provincial_address }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Home number</span>
                            </td>
                            <td>
                                {{ contact.home_number }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Mobile number</span>
                            </td>
                            <td>
                                {{ contact.mobile_number }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Email</span>
                            </td>
                            <td>
                                {{ userInfo.email }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Skype ID</span>
                            </td>
                            <td>
                                {{ personal.skype_id }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Facebook URL</span>
                            </td>
                            <td>
                                {{ personal.fb_email }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <section id="family-section">
                <label class="control-label ml-2">Family details</label>
                <table class="table table-striped table-bordered table-sm mb-4">
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <span>Father</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>First name</span>
                            </td>
                            <td>
                                {{ father.first_name }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Middle name</span>
                            </td>
                            <td>
                                {{ father.middle_name }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Last name</span>
                            </td>
                            <td>
                                {{ father.last_name }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Occupation</span>
                            </td>
                            <td>
                                {{ father.occupation }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Company</span>
                            </td>
                            <td>
                                {{ father.company }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Contact no.</span>
                            </td>
                            <td>
                                {{ father.contact_no }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-striped table-bordered table-sm">
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <span>Mother</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>First name</span>
                            </td>
                            <td>
                                {{ mother.first_name }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Middle name</span>
                            </td>
                            <td>
                                {{ mother.middle_name }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Last name</span>
                            </td>
                            <td>
                                {{ mother.last_name }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Occupation</span>
                            </td>
                            <td>
                                {{ mother.occupation }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Company</span>
                            </td>
                            <td>
                                {{ mother.company }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%">
                                <span>Contact no.</span>
                            </td>
                            <td>
                                {{ mother.contact_no }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <section id="education-section">
                <label  class="control-label ml-2">Educational background</label>

                <table class="table table-striped table-bordered table-sm mb-4">
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <b>Tertiary</b>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">
                                <span>School</span>
                            </td>
                            <td>{{ tertiary.school }}</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">
                                <span>Address</span>
                            </td>
                            <td>{{ tertiary.address }}</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">
                                <span>Degree</span>
                            </td>
                            <td>{{ tertiary.degree }}</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">
                                <span>Start date</span>
                            </td>
                            <td>{{ tertiary.start_date }}</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">
                                <span>Date graduated</span>
                            </td>
                            <td>{{ tertiary.date_graduated }}</td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-striped table-bordered table-sm mb-4">
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <b>Secondary</b>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">
                                <span>School</span>
                            </td>
                            <td>{{ secondary.school }}</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">
                                <span>Address</span>
                            </td>
                            <td>{{ secondary.address }}</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">
                                <span>Date graduated</span>
                            </td>
                            <td>{{ secondary.date_graduated }}</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <section id="education-section" style="margin-bottom: 10px;">
                <label  class="control-label ml-2">Work Experience/On-the-Job Training</label>

                <table v-for="(exp, index) in experiences" :key="index" class="table table-striped table-bordered table-sm mb-4">
                    <tbody>
                        <tr>
                            <td>
                                <span>Company</span>
                            </td>
                            <td>{{ exp.company }}</td>
                        </tr>
                        <tr>
                            <td >
                                <span>Address</span>
                            </td>
                            <td>{{ exp.address }}</td>
                        </tr>
                        <tr>
                            <td >
                                <span>Description</span>
                            </td>
                            <td>{{ exp.description }}</td>
                        </tr>
                        <tr>
                            <td>
                                <span>Start date</span>
                            </td>
                            <td>{{ exp.start_date }}</td>
                        </tr>
                        <tr>
                            <td>
                                <span>End date</span>
                            </td>
                            <td>{{ exp.end_date }}</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</template>

<style scoped>
    table tr td:nth-child(1) {
        width: 30%;
    }

    table tr td:nth-child(2) {
        font-weight: bold;
    }
</style>