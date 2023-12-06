<script setup lang="ts">
import HostCompanyDetails from './HostCompanyCard.vue';
import VisaInterviewDetails from './VisaInterviewDetails.vue';
import PdosCfoDetailsCard from './PdosCfoDetailsCard.vue';
import FlightDetailsCard from './FlightDetailsCard.vue';

import { ref } from 'vue';

const visaInterview = ref();
const schedule = ref();
const flightDetails = ref();

</script>

<template>
    <div class="card card-default" style="height: 75vh; overflow-y: scroll; padding-right: 1px;">
        <div class="card-body p-0">
            <HostCompanyDetails />
            <VisaInterviewDetails />
            <PdosCfoDetailsCard />
            <FlightDetailsCard />
        </div>
    </div>
</template>