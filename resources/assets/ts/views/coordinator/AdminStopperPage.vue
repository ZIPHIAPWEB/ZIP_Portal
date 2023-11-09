<script setup lang="ts">
import AuthLayout from '../../components/layouts/AuthLayout.vue';

import { useAuthStore } from '../../store/auth';
const authStore = useAuthStore();

const logoutUserHandler = async () => {
    await authStore.logout();
    
    alert('Logout!');
}

</script>

<template>
    <AuthLayout>
        <div class="card card-danger">
            <div class="card-body">
                <p class="card-text">
                    <span>Please contact your superadministrator to verify your account.</span>
                </p>
            </div>
            <div class="card-footer">
                <button @click="logoutUserHandler" class="btn btn-danger btn-block btn-sm">Logout</button>
            </div>
        </div>
    </AuthLayout>    
</template>