<script setup lang="ts">
import AdminLayout from '../../components/layouts/AdminLayout.vue';
import { useCoordStudent } from '../../store/coordStudents'

import { ref, onMounted } from 'vue';
import router from '../../router';
import { storeToRefs } from 'pinia';

const coordStudent = useCoordStudent();
const { students } = storeToRefs(coordStudent);

onMounted(async () => {
    await coordStudent.loadCoordStudentsData();
});

const viewStudent = (userId: number | string) => {

    router.push({
        name: "coordinator-student-profile",
        params: {
            id: userId
        }
    });
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
                                <input class="form-control" type="date">
                            </div>
    
                            <div class="input-group input-group-sm mr-2">
                                <label for="from-date" style="margin-right: 5px;">To date</label>
                                <input class="form-control" type="date">
                            </div>

                            <div class="input-group input-group-sm mr-2">
                                <label for="filter-statue" style="margin-right: 5px;">Filter by Status</label>
                                <select class="form-control">
                                    <option>Select</option>
                                    <option value="Hellow">Hellow</option>
                                </select>
                            </div>
                            <div class="input-group input-group-sm">
                                <button class="btn btn-primary btn-sm mr-1">Filter</button>
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
                                <td>
                                    <span class="badge bg-success">{{ student.application_status }}</span>
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
                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li>
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
</style>