import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";

export interface IStudentBasicRequirement {
    id?: number;
    status: boolean;
    path: string;
}

export interface IBasicRequirement {
    id?: number;
    name: string;
    description: string;
    program_id: number | string;
    student_preliminary: IStudentBasicRequirement | undefined;
    created_at?: string;
    updated_at?: string;
    path?: string;
}

export interface IStudentBasicRequirementState {
    isSuccess: boolean;
    isLoading: boolean;
    requirements: IBasicRequirement[];
    error: string | undefined;
}

export const useStudentBasicRequirement = defineStore({
    id: 'studentBasicRequirement',
    state: () : IStudentBasicRequirementState => ({
        isSuccess: false,
        isLoading: false,
        error: undefined,
        requirements: [],
    }),
    getters: {
        
    },
    actions: {
        async loadStudentBasicRequirements() {
            try {
                this.isLoading = true;
                const response = await StudentAPI.getStudentBasicRequirements();
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