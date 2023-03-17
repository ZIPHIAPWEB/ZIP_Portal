<script setup lang="ts">
import AuthLayout from '../components/layouts/AuthLayout.vue';

import { ref, computed } from 'vue';
import axios, { AxiosError, AxiosResponse } from 'axios';

const username = ref<string>('');
const password = ref<string>('');
const isLoading = ref<boolean>(false);

const errors = ref<string[]|any>([]);
const errorMessage = ref<string>('');

const usernameError = computed(() => {
    if (errors.value['username']) {
        return errors.value['username'][0];
    }

    return false;
});

const passwordError = computed(() => {
    if (errors.value['password']) {
        return errors.value['password'][0];
    }

    return false;
});

const login = () => {
    errorMessage.value = '';
    isLoading.value = true;

    axios.post('/api/login', {
        username: username.value,
        password: password.value
    }).then((response: AxiosResponse) => {
        console.log(response);
        isLoading.value = false;
    }).catch((error: AxiosError) => {
        isLoading.value = false;
        if(error.response?.status == 422) {
            errors.value = error.response?.data.errors;
            errorMessage.value = error.response?.data.message;
        } else {
            errorMessage.value = error.response?.data.message;
        }
        errorMessage.value = error.response?.data.message;
    });
}

</script>

<template>
    <AuthLayout>
        <div class="login-box">
    <!-- /.login-logo -->
        <div v-if="errorMessage" class="alert alert-danger">
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
            {{ errorMessage }}
        </div>
        <div class="card card-outline card-primary">
            <div v-if="isLoading" class="overlay dark">
                <i class="fas fa-3x fa-spinner fa-spin"></i>
            </div>
            <div class="card-header" style="border-bottom: 0; display: flex; justify-content: center;">
                <img style="background-color: darkblue; border-radius: 50%; width: 8rem; height: 8rem;" src="../../../../public/logo.png" alt="company logo">
            </div>
            <div class="card-body">
            <p class="login-box-msg"><span style="font-weight: 900">ZIP TRAVEL</span> Philippines</p>
            <form @submit.prevent="login">
                <div class="input-group mb-3">
                    <input :class="{ 'is-invalid' : usernameError }" v-model="username" type="text" class="form-control" placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input :class="{ 'is-invalid' : passwordError }" v-model="password" type="password" class="form-control" placeholder="Password">
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

            <div class="social-auth-links text-center mt-2 mb-3">
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div>
            <!-- /.social-auth-links -->

            <p class="mb-1 mt-1">
                <a href="forgot-password.html">I forgot my password</a>
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