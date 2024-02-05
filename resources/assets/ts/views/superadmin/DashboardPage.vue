<script setup lang="ts">
import SuperadminLayout from '../../components/layouts/SuperadminLayout.vue';
import { ref } from 'vue';

const title = ref<string>('Superadmin Page');
</script>

<template>
    <SuperadminLayout>
        <div class="pt-4 container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-body">
                    <h1>Testing</h1>
                </div>
            </div>
        </div>

        <div class="pt-4 container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-body">
                    <h1>Testing</h1>
                </div>
            </div>
        </div>

        <div class="pt-4 container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-body">
                    <h1>Testing</h1>
                </div>
            </div>
        </div>
    </SuperadminLayout>
</template>