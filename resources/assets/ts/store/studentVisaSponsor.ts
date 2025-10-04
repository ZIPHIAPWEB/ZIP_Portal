import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";
import { IActionResult } from "../interfaces/IActionResult";

export interface IVisaSponsor {
    visa_sponsor: string,
    visa_sponsor_id: string | number,
    host_company: string,
    host_company_id: string | number,
    housing_address: string,
    position: string,
    stipend: string | number,
    start_date: string | Date,
    formatted_start_date: string | Date,
    end_date: string | Date,
    formatted_end_date: string | Date
}

export interface IStudentVisaSponsorState {
    isSuccess: boolean;
    isLoading: boolean;
    visaSponsor: IVisaSponsor | undefined,
    error: string | undefined
}

export const useStudentVisaSponsor = defineStore({
    id: 'studentVisaSponsor',
    state: () : IStudentVisaSponsorState => ({
        isSuccess: false,
        isLoading: false,
        visaSponsor: {} as IVisaSponsor,
        error: undefined
    }),
    getters : {

    },
    actions: {
    async loadStudentVisaSponsor(): Promise<IActionResult<IVisaSponsor>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.getStudentVisaSponsor();
                this.visaSponsor = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.visaSponsor };
            } catch (error: any) {
                this.error = error.response?.data?.message ?? 'Failed to load visa sponsor';
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error.response?.data?.message ?? 'Failed to load visa sponsor', errors: error.response?.data?.errors ?? {} };
            }
        }
    }
})