<script setup lang="ts">
import AuthLayout from '../components/layouts/AuthLayout.vue';

import { storeToRefs } from 'pinia';
import { reactive } from 'vue';

import { useRoute } from 'vue-router';
const route = useRoute();

import { IResetPasswordForm, useResetPassword } from '../store/resetPassword';
const resetPasswordStore = useResetPassword();
const { error, isSuccess, isLoading } = storeToRefs(resetPasswordStore);

const resetPasswordForm = reactive<IResetPasswordForm>({
    token: route.params.token,
    username: '',
    email: '',
    currentPassword: '',
    newPassword: ''
});

const resetPasswordHandler = async () => {

    await resetPasswordStore.changePassword(resetPasswordForm);
}

</script>

<template>
    <AuthLayout>
        <div class="login-box">
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
                            <label for="current-username">Current username</label>
                            <input v-model="resetPasswordForm.username" type="email" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group mb-3">
                            <label for="current-email">Current email</label>
                            <input v-model="resetPasswordForm.email" type="email" class="form-control" placeholder="E-mail">
                        </div>
                        <div class="form-group mb-3">
                            <label for="current-password">Current password</label>
                            <input v-model="resetPasswordForm.currentPassword" type="password" class="form-control" placeholder="*******">
                        </div>
                        <div class="form-group mb-3">
                            <label for="current-password">New password</label>
                            <input v-model="resetPasswordForm.newPassword" type="password" class="form-control" placeholder="*******">
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" :disabled="isLoading" class="btn btn-success btn-block">Change password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>