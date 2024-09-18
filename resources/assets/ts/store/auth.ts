import { defineStore } from 'pinia';
import AuthAPI from '../services/AuthAPI';
import { UserInitial, UserType } from '../types/UserType';
import { RemovableRef, useLocalStorage } from '@vueuse/core';
import { AxiosError } from 'axios';

export interface IAuthState {
    auth: RemovableRef<UserType>;
    accessToken: RemovableRef<string>;
    authErrors: any
    errorMessage: string;
    isLoading: boolean;
}

export const useAuthStore = defineStore({
    id: 'authState',
    state: () : IAuthState => ({
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
        getIsAuthenticate(state) : boolean {
            return state.accessToken != '';
        },
        getIsVerified(state) : boolean {
            return state.auth.is_verified;
        },
        getIsFilled(state) : boolean {
            return state.auth.is_filled;
        },
        getAuthRole(state) : string {
            return state.auth.role;
        }
    },
    actions: {
        async getAuthUser() {

            try {
                this.isLoading = true;
                const response = await AuthAPI.getAuthUser();

                this.auth = response.data.data.user;

                this.isLoading = false;
            } catch (err) {
                const error = err as AxiosError;
                this.isLoading = false;
                this.authErrors = error.response?.data.errors;
                this.errorMessage = error.response?.data.message;
            }
        },
        
        async login(username: string, password: string) {
            this.authErrors = {};
            this.errorMessage = '';

            try {
                this.isLoading = true;
                const response = await AuthAPI.login(username, password);

                this.accessToken = response.data.data.access_token;
                this.auth = response.data.data.user;

                this.isLoading = false;

                if (this.auth.role == 'superadmin' || this.auth.role == 'admin') {
                    
                    this.router.push({ name: 'superadmin-dashboard' });

                    return;
                }

                if (this.auth.role == 'coordinator' || this.auth.role == 'accounting') {

                    if (this.auth.is_verified) {

                        this.router.push({ name: 'coordinator-dashboard' });
                    } else {

                        this.router.push({ name: 'coordinator-admin-veriff'});
                    }

                    return;
                }

                if (this.auth.role == 'student') {

                    if (this.auth.is_verified) {
                    
                        if (this.auth.is_filled) {
                            this.router.push({ name: 'student-dashboard' });
                        } else {
                            this.router.push({ name: 'application-form'});
                        }
                    } else {

                        this.router.push({ name: 'email-verification' })       
                    }
                }
            } catch (err) {
                const error = err as AxiosError;
                this.isLoading = false;
                this.authErrors = error.response?.data.errors;
                this.errorMessage = error.response?.data.message;
            }
        },

        async register(username: string, email: string, password: string, password_confirmation: string) {
            this.authErrors = {};
            this.errorMessage = '';

            try {
                this.isLoading = true;
                const response = await AuthAPI.register(username, email, password, password_confirmation);
                this.auth = response.data.data.user;
                this.accessToken = response.data.data.access_token;
                this.isLoading = false;

                this.router.push({ name: 'email-verification' });
            } catch (err) {
                const error = err as AxiosError;
                this.isLoading = false;
                this.authErrors = error.response?.data.errors;
                this.errorMessage = error.response?.data.message;
            }
        },

        async sendForgotPasswordLink(email: string, username: string) {

            try {
                this.isLoading = true;
                const response = await AuthAPI.sendForgotPasswordLink(email, username);

                this.isLoading = false;
            } catch (err) {
                const error = err as AxiosError;
                this.isLoading = false;
                this.authErrors = error.response?.data.errors;
                this.errorMessage = error.response?.data.message;
            }
        },
        
        async logout() {
            await AuthAPI.logout();
            this.clearAuthData();
        },

        clearAuthData() {
            this.router.push({ name: 'login' });
            this.auth = {...UserInitial};
            this.accessToken = '';
        }
    }
});