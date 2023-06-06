import { defineStore } from 'pinia';
import StudentAPI from '../services/StudentAPI';

export interface IStudentAdditionalRequirement {
    id?: number;
    status: boolean;
    path: string;
}

export interface IAdditionalRequirement {
    id?: number;
    name: string;
    description: string;
    program_id: number | string;
    student_additional: IStudentAdditionalRequirement | undefined;
    created_at?: string;
    updated_at?: string;
    path?: string;
}

export interface IStudentAdditionalRequirementState {
    isSuccess: boolean;
    isLoading: boolean;
    error: string | undefined;
    requirements: IAdditionalRequirement[];
}

export const useStudentAdditionalRequirement = defineStore({
    id: 'studentAdditionalRequirement',
    state: () : IStudentAdditionalRequirementState => ({
        isSuccess: false,
        isLoading: false,
        error: undefined,
        requirements: [],
    }),
    getters: {

    },
    actions: {
        async loadStudentAdditionalRequirements() {
            try {
                this.isLoading = true;
                const response = await StudentAPI.getStudentAdditionalRequirements();
                this.requirements = response.data.data;
                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
            }
        },


    }
});