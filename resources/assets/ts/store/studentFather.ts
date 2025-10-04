import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";
import { IActionResult } from "../interfaces/IActionResult";

export interface IStudentFather {
    id?: number | string;
    first_name: string;
    middle_name: string;
    last_name: string;
    occupation: string;
    company: string;
    contact_no: string;
}

export const useStudentFatherStore = defineStore({
    id: "studentFather",
    state: () => ({
        isLoading: false,
        isSuccess: false,
        father: {} as IStudentFather,
        errors: {} as any
    }),
    getters: {},
    actions: {

    async loadStudentFatherDetails(): Promise<IActionResult<IStudentFather>> {
            try {
                this.isLoading = true;
                this.isSuccess = false

                const response = await StudentAPI.getStudentFatherDetails();
                this.father = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.father };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
        this.errors = error.response?.data?.errors ?? {};
        return { success: false, errors: this.errors, message: error.response?.data?.message ?? 'Failed to load father details' };
            }
        },

    async updateFatherDetails(data : IStudentFather): Promise<IActionResult<IStudentFather>> {
            try {
                this.isLoading = true;
                this.isSuccess = false

                await StudentAPI.updateFatherDetails(data);
                this.father = {...data};

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.father };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
        this.errors = error.response?.data?.errors ?? {};
        return { success: false, errors: this.errors, message: error.response?.data?.message ?? 'Failed to update father details' };
            }
        }
    }
})