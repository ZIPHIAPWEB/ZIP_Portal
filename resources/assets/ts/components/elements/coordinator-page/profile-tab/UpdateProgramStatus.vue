<script setup lang="ts">
import { defineProps } from 'vue';

const props = defineProps({
    status: {
        type: String,
        required: true
    }
});

import { useCoordSelectedStudent } from '../../../../store/coordSelectedStudent';
const useCoordStudent = useCoordSelectedStudent();

const updateApplicationStatus = async () => {
    let nextStatus = "";

    if (props.status == 'New Applicant') {

        nextStatus = 'Assessed';
    }

    if (props.status == 'Assessed') {

        nextStatus = 'Confirmed';
    }

    if (props.status == 'Confirmed') {

        nextStatus = 'Hired';
    }

    if (props.status == 'Hired') {

        nextStatus = 'For Visa Interview';
    }

    if (props.status == 'For Visa Interview') {

        nextStatus = 'For PDOS & CFO';
    }

    if (props.status == 'For PDOS & CFO') {
     
        nextStatus = 'Program Proper';
    }

    if (props.status == 'Program Proper') {

        nextStatus = 'Returnee';
    }

    if (props.status == 'Cancel') {

    }

    if (nextStatus == "") {
        return;
    }

    if (confirm(`Tag student to ${nextStatus}`)) {

        await useCoordStudent.updateProgramStatus(nextStatus);
    }
}

</script>

<template>
    <div style="display: flex; justify-content: space-between;">
        <b>{{ props.status }}</b>
        <a @click.prevent="updateApplicationStatus" href="#" style="font-style: normal; font-weight: normal;">Progress to next step</a>
    </div>
</template>