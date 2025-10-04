import { defineStore } from "pinia";
import CoordinatorApi from "../services/CoordinatorApi";
import { useCoordSelectedStudent } from "./coordSelectedStudent";
import { IVisaSponsorRequirement } from "./studentVisaSponsorRequirement";
import { downloadFile } from "../hooks/useFileDownload";
import { IActionResult } from "../interfaces/IActionResult";

export interface ICoordStudentVisaSponsorRequirement {
    isSuccess: boolean;
    isLoading: boolean;
    sponsorRequirements: IVisaSponsorRequirement[]
}

export const userCoordStudentVisaSponsorRequirement = defineStore({
    id: 'coordStudentVisaSponsorRequirement',
    state: () : ICoordStudentVisaSponsorRequirement => ({
        isLoading: false,
        isSuccess: false,
        sponsorRequirements: [] as IVisaSponsorRequirement[]
    }),
    getters: {},
    actions: {
    async loadSelectedStudentSponsorRequirement(): Promise<IActionResult<IVisaSponsorRequirement[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.getSelectedStudentVisaSponsorRequirement(coordSelectedStudent.userInfo.id)).data;
                this.sponsorRequirements = response.data;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.sponsorRequirements };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                const message = error.response?.data?.message ?? 'Failed to load requirements';
                const errors = error.response?.data?.errors ?? {};
                return { success: false, message, errors };
            }
        },

    async uploadSelectedStudentVisaSponsorRequirement(requirementId : number | string | undefined, file : File): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                await CoordinatorApi.uploadSelectedStudentVisaSponsorRequirement(coordSelectedStudent.userInfo.id, requirementId, file);
                await this.loadSelectedStudentSponsorRequirement();

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                const message = error.response?.data?.message ?? 'Failed to upload file';
                const errors = error.response?.data?.errors ?? {};
                return { success: false, message, errors };
            }
        },

    async downloadSelectedStudentVisaSponsorRequirement(requirementId : number | string): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.downloadSelectedStudentVisaSponsorRequirement(coordSelectedStudent.userInfo.id, requirementId)).data;
                downloadFile(response); 

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                const message = error.response?.data?.message ?? 'Failed to download file';
                return { success: false, message };
            }
        },

    async removeSelectedStudentVisaSponsorRequirement(requirementId : number | string): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                await CoordinatorApi.removeSelectedStudentVisaSponsorRequirement(coordSelectedStudent.userInfo.id, requirementId);
                this.loadSelectedStudentSponsorRequirement();
                
                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                const message = error.response?.data?.message ?? 'Failed to remove file';
                const errors = error.response?.data?.errors ?? {};
                return { success: false, message, errors };
            }
        }
    }
})