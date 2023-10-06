<script setup lang="ts">
import AdminLayout from '../../components/layouts/AdminLayout.vue';
import { useCoordStudent } from '../../store/coordStudents'

import { ref, onMounted } from 'vue';
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
                                    <option selected>Select</option>
                                    <option value="New Applicant">New Applicant</option>
                                    <option value="Confirmed">Confirmed</option>
                                </select>
                            </div>
                            <div class="input-group input-group-sm">
                                <button @click="filterResult()" class="btn btn-primary btn-sm mr-1">Filter</button>
                                <button class="btn btn-success btn-sm">Export</button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
        
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                              </button>
                            </div>
                          </div>
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
                        <tbody>
                            <tr v-for="student in students">
                                <td>{{ student.date_of_application }}</td>
                                <td class="text-white">
                                    <span v-if="student.application_status == 'New Applicant'" class="badge bg-new-applicant">{{ student.application_status }}</span>
                                    <span v-if="student.application_status == 'Confirmed'" class="badge bg-confirmed">{{ student.application_status }}</span>
                                    <span v-if="student.application_status == 'Assessed'" class="badge bg-assessed">{{ student.application_status }}</span>
                                    <span v-if="student.application_status == 'Hired'" class="badge bg-hired">{{ student.application_status }}</span>

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
                                    <a href="#" @click.prevent="viewStudent(1)">View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-if="true" class="card-footer clearfix p-1">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li v-for="link in pagination" class="page-item">
                            <a @click.prevent="paginatedResult(+link.label)" v-if="link.active" class="page-link" href="#" v-html="link.label"></a>
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

    .bg-visa-denied {
        background: rgb(185, 32, 37);
    }

    .bg-cancelled {
        background: rgb(185, 32, 37);
    }
</style>