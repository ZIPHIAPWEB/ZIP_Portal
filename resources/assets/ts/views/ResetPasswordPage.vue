<script setup lang="ts">
import AuthLayout from '../components/layouts/AuthLayout.vue';

import { storeToRefs } from 'pinia';
import { reactive } from 'vue';

import { useRoute } from 'vue-router';
const route = useRoute();

import { IResetPasswordForm, useResetPassword } from '../store/resetPassword';
const resetPasswordStore = useResetPassword();
const { res_message, error, isSuccess, isLoading } = storeToRefs(resetPasswordStore);

const resetPasswordForm = reactive<IResetPasswordForm>({
    token: route.params.token,
    username: '',
    email: '',
    new_password: ''
});

const resetPasswordHandler = async () => {

    await resetPasswordStore.changePassword(resetPasswordForm);

    setTimeout(() => {

        window.close();
    }, 5000);
}

</script>

<template>
    <AuthLayout>
        <div class="login-box">
            <div v-if="!(res_message == '' || res_message == undefined)" :class="{'alert-danger': !isSuccess, 'alert-success': isSuccess}" class="alert">
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                {{ res_message }}
            </div>
            <div class="card card-outline card-primary">
                <div v-if="isLoading" class="overlay dark">
                    <i class="fas fa-3x fa-spinner fa-spin"></i>
                </div>
                <div class="card-header" style="border-bottom: 0; display: flex; justify-content: center;">
                    <img style="background-color: #0d133b; border-radius: 50%; width: 8rem; height: 8rem;" src="https://ziptravel.com.ph/logo.png" alt="company logo">
                </div>
                <div class="card-body">
                    <p class="login-box-msg"><span style="font-size: 20px; font-weight: 900">Zip Travel Philippines</span></p>
                    <form @submit.prevent="resetPasswordHandler">
                        <div class="form-group mb-3">
                            <input :class="{ 'is-invalid': error?.username ? error?.username[0] : ''}" v-model="resetPasswordForm.username" type="text" class="form-control" placeholder="Current username">
                        </div>
                        <div class="form-group mb-3">
                            <input :class="{ 'is-invalid': error?.email ? error?.email[0] : ''}" v-model="resetPasswordForm.email" type="email" class="form-control" placeholder="Current e-mail">
                        </div>
                        <div class="form-group mb-3">
                            <input :class="{ 'is-invalid': error?.new_password ? error?.new_password[0] : '' }" v-model="resetPasswordForm.new_password" type="password" class="form-control" placeholder="New password">
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" :disabled="isLoading || isSuccess" class="btn btn-success btn-block">Change password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>