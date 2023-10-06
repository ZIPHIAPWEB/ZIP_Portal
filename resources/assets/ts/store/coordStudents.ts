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

export interface ICoordStudentLinks {
    active: boolean,
    label: string,
    url: string
}

export interface ICoordStudentState {
    isSuccess: boolean,
    isLoading: boolean,
    error: string | undefined,
    students: ICoordinatorStudent[],
    pagination: ICoordStudentLinks[]
}

export const useCoordStudent = defineStore({
    id: 'coordinatorStudent',
    state: () : ICoordStudentState => ({
        isSuccess: false,
        isLoading: false,
        error: undefined,
        students: [],
        pagination: []
    }),
    getters: {},
    actions: {
        async exportCoordStudentsData() {
            
        },

        async loadCoordStudentsData(program : string | string[]) {
            try {
                this.isLoading = true;
                this.isSuccess = false;
                
                const response = await CoordinatorApi.getCoordStudents(program);
                this.students = response.data.data;
                this.pagination = response.data.meta.links;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async filterCoordStudentsData(program : string | string[], from : string, to : string, status : string) {
            try {
                this.isLoading = true;
                this.isSuccess = false;
                
                const response = await CoordinatorApi.getFilteredCoordStudents(program, from, to, status);
                this.students = response.data.data;
                this.pagination = response.data.meta.links;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        
        async loadPaginatedStudentsData(page : number, program : string | string[], from : string, to : string, status : string) {
            try {
                this.isLoading = true;
                this.isSuccess = false;
                
                const response = await CoordinatorApi.getPaginatedResult(page, program, from, to, status);
                this.students = response.data.data;
                this.pagination = response.data.meta.links;

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