import { defineStore } from "pinia";
import { IStudentPersonalInfo } from "./studentPersonal";
import { IStudentContactInfo } from "./studentContact";
import { IStudentTertiary } from "./studentTertiary";
import { IStudentSecondary } from "./studentSecondary";
import { IStudentFather } from "./studentFather";
import { IStudentMother } from "./studentMother";
import { IStudentWorkExperience } from "./studentWorkExperience";
import CoordinatorApi from "../services/CoordinatorApi";

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
        async loadSelectedStudent(userId : number | string) {
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
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async updateProgramInfo(programId : number | string) {
            try {
                this.isLoading = true;
                this.isSuccess = false;
                
                const response = await CoordinatorApi.updateStudentProgram(this.userInfo.id, programId);
                this.userInfo.program = response.data.data.program;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async updateProgramCompliance(status : string) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await CoordinatorApi.updateStudentProgramCompliance(this.userInfo.id, status)).data;
                this.userInfo.program_compliance = response.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async updateProgramStatus(status : string) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await CoordinatorApi.updateStudentProgramStatus(this.userInfo.id, status);
                this.userInfo.application_status = response.data.data.application_status;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async cancelStudentProgram(reason : string) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await CoordinatorApi.cancelStudentStatus(this.userInfo.id, reason)).data;
                this.userInfo.application_status = response.application_status;

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