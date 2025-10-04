import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";
import { AxiosError } from "axios";
import { IActionResult } from "../interfaces/IActionResult";

export interface IStudentPaymentRequirementForm {
    bank_code: string;
    reference_no: string;
    date_deposit: string | Date;
    bank_account_no: string,
    amount: number | string,
    file: any
}

export interface IStudentPaymentRequirement {
    id?: number;
    bank_code: string;
    reference_no: string;
    date_deposit: string | Date;
    bank_account_no: string;
    amount: number | string;
    path: string;
    status: boolean;
    acknowledgement: boolean;
}

export interface IPaymentRequirement {
    id: number;
    name: string;
    description: string;
    program_id: number | string;
    student_payment: IStudentPaymentRequirement | undefined;
    created_at?: string;
    updated_at?: string;
}

export interface PaymentRequirementState {
    isSuccess: boolean;
    isLoading: boolean;
    requirements: IPaymentRequirement[];
    error: string | undefined;
    errors: [];
}

export const useStudentPaymentRequirement = defineStore({
    id: 'paymentRequirementState',
    state: () : PaymentRequirementState => ({
        isSuccess: false,
        isLoading: false,
        error: undefined,
        errors: [],
        requirements: [],
    }),
    getters: {

    },
    actions: {
    async loadStudentPaymentRequirements(): Promise<IActionResult<IPaymentRequirement[]>> {
            try {
                this.isLoading = true;
                const response = await StudentAPI.getPaymentRequirements();
                this.requirements = response.data.data;
                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.requirements };
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: this.error, errors: error.response?.data?.errors };
            }
        },

    async storePaymentRequirement(requirementId: any, data: IStudentPaymentRequirementForm): Promise<IActionResult<any>> {
            try {
                this.isLoading = true;
                const response = await StudentAPI.storePaymentRequirement(requirementId, data);

                this.requirements = this.requirements.map(requirement => {
                    if (requirement.id === requirementId) {
                        requirement.student_payment = response.data.data;
                    }

                    return requirement;
                });

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: response.data };
            } catch (e) {
                const errors = e as AxiosError;
                this.error = errors.response.data.message;
                this.errors = errors.response.data.errors;

                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: this.error, errors: this.errors };
            }
        },

    async removePaymentRequirement(requirementId: any): Promise<IActionResult> {
            try {
                this.isLoading = true;
                await StudentAPI.removePaymentRequirement(requirementId);

                this.requirements = this.requirements.map(requirement => {
                    if (requirement.id === requirementId) {
                        requirement.student_payment = undefined;
                    }

                    return requirement;
                });
                this.isLoading = false;
                this.isSuccess = true;
        return { success: true };
            } catch (e) {
                const errors = e as AxiosError;
                this.error = errors.response.data.message;
                this.errors = errors.response.data.errors;

                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: this.error, errors: this.errors };
            }
        }
    }
});