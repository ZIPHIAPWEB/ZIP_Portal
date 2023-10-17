import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";

export interface IVisaSponsor {
    visa_sponsor: string,
    host_company: string,
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
        async loadStudentVisaSponsor() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.getStudentVisaSponsor();
                this.visaSponsor = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})