<script setup lang="ts">
import AuthLayout from '../components/layouts/AuthLayout.vue';

import { ref, computed } from 'vue';
import axios, { AxiosError } from 'axios';

const username = ref<string>('');
const email = ref<string>('');
const password = ref<string>('');
const password_confirmation = ref<string>('');
const isLoading = ref<boolean>(false);

const errors = ref<string[]|any>([]);
const errorMessage = ref<string>('');

const usernameError = computed(() => {
    if (errors.value['username']) {
        return errors.value['username'][0];
    }

    return false;
});

const emailError = computed(() => {
    if (errors.value['email']) {
        return errors.value['email'][0];
    }

    return false;
});

const passwordError = computed(() => {
    if (errors.value['password']) {
        return errors.value['password'][0];
    }

    return false;
});

const passwordConfirmationError = computed(() => {
    if (errors.value['password_confirmation']) {
        return errors.value['password_confirmation'][0];
    }

    return false;
});

const register = () => {
    isLoading.value = true;
    errorMessage.value = '';
    errors.value = [];

    axios.post('/api/register', {
        username: username.value,
        email: email.value,
        password: password.value,
        password_confirmation: password_confirmation.value
    }).then((response) => {
        console.log(response);
        isLoading.value = false;
    }).catch((error: AxiosError) => {
        console.log(error.response?.status);
        if(error.response?.status == 422) {
            errors.value = error.response?.data.errors;
            errorMessage.value = error.response?.data.message;
        } else {
            errorMessage.value = error.response?.data.message;
        }
        isLoading.value = false;
    });
}

</script>

<template>
    <AuthLayout>
        <div class="register-box">
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
                    
                <form @submit.prevent="register">
                    <div class="input-group mb-3">
                        <input :class="{ 'is-invalid' : usernameError }" v-model="username" type="text" class="form-control" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                    <input :class="{ 'is-invalid' : emailError }" v-model="email" type="email" class="form-control" placeholder="Email">
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
                    <div class="input-group mb-3">
                    <input :class="{ 'is-invalid' : passwordConfirmationError }" v-model="password_confirmation" type="password" class="form-control" placeholder="Retype password">
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