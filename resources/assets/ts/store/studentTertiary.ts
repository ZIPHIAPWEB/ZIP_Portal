import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";
import { IActionResult } from "../interfaces/IActionResult";

export interface IStudentTertiary {
    id?: string;
    school: string;
    address: string;
    degree: string | number;
    start_date: string;
    date_graduated: string;
    school_id: number | string;
}

export const useStudentTertiaryStore = defineStore({
    id: 'studentTertiary',
    state: () => ({
        isLoading: false,
        isSuccess: false,
        tertiary: {} as IStudentTertiary,
        errors: {} as any
    }),
    getters: {},
    actions: {

    async loadStudentTertiaryDetails(): Promise<IActionResult<IStudentTertiary>> {

            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.getStudentTertiaryDetails();
                this.tertiary = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.tertiary };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
        this.errors = error.response?.data?.errors ?? {};
        return { success: false, errors: this.errors, message: error.response?.data?.message ?? 'Failed to load tertiary details' };
            }
        },

    async updateStudentTertiaryDetails(data: IStudentTertiary): Promise<IActionResult<IStudentTertiary>> {

            try {
                this.isLoading = true;
                this.isSuccess = false;

                await StudentAPI.updateTertiaryDetails(data);
                this.tertiary = {...data};

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.tertiary };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
        this.errors = error.response?.data?.errors ?? {};
        return { success: false, errors: this.errors, message: error.response?.data?.message ?? 'Failed to update tertiary details' };
            }
        }
    }
})