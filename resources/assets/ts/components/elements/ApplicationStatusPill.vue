<script setup lang="ts">
const props = defineProps<{
    status: string
}>();

</script>

<template>
    <span v-if="props.status == 'New Applicant'" class="badge bg-new-applicant">{{ props.status }}</span>
    <span v-if="props.status == 'Confirmed'" class="badge bg-confirmed">{{ props.status }}</span>
    <span v-if="props.status == 'Hired'" class="badge bg-hired">{{ props.status }}</span>
    <span v-if="props.status == 'Visa Status'" class="badge bg-visa-status">{{ props.status }}</span>
    <span v-if="props.status == 'For PDOS & CFO'" class="badge bg-pdos-cfo">{{ props.status }}</span>
    <span v-if="props.status == 'Program Proper'" class="badge bg-program-proper">{{ props.status }}</span>
    <span v-if="props.status == 'Program Compliance'" class="badge bg-program-compliance">{{ props.status }}</span>
    <span v-if="props.status.includes('Cancel')" class="badge bg-visa-denied">{{ props.status }}</span>
</template>

<style scoped>
.bg-new-applicant {
    background: rgb(236, 176, 33);
}

.bg-confirmed {
    background: rgb(189, 61, 38);
}

.bg-assessed {
    background: rgb(210, 91, 39);
}

.bg-hired {
    background: rgb(37, 110, 182);
}

.bg-visa-status {
    background: rgb(23, 66, 117);
}

.bg-pdos-cfo {
    background: rgb(21, 51, 92);
}

.bg-program-proper {
    background: rgb(17, 133, 66);
}

.bg-program-compliance {
    background: rgb(228, 255, 27);
    color: black;
}

.bg-visa-denied {
    background: rgb(185, 32, 37);
}

.bg-cancelled {
    background: rgb(185, 32, 37);
}
</style>