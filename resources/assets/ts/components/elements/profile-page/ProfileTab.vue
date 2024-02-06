<script setup lang="ts">
import type { Component } from 'vue';
import { ref } from 'vue';

interface IProfileTab {
    name: string;
    component: Component;
    isActive: boolean;
}

import PersonalInfoTab from './PersonalInfoTab.vue';
import ProgramInfoTab from './ProgramInfoTab.vue';

const tabs = ref<IProfileTab[]>([
    { name: 'Personal', component: PersonalInfoTab, isActive: true },
    { name: 'Program Info', component: ProgramInfoTab, isActive: false },
]);
const selectedTab = ref<Component>(PersonalInfoTab);

const selectTab = (tab : IProfileTab) => {
    tabs.value.forEach(t => {
        t.isActive = (t.name === tab.name)
    })
    selectedTab.value = tab.component;
}
</script>

<template>
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
</template>

<style scoped>
    .profile-header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: 100%;
        margin: 5px 0;
    }

    .profile-header__title {
        font-weight: bold;
        font-size: 15px;
        margin: 0;
    }

    .profile-content-body {
        height:84vh; 
        overflow-y: auto;
        padding-right: 10px;
    }

    .profile-content-body::-webkit-scrollbar {
        background: transparent;
    }

    .profile-content-body::-webkit-scrollbar-thumb {
       background: #007bff;
       border: 3px solid #FFFFFF;
       border-radius: 5px;
    }
</style>