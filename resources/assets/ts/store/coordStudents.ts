import { defineStore } from "pinia";
import CoordinatorApi from "../services/CoordinatorApi";
import { IActionResult } from "../interfaces/IActionResult";

export interface ICoordinatorStudent {
    id: number | string,
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
    async searchStudentData(program : string | string[], toBeSearch : string): Promise<IActionResult<ICoordinatorStudent[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;
                
                const response = (await CoordinatorApi.getSearchStudentLastName(program, toBeSearch)).data;
                this.students = response.data;
                this.pagination = response.meta.links;
                
                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.students };
            } catch (error : any) {
                this.error = error.response?.data?.message ?? 'Failed to search students';
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: this.error, errors: error.response?.data?.errors ?? {} };
            }
        },
    async loadCoordStudentsData(program : string | string[]): Promise<IActionResult<ICoordinatorStudent[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;
                
                const response = await CoordinatorApi.getCoordStudents(program);
                this.students = response.data.data;
                this.pagination = response.data.meta.links;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.students };
            } catch (error : any) {
                this.error = error.response?.data?.message ?? 'Failed to load students';
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: this.error, errors: error.response?.data?.errors ?? {} };
            }
        },

    async filterCoordStudentsData(program : string | string[], from : string, to : string, status : string): Promise<IActionResult<ICoordinatorStudent[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;
                
                const response = await CoordinatorApi.getFilteredCoordStudents(program, from, to, status);
                this.students = response.data.data;
                this.pagination = response.data.meta.links;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.students };
            } catch (error : any) {
                this.error = error.response?.data?.message ?? 'Failed to filter students';
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: this.error, errors: error.response?.data?.errors ?? {} };
            }
        },
        
    async loadPaginatedStudentsData(page : number, program : string | string[], from : string, to : string, status : string): Promise<IActionResult<ICoordinatorStudent[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;
                
                const response = await CoordinatorApi.getPaginatedResult(page, program, from, to, status);
                this.students = response.data.data;
                this.pagination = response.data.meta.links;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.students };
            } catch (error : any) {
                this.error = error.response?.data?.message ?? 'Failed to load paginated students';
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: this.error, errors: error.response?.data?.errors ?? {} };
            }
        }
    }
});