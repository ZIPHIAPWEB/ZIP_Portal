import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";
import { IActionResult } from "../interfaces/IActionResult";

export interface IStudentPersonalInfo {
    id?: string | number;
    first_name: string;
    middle_name?: string;
    last_name: string;
    gender: string;
    birthdate: Date | string;
    fb_email: string;
    skype_id: string;
}

export const useStudentPersonal = defineStore({
    id: 'studentPersonal',
    state: () => ({
        isLoading: false,
        isSuccess: false,
        personal: {} as IStudentPersonalInfo,
        errors: {} as any
    }),
    getters: {
        getFullname({ personal, isLoading }) {
            if (isLoading) {
                return '';
            }

            return `${personal.first_name} ${personal.last_name}`
        }
    },
    actions: {
        
    async loadStudentPersonalDetails(): Promise<IActionResult<IStudentPersonalInfo>> {
            try {
                this.isLoading = true;
                
                const response = await StudentAPI.getStudentPersonal();
                this.personal = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.personal };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
        this.errors = error.response?.data?.errors ?? {};
        return { success: false, message: error.response?.data?.message ?? 'Failed to load personal details', errors: this.errors };
            }
        },

    async updateStudentPersonalDetails(data: IStudentPersonalInfo): Promise<IActionResult<IStudentPersonalInfo>> {
            try {
                this.isLoading = true;

                await StudentAPI.updatePersonalDetails(data);
                this.personal = {...data};
                
                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.personal };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
        this.errors = error.response?.data?.errors ?? {};
        return { success: false, message: error.response?.data?.message ?? 'Failed to update personal details', errors: this.errors };
            }
        }
    }
});