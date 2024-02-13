import AuthAPI from "../services/AuthAPI";
import { IBaseState } from "../interfaces/IBaseState";
import { defineStore } from "pinia";

export interface IResetPasswordForm {
    token: string | string[];
    username: string;
    email: string;
    currentPassword: string;
    newPassword: string;
}

export const useResetPassword = defineStore({
    id: 'resetPassword',
    state: () : IBaseState => ({
        error: undefined,
        isLoading: false,
        isSuccess: false
    }),
    actions: {
        async changePassword(data : IResetPasswordForm) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await AuthAPI.changePassword(data)).data;
                console.log(response.data);

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})