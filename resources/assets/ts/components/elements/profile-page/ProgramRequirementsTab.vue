<script setup lang="ts">
import BasicTab from './program-requirements/BasicTab.vue';
import VisaTab from './program-requirements/VisaTab.vue';
import AdditionalTab from './program-requirements/AdditionalTab.vue';

import { useAuthStore } from '../../../store/auth';
const authStore = useAuthStore();
const { auth } = storeToRefs(authStore);

import { IProgramRequirementsTabs } from '../../../types/ProgramReqTabsType'

import { onMounted, ref } from 'vue';
import { storeToRefs } from 'pinia';

const selectedTab = ref();
const programReqTabs = ref<IProgramRequirementsTabs[]>([
    {
        name: 'Basic Req.',
        component: BasicTab,
        isActive: true
    },
    {
        name: 'Visa Sponsor Req.',
        component: VisaTab,
        isActive: false
    },
    {
        name: 'Additional Req.',
        component: AdditionalTab,
        isActive: false
    },
]);

onMounted(() => {
    selectedTab.value = programReqTabs.value[0].component;
});

const selectTabHandler = (selected : IProgramRequirementsTabs) : void => {
    programReqTabs.value.forEach(tab => {
        tab.isActive = (tab.name === selected.name);
    });
    selectedTab.value = selected.component;
}
</script>

<template>
    <div class="card card-primary card-outline">
        <div v-if="false" class="overlay dark">
            <i class="fas fa-3x fa-spinner fa-spin"></i>
        </div>
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li v-for="(tab, index) in programReqTabs" :key="index" class="nav-item mx-3">
                    <a href="#" @click.prevent="selectTabHandler(tab)" class="nav-link" :class="{ 'active' : tab.isActive }">{{ tab.name }}</a>
                </li>
            </ul>
        </div>
        <div class="card-body p-3" style="max-height: 83vh; overflow-y: auto;">
            <KeepAlive>
                <component :is="selectedTab" />
            </KeepAlive>
        </div>
    </div>
</template>