<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';

import SuperadminLayout from '../../../components/layouts/SuperadminLayout.vue';
import PopUp from '../../../components/elements/PopUp.vue';
import UploadButton from '../../../components/elements/profile-page/program-requirements/UploadButton.vue';

import { ISuperadminPrelimRequirement, useSuperadminPrelimRequirementStore } from '../../../store/superadminPrelimRequirement';
import AlertService from '../../../services/AlertService';
const superadminPrelimRequirementStore = useSuperadminPrelimRequirementStore();
const { prelims, error, isLoading, isSuccess, links } = storeToRefs(superadminPrelimRequirementStore);

import { useSuperadminProgram } from '../../../store/superadminProgram';
const superadminProgramStore = useSuperadminProgram();
const { programs } = storeToRefs(superadminProgramStore);

const isPrelimReqFormOpen = ref<boolean>(false);
const isPrelimForEdit = ref<boolean>(false);
const prelimForm = ref<ISuperadminPrelimRequirement>({
    id: '',
    description: '',
    is_active: false,
    name: '',
    program_id: ''
})

onMounted(async () => {
    await superadminPrelimRequirementStore.loadSuperadminPrelimRequirements();
    await superadminProgramStore.loadSuperadminPrograms();
})

const openPrelimRequirementForm = (prelim?: ISuperadminPrelimRequirement) => {

    isPrelimReqFormOpen.value = true;

    if (prelim) {

        prelimForm.value = {...prelim}

        isPrelimForEdit.value = true;

        return;
    }

    isPrelimForEdit.value = false;
}

const submitActionHandler = async () => {

    if (!isPrelimForEdit.value) {
        const res = await superadminPrelimRequirementStore.storeSuperadminPrelimRequirement(prelimForm.value);
        if (!res.success) {
            if (res.errors) await AlertService.validation(res.errors);
            else await AlertService.error(res.message || 'Failed to store requirement');
            return;
        }
    } else {
        const res = await superadminPrelimRequirementStore.updateSuperadminPrelimRequirement(prelimForm.value, prelimForm.value.id);
        if (!res.success) {
            if (res.errors) await AlertService.validation(res.errors);
            else await AlertService.error(res.message || 'Failed to update requirement');
            return;
        }
    }

    if (isSuccess.value) {

        isPrelimReqFormOpen.value = false;
        resetFormHandler();
    }
}

const closePrelimRequirementFormHandler = () => {

    isPrelimReqFormOpen.value = false;
    resetFormHandler();
}


const resetFormHandler = () => {
    prelimForm.value.description = '';
    prelimForm.value.is_active = false;
    prelimForm.value.program_id = '';
    prelimForm.value.name = '';
    prelimForm.value.id = '';
}


const uploadFileHander = async (file: File, requirementId : string | number | undefined) => {
    const res = await superadminPrelimRequirementStore.uploadSuperadminPrelimRequirementFile(file, requirementId);
    if (!res.success) {
        if (res.errors) await AlertService.validation(res.errors);
        else await AlertService.error(res.message || 'Failed to upload file');
        return;
    }

    await AlertService.success('File uploaded', 'Uploaded');
}

const onRemoveFile = async (id: string | number) => {
    const res = await superadminPrelimRequirementStore.removeSuperadminPrelimRequirementFile(id);
    if (!res.success) {
        if (res.errors) await AlertService.validation(res.errors);
        else await AlertService.error(res.message || 'Failed to remove file');
        return;
    }

    await AlertService.success('File removed', 'Removed');
}

const onDeletePrelim = async (id: string | number) => {
    const confirmed = await AlertService.confirm('Are you sure you want to delete this requirement?');
    if (!confirmed) return;

    const res = await superadminPrelimRequirementStore.deleteSuperadminPrelimRequirement(id);
    if (!res.success) {
        if (res.errors) await AlertService.validation(res.errors);
        else await AlertService.error(res.message || 'Failed to delete requirement');
        return;
    }

    await AlertService.success('Requirement deleted', 'Deleted');
}

</script>

<template>
    <SuperadminLayout>

        <Teleport to="body">
            <PopUp 
                @trigger-close-event="closePrelimRequirementFormHandler()"
                @trigger-button-event="submitActionHandler"
                v-if="isPrelimReqFormOpen" 
                title="Prelim requirement" 
                size="md"
                with-buttons
                :button-text="isPrelimForEdit ? 'Update requirement' : 'Add requirement'"
            >    
                <div class="row">
                    <div class="form-group col-12">
                        <label for="name">Name</label>
                        <input v-model="prelimForm.name" type="text" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="description">Description</label>
                        <input v-model="prelimForm.description" type="text" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="description">Program</label>
                        <select v-model="prelimForm.program_id" class="form-control">
                            <option value="">Select program</option>
                            <option v-for="(program, index) in programs" :key="index" :value="program.id">{{ program.display_name }}</option>
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label for="description">Is Active?</label>
                        <select v-model="prelimForm.is_active" class="form-control">
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
                    <span><b>Prelim Requirements</b></span>
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
                            <tr v-for="(req, index) in prelims" :key="index">
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
                                    <button v-if="!(req.path == '' || req.path == null)" @click="onRemoveFile(req.id)" class="btn btn-default btn-xs mr-1">Remove file</button>
                                    <button @click="openPrelimRequirementForm(req)" class="btn btn-success btn-xs mr-1">Edit</button>
                                    <button @click="onDeletePrelim(req.id)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </SuperadminLayout>
</template>