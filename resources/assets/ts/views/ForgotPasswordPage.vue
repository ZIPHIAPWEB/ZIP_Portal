<script setup lang="ts">
import AuthLayout from '../components/layouts/AuthLayout.vue';
import {ref} from 'vue';
import { useAuthStore } from '../store/auth';
const authStore = useAuthStore();

const email = ref<string>('');

const sendForgotPasswordLink = async () => {

    await authStore.sendForgotPasswordLink(email.value)
}
</script>

<template>
    <AuthLayout>
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div v-if="authStore.isLoading" class="overlay dark">
                    <i class="fas fa-3x fa-spinner fa-spin"></i>
                </div>
                <div class="card-header" style="border-bottom: 0; display: flex; justify-content: center;">
                    <img style="background-color: #0d133b; border-radius: 50%; width: 8rem; height: 8rem;" :src="require('../../../../public/logo.png')" alt="company logo">
                </div>
                <div class="card-body">
                    <p class="login-box-msg"><span style="font-weight: 900">ZIP TRAVEL</span> Philippines</p>
                    <form @submit.prevent="sendForgotPasswordLink">
                        <div class="input-group mb-3">
                            <input v-model="email" type="email" class="form-control" placeholder="E-mail">
                        </div>
                        <div class="row">
                            <div class="col-12">
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