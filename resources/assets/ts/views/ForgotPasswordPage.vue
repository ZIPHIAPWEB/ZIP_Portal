<script setup lang="ts">
import AuthLayout from '../components/layouts/AuthLayout.vue';
import {ref} from 'vue';
import { useAuthStore } from '../store/auth';
import { storeToRefs } from 'pinia';
const authStore = useAuthStore();
const { authErrors } = storeToRefs(authStore);

const email = ref<string>('');
const username = ref<string>('');

const sendForgotPasswordLink = async () => {

    await authStore.sendForgotPasswordLink(email.value, username.value)
}
</script>

<template>
    <AuthLayout>
        <div class="login-box">
            <div v-if="authStore.errorMessage" class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                {{ authStore.errorMessage }}
            </div>
            <div class="card card-outline card-primary">
                <div v-if="authStore.isLoading" class="overlay dark">
                    <i class="fas fa-3x fa-spinner fa-spin"></i>
                </div>
                <div class="card-header" style="border-bottom: 0; display: flex; justify-content: center;">
                    <img style="background-color: #0d133b; border-radius: 50%; width: 8rem; height: 8rem;" src="https://ziptravel.com.ph/logo.png" alt="company logo">
                </div>
                <div class="card-body">
                    <p class="login-box-msg"><span style="font-size: 20px; font-weight: 900">Zip Travel Philippines</span></p>
                    <form @submit.prevent="sendForgotPasswordLink">
                        <div class="input-group mb-3">
                            <input v-model="username" type="text" :class="{ 'is-invalid': authErrors?.email ? authErrors?.email[0] : ''}" class="form-control" placeholder="Username">
                        </div>
                        <div class="input-group mb-3">
                            <input v-model="email" type="email" :class="{ 'is-invalid': authErrors?.username ? authErrors?.username[0] : ''}" class="form-control" placeholder="E-mail">
                        </div>
                        <div class="row">
                            <div class="col-12 mb-2">
                                <button class="btn btn-success btn-block">Send Reset Password Link</button>
                            </div>
                        </div>
                    </form>
                    <router-link class="text-center mt-1" to="/portal/v2/login">I already have a membership</router-link>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>