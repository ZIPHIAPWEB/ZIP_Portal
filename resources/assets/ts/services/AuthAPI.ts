import { AxiosResponse } from "axios";
import { ApiRequest, ApiRequestWithoutAuth } from "./ApiRequest";

import { IResetPasswordForm } from '../store/resetPassword';

export default {
    login(username: string, password: string) : Promise<AxiosResponse> {

        return ApiRequestWithoutAuth.post('/login', { username, password });
    },

    register(username: string, email: string, password: string, password_confirmation: string) : Promise<AxiosResponse> {

        return ApiRequestWithoutAuth.post('/register', { username, email, password, password_confirmation });
    },

    sendForgotPasswordLink(email: string) : Promise<AxiosResponse> {

        return ApiRequestWithoutAuth.post('/send-forgot-password', { email });
    },

    changePassword(data : IResetPasswordForm) : Promise<AxiosResponse> {

        return ApiRequestWithoutAuth.put('/reset-password', { data });
    },

    resendEmailVerification() : Promise<AxiosResponse> {

        return ApiRequest.post('/verify/resend-email');
    },

    getAuthUser() : Promise<AxiosResponse> {

        return ApiRequest.get('/user');
    },

    logout() : Promise<AxiosResponse> {
            
        return ApiRequest.get('/logout');
    }
}