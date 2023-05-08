import { defineStore } from 'pinia';
import AuthAPI from '../services/AuthAPI';

export const useAuthStore = defineStore({
    id: 'authState',
    state: () => ({
        auth: null,
        authErrors: null,
        isLoading: false
    }),
    actions: {
        async login(username: string, password: string) {
            try {
                this.isLoading = true;
                const response = await AuthAPI.login(username, password);
                this.auth = response.data.data;
                this.isLoading = false;
            } catch (error: any) {
                this.authErrors = error.response.data.errors;
            }
        },
        async logout() {
            await AuthAPI.logout();
            this.auth = null;
        }
    }
});