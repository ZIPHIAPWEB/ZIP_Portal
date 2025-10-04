import { defineStore } from 'pinia';
import StudentAPI from '../services/StudentAPI';
import { downloadFile } from '../hooks/useFileDownload';
import { IActionResult } from '../interfaces/IActionResult';

export interface IStudentAdditionalRequirement {
    id?: number;
    status: boolean;
    path: string;
}

export interface IAdditionalRequirement {
    id: number;
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
    async loadStudentAdditionalRequirements(): Promise<IActionResult<IAdditionalRequirement[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.getStudentAdditionalRequirements();
                this.requirements = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.requirements };
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: this.error, errors: error.response?.data?.errors };
            }
        },

    async downloadAdditionalRequirement(requirementId: string | number | undefined): Promise<IActionResult> {
            try {
                this.isLoading = true;
                const response = (await StudentAPI.downloadAdditionalRequirement(requirementId)).data;
                downloadFile(response);
                this.isLoading = false;
        return { success: true };
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: this.error };
            }
        },

    async storeStudentAdditionalRequirement(requirementId: string | number | undefined, file : File): Promise<IActionResult<any>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.storeStudentAdditionalRequirement(requirementId, file);
                this.requirements = this.requirements.map((addReq => {
                    if (addReq.id === requirementId) {
                        addReq.student_additional = response.data.data;
                    }
                    return addReq;
                }));

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: response.data };
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: this.error, errors: error.response?.data?.errors };
            }
        },

    async removeStudentAdditionalRequirement(requirement : IAdditionalRequirement) : Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.deleteStudentAdditionalRequirement(requirement.student_additional?.id);
                
                this.requirements = this.requirements.map(rq => {
                    if (requirement.id === rq.id) {
                        rq.student_additional = undefined;
                    }

                    return rq;
                });

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true };
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: this.error, errors: error.response?.data?.errors };
            }
        }
    }
});