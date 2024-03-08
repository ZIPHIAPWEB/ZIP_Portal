<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { storeToRefs } from 'pinia';

import PopUp from '../../../components/elements/PopUp.vue';
import SuperadminLayout from '../../../components/layouts/SuperadminLayout.vue';

import { ISuperadminDegree, useSuperadminDegreeStore } from '../../../store/superadminDegree';
const superadminDegreeStore = useSuperadminDegreeStore();
const { isLoading, isSuccess, degrees, links } = storeToRefs(superadminDegreeStore);

const isDegreeFormOpen = ref<boolean>(false);
const isDegreeForEdit = ref<boolean>(false);
const degreeForm = ref<ISuperadminDegree>({
    id: '',
    display_name: '',
    name: ''
})

onMounted(async () => {
    await superadminDegreeStore.loadSuperadminDegrees();
});

const openDegreeForm = (company? : ISuperadminDegree) => {
    isDegreeFormOpen.value = true;

    if (company) {

        degreeForm.value = {...company}

        isDegreeForEdit.value = true;

        return;
    }

    isDegreeForEdit.value = false;
}

const submitActionHandler = async () => {

    if (!isDegreeForEdit.value) {

        await superadminDegreeStore.storeSuperadminDegree(degreeForm.value);
    } else {

        await superadminDegreeStore.updateSuperadminDegree(degreeForm.value, degreeForm.value.id);
    }

    if (isSuccess.value) {

        isDegreeFormOpen.value = false;
    resetFormHandler();
    }
}

const closeHostCompanyFormHandler = () => {

    isDegreeFormOpen.value = false;
    resetFormHandler();
}

const resetFormHandler = () => {

    degreeForm.value.display_name = '';
    degreeForm.value.name = '';
    degreeForm.value.id = '';
}

</script>

<template>
    <SuperadminLayout>

        <Teleport to="body">
            <PopUp 
                @trigger-close-event="closeHostCompanyFormHandler()"
                @trigger-button-event="submitActionHandler"
                v-if="isDegreeFormOpen" 
                title="Degrees" 
                size="md"
                with-buttons
                :button-text="isDegreeForEdit ? 'Update degree' : 'Add degree'"
            >    
                <div class="row">
                    <div class="form-group col-12">
                        <label for="name">Name</label>
                        <input v-model="degreeForm.name" type="text" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="description">Display name</label>
                        <input v-model="degreeForm.display_name" type="text" class="form-control">
                    </div>
                </div>
            </PopUp>
        </Teleport>

        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <span><b>Degree</b></span>
                    <div class="card-tools">
                        <div>
                            <button @click="openDegreeForm()" class="btn btn-primary btn-xs">Add degree</button>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0" style="height: 75vh">
                    <table class="table table-head-fixed text-nowrap table-sm">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Date created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(degree, index) in degrees" :key="index">
                                <td>{{ degree.id }}</td>
                                <td>{{ degree.name }}</td>
                                <td>{{ degree.display_name }}</td>
                                <td>{{ degree.created_at }}</td>
                                <td>
                                    <button @click="openDegreeForm(degree)" class="btn btn-success btn-xs mr-1">Edit</button>
                                    <button @click="superadminDegreeStore.deleteSuperadminDegree(degree.id)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </SuperadminLayout>
</template>