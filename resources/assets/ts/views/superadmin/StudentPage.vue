<script setup lang="ts">
import SuperadminLayout from '../../components/layouts/SuperadminLayout.vue';
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';

import { useSuperadminStudent } from '../../store/superadminStudents';
const superadminStudentStore = useSuperadminStudent();
const { isLoading, isSuccess, students } = storeToRefs(superadminStudentStore);

const toBeSearch = ref<string>('');

onMounted(async () => {
    await superadminStudentStore.loadSuperadminStudentsData();
});

const searchStudentData = async () => {

    await superadminStudentStore.searchSuperaminStudentData(toBeSearch.value);
}

</script>

<template>
    <SuperadminLayout>
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header" style="display: flex; flex-direction: row; justify-content: space-between">
                    <div style="flex: 1"><b>Students</b></div>
                    <div class="input-group input-group-sm" style="width: 200px;">
                        <input v-model="toBeSearch" type="text" name="table_search" class="form-control float-right" placeholder="Search by username">
                
                        <div class="input-group-append">
                          <button @click="searchStudentData()" type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0" style="height: 75vh">
                    <table class="table table-head-fixed text-nowrap table-sm">
                        <thead>
                            <tr>
                                <th>UserId</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Is Verified</th>
                                <th class="text-center">Is Filled</th>
                                <th class="text-center">Registered At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(student, index) in students" :key="index">
                                <td>{{ student.user_id }}</td>
                                <td class="text-center">{{ student.username }}</td>
                                <td class="text-center">{{ student.email }}</td>
                                <td class="text-center">
                                    <i v-if="student.is_verified" class="fas fa-check text-green"></i>
                                    <i v-if="!student.is_verified" class="fas fa-times text-red"></i>
                                </td>
                                <td class="text-center">
                                    <i v-if="student.is_filled" class="fas fa-check text-green"></i>
                                    <i v-if="!student.is_filled" class="fas fa-times text-red"></i>
                                </td>
                                <td class="text-center">{{ student.registered_at }}</td>
                                <td class="text-center">
                                    <button @click="superadminStudentStore.verifyStudent(student.user_id)" v-if="!student.is_verified" class="btn btn-primary btn-xs mr-1">Verify</button>
                                    <button @click="superadminStudentStore.unverifyStudent(student.user_id)" v-if="student.is_verified" class="btn btn-primary btn-xs mr-1">Unverify</button>
                                    <button @click="superadminStudentStore.deleteSuperadminStudent(student.user_id)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </SuperadminLayout>
</template>