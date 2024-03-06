<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';

import SuperadminLayout from '../../../components/layouts/SuperadminLayout.vue';
import PopUp from '../../../components/elements/PopUp.vue';
import UploadButton from '../../../components/elements/profile-page/program-requirements/UploadButton.vue';

import { ISuperadminAdditionalRequirement, useSuperadminAdditionalRequirementStore } from '../../../store/superadminAdditionalRequirement';
const superadminAdditionalRequirementStore = useSuperadminAdditionalRequirementStore();
const { additionals, isLoading, isSuccess, links } = storeToRefs(superadminAdditionalRequirementStore);

import { useSuperadminProgram } from '../../../store/superadminProgram';
const superadminProgramStore = useSuperadminProgram();
const { programs } = storeToRefs(superadminProgramStore);

const isAdditionalReqFormOpen = ref<boolean>(false);
const isAdditionalForEdit = ref<boolean>(false);
const additionalForm = ref<ISuperadminAdditionalRequirement>({
    id: '',
    description: '',
    is_active: false,
    name: '',
    program_id: ''
})

onMounted(async () => {
    await superadminAdditionalRequirementStore.loadSuperadminAdditionalRequirements();
    await superadminProgramStore.loadSuperadminPrograms();
})

const openPrelimRequirementForm = (prelim?: ISuperadminAdditionalRequirement) => {

    isAdditionalReqFormOpen.value = true;

    if (prelim) {

        additionalForm.value = {...prelim}

        isAdditionalForEdit.value = true;

        return;
    }

    isAdditionalForEdit.value = false;
}

const submitActionHandler = async () => {

    if (!isAdditionalForEdit.value) {

        await superadminAdditionalRequirementStore.storeSuperadminAdditionalRequirement(additionalForm.value);
    } else {

        await superadminAdditionalRequirementStore.updateSuperadminAdditionalRequirement(additionalForm.value, additionalForm.value.id);
    }

    if (isSuccess.value) {

        isAdditionalReqFormOpen.value = false;
        resetFormHandler();
    }
}

const closePrelimRequirementFormHandler = () => {

    isAdditionalReqFormOpen.value = false;
    resetFormHandler();
}


const resetFormHandler = () => {
    additionalForm.value.description = '';
    additionalForm.value.is_active = false;
    additionalForm.value.program_id = '';
    additionalForm.value.name = '';
    additionalForm.value.id = '';
}


const uploadFileHander = async (file: File, requirementId : string | number | undefined) => {

    await superadminAdditionalRequirementStore.uploadSuperadminAdditionalRequirementFile(file, requirementId);
}
</script>

<template>
    <SuperadminLayout>

        <Teleport to="body">
            <PopUp 
                @trigger-close-event="closePrelimRequirementFormHandler()"
                @trigger-button-event="submitActionHandler"
                v-if="isAdditionalReqFormOpen" 
                title="Additional requirement" 
                size="md"
                with-buttons
                :button-text="isAdditionalForEdit ? 'Update requirement' : 'Add requirement'"
            >    
                <div class="row">
                    <div class="form-group col-12">
                        <label for="name">Name</label>
                        <input v-model="additionalForm.name" type="text" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="description">Description</label>
                        <input v-model="additionalForm.description" type="text" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="description">Program</label>
                        <select v-model="additionalForm.program_id" class="form-control">
                            <option value="">Select program</option>
                            <option v-for="(program, index) in programs" :key="index" :value="program.id">{{ program.display_name }}</option>
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label for="description">Is Active?</label>
                        <select v-model="additionalForm.is_active" class="form-control">
                            <option value="">Select</option>
                            <option value="true">Yes</option>
                            <option value="false">No</option>
                        </select>
                    </div>
                </div>
            </PopUp>
        </Teleport>

        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <span><b>Additional Requirements</b></span>
                    <div class="card-tools">
                        <div>
                            <button @click="openPrelimRequirementForm()" class="btn btn-primary btn-xs">Add requirement</button>
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
                                <th>Program</th>
                                <th>Active?</th>
                                <th>Date created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(req, index) in additionals" :key="index">
                                <td>{{ req.id }}</td>
                                <td>{{ req.name }}</td>
                                <td>{{ req.description }}</td>
                                <td>{{ req.program }}</td>
                                <td>
                                    <i v-if="req.is_active" class="fas fa-check text-green"></i>
                                    <i v-if="!req.is_active" class="fas fa-times text-red"></i>
                                </td>
                                <td>{{ req.created_at }}</td>
                                <td>
                                    <UploadButton v-if="(req.path == '' || req.path == null)" :requirementId="req.id" @getFile="uploadFileHander" />
                                    <button v-if="!(req.path == '' || req.path == null)" @click="superadminAdditionalRequirementStore.removeSuperadminAdditionalRequirementFile(req.id)" class="btn btn-default btn-xs mr-1">Remove file</button>
                                    <button @click="openPrelimRequirementForm(req)" class="btn btn-success btn-xs mr-1">Edit</button>
                                    <button @click="superadminAdditionalRequirementStore.deleteSuperadminAdditionalRequriement(req.id)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </SuperadminLayout>
</template>