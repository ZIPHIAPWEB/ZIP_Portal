// No changes needed to remove Markdown code fences as they do not exist in the file.
// Removed stray markdown fence and comment to make the file valid TypeScript.
import { defineStore } from 'pinia';

import AuthAPI from '../services/AuthAPI';
import { UserInitial, UserType } from '../types/UserType';
import { RemovableRef, useLocalStorage } from '@vueuse/core';
import { AxiosError } from 'axios';
import { IActionResult } from '../interfaces/IActionResult';
import router from '../router';

export interface IAuthState {
    auth: RemovableRef<UserType>;
    accessToken: RemovableRef<string>;
    authErrors: any;
    errorMessage: string;
    isLoading: boolean;
}

export const useAuthStore = defineStore({
    id: 'authState',
    state: (): IAuthState => ({
        auth: useLocalStorage('auth', UserInitial),
        accessToken: useLocalStorage('access_token', ''),
        authErrors: {} as any,
        errorMessage: '',
        isLoading: false
    }),
    getters: {
        getUsernameError(state) {
            return state.authErrors?.username ? state.authErrors?.username[0] : '';
        },
        getPasswordError(state) {
            return state.authErrors?.password ? state.authErrors?.password[0] : '';
        },
        getEmailError(state) {
            return state.authErrors?.email ? state.authErrors?.email[0] : '';
        },
        getPasswordConfirmationError(state) {
            return state.authErrors?.password_confirmation ? state.authErrors?.password_confirmation[0] : '';
        },
        getIsAuthenticate(state): boolean {
            return state.accessToken != '';
        },
        getIsVerified(state): boolean {
            return state.auth.is_verified;
        },
        getIsFilled(state): boolean {
            return state.auth.is_filled;
        },
        getAuthRole(state): string {
            return state.auth.role;
        }
    },
    actions: {
        async getAuthUser(): Promise<IActionResult<any>> {
            try {
                this.isLoading = true;
                const response = await AuthAPI.getAuthUser();

                this.auth = response.data.data.user;

                this.isLoading = false;
                return { success: true, data: this.auth };
            } catch (err) {
                const error = err as AxiosError;
                this.isLoading = false;
                this.authErrors = error.response?.data.errors;
                this.errorMessage = error.response?.data.message;
                return { success: false, errors: this.authErrors, message: this.errorMessage };
            }
        },

        async login(username: string, password: string): Promise<IActionResult<{ redirect?: string }>> {
            this.authErrors = {};
            this.errorMessage = '';

            try {
                this.isLoading = true;
                const response = await AuthAPI.login(username, password);

                this.accessToken = response.data.data.access_token;
                this.auth = response.data.data.user;

                this.isLoading = false;

                // Decide redirect route by role/state but return it to the caller
                if (this.auth.role == 'superadmin' || this.auth.role == 'admin') {
                    return { success: true, data: { redirect: 'superadmin-dashboard' } };
                }

                if (this.auth.role == 'coordinator' || this.auth.role == 'accounting') {
                    if (this.auth.is_verified) return { success: true, data: { redirect: 'coordinator-dashboard' } };
                    return { success: true, data: { redirect: 'coordinator-admin-veriff' } };
                }

                if (this.auth.role == 'student') {
                    if (this.auth.is_verified) {
                        if (this.auth.is_filled) return { success: true, data: { redirect: 'student-dashboard' } };
                        return { success: true, data: { redirect: 'application-form' } };
                    }

                    return { success: true, data: { redirect: 'email-verification' } };
                }

                return { success: true };
            } catch (err) {
                const error = err as AxiosError;
                this.isLoading = false;
                this.authErrors = error.response?.data.errors;
                this.errorMessage = error.response?.data.message;
                return { success: false, errors: this.authErrors, message: this.errorMessage };
            }
        },

        async register(username: string, email: string, password: string, password_confirmation: string): Promise<IActionResult<{ redirect?: string }>> {
            this.authErrors = {};
            this.errorMessage = '';

            try {
                this.isLoading = true;
                const response = await AuthAPI.register(username, email, password, password_confirmation);
                this.auth = response.data.data.user;
                this.accessToken = response.data.data.access_token;
                this.isLoading = false;

                return { success: true, data: { redirect: 'email-verification' } };
            } catch (err) {
                const error = err as AxiosError;
                this.isLoading = false;
                this.authErrors = error.response?.data.errors;
                this.errorMessage = error.response?.data.message;
                return { success: false, errors: this.authErrors, message: this.errorMessage };
            }
        },

        async sendForgotPasswordLink(email: string, username: string): Promise<IActionResult> {
            try {
                this.isLoading = true;
                const response = await AuthAPI.sendForgotPasswordLink(email, username);

                this.isLoading = false;
                return { success: true };
            } catch (err) {
                const error = err as AxiosError;
                this.isLoading = false;
                this.authErrors = error.response?.data.errors;
                this.errorMessage = error.response?.data.message;
                return { success: false, errors: this.authErrors, message: this.errorMessage };
            }
        },

        async logout() {
            await AuthAPI.logout();
            this.clearAuthData();

            // Redirect to login page after logout. Navigation is done via router instance.
            try {
                router.push({ name: 'login' }).catch(() => {});
            } catch (e) {
                // ignore navigation errors in non-browser contexts
            }
        },

        clearAuthData() {
            // Do not perform navigation here; caller should handle it
            this.auth = { ...UserInitial };
            this.accessToken = '';
        }
    }
});