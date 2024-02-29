<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';

import PopUp from '../../../components/elements/PopUp.vue';
import SuperadminLayout from '../../../components/layouts/SuperadminLayout.vue';

import { ISuperadminHostCompany, useSuperadminHostCompanyStore } from '../../../store/superadminHosCompany';
const superadminHostCompanyStore = useSuperadminHostCompanyStore();
const { isLoading, isSuccess, hostCompanies } = storeToRefs(superadminHostCompanyStore);

const isHostCompanyFormOpen = ref<boolean>(false);
const isHostCompanyForEdit = ref<boolean>(false);
const hostCompanyForm = ref<ISuperadminHostCompany>({
    id: '',
    description: '',
    name: ''
})

onMounted(async () => {
    await superadminHostCompanyStore.loadSuperadminHostCompanies();
});

const openHostCompanyForm = (company? : ISuperadminHostCompany) => {
    isHostCompanyFormOpen.value = true;

    if (company) {

        hostCompanyForm.value = {...company}

        isHostCompanyForEdit.value = true;

        return;
    }

    isHostCompanyForEdit.value = false;
}

const submitActionHandler = async () => {

    if (!isHostCompanyForEdit.value) {

        await superadminHostCompanyStore.storeSuperadminHostCompany(hostCompanyForm.value);
    } else {

        await superadminHostCompanyStore.updateSuperadminHostCompany(hostCompanyForm.value, hostCompanyForm.value.id);
    }

    if (isSuccess.value) {

    isHostCompanyFormOpen.value = false;
    resetFormHandler();
    }
}

const closeHostCompanyFormHandler = () => {

    isHostCompanyFormOpen.value = false;
    resetFormHandler();
}

const resetFormHandler = () => {

    hostCompanyForm.value.description = '';
    hostCompanyForm.value.name = '';
    hostCompanyForm.value.id = '';
}

</script>

<template>
    <SuperadminLayout>

        <Teleport to="body">
            <PopUp 
                @trigger-close-event="closeHostCompanyFormHandler()"
                @trigger-button-event="submitActionHandler"
                v-if="isHostCompanyFormOpen" 
                title="Host company" 
                size="md"
                with-buttons
                :button-text="isHostCompanyForEdit ? 'Update company' : 'Add company'"
            >    
                <div class="row">
                    <div class="form-group col-12">
                        <label for="name">Name</label>
                        <input v-model="hostCompanyForm.name" type="text" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="description">Description</label>
                        <input v-model="hostCompanyForm.description" type="text" class="form-control">
                    </div>
                </div>
            </PopUp>
        </Teleport>

        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <span><b>Host companies</b></span>
                    <div class="card-tools">
                        <div>
                            <button @click="openHostCompanyForm()" class="btn btn-primary btn-xs">Add host company</button>
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
                            <tr v-for="(company, index) in hostCompanies" :key="index">
                                <td>{{ company.id }}</td>
                                <td>{{ company.name }}</td>
                                <td>{{ company.description }}</td>
                                <td>{{ company.created_at }}</td>
                                <td>
                                    <button @click="openHostCompanyForm(company)" class="btn btn-success btn-xs mr-1">Edit</button>
                                    <button @click="superadminHostCompanyStore.deleteSuperadmonHostCompany(company.id)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </SuperadminLayout>
</template>