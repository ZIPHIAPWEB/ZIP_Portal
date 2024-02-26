<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';

import SuperadminLayout from '../../../components/layouts/SuperadminLayout.vue';
import PopUp from '../../../components/elements/PopUp.vue';

import { ISuperadminProgramCategory, useSuperadminProgramCategory } from '../../../store/superadminProgramCategory';
const superadminProgramCategory = useSuperadminProgramCategory();
const { programCategories, isLoading, isSuccess } = storeToRefs(superadminProgramCategory);

const isCategoryFormOpen = ref<boolean>(false);
const isCategoryForEdit = ref<boolean>(false);
const categoryForm = ref<ISuperadminProgramCategory>({
    description: '',
    display_name: '',
    name: '',
    id: ''
})

onMounted(async () => {

    await superadminProgramCategory.loadProgramCategories();
})

const openCategoryForm = async (category?: ISuperadminProgramCategory) => {

    isCategoryFormOpen.value = true;

    if (category) {

        categoryForm.value = {...category}

        isCategoryForEdit.value = true;

        return;
    }

    isCategoryForEdit.value = false;
}

const submitActionHandler = async () => {

    if (!isCategoryForEdit.value) {

        await superadminProgramCategory.storeProgramCategory(categoryForm.value);
    } else {

        await superadminProgramCategory.updateProgramCategory(categoryForm.value, categoryForm.value.id);
    }

    if (isSuccess.value) {
        
        isCategoryFormOpen.value = false;
        resetFormHandler();
    }
}

const closeCategoryFormHandler = () => {
    
    isCategoryFormOpen.value = false; 
    resetFormHandler();
}

const resetFormHandler = () => {

    categoryForm.value.description = '';
    categoryForm.value.display_name = '';
    categoryForm.value.name = '';
    categoryForm.value.id = '';
}

</script>

<template>
    <SuperadminLayout>

        <Teleport to="body">
            <PopUp 
                @trigger-close-event="closeCategoryFormHandler()"
                @trigger-button-event="submitActionHandler"
                v-if="isCategoryFormOpen" 
                title="Program category" 
                size="md"
                with-buttons
                :button-text="isCategoryForEdit ? 'Update category' : 'Add category'"
            >    
                <div class="row">
                    <div class="form-group col-12">
                        <label for="name">Name</label>
                        <input v-model="categoryForm.name" type="text" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="display-name">Display name</label>
                        <input v-model="categoryForm.display_name" type="text" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="description">Description</label>
                        <input v-model="categoryForm.description" type="text" class="form-control">
                    </div>
                </div>
            </PopUp>
        </Teleport>

        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <span><b>Program categories</b></span>
                    <div class="card-tools">
                        <div>
                            <button @click="openCategoryForm()" class="btn btn-primary btn-xs">Add category</button>
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
                                    <button @click="openCategoryForm(category)" class="btn btn-success btn-xs mr-1">Edit</button>
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