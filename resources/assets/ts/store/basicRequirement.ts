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
        },

        async storeStudentBasicRequirement(requirementId: string | number | undefined, file : File) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.storeStudentBasicRequirement(requirementId, file);
                
                this.requirements = this.requirements.map(requirement => {
                    if (requirement.id === requirementId) {
                        requirement.student_preliminary = response.data.data;
                    }

                    return requirement;
                });

                this.isLoading = false;
                this.isSuccess = true;
                return response.data;
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
                return error.response.data;
            }
        },

        async removeStudentBasicRequirement(requirement : IBasicRequirement) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.deleteStudentBasicRequirement(requirement.student_preliminary?.id);
                
                this.requirements = this.requirements.map(rq => {
                    if (requirement.id === rq.id) {
                        rq.student_preliminary = undefined;
                    }

                    return rq;
                });

                this.isLoading = false;
                this.isSuccess = true;
                return response.data;
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
                return error.response.data;
            }
        }
    }
});