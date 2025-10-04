import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";
import { downloadFile } from "../hooks/useFileDownload";
import { IActionResult, IActionResultVoid } from "../interfaces/IActionResult";

export interface IStudentVisaSponsorRequirement {
    id?: number;
    status: boolean;
    path: string;
}

export interface IVisaSponsorRequirement {
    id: number;
    name: string;
    description: string;
    program_id: number | string;
    student_visa: IStudentVisaSponsorRequirement | undefined;
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
    async loadVisaSponsorRequirements(): Promise<IActionResult<IVisaSponsorRequirement[]>> {
            try {
                this.isLoading = true;
                this.isSuccess= false;

                const response = await StudentAPI.getStudentVisaSponsorRequirements();
                this.requirements = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.requirements };
            } catch (error : any) {
        this.error = error?.response?.data?.message;
        this.isLoading = false;
        this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to load requirements', errors: error?.response?.data?.errors ?? {} };
            }
        },

    async downloadVisaSponsorRequirement(requirementId: string | number | undefined): Promise<IActionResultVoid> {
            try {
                this.isLoading = true;
                const response = (await StudentAPI.downloadVisaSponsorRequirement(requirementId)).data;
                downloadFile(response);
                this.isLoading = false;
        return { success: true };
            } catch (error : any) {
        this.error = error?.response?.data?.message;
        this.isLoading = false;
        this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to download file', errors: error?.response?.data?.errors ?? {} };
            }
        },

    async storeVisaSponsorRequirement(requirementId: string | number | undefined, file : File) : Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.storeStudentVisaSponsorRequirement(requirementId, file);
                this.requirements = this.requirements.map((requirement) => {
                    if (requirement.id === requirementId) {
                        requirement.student_visa = response.data.data;
                    }

                    return requirement;
                });

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: response.data.data };
            } catch (error : any) {
        this.error = error?.response?.data?.message;
        this.isLoading = false;
        this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to upload file', errors: error?.response?.data?.errors ?? {} };
            }
        },

    async deleteVisaSponsorRequirement(requirement : IVisaSponsorRequirement) : Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.deleteStudentVisaSponsorRequirement(requirement.student_visa?.id);
                this.requirements = this.requirements.map((req) => {
                    if (req.id === requirement.id) {
                        req.student_visa = undefined;
                    }

                    return req;
                });

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true };
            } catch (error : any) {
        this.error = error?.response?.data?.message;
        this.isLoading = false;
        this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to delete file', errors: error?.response?.data?.errors ?? {} };
            }
        }
    }
});