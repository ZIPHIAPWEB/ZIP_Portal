import { defineStore } from "pinia";
import CoordinatorApi from "../services/CoordinatorApi";
import { useCoordSelectedStudent } from "./coordSelectedStudent";
import { IBasicRequirement } from "./basicRequirement";
import { downloadFile } from "../hooks/useFileDownload";
import { IActionResult } from "../interfaces/IActionResult";

export interface ICoordStudentPrelimRequirement {
    isSuccess: boolean;
    isLoading: boolean;
    prelimRequirement: IBasicRequirement[]
}

export const userCoordStudentPrelimRequirement = defineStore({
    id: 'coordStudentPrelimRequirement',
    state: () : ICoordStudentPrelimRequirement => ({
        isLoading: false,
        isSuccess: false,
        prelimRequirement: [] as IBasicRequirement[]
    }),
    getters: {},
    actions: {
    async loadSelectedStudentPrelimRequirement(): Promise<IActionResult<IBasicRequirement[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.getSelectedStudentPrelimRequirement(coordSelectedStudent.userInfo.id)).data;
                this.prelimRequirement = response.data;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.prelimRequirement };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                const message = error.response?.data?.message ?? 'Failed to load requirements';
                const errors = error.response?.data?.errors ?? {};
                return { success: false, message, errors };
            }
        },

    async uploadSelectedStudentPrelimRequirement(requirementId : number | string | undefined, file : File): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                await CoordinatorApi.uploadSelectedStudentPrelimRequirement(coordSelectedStudent.userInfo.id, requirementId, file);
                await this.loadSelectedStudentPrelimRequirement();

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

    async downloadSelectedStudentPrelimRequirement(requirementId : number | string): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.downloadSelectedStudentPrelimRequirement(coordSelectedStudent.userInfo.id, requirementId)).data;
                
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

    async removeSelectedStudentPrelimRequirement(requirementId : number | string): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                await CoordinatorApi.removeSelectedStudentPrelimRequirement(coordSelectedStudent.userInfo.id, requirementId);
                await this.loadSelectedStudentPrelimRequirement();
                
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