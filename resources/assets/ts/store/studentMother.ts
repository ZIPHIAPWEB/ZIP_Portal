import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";
import { IActionResult } from "../interfaces/IActionResult";

export interface IStudentMother {
    id?: number | string;
    first_name: string;
    middle_name: string;
    last_name: string;
    occupation: string;
    company: string;
    contact_no: string;
}

export const useStudentMotherStore = defineStore({
    id: "studentMother",
    state: () => ({
        isLoading: false,
        isSuccess: false,
        mother: {} as IStudentMother,
        errors: {} as any
    }),
    getters: {},
    actions: {

    async loadStudentMotherDetails(): Promise<IActionResult<IStudentMother>> {
            try {
                this.isLoading = true;
                this.isSuccess = false

                const response = await StudentAPI.getStudentMotherDetails();
                this.mother = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.mother };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
        this.errors = error.response?.data?.errors ?? {};
        return { success: false, errors: this.errors, message: error.response?.data?.message ?? 'Failed to load mother details' };
            }
        },

    async updateMotherDetails(data : IStudentMother): Promise<IActionResult<IStudentMother>> {
            try {
                this.isLoading = true;
                this.isSuccess = false

                await StudentAPI.updateMotherDetails(data);
                this.mother = {...data};

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.mother };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
        this.errors = error.response?.data?.errors ?? {};
        return { success: false, errors: this.errors, message: error.response?.data?.message ?? 'Failed to update mother details' };
            }
        }
    }
})