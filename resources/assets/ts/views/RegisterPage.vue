<script setup lang="ts">
import AuthLayout from '../components/layouts/AuthLayout.vue';
import AuthAPI from '../services/AuthAPI';

import { ref } from 'vue';

import { useAuthStore } from '../store/auth';
const authStore = useAuthStore();

const username = ref<string>('');
const email = ref<string>('');
const password = ref<string>('');
const password_confirmation = ref<string>('');

const register = async () => {
    
    await authStore.register(username.value, email.value, password.value, password_confirmation.value);

}

</script>

<template>
    <AuthLayout>
        <div class="register-box">
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
                    
                <form @submit.prevent="register">
                    <div class="input-group mb-3">
                        <input :class="{ 'is-invalid' : authStore.getUsernameError }" v-model="username" type="text" class="form-control" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                    <input :class="{ 'is-invalid' : authStore.getEmailError }" v-model="email" type="email" class="form-control" placeholder="Email">
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
                    <div class="input-group mb-3">
                    <input :class="{ 'is-invalid' : authStore.getPasswordConfirmationError }" v-model="password_confirmation" type="password" class="form-control" placeholder="Retype password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    <!-- /.col -->
                    </div>
                </form>
                    <router-link class="text-center mt-1" to="/portal/v2/login">I already have a membership</router-link>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
            </div>
    </AuthLayout>
</template>