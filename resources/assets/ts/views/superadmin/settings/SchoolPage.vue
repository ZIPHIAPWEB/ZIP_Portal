<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';

import SuperadminLayout from '../../../components/layouts/SuperadminLayout.vue';
import PopUp from '../../../components/elements/PopUp.vue';

import { ISuperadminSchool, useSuperadminSchoolStore } from '../../../store/superadminSchool';
import AlertService from '../../../services/AlertService';
const superadminSchoolStore = useSuperadminSchoolStore();
const { isSuccess, schools } = storeToRefs(superadminSchoolStore);

const isSchoolFormOpen = ref<boolean>(false);
const isSchoolForEdit = ref<boolean>(false);
const schoolForm = ref<ISuperadminSchool>({
    description: '',
    display_name: '',
    name: '',
    id: ''
})

onMounted(async () => {

    await superadminSchoolStore.loadSuperadminSchools();
})

const openCategoryForm = async (school?: ISuperadminSchool) => {

    isSchoolFormOpen.value = true;

    if (school) {

        schoolForm.value = {...school}

        isSchoolForEdit.value = true;

        return;
    }

    isSchoolForEdit.value = false;
}

const submitActionHandler = async () => {

    if (!isSchoolForEdit.value) {
        const res = await superadminSchoolStore.storeSuperadminSchool(schoolForm.value);
        if (!res.success) {
            if (res.errors) await AlertService.validation(res.errors);
            else await AlertService.error(res.message || 'Failed to store school');
            return;
        }
    } else {
        const res = await superadminSchoolStore.updateSuperadminSchool(schoolForm.value, schoolForm.value.id);
        if (!res.success) {
            if (res.errors) await AlertService.validation(res.errors);
            else await AlertService.error(res.message || 'Failed to update school');
            return;
        }
    }

    if (isSuccess.value) {
        
        isSchoolFormOpen.value = false;
        resetFormHandler();
    }
}

const closeCategoryFormHandler = () => {

    isSchoolFormOpen.value = false; 
    resetFormHandler();
}

const resetFormHandler = () => {

    schoolForm.value.description = '';
    schoolForm.value.display_name = '';
    schoolForm.value.name = '';
    schoolForm.value.id = '';
}

const onDeleteSchool = async (id: string | number) => {
    const confirmed = await AlertService.confirm('Are you sure you want to delete this school?');
    if (!confirmed) return;

    const res = await superadminSchoolStore.deleteSuperadminSchool(id);
    if (!res.success) {
        if (res.errors) await AlertService.validation(res.errors);
        else await AlertService.error(res.message || 'Failed to delete school');
        return;
    }

    await AlertService.success('School deleted', 'Deleted');
}
</script>

<template>
    <SuperadminLayout>

        <Teleport to="body">
            <PopUp 
                @trigger-close-event="closeCategoryFormHandler()"
                @trigger-button-event="submitActionHandler"
                v-if="isSchoolFormOpen" 
                title="School" 
                size="md"
                with-buttons
                :button-text="isSchoolForEdit ? 'Update school' : 'Add school'"
            >    
                <div class="row">
                    <div class="form-group col-12">
                        <label for="name">Name</label>
                        <input v-model="schoolForm.name" type="text" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="display-name">Display name</label>
                        <input v-model="schoolForm.display_name" type="text" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="description">Description</label>
                        <input v-model="schoolForm.description" type="text" class="form-control">
                    </div>
                </div>
            </PopUp>
        </Teleport>

        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <span><b>Schools</b></span>
                    <div class="card-tools">
                        <div>
                            <button @click="openCategoryForm()" class="btn btn-primary btn-xs">Add school</button>
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
                            <tr v-for="(school, index) in schools" :key="index">
                                <td>{{ school.id }}</td>
                                <td>{{ school.name }}</td>
                                <td>{{ school.display_name }}</td>
                                <td>{{ school.description }}</td>
                                <td>{{ school.created_at }}</td>
                                <td>
                                    <button @click="openCategoryForm(school)" class="btn btn-success btn-xs mr-1">Edit</button>
                                    <button @click="onDeleteSchool(school.id)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </SuperadminLayout>
</template>