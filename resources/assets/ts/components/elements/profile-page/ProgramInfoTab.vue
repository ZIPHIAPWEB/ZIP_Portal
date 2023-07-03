<script setup lang="ts">
import FlightDetailsCard from './program-information/FlightDetailsCard.vue';
import HostCompanyCard from './program-information/HostCompanyCard.vue';
import PdosCfoScheduleCard from './program-information/PdosCfoScheduleCard.vue';
import VisaInterviewCard from './program-information/VisaInterviewCard.vue';


</script>

<template>
    <div class="profile-content-body">
        <HostCompanyCard />
        <VisaInterviewCard />
        <PdosCfoScheduleCard />
        <FlightDetailsCard />
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