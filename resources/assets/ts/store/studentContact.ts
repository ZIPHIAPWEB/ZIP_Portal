import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";
import { IActionResult } from "../interfaces/IActionResult";

export interface IStudentContactInfo {
    provincial_address: string;
    permanent_address: string;
    home_number: string;
    mobile_number: string;
}

export const useStudentContactStore = defineStore({
    id: 'studentContact',
    state: () => ({
        isLoading: false,
        isSuccess: false,
        contact: {} as IStudentContactInfo,
        errors: {} as any
    }),
    getters: {},
    actions: {

    async loadStudentContactDetails(): Promise<IActionResult<IStudentContactInfo>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.getStudentContact();
                this.contact = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.contact };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
        this.errors = error.response?.data?.errors ?? {};
        return { success: false, errors: this.errors, message: error.response?.data?.message ?? 'Failed to load contact details' };
            }
        },

    async updateStudentContactDetails(data: IStudentContactInfo): Promise<IActionResult<IStudentContactInfo>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await StudentAPI.updateContactDetails(data);
                this.contact = data;

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.contact };
            } catch (error: any) {
                this.isLoading = false;
                this.isSuccess = false;
        this.errors = error.response?.data?.errors ?? {};
        return { success: false, errors: this.errors, message: error.response?.data?.message ?? 'Failed to update contact details' };
            }
        }
    }
})