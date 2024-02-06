<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useCoordStudentHostInfo } from '../../../../store/coordStudentHostInfo';
import { IVisaSponsor } from '../../../../store/studentVisaSponsor';
import { storeToRefs } from 'pinia';
import VisaSponsorAPI from '../../../../services/VisaSponsorAPI';
import HostCompaniesAPI from '../../../../services/HostCompaniesAPI';

const coordStudentHostInfoStore = useCoordStudentHostInfo();
const { isLoading, visaSponsor } = storeToRefs(coordStudentHostInfoStore);
const sponsors = ref();
const companies = ref();
const hostCompanyIsEdit = ref<boolean>(false);
const hostCompanyForm = ref<IVisaSponsor>({
    host_company: '',
    host_company_id: '',
    visa_sponsor: '',
    visa_sponsor_id: '',
    housing_address: '',
    position: '',
    stipend: '',
    start_date: '',
    end_date: '',
    formatted_start_date: '',
    formatted_end_date: ''
});

onMounted(async () => {
    await coordStudentHostInfoStore.loadCoordStudentHostInfo();
    sponsors.value = (await VisaSponsorAPI.getAllVisaSponsors()).data;
    companies.value = (await HostCompaniesAPI.getAllHostCompanies()).data;
    hostCompanyForm.value = {...visaSponsor.value};
})

const updateHostCompany = async () => {
    await coordStudentHostInfoStore.updateCoordStudentHostInfo(hostCompanyForm.value);
    hostCompanyIsEdit.value = false;
    alert('Host company updated!');
}
</script>

<template>
    <section id="host-company">
        <div class="ml-2 mt-2 mr-2" style="display: flex; justify-content:space-between;">
            <label class="control-label">Host company details</label>
            <a v-if="!hostCompanyIsEdit" @click.prevent="hostCompanyIsEdit = true" href="#">Edit</a>
            <div v-if="hostCompanyIsEdit">
                <a @click.prevent="updateHostCompany" href="#" class="mr-1">Update</a>
                <a @click.prevent="hostCompanyIsEdit = false" href="#">Cancel</a>
            </div>
        </div>
        <table class="table table-striped table-bordered table-sm">
            <tbody>
                <tr>
                    <td style="width: 40%">Visa Sponsor</td>
                    <td v-if="!hostCompanyIsEdit">{{ visaSponsor.visa_sponsor }}</td>
                    <td v-if="hostCompanyIsEdit">
                        <select v-model="hostCompanyForm.visa_sponsor_id" class="form-control form-control-sm">
                            <option v-for="(sponsor, index) in sponsors.data" :key="index" :value="sponsor.id">{{ sponsor.display_name }}</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Host Company</td>
                    <td v-if="!hostCompanyIsEdit">{{ visaSponsor.host_company }}</td>
                    <td v-if="hostCompanyIsEdit">
                        <select v-model="hostCompanyForm.host_company_id" class="form-control form-control-sm">
                            <option v-for="(company, index) in companies.data" :key="index" :value="company.id">{{ company.name }}</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Housing Address</td>
                    <td v-if="!hostCompanyIsEdit">{{ visaSponsor.housing_address }}</td>
                    <td v-if="hostCompanyIsEdit">
                        <input v-model="hostCompanyForm.housing_address" type="text" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Position</td>
                    <td v-if="!hostCompanyIsEdit">{{ visaSponsor.position }}</td>
                    <td v-if="hostCompanyIsEdit">
                        <input v-model="hostCompanyForm.position" type="text" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Stipend</td>
                    <td v-if="!hostCompanyIsEdit">{{ visaSponsor.stipend }}</td>
                    <td v-if="hostCompanyIsEdit">
                        <input v-model="hostCompanyForm.stipend" type="text" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">Start Date</td>
                    <td v-if="!hostCompanyIsEdit">{{ visaSponsor.formatted_start_date }}</td>
                    <td v-if="hostCompanyIsEdit">
                        <input v-model="hostCompanyForm.start_date" type="date" class="form-control form-control-sm">
                    </td>
                </tr>
                <tr>
                    <td style="width: 40%">End Date</td>
                    <td v-if="!hostCompanyIsEdit">{{ visaSponsor.formatted_end_date }}</td>
                    <td v-if="hostCompanyIsEdit">
                        <input v-model="hostCompanyForm.end_date" type="date" class="form-control form-control-sm">
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</template>