<script setup lang="ts">
import { ref, onMounted } from 'vue';
import type { Component } from 'vue';
import AdminLayout from '../../components/layouts/AdminLayout.vue';
import ProfileTab from '../../components/elements/coordinator-page/profile-tab/ProfileDetailsCard.vue';
import PrelimTab from '../../components/elements/coordinator-page/prelim-tab/PrelimRequirementCard.vue';
import VisaTab from '../../components/elements/coordinator-page/visa-tab/VisaRequirementCard.vue';
import AdditionalTab from '../../components/elements/coordinator-page/additional-tab/AdditionalRequirementCard.vue';
import PaymentTab from '../../components/elements/coordinator-page/payments-tab/PaymentRequirementCard.vue';

import { useRoute } from 'vue-router';
const route = useRoute();

import { useCoordSelectedStudent } from '../../store/coordSelectedStudent';

const useCoordStudent = useCoordSelectedStudent();

onMounted(async () => {
    await useCoordStudent.loadSelectedStudent(+route.params.id);
})

interface ITabs {
    name: string,
    isActive: boolean,
    component: Component
}

const tabs = ref<ITabs[]>([
    { name: "Profile", isActive: true, component: ProfileTab },
    { name: "Program", isActive: false, component: ProfileTab}, // will update component
    { name: "Preliminary", isActive: false, component: PrelimTab },
    { name: "Visa Sponsor", isActive: false, component: VisaTab },
    { name: "Additional", isActive: false, component: AdditionalTab },
    { name: "Payments", isActive: false, component: PaymentTab },
]);

const selectedTab = ref<Component>(ProfileTab);

const selectTab = (tab : ITabs) => {
    tabs.value.forEach(t => {
        t.isActive = (t.name === tab.name)
    })
    
    selectedTab.value = tab.component;
}
</script>

<template>
    <AdminLayout title="Student Profile">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li v-for="(tab, index) in tabs" :key="index" class="nav-item">
                            <a href="#" @click.prevent="selectTab(tab)" class="nav-link mr-2" :class="{ 'active' : tab.isActive}">{{ tab.name }}</a>
                        </li>
                    </ul>
                </div><!-- /.card-header -->
            </div>

            <KeepAlive>
                <component :is="selectedTab" />
            </KeepAlive>
        </div>
    </AdminLayout>
</template>