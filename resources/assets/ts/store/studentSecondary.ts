import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";

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

        async loadStudentSecondaryDetails() {
            try {
                this.isLoading = true;
                this.isSuccess = false

                const response = await StudentAPI.getStudentSecondaryDetails();
                this.secondary = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async updateSecondaryDetails(data : IStudentSecondary) {
            try {
                this.isLoading = true;
                this.isSuccess = false

                await StudentAPI.updateSecondaryDetails(data);
                this.secondary = {...data};

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})