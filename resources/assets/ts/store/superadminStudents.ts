import SuperadminApi from "../services/SuperadminApi";
import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from '../interfaces/IPagination';
import { defineStore } from "pinia";
import { IActionResult } from "../interfaces/IActionResult";

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
    async deleteSuperadminStudent(userId : number | string): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deleteSuperadminStudent(userId);
                await this.loadSuperadminStudentsData();

                this.isLoading = false;
                this.isSuccess = true;                
                return { success: true };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to delete student', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async searchSuperaminStudentData(searchData : string): Promise<IActionResult<ISuperadminStudent[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getSearchStudentByUsername(searchData)).data;
                this.students = response.data;
                this.links = response.meta.links;

                this.isLoading = false;
                this.isSuccess = true;                
                return { success: true, data: this.students };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to search students', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async loadSuperadminStudentsData(): Promise<IActionResult<ISuperadminStudent[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getSuperadminStudents()).data;
                this.students = response.data;
                this.links = response.meta.links;

                this.isLoading = false;
                this.isSuccess = true;                
                return { success: true, data: this.students };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to load students', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async verifyStudent(userId : number | string): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.activateUserAccount(userId)).data;
                await this.loadSuperadminStudentsData();

                this.isLoading = false;
                this.isSuccess = true;                
                return { success: true };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to verify student', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async unverifyStudent(userId : number | string): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.deactivateUserAccount(userId)).data;
                await this.loadSuperadminStudentsData();

                this.isLoading = false;
                this.isSuccess = true;                
                return { success: true };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to unverify student', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async resetAccountPassword(userId : number | string): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.resetUserPassword(userId)).data;
                await this.loadSuperadminStudentsData();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                return { success: false, message: error?.response?.data?.message ?? 'Failed to reset password', errors: error?.response?.data?.errors ?? {} };
            }
        }
    }
});