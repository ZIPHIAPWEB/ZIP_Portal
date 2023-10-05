import { defineStore } from "pinia";
import CoordinatorApi from "../services/CoordinatorApi";

export interface ICoordinatorStudent {
    id?: number | string,
    date_of_application: string,
    application_status: string,
    email: string,
    first_name: string,
    middle_name: string,
    last_name: string,
    contact_no: string | number,
    school: string,
    program: string,
    recent_action: string
}

export interface ICoordStudentState {
    isSuccess: boolean,
    isLoading: boolean,
    error: string | undefined,
    students: ICoordinatorStudent[]
}

export const useCoordStudent = defineStore({
    id: 'coordinatorStudent',
    state: () : ICoordStudentState => ({
        isSuccess: false,
        isLoading: false,
        error: undefined,
        students: []
    }),
    getters: {},
    actions: {
        async loadCoordStudentsData() {
            try {
                this.isLoading = true;
                this.isSuccess = false;
                
                const response = await CoordinatorApi.getCoordStudents();
                this.students = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
});