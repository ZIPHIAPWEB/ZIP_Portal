<script setup lang="ts">
import { useStudentVisaSponsor } from '../../../../store/studentVisaSponsor';
import DetailsCard from '../../DetailsCard.vue';
import { storeToRefs } from 'pinia';

import { onMounted } from 'vue';

const studentVisaSponsorStore = useStudentVisaSponsor();
const { isLoading, isSuccess, visaSponsor } = storeToRefs(studentVisaSponsorStore);

onMounted(async () => {
    await studentVisaSponsorStore.loadStudentVisaSponsor();
})


</script>

<template>
    <DetailsCard title="Host Company">
        <table class="table table-striped table-sm">
            <tbody>
                <tr>
                    <td style="width: 40%">Visa Sponsor</td>
                    <td>{{ visaSponsor?.visa_sponsor }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Host Company</td>
                    <td>{{ visaSponsor?.host_company }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Housing Address</td>
                    <td>{{  visaSponsor?.housing_address }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Position</td>
                    <td>{{ visaSponsor?.position }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Stipend</td>
                    <td>{{ visaSponsor?.stipend }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">Start Date</td>
                    <td>{{ visaSponsor?.start_date }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">End Date</td>
                    <td>{{ visaSponsor?.end_date }}</td>
                </tr>
            </tbody>
        </table>
    </DetailsCard>
</template>