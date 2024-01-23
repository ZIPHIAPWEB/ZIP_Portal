<script setup lang="ts">
import SuperadminLayout from '../../components/layouts/SuperadminLayout.vue';
import PopUp from '../../components/elements/PopUp.vue';
import CoordRegistrationForm from '../../components/elements/superamin-page/CoordRegistrationForm.vue';

import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';

import { useSuperadminCoord } from '../../store/superadminCoords';
const superadminCoordsStore = useSuperadminCoord();
const { isLoading, isSuccess, coordinators } = storeToRefs(superadminCoordsStore);

const isAddCoordFormOpen = ref<boolean>(false);

onMounted(async () => {
    await superadminCoordsStore.loadSuperadminCoordsData();
});

</script>

<template>
    <SuperadminLayout>
        <Teleport to="body">
            <PopUp @trigger-close-event="isAddCoordFormOpen = false" v-if="isAddCoordFormOpen" title="Coordinator form" size="lg">
                <CoordRegistrationForm @submit-success-event="isAddCoordFormOpen = false" />
            </PopUp>
        </Teleport>

        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <span><b>Coordinators</b></span>
                    <div class="card-tools">
                        <div>
                            <button @click="isAddCoordFormOpen = true" class="btn btn-primary btn-sm">Add coordinator</button>
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
                                <th class="text-center">First name</th>
                                <th class="text-center">Middle name</th>
                                <th class="text-center">Last name</th>
                                <th class="text-center">Position</th>
                                <th class="text-center">Program</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Registered At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(coordinator, index) in coordinators" :key="index">
                                <td>{{ coordinator.user_id }}</td>
                                <td class="text-center">{{ coordinator.username }}</td>
                                <td class="text-center">{{ coordinator.email }}</td>
                                <td class="text-center">{{ coordinator.first_name }}</td>
                                <td class="text-center">{{ coordinator.middle_name }}</td>
                                <td class="text-center">{{ coordinator.last_name }}</td>
                                <td class="text-center">{{ coordinator.position }}</td>
                                <td class="text-center">{{ coordinator.program }}</td>
                                <td class="text-center">
                                    <i v-if="coordinator.is_activated" class="fas fa-check text-green"></i>
                                    <i v-if="!coordinator.is_activated" class="fas fa-times text-red"></i>
                                </td>
                                <td class="text-center">{{ coordinator.registered_at }}</td>
                                <td class="text-center">
                                    <button @click="superadminCoordsStore.activateCoordUser(coordinator.user_id)" v-if="!coordinator.is_activated" class="btn btn-primary btn-xs mr-1">Activate</button>
                                    <button @click="superadminCoordsStore.deactivateCoordUser(coordinator.user_id)" v-if="coordinator.is_activated" class="btn btn-primary btn-xs mr-1">Deactivate</button>
                                    <button @click="superadminCoordsStore.deleteSuperadminCoord(coordinator.id)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </SuperadminLayout>
</template>