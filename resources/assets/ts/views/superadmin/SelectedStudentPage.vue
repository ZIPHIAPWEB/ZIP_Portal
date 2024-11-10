<script setup lang="ts">
import { ref, onMounted, watch } from 'vue';
import type { Component } from 'vue';
import AdminLayout from '../../components/layouts/AdminLayout.vue';
import SuperadminLayout from '../../components/layouts/SuperadminLayout.vue';

import ProfileTab from '../../components/elements/coordinator-page/profile-tab/ProfileDetailsCard.vue';
import ProgramInfoTab from '../../components/elements/coordinator-page/program-tab/ProgramInfoCard.vue';
import PrelimTab from '../../components/elements/coordinator-page/prelim-tab/PrelimRequirementCard.vue';
import VisaTab from '../../components/elements/coordinator-page/visa-tab/VisaRequirementCard.vue';
import AdditionalTab from '../../components/elements/coordinator-page/additional-tab/AdditionalRequirementCard.vue';
import PaymentTab from '../../components/elements/coordinator-page/payments-tab/PaymentRequirementCard.vue';

import { useRoute } from 'vue-router';
const route = useRoute();

import { useCoordSelectedStudent } from '../../store/coordSelectedStudent';
import { storeToRefs } from 'pinia';
const useCoordStudent = useCoordSelectedStudent();
const { userInfo } = storeToRefs(useCoordStudent);

onMounted(async () => {
    await useCoordStudent.loadSelectedStudent(+route.params.id);
})

interface ITabs {
    name: string,
    isShown: boolean,
    isActive: boolean,
    component: Component
}

const tabs = ref<ITabs[]>([
    { name: "Profile", isActive: true, isShown: true, component: ProfileTab },
    { name: "Program", isActive: false, isShown: (userInfo.value.application_status == 'New Applicant' || userInfo.value.application_status == 'Confirmed') ? false : true, component: ProgramInfoTab},
    { name: "Preliminary", isActive: false, isShown: true, component: PrelimTab },
    { name: "Additional", isActive: false, isShown: true, component: AdditionalTab },
    { name: "Payments", isActive: false, isShown: true, component: PaymentTab },
    { name: "Visa Sponsor", isActive: false, isShown: (userInfo.value.application_status == 'New Applicant' || userInfo.value.application_status == 'Confirmed') ? false : true, component: VisaTab },
]);

watch(() => useCoordStudent.userInfo.application_status, () => {

    tabs.value = [
        { name: "Profile", isActive: true, isShown: true, component: ProfileTab },
        { name: "Program", isActive: false, isShown: (userInfo.value.application_status == 'New Applicant' || userInfo.value.application_status == 'Confirmed') ? false : true, component: ProgramInfoTab},
        { name: "Preliminary", isActive: false, isShown: true, component: PrelimTab },
        { name: "Additional", isActive: false, isShown: true, component: AdditionalTab },
        { name: "Payments", isActive: false, isShown: true, component: PaymentTab },
        { name: "Visa Sponsor", isActive: false, isShown: (userInfo.value.application_status == 'New Applicant' || userInfo.value.application_status == 'Confirmed') ? false : true, component: VisaTab }
    ];
});

const selectedTab = ref<Component>(ProfileTab);

const selectTab = (tab : ITabs) => {
    tabs.value.forEach(t => {
        t.isActive = (t.name === tab.name)
    })
    
    selectedTab.value = tab.component;
}
</script>

<template>
    <SuperadminLayout>
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li v-for="(tab, index) in tabs" :key="index" :class="{ 'd-none' : !tab.isShown }" class="nav-item">
                            <a href="#" @click.prevent="selectTab(tab)" class="nav-link mr-2" :class="{ 'active' : tab.isActive}">{{ tab.name }}</a>
                        </li>
                    </ul>
                </div><!-- /.card-header -->
            </div>

            <KeepAlive>
                <component :is="selectedTab" />
            </KeepAlive>
        </div>
    </SuperadminLayout>
</template>