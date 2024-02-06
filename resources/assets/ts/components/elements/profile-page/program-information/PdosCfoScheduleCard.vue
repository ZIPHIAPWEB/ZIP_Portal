<script setup lang="ts">
import DetailsCard from '../../DetailsCard.vue';

import { storeToRefs } from 'pinia';
import { useStudentPdosCfoSchedule } from '../../../../store/studentPdosCfoSchedule';
import { onMounted } from 'vue';

const studentPdosCfoScheduleStore = useStudentPdosCfoSchedule();
const { isLoading, isSuccess, schedule } = storeToRefs(studentPdosCfoScheduleStore)

onMounted(async () => {
    await studentPdosCfoScheduleStore.loadStudentPdosCfoSchedule();
})

</script>

<template>
    <DetailsCard title="PDOS & CFO Schedule">
        <table class="table table-striped table-sm">
            <tbody>
                <tr>
                    <td style="width: 40%">PDOS Schedule</td>
                    <td>{{ schedule?.pdos_schedule }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">PDOS Time</td>
                    <td>{{ schedule?.pdos_schedule_time }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">CFO Schedule</td>
                    <td>{{ schedule?.cfo_schedule }}</td>
                </tr>
                <tr>
                    <td style="width: 40%">CFO Time</td>
                    <td>{{ schedule?.cfo_schedule_time }}</td>
                </tr>
            </tbody>
        </table>
    </DetailsCard>
</template>