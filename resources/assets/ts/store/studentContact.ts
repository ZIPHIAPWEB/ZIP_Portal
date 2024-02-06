import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";

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

        async loadStudentContactDetails() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.getStudentContact();
                this.contact = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async updateStudentContactDetails(data: IStudentContactInfo) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await StudentAPI.updateContactDetails(data);
                this.contact = data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error: any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})