<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';

import SuperadminLayout from '../../../components/layouts/SuperadminLayout.vue';
import PopUp from '../../../components/elements/PopUp.vue';
import UploadButton from '../../../components/elements/profile-page/program-requirements/UploadButton.vue';

import { ISuperadminVisaSponsorRequirement, useSuperadminVisaSponsorRequirementStore } from '../../../store/superadminVisaSponsorRequirement';
import AlertService from '../../../services/AlertService';
const superadminVisaSponsorRequirementStore = useSuperadminVisaSponsorRequirementStore();
const { sponsorReqs, isLoading, isSuccess, links } = storeToRefs(superadminVisaSponsorRequirementStore);

import { useSuperadminVisaSponsorStore } from '../../../store/superadminVisaSponsor';
const superadminVisaSponsorStore = useSuperadminVisaSponsorStore();
const { sponsors } = storeToRefs(superadminVisaSponsorStore);

const isSponsorReqFormOpen = ref<boolean>(false);
const isSponsorForEdit = ref<boolean>(false);
const sponsorForm = ref<ISuperadminVisaSponsorRequirement>({
    id: '',
    description: '',
    is_active: false,
    name: '',
    sponsor_id: ''
})

onMounted(async () => {
    await superadminVisaSponsorRequirementStore.loadSuperadminVisaSponsorRequriements();
    await superadminVisaSponsorStore.loadSuperadminVisaSponsors();
});

const openSponsorRequirementForm = (sponsorReq?: ISuperadminVisaSponsorRequirement) => {

    isSponsorReqFormOpen.value = true;

    if (sponsorReq) {

        sponsorForm.value = {...sponsorReq}

        isSponsorForEdit.value = true;

        return;
    }

    isSponsorForEdit.value = false;
}

const submitActionHandler = async () => {

    if (!isSponsorForEdit.value) {
        const res = await superadminVisaSponsorRequirementStore.storeSuperadminVisaSponsorRequirement(sponsorForm.value);
        if (!res.success) {
            if (res.errors) await AlertService.validation(res.errors);
            else await AlertService.error(res.message || 'Failed to store requirement');
            return;
        }
    } else {
        const res = await superadminVisaSponsorRequirementStore.updateSuperadminVisaSponsorRequirement(sponsorForm.value, sponsorForm.value.id);
        if (!res.success) {
            if (res.errors) await AlertService.validation(res.errors);
            else await AlertService.error(res.message || 'Failed to update requirement');
            return;
        }
    }

    if (isSuccess.value) {

        isSponsorReqFormOpen.value = false;
        resetFormHandler();
    }
}

const closeSponsorRequirementFormHandler = () => {

    isSponsorReqFormOpen.value = false;
    resetFormHandler();
}


const resetFormHandler = () => {
    sponsorForm.value.description = '';
    sponsorForm.value.is_active = false;
    sponsorForm.value.sponsor_id = '';
    sponsorForm.value.name = '';
    sponsorForm.value.id = '';
}


const uploadFileHander = async (file: File, requirementId : string | number | undefined) => {
    const res = await superadminVisaSponsorRequirementStore.uploadSuperadminVisaSponsorRequirementFile(file, requirementId);
    if (!res.success) {
        if (res.errors) await AlertService.validation(res.errors);
        else await AlertService.error(res.message || 'Failed to upload file');
        return;
    }

    await AlertService.success('File uploaded', 'Uploaded');
}

const onRemoveFile = async (id: string | number) => {
    const res = await superadminVisaSponsorRequirementStore.removeSuperadminVisaSponsorRequirementFile(id);
    if (!res.success) {
        if (res.errors) await AlertService.validation(res.errors);
        else await AlertService.error(res.message || 'Failed to remove file');
        return;
    }

    await AlertService.success('File removed', 'Removed');
}

const onDeleteSponsorReq = async (id: string | number) => {
    const confirmed = await AlertService.confirm('Are you sure you want to delete this requirement?');
    if (!confirmed) return;

    const res = await superadminVisaSponsorRequirementStore.deleteSuperadminVisaSponsorRequriement(id);
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
                @trigger-close-event="closeSponsorRequirementFormHandler()"
                @trigger-button-event="submitActionHandler"
                v-if="isSponsorReqFormOpen" 
                title="Sponsor requirement" 
                size="md"
                with-buttons
                :button-text="isSponsorForEdit ? 'Update requirement' : 'Add requirement'"
            >    
                <div class="row">
                    <div class="form-group col-12">
                        <label for="name">Name</label>
                        <input v-model="sponsorForm.name" type="text" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="description">Description</label>
                        <input v-model="sponsorForm.description" type="text" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="description">Program</label>
                        <select v-model="sponsorForm.sponsor_id" class="form-control">
                            <option value="">Select program</option>
                            <option v-for="(sponsor, index) in sponsors" :key="index" :value="sponsor.id">{{ sponsor.display_name }}</option>
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label for="description">Is Active?</label>
                        <select v-model="sponsorForm.is_active" class="form-control">
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
                    <span><b>Visa Sponsor Requirements</b></span>
                    <div class="card-tools">
                        <div>
                            <button @click="openSponsorRequirementForm()" class="btn btn-primary btn-xs">Add requirement</button>
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
                                <th>Sponsor</th>
                                <th>Active?</th>
                                <th>Date created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(req, index) in sponsorReqs" :key="index">
                                <td>{{ req.id }}</td>
                                <td>{{ req.name }}</td>
                                <td>{{ req.description }}</td>
                                <td>{{ req.sponsor }}</td>
                                <td>
                                    <i v-if="req.is_active" class="fas fa-check text-green"></i>
                                    <i v-if="!req.is_active" class="fas fa-times text-red"></i>
                                </td>
                                <td>{{ req.created_at }}</td>
                                <td>
                                    <UploadButton v-if="(req.path == '' || req.path == null)" :requirementId="req.id" @getFile="uploadFileHander" />
                                    <button v-if="!(req.path == '' || req.path == null)" @click="onRemoveFile(req.id)" class="btn btn-default btn-xs mr-1">Remove file</button>
                                    <button @click="openSponsorRequirementForm(req)" class="btn btn-success btn-xs mr-1">Edit</button>
                                    <button @click="onDeleteSponsorReq(req.id)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </SuperadminLayout>
</template>