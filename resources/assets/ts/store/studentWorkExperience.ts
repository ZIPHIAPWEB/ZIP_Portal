import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";
import { IActionResult } from "../interfaces/IActionResult";

export interface IStudentWorkExperience {
    id?: string | number;
    company: string;
    address: string;
    start_date: string;
    end_date: string;
    description: string;   
}

export const useStudentWorkExperienceStore = defineStore({
    id: 'studentWorkExperience',
    state: () => ({
      isLoading: false,
      isSuccess: false,
      experiences: [] as IStudentWorkExperience[],
      errors: {} as any
    }),
    getters: {},
    actions: {

    async loadWorkExperiences(): Promise<IActionResult<IStudentWorkExperience[]>> {

            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.getStudentExperienceDetails();
                this.experiences = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.experiences };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
        this.errors = error.response?.data?.errors ?? {};
        return { success: false, errors: this.errors, message: error.response?.data?.message ?? 'Failed to load experiences' };
            }
        },

    async storeWorkExperience(data: IStudentWorkExperience): Promise<IActionResult<IStudentWorkExperience>> {

            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.storeWorkExperience(data);
                this.experiences.unshift(response.data.data);

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: response.data.data };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
        this.errors = error.response?.data?.errors ?? {};
        return { success: false, errors: this.errors, message: error.response?.data?.message ?? 'Failed to store experience' };
            }
        },

    async updateWorkExperience(data: IStudentWorkExperience): Promise<IActionResult<IStudentWorkExperience>> {

            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.updateWorkExperience(data);
                this.experiences.map((e) => {
                    if (data.id === e.id) {
                        e = response.data.data;
                    }
                });

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: response.data.data };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
        this.errors = error.response?.data?.errors ?? {};
        return { success: false, errors: this.errors, message: error.response?.data?.message ?? 'Failed to update experience' };
            }
        },

    async deleteWorkExperience(data: IStudentWorkExperience): Promise<IActionResult> {

            try {
                this.isLoading = true;
                this.isSuccess = false;

                await StudentAPI.deleteWorkExperience(data.id);
                this.experiences = this.experiences.filter(e => e.id !== data.id);

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
        this.errors = error.response?.data?.errors ?? {};
        return { success: false, errors: this.errors, message: error.response?.data?.message ?? 'Failed to delete experience' };
            }
        }
    }
})