<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useCoordStudentPdosCfoInfo } from '../../../../store/coordStudentPdosCfoInfo';
import { storeToRefs } from 'pinia';
import { IStudentPdosCfoSchedule } from '../../../../store/studentPdosCfoSchedule';
import AlertService from '../../../../services/AlertService';

const coordStudentPdosCfoInfo = useCoordStudentPdosCfoInfo();
const { isLoading, pdosCfoSchedule } = storeToRefs(coordStudentPdosCfoInfo);

onMounted(async () => {
    const res = await coordStudentPdosCfoInfo.loadPdosCfoInfo();
    if (!res.success) AlertService.error(res.message || 'Failed to load PDOS/CFO info');
    pdosCfoForm.value = { ...pdosCfoSchedule.value };
});

const pdosCfoIsEdit = ref<boolean>(false);
const pdosCfoForm = ref<IStudentPdosCfoSchedule>({
    cfo_schedule: '',
    cfo_schedule_time: '',
    formatted_cfo_schedule: '',
    formatted_pdos_schedule: '',
    pdos_schedule: '',
    pdos_schedule_time: ''
})

const updatePdosCfoInfo = async () => {
    const res = await coordStudentPdosCfoInfo.updatePdosCfoInfo(pdosCfoForm.value);
    if (res.success) {
        pdosCfoIsEdit.value = false;
        AlertService.success('PDOS and CFO details updated!', 'Success');
    } else if (res.errors) {
        AlertService.validation(res.errors);
    } else {
        AlertService.error(res.message || 'Failed to update PDOS/CFO details');
    }
}
</script>

<template>
    <section id="pdos-cfo-details">
        <div class="ml-2 mt-2 mr-2" style="display: flex; justify-content:space-between;">
            <label class="control-label">PDOS & CFO details</label>
            <a v-if="!pdosCfoIsEdit" @click.prevent="pdosCfoIsEdit = true" href="#">Edit</a>
            <div v-if="pdosCfoIsEdit">
                <a @click.prevent="updatePdosCfoInfo" href="#" class="mr-1">Update</a>
                <a @click.prevent="pdosCfoIsEdit = false" href="#">Cancel</a>
            </div>
        </div>
        <table class="table table-striped table-bordered table-sm">
            <tbody>
                <tr>
                    <td style="width: 40%">PDOS Schedule</td>
                    <td v-if="!pdosCfoIsEdit">{{ pdosCfoSchedule.formatted_pdos_schedule }}</td>
                    <td v-if="pdosCfoIsEdit">
                        <input v-model="pdosCfoForm.pdos_schedule" type="date" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">PDOS Time</td>
                    <td v-if="!pdosCfoIsEdit">{{ pdosCfoSchedule.pdos_schedule_time }}</td>
                    <td v-if="pdosCfoIsEdit">
                        <input v-model="pdosCfoForm.pdos_schedule_time" type="text" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">CFO Schedule</td>
                    <td v-if="!pdosCfoIsEdit">{{ pdosCfoSchedule.formatted_cfo_schedule }}</td>
                    <td v-if="pdosCfoIsEdit">
                        <input v-model="pdosCfoForm.cfo_schedule" type="date" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">CFO Time</td>
                    <td v-if="!pdosCfoIsEdit">{{ pdosCfoSchedule.cfo_schedule_time }}</td>
                    <td v-if="pdosCfoIsEdit">
                        <input v-model="pdosCfoForm.cfo_schedule_time" type="text" class="form-control form-control-sm">
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</template>