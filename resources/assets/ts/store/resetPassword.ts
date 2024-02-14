import AuthAPI from "../services/AuthAPI";
import { IBaseState } from "../interfaces/IBaseState";
import { defineStore } from "pinia";
import { AxiosError } from "axios";
export interface IResetPasswordForm {
    token: string | string[];
    username: string;
    email: string;
    new_password: string;
}

export interface IResetPasswordStoreState extends IBaseState {
    res_message: string
}

export const useResetPassword = defineStore({
    id: 'resetPassword',
    state: () : IResetPasswordStoreState => ({
        error: undefined,
        isLoading: false,
        isSuccess: false,
        res_message: ''
    }),
    actions: {
        async changePassword(data : IResetPasswordForm) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await AuthAPI.changePassword(data)).data;
                this.res_message = response.message;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (err : any) {
                
                this.error = err.response?.data.errors;
                this.res_message = err.response?.data.message;
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})