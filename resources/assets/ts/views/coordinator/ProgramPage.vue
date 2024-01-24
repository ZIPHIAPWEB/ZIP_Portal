<script setup lang="ts">
import AdminLayout from '../../components/layouts/AdminLayout.vue';
import SearchStudent from '../../components/elements/coordinator-page/SearchStudent.vue';

import { useCoordStudent } from '../../store/coordStudents'
import CoordinatorApi from '../../services/CoordinatorApi';

import { ref, onMounted, watch } from 'vue';
import router from '../../router';
import { useRoute } from 'vue-router';
import { storeToRefs } from 'pinia';

const coordStudent = useCoordStudent();
const { students, pagination, isLoading } = storeToRefs(coordStudent);

const route = useRoute();

const program = ref<string | string[]>('');
const fromDate = ref<string>('');
const toDate = ref<string>('');
const status = ref<string>('');

onMounted(async () => {
    program.value = route.params.name;
    await coordStudent.loadCoordStudentsData(program.value);
});

watch(() => route.path, async () => {

    program.value = route.params.name;
    await coordStudent.loadCoordStudentsData(program.value);
})

const viewStudent = (userId: number | string) => {

    router.push({
        name: "coordinator-student-profile",
        params: {
            id: userId
        }
    });
}

const filterResult = async () => {

    await coordStudent.filterCoordStudentsData(program.value, fromDate.value, toDate.value, status.value);
}

const paginatedResult = async (page : number) => {

    await coordStudent.loadPaginatedStudentsData(page, program.value, fromDate.value, toDate.value, status.value);
}

const exportStudentDatas = async () => {
    let filename = (await CoordinatorApi.downloadExportedData(program.value, status.value, fromDate.value, toDate.value)).data;
    let url = `https://prototype.ziptravel.com.ph/download-exported/${filename}`;
    const link = document.createElement('a')
    link.href = url;
    link.setAttribute('download', 'title');
    document.body.appendChild(link);
    link.click();
}

</script>

<template>
    <AdminLayout :title="$route.params.name">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header" style="display: flex; flex-direction: row; justify-content: space-between">
                    <div style="flex: 1;">
                        <div style="width: max-content; display:flex; flex-direction: row;">
                            <div class="input-group input-group-sm mr-2">
                                <label for="from-date" style="margin-right: 5px;">From date</label>
                                <input v-model="fromDate" class="form-control" type="date">
                            </div>
    
                            <div class="input-group input-group-sm mr-2">
                                <label for="from-date" style="margin-right: 5px;">To date</label>
                                <input v-model="toDate" class="form-control" type="date">
                            </div>

                            <div class="input-group input-group-sm mr-2">
                                <label for="filter-statue" style="margin-right: 5px;">Filter by Status</label>
                                <select v-model="status" class="form-control">
                                    <option value="" selected>All</option>
                                    <option value="New Applicant">New Applicant</option>
                                    <option value="Assessed">Assessed</option>
                                    <option value="Confirmed">Confirmed</option>
                                    <option value="Hired">Hired</option>
                                    <option value="For Visa Interview">For Visa Interview</option>
                                    <option value="For PDOS %26 CFO">For PDOS & CFO</option>
                                    <option value="Program Proper">Program Proper</option>
                                    <option value="Returned">Returned</option>
                                </select>
                            </div>
                            <div class="input-group input-group-sm">
                                <button @click="filterResult()" class="btn btn-primary btn-sm mr-1">Filter</button>
                                <button @click="exportStudentDatas()" class="btn btn-success btn-sm">Export</button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <SearchStudent :program="program" />
                    </div>
                </div>
                <div class="card-body table-responsive p-0" style="height: 75vh">
                    <table class="table table-head-fixed text-nowrap table-sm">
                        <thead>
                            <tr>
                                <th>Date of Application</th>
                                <th>Status</th>
                                <th>Email</th>
                                <th>First name</th>
                                <th>Middle name</th>
                                <th>Last name</th>
                                <th>Contact</th>
                                <th>School</th>
                                <th>Program</th>
                                <th>Recent Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody v-if="isLoading">
                            <tr>
                                <td colspan="11" class="text-center">Loading...</td>
                            </tr>
                        </tbody>
                        <tbody v-if="!isLoading && students.length == 0">
                            <tr>
                                <td colspan="11" class="text-center">No record found</td>
                            </tr>
                        </tbody>
                        <tbody v-if="!isLoading && students.length > 0">
                            <tr v-for="student in students">
                                <td>{{ student.date_of_application }}</td>
                                <td class="text-white">
                                    <span v-if="student.application_status == 'New Applicant'" class="badge bg-new-applicant">{{ student.application_status }}</span>
                                    <span v-if="student.application_status == 'Confirmed'" class="badge bg-confirmed">{{ student.application_status }}</span>
                                    <span v-if="student.application_status == 'Assessed'" class="badge bg-assessed">{{ student.application_status }}</span>
                                    <span v-if="student.application_status == 'Hired'" class="badge bg-hired">{{ student.application_status }}</span>
                                    <span v-if="student.application_status == 'For Visa Interview'" class="badge bg-visa-interview">{{ student.application_status }}</span>
                                    <span v-if="student.application_status == 'For PDOS & CFO'" class="badge bg-pdos-cfo">{{ student.application_status }}</span>
                                    <span v-if="student.application_status == 'Program Proper'" class="badge bg-program-proper">{{ student.application_status }}</span>
                                    <span v-if="student.application_status == 'Program Compliance'" class="badge bg-program-compliance">{{ student.application_status }}</span>
                                    <span v-if="student.application_status.includes('Cancel')" class="badge bg-visa-denied">{{ student.application_status }}</span>
                                </td>
                                <td>{{ student.email }}</td>
                                <td>{{ student.first_name }}</td>
                                <td>{{ student.middle_name }}</td>
                                <td>{{ student.last_name }}</td>
                                <td>{{ student.contact_no }}</td>
                                <td>{{ student.school }}</td>
                                <td>{{ student.program }}</td>
                                <td>{{ student.recent_action }}</td>
                                <td>
                                    <a href="#" @click.prevent="viewStudent(student.id)">View</a>
                                </td>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
                <div v-if="students.length > 0 && !isLoading" class="card-footer clearfix p-1">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li v-for="link in pagination" class="page-item" :class="{ 'disabled' : link.active }">
                            <a @click.prevent="paginatedResult(+link.label)" class="page-link" href="#" v-html="link.label"></a>
                        </li>
                      </ul>
                </div>
            </div>
        </div>
    </AdminLayout>    
</template>

<style scoped>
    tbody > * {
        font-size: 14px;
    }

    label {
        margin: 0;
    }

    .bg-new-applicant {
        background: rgb(236, 176, 33);
    }

    .bg-confirmed {
        background: rgb(189, 61, 38);
    }

    .bg-assessed {
        background: rgb(210, 91, 39);
    }

    .bg-hired {
        background: rgb(37, 110, 182);
    }

    .bg-visa-interview {
        background: rgb(23, 66, 117);
    }

    .bg-pdos-cfo {
        background: rgb(21, 51, 92);
    }

    .bg-program-proper {
        background: rgb(17, 133, 66);
    }

    .bg-program-compliance {
        background: rgb(228, 255, 27);
        color: black;
    }

    .bg-visa-denied {
        background: rgb(185, 32, 37);
    }

    .bg-cancelled {
        background: rgb(185, 32, 37);
    }
</style>