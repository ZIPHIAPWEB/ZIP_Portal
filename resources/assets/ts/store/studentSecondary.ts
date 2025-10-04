import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";
import { IActionResult } from "../interfaces/IActionResult";

export interface IStudentSecondary {
    id?: number | string;
    school: string;
    address: string;
    start_date: string;
    date_graduated: string;
}

export const useStudentSecondaryStore = defineStore({
    id: 'studentSecondary',
    state: () => ({
        isLoading: false,
        isSuccess: false,
        secondary: {} as IStudentSecondary,
        errors: {} as any
    }),
    getters: {},
    actions: {

    async loadStudentSecondaryDetails(): Promise<IActionResult<IStudentSecondary>> {
            try {
                this.isLoading = true;
                this.isSuccess = false

                const response = await StudentAPI.getStudentSecondaryDetails();
                this.secondary = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.secondary };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
        this.errors = error.response?.data?.errors ?? {};
        return { success: false, message: error.response?.data?.message ?? 'Failed to load secondary details', errors: this.errors };
            }
        },

    async updateSecondaryDetails(data : IStudentSecondary): Promise<IActionResult<IStudentSecondary>> {
            try {
                this.isLoading = true;
                this.isSuccess = false

                await StudentAPI.updateSecondaryDetails(data);
                this.secondary = {...data};

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.secondary };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
        this.errors = error.response?.data?.errors ?? {};
        return { success: false, message: error.response?.data?.message ?? 'Failed to update secondary details', errors: this.errors };
            }
        }
    }
})