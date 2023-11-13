<script setup lang="ts">
import { ref, defineProps } from 'vue';

const props = defineProps<{
    name: string,
    part: number,
    whole: number
}>();

const calculatePercentage = (part : number, whole : number) => (part / whole) * 100;

</script>

<template>
    <div class="col-6">
        <h6>{{ props.name }} - {{ props.part }}/{{ props.whole }}</h6>
        <div class="progress">
            <div :style="{ width: `${calculatePercentage(props.part, props.whole)}%`}" class="progress-bar bg-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                <span class="sr-only">40% Complete (success)</span>
            </div>
        </div>
    </div>
</template>