import { defineStore } from "pinia";
import { IStudentPersonalInfo } from "./studentPersonal";
import { IStudentContactInfo } from "./studentContact";
import { IStudentTertiary } from "./studentTertiary";
import { IStudentSecondary } from "./studentSecondary";
import { IStudentFather } from "./studentFather";
import { IStudentMother } from "./studentMother";
import { IStudentWorkExperience } from "./studentWorkExperience";
import CoordinatorApi from "../services/CoordinatorApi";
import { IActionResult } from "../interfaces/IActionResult";

export interface IUserInfo {
    id: string | number;
    username: string;
    email: string;
    profile_picture: string;
    is_verified: string;
    is_filled: string;
    date_registered: string;
    application_status: string;
    application_id: string;
    program: string;
    program_compliance: string;
}

export interface ICoordSelectedStudentState {
    isSuccess: boolean;
    isLoading: boolean;
    error: undefined;
    userInfo: IUserInfo;
    personal: IStudentPersonalInfo;
    contact: IStudentContactInfo;
    tertiary: IStudentTertiary;
    secondary: IStudentSecondary;
    father: IStudentFather;
    mother: IStudentMother;
    experiences: IStudentWorkExperience[]
}

export const useCoordSelectedStudent = defineStore({
    id: 'coordSelectedStudent',
    state: () : ICoordSelectedStudentState => ({
        isSuccess: false,
        isLoading: false,
        error: undefined,
        userInfo: {} as IUserInfo,
        personal: {} as IStudentPersonalInfo,
        contact: {} as IStudentContactInfo,
        tertiary: {} as IStudentTertiary,
        secondary: {} as IStudentSecondary,
        father: {} as IStudentFather,
        mother: {} as IStudentMother,
        experiences: []
    }),
    actions: {
    async loadSelectedStudent(userId : number | string): Promise<IActionResult<any>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;
                
                const response = await CoordinatorApi.getSelectedStudent(userId);
                this.userInfo = response.data.data.user;
                this.personal = response.data.data.personal;
                this.contact = response.data.data.contact;
                this.tertiary = response.data.data.tertiary;
                this.secondary = response.data.data.secondary;
                this.father = response.data.data.father;
                this.mother = response.data.data.mother;
                this.experiences = response.data.data.experiences;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: response.data.data };
            } catch (error : any) {
                this.error = error.response?.data?.message ?? 'Failed to load student';
                this.isLoading = false;
                this.isSuccess = false;
                const message = error.response?.data?.message ?? 'Failed to load student';
                const errors = error.response?.data?.errors ?? {};
                return { success: false, message, errors };
            }
        },

    async updateProgramInfo(programId : number | string): Promise<IActionResult<any>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;
                
                const response = await CoordinatorApi.updateStudentProgram(this.userInfo.id, programId);
                this.userInfo.program = response.data.data.program;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.userInfo };
            } catch (error : any) {
                this.error = error.response?.data?.message ?? 'Failed to update program';
                this.isLoading = false;
                this.isSuccess = false;
                const message = error.response?.data?.message ?? 'Failed to update program';
                const errors = error.response?.data?.errors ?? {};
                return { success: false, message, errors };
            }
        },

    async updateProgramCompliance(status : string): Promise<IActionResult<any>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await CoordinatorApi.updateStudentProgramCompliance(this.userInfo.id, status)).data;
                this.userInfo.program_compliance = response.data;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.userInfo };
            } catch (error : any) {
                this.error = error.response?.data?.message ?? 'Failed to update program compliance';
                this.isLoading = false;
                this.isSuccess = false;
                const message = error.response?.data?.message ?? 'Failed to update program compliance';
                const errors = error.response?.data?.errors ?? {};
                return { success: false, message, errors };
            }
        },

    async updateProgramStatus(status : string): Promise<IActionResult<any>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await CoordinatorApi.updateStudentProgramStatus(this.userInfo.id, status);
                this.userInfo.application_status = response.data.data.application_status;

                if (status == 'Confirmed') {
                    
                    this.userInfo.application_id = response.data.data.application_id;
                }

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.userInfo };
            } catch (error : any) {
                this.error = error.response?.data?.message ?? 'Failed to update program status';
                this.isLoading = false;
                this.isSuccess = false;
                const message = error.response?.data?.message ?? 'Failed to update program status';
                const errors = error.response?.data?.errors ?? {};
                return { success: false, message, errors };
            }
        },

    async cancelStudentProgram(reason : string): Promise<IActionResult<any>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await CoordinatorApi.cancelStudentStatus(this.userInfo.id, reason)).data;
                this.userInfo.application_status = response.application_status;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.userInfo };
            } catch (error : any) {
                this.error = error.response?.data?.message ?? 'Failed to cancel program';
                this.isLoading = false;
                this.isSuccess = false;
                const message = error.response?.data?.message ?? 'Failed to cancel program';
                const errors = error.response?.data?.errors ?? {};
                return { success: false, message, errors };
            }
        }
    }
})