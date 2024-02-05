<script setup lang="ts">
import { storeToRefs } from 'pinia';

import HostCompanyDetails from './HostCompanyCard.vue';
import VisaInterviewDetails from './VisaInterviewDetails.vue';
import PdosCfoDetailsCard from './PdosCfoDetailsCard.vue';
import FlightDetailsCard from './FlightDetailsCard.vue';

import { useCoordSelectedStudent } from '../../../../store/coordSelectedStudent';
const coordSelectedStudentStore = useCoordSelectedStudent();
const { userInfo } = storeToRefs(coordSelectedStudentStore);

</script>

<template>
    <div class="card card-default" :style="{ height : !(userInfo.application_status == 'New Applicant' || userInfo.application_status == 'Confirmed' || userInfo.application_status == 'Hired' || userInfo.application_status == 'Visa Status') ? '75vh' : 'max-content' }" style="overflow-y: auto; padding-right: 1px;">
        <div class="card-body p-0">
            <HostCompanyDetails :class="{ 'd-none' : (userInfo.application_status == 'New Applicant' || userInfo.application_status == 'Confirmed') }" />
            <VisaInterviewDetails :class="{ 'd-none' : (userInfo.application_status == 'New Applicant' || userInfo.application_status == 'Confirmed' || userInfo.application_status == 'Hired') }" />
            <PdosCfoDetailsCard :class="{ 'd-none' : (userInfo.application_status == 'New Applicant' || userInfo.application_status == 'Confirmed' || userInfo.application_status == 'Hired' || userInfo.application_status == 'Visa Status') }" />
            <FlightDetailsCard :class="{ 'd-none' : (userInfo.application_status == 'New Applicant' || userInfo.application_status == 'Confirmed' || userInfo.application_status == 'Hired' || userInfo.application_status == 'Visa Status') }" />
        </div>
    </div>
</template>