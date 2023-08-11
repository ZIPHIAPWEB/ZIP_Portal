import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";

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
        
        async loadStudentPersonalDetails() {
            try {
                this.isLoading = true;
                
                const response = await StudentAPI.getStudentPersonal();
                this.personal = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async updateStudentPersonalDetails(data: IStudentPersonalInfo) {
            try {
                this.isLoading = true;

                await StudentAPI.updatePersonalDetails(data);
                this.personal = {...data};
                
                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
});