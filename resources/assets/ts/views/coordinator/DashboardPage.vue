<script setup lang="ts">
import AdminLayout from '../../components/layouts/AdminLayout.vue';
import ProgramStatusStats from '../../components/elements/coordinator-page/ProgramStatusStats.vue';

import { ref, onMounted } from 'vue';
import CoordinatorApi from '../../services/CoordinatorApi';
import ProgramAPI from '../../services/ProgramAPI';
import { IProgramCategory } from '../../interfaces/IProgramCategory';
import { IProgram } from '../../interfaces/IProgram';

const stats = ref();
const statuses = ref();
const programs = ref<IProgram[]>([]);

onMounted(async () => {
    await loadPrograms();
    await loadStatistics();
})

const loadStatistics = async (program? : string) => {
    stats.value = (await CoordinatorApi.getCoordStudentsStats(program)).data.data;

    statuses.value = [
        { name: 'New Applicant', whole: stats.value.all, part: stats.value.new_applicant },
        { name: 'Assessed', whole: stats.value.all, part: stats.value.assessed },
        { name: 'Confirmed', whole: stats.value.all, part: stats.value.confirmed },
        { name: 'Hired', whole: stats.value.all, part: stats.value.hired },
        { name: 'Visa Status', whole: stats.value.all, part: stats.value.for_visa_interview },
        { name: 'For PDOS & CFO', whole: stats.value.all, part: stats.value.for_pdos_cfo },
        { name: 'Program Proper', whole: stats.value.all, part: stats.value.program_proper },
        { name: 'Program Compliance', whole: stats.value.all, part: stats.value.returned },
    ]
}

const loadPrograms = async () => {
    try {
        const response = await ProgramAPI.getPrograms();

        response.data.data.programs.forEach((p : IProgramCategory) => {

            p.programs.forEach(prog => {

                programs.value.push(prog);
            });
        });
    } catch (error: any) {
        console.log(error.response);
    }
};

const loadStatisticsHandler = async (event : Event) => {
    const target = event.target as HTMLSelectElement;
    
    await loadStatistics(target.value);
}

</script>

<template>
    <AdminLayout>
        <div class="pt-4 container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div class="card-tools">
                        <div style="width: 180px; display: flex; align-items: center;">
                            <b style="margin-right: 10px;">Filter</b>
                            <select @change="loadStatisticsHandler" class="form-control form-control-sm">
                                <option value="" selected>All</option>
                                <option v-for="(program, index) in programs" :key="index" :value="program.id">{{ program.display_name }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <ProgramStatusStats style="margin-top: 5px;" v-for="(status, index) in statuses" :key="index" :name="status.name" :whole="status.whole" :part="status.part" />
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>