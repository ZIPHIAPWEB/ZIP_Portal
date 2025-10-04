<script setup lang="ts">
import AuthLayout from '../components/layouts/AuthLayout.vue';

import { ref } from 'vue';
import { useRouter } from 'vue-router';
import AlertService from '../services/AlertService';

import { useAuthStore } from '../store/auth';
const authStore = useAuthStore();

const username = ref<string>('');
const password = ref<string>('');

const router = useRouter();

const login = async () => {
    const result = await authStore.login(username.value, password.value);

    if (result.success) {
        if (result.data?.redirect) router.push({ name: result.data.redirect });
    } else {
        if (result.errors) {
            await AlertService.validation(result.errors);
        } else {
            await AlertService.error(result.message || 'Login failed.');
        }
    }

}
</script>

<template>
    <AuthLayout>
        <div class="login-box">
    <!-- /.login-logo -->
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
            <form @submit.prevent="login">
                <div class="input-group mb-3">
                    <input :class="{ 'is-invalid' : authStore.getUsernameError }" v-model="username" type="text" class="form-control" placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input :class="{ 'is-invalid' : authStore.getPasswordError }" v-model="password" type="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>

            <div v-if="false" class="social-auth-links text-center mt-2 mb-3">
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div>
            <!-- /.social-auth-links -->

            <p class="mb-1 mt-1">
                <router-link to="/portal/v2/forgot-password">I forgot my password</router-link>
            </p>
            <p class="mb-0">
                <router-link class="text-center" to="/portal/v2/register">Register as a participant</router-link>
            </p>
            </div>
            <!-- /.card-body -->
        </div>
    <!-- /.card -->
    </div>
<!-- /.login-box -->
    </AuthLayout>
</template>