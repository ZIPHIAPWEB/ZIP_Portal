<script setup lang="ts">
import AuthLayout from '../../components/layouts/AuthLayout.vue';
import AuthAPI from '../../services/AuthAPI';

import { ref, computed, onMounted } from 'vue';
import { useAuthStore } from '../../store/auth';
import router from '../../router';

const authStore = useAuthStore();

const cooldown = ref<number>(120);

const isButtonReady = ref<boolean>(true);

onMounted(async () => {
    await authStore.getAuthUser();
    
    if(authStore.getIsVerified) {

        router.push({name: 'student-dashboard'});
    }
});

const resendEmail = async () => {
    try {
        startCooldownTimer();
        const response = await AuthAPI.resendEmailVerification();
        console.log(response);
    } catch (error: any) {
        console.log(error);
    }
}

const startCooldownTimer = () => {
    const cooldownTimer = setInterval(() => {
        if (cooldown.value > 0) {
            cooldown.value--;
            isButtonReady.value = false;
        } else {
            isButtonReady.value = true;
            clearInterval(cooldownTimer);
        }
    }, 1000);
}

</script>

<template>
    <AuthLayout>
        <div class="card card-primary">
            <div class="card-body">
                <p class="card-text">
                    <span>Email verification has been sent. Please check your email to verify your account.</span>
                </p>
            </div>
            <div class="card-footer">
                <button @click="resendEmail" class="btn btn-primary btn-block" :class="{ 'disabled' : !isButtonReady }">{{ isButtonReady ? 'Resend email' : `Resend email in ${cooldown}s` }}</button>
            </div>
        </div>
    </AuthLayout>
</template>