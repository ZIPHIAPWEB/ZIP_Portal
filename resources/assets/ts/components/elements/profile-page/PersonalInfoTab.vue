<script setup lang="ts">
import PersonalDetailsCard from './personal-information/PersonalDetailsCard.vue';
import ContactDetailsCard from './personal-information/ContactDetailsCard.vue';
import TertiaryDetailsCard from './personal-information/TertiaryDetailsCard.vue';
import SecondaryDetailsCard from './personal-information/SecondaryDetailsCard.vue';
import FatherDetailsCard from './personal-information/FatherDetailsCard.vue';
import MotherDetailsCard from './personal-information/MotherDetailsCard.vue';
import WorkExperienceCard from './personal-information/WorkExperienceCard.vue';

</script>

<template>
    <div class="profile-content-body">
        <PersonalDetailsCard />
        <ContactDetailsCard />
        <TertiaryDetailsCard />
        <SecondaryDetailsCard />
        <FatherDetailsCard />
        <MotherDetailsCard />
        <WorkExperienceCard />
    </div>
</template>

<style scoped>
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