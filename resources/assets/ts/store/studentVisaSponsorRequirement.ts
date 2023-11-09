import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";

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
        async loadVisaSponsorRequirements() {
            try {
                this.isLoading = true;
                this.isSuccess= false;

                const response = await StudentAPI.getStudentVisaSponsorRequirements();
                this.requirements = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async downloadVisaSponsorRequirement(requirementId: string | number | undefined) {
            try {
                this.isLoading = true;
                await StudentAPI.downloadVisaSponsorRequirement(requirementId);
                this.isLoading = false;
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async storeVisaSponsorRequirement(requirementId: string | number | undefined, file : File) : Promise<void> {
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
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
                return error.response.data;
            }
        },

        async deleteVisaSponsorRequirement(requirement : IVisaSponsorRequirement) : Promise<void> {
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
            } catch (error : any) {

                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
                return error.response.data;
            }
        }
    }
});