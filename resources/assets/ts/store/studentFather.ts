import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";

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

        async loadStudentFatherDetails() {
            try {
                this.isLoading = true;
                this.isSuccess = false

                const response = await StudentAPI.getStudentFatherDetails();
                this.father = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async updateFatherDetails(data : IStudentFather) {
            try {
                this.isLoading = true;
                this.isSuccess = false

                await StudentAPI.updateFatherDetails(data);
                this.father = {...data};

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})