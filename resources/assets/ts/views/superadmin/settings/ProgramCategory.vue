<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';

import SuperadminLayout from '../../../components/layouts/SuperadminLayout.vue';

import { useSuperadminProgramCategory } from '../../../store/superadminProgramCategory';
const superadminProgramCategory = useSuperadminProgramCategory();
const { programCategories, isLoading } = storeToRefs(superadminProgramCategory);

onMounted(async () => {

    await superadminProgramCategory.loadProgramCategories();
})

</script>

<template>
    <SuperadminLayout>
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <span><b>Program categories</b></span>
                    <div class="card-tools">
                        <div>
                            <button class="btn btn-primary btn-xs">Add program</button>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0" style="height: 75vh">
                    <table class="table table-head-fixed text-nowrap table-sm">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Display name</th>
                                <th>Description</th>
                                <th>Date created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(category, index) in programCategories" :key="index">
                                <td>{{ category.id }}</td>
                                <td>{{ category.name }}</td>
                                <td>{{ category.display_name }}</td>
                                <td>{{ category.description }}</td>
                                <td>{{ category.created_at }}</td>
                                <td>
                                    <button class="btn btn-success btn-xs mr-1">Edit</button>
                                    <button @click="superadminProgramCategory.deleteProgramCategory(category.id)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </SuperadminLayout>
</template>