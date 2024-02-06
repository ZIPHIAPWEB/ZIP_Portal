<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';

import SuperadminLayout from '../../../components/layouts/SuperadminLayout.vue';
import PopUp from '../../../components/elements/PopUp.vue';

import { useSuperadminProgram } from '../../../store/superadminProgram';
const superadminProgramStore = useSuperadminProgram();
const { programs, links, isLoading } = storeToRefs(superadminProgramStore);

onMounted(async () => {
    await superadminProgramStore.loadSuperadminPrograms();
})

const openProgramForm = ref<boolean>(false);

</script>

<template>
    <SuperadminLayout>

        <Teleport to="body">
            <PopUp @trigger-close-event="openProgramForm = false" v-if="openProgramForm" title="Program" size="md">
                
            </PopUp>
        </Teleport>

        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <span><b>Programs</b></span>
                    <div class="card-tools">
                        <div>
                            <button @click="openProgramForm = true" class="btn btn-primary btn-xs">Add program</button>
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
                                <th>Category</th>
                                <th>Date created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(program, index) in programs" :key="index">
                                <td>{{ program.id }}</td>
                                <td>{{ program.name }}</td>
                                <td>{{ program.display_name }}</td>
                                <td>{{ program.description }}</td>
                                <td>{{ program.category }}</td>
                                <td>{{ program.date_created }}</td>
                                <td>
                                    <button class="btn btn-success btn-xs mr-1">Edit</button>
                                    <button @click="superadminProgramStore.deleteSuperadminProgram(program.id)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </SuperadminLayout>
</template>