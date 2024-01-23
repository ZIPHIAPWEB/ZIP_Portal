import SuperadminApi from "../services/SuperadminApi";
import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from '../interfaces/IPagination';
import { defineStore } from "pinia";

export interface ISuperadminStudent {
    user_id: string | number;
    email: string;
    username: string;
    is_verified: boolean;
    is_filled: boolean;
    registered_at: string;
}

export interface ISuperadminStudentState extends IBaseState, IPagination {
    students: ISuperadminStudent[];
}

export const useSuperadminStudent = defineStore({
    id: 'superadminStudent',
    state: () : ISuperadminStudentState => ({
        error: undefined,
        isSuccess: false,
        isLoading: false,
        students: [],
        links: []
    }),
    actions: {
        async deleteSuperadminStudent(userId : number | string) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deleteSuperadminStudent(userId);
                await this.loadSuperadminStudentsData();

                this.isLoading = false;
                this.isSuccess = true;                
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async loadSuperadminStudentsData() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getSuperadminStudents()).data;
                this.students = response.data;
                this.links = response.meta.links;

                this.isLoading = false;
                this.isSuccess = true;                
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async verifyStudent(userId : number | string) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.activateUserAccount(userId)).data;
                await this.loadSuperadminStudentsData();

                this.isLoading = false;
                this.isSuccess = true;                
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },
        async unverifyStudent(userId : number | string) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.deactivateUserAccount(userId)).data;
                await this.loadSuperadminStudentsData();

                this.isLoading = false;
                this.isSuccess = true;                
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
});