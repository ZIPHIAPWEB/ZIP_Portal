<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';

import PopUp from '../../../components/elements/PopUp.vue';
import SuperadminLayout from '../../../components/layouts/SuperadminLayout.vue';

import { ISuperadminVisaSponsor, useSuperadminVisaSponsorStore } from '../../../store/superadminVisaSponsor';
const superadminVisaSponsorStore = useSuperadminVisaSponsorStore();
const { isLoading, isSuccess, sponsors } = storeToRefs(superadminVisaSponsorStore);

const isVisaSponsorFormOpen = ref<boolean>(false);
const isVisaSponsorForEdit = ref<boolean>(false);
const visaSponsorForm = ref<ISuperadminVisaSponsor>({
    description: '',
    display_name: '',
    name: '',
    id: ''
});

onMounted(async () => {

    await superadminVisaSponsorStore.loadSuperadminVisaSponsors();
});

const openVisaSponsorForm = (sponsor?: ISuperadminVisaSponsor) => {

    isVisaSponsorFormOpen.value = true;

    if (sponsor) {

        visaSponsorForm.value = {...sponsor}

        isVisaSponsorForEdit.value = true;

        return;
    }

    isVisaSponsorForEdit.value = false;
}

const submitActionHandler = async () => {

    if (!isVisaSponsorForEdit.value) {

        await superadminVisaSponsorStore.storeSuperadminVisaSponsor(visaSponsorForm.value);
    } else {

        await superadminVisaSponsorStore.updateSuperadminVisaSponsor(visaSponsorForm.value, visaSponsorForm.value.id);
    }

    if (isSuccess.value) {

        isVisaSponsorFormOpen.value = false;
        resetFormHandler();
    }
}

const closeVisaSponsorFormHandler = () => {
    
    isVisaSponsorFormOpen.value = false;
    resetFormHandler();
}

const resetFormHandler = () => {

    visaSponsorForm.value.description = '';
    visaSponsorForm.value.display_name = '';
    visaSponsorForm.value.name = '';
    visaSponsorForm.value.id = '';
}

</script>

<template>
    <SuperadminLayout>

        <Teleport to="body">
            <PopUp 
                @trigger-close-event="closeVisaSponsorFormHandler()"
                @trigger-button-event="submitActionHandler"
                v-if="isVisaSponsorFormOpen" 
                title="Visa sponsor" 
                size="md"
                with-buttons
                :button-text="isVisaSponsorForEdit ? 'Update sponsor' : 'Add sponsor'"
            >    
                <div class="row">
                    <div class="form-group col-12">
                        <label for="name">Name</label>
                        <input v-model="visaSponsorForm.name" type="text" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="display-name">Display name</label>
                        <input v-model="visaSponsorForm.display_name" type="text" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="description">Description</label>
                        <input v-model="visaSponsorForm.description" type="text" class="form-control">
                    </div>
                </div>
            </PopUp>
        </Teleport>

        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <span><b>Visa sponsors</b></span>
                    <div class="card-tools">
                        <div>
                            <button @click="openVisaSponsorForm()" class="btn btn-primary btn-xs">Add sponsor</button>
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
                            <tr v-for="(sponsor, index) in sponsors" :key="index">
                                <td>{{ sponsor.id }}</td>
                                <td>{{ sponsor.name }}</td>
                                <td>{{ sponsor.display_name }}</td>
                                <td>{{ sponsor.description }}</td>
                                <td>{{ sponsor.created_at }}</td>
                                <td>
                                    <button @click="openVisaSponsorForm(sponsor)" class="btn btn-success btn-xs mr-1">Edit</button>
                                    <button @click="superadminVisaSponsorStore.deleteSuperadminVisaSponsor(sponsor.id)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </SuperadminLayout>
</template>