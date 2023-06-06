import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";

export interface IStudentVisaSponsorRequirement {
    id?: number;
    status: boolean;
    path: string;
}

export interface IVisaSponsorRequirement {
    id?: number;
    name: string;
    description: string;
    program_id: number | string;
    student_visa: IStudentVisaSponsorRequirement;
    created_at?: string;
    updated_at?: string;
    path?: string;
}

export interface IStudentVisaSponsorRequirementState {
    isSuccess: boolean;
    isLoading: boolean;
    error: string | undefined;
    requirements: IVisaSponsorRequirement[];
}

export const useStudentVisaSponsorRequirement = defineStore({
    id: 'studentVisaRequirement',
    state: () :IStudentVisaSponsorRequirementState => ({
        isSuccess: false,
        isLoading: false,
        error: undefined,
        requirements: [],
    }),
    getters: {

    },
    actions: {
        async loadVisaSponsorRequirements() {
            try {
                this.isLoading = true;
                const response = await StudentAPI.getStudentVisaSponsorRequirements();
                this.requirements = response.data.data;
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