import { defineStore } from "pinia";
import CoordinatorApi from "../services/CoordinatorApi";
import { useCoordSelectedStudent } from "./coordSelectedStudent";
import { IAdditionalRequirement } from "./studentAdditionalRequirement";
import { downloadFile } from "../hooks/useFileDownload";
import { IActionResult } from "../interfaces/IActionResult";

export interface ICoordStudentAdditionalRequirement {
    isSuccess: boolean;
    isLoading: boolean;
    additionalRequirement: IAdditionalRequirement[]
}

export const userCoordStudentAdditionalRequirement = defineStore({
    id: 'coordStudentAdditionalRequirement',
    state: () : ICoordStudentAdditionalRequirement => ({
        isLoading: false,
        isSuccess: false,
        additionalRequirement: [] as IAdditionalRequirement[]
    }),
    getters: {},
    actions: {
    async loadSelectedStudentAdditionalRequirement(): Promise<IActionResult<IAdditionalRequirement[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.getSelectedStudentAdditionalRequirement(coordSelectedStudent.userInfo.id)).data;
                this.additionalRequirement = response.data;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.additionalRequirement };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                const message = error.response?.data?.message ?? 'Failed to load requirements';
                const errors = error.response?.data?.errors ?? {};
                return { success: false, message, errors };
            }
        },

    async uploadSelectedStudentAdditionalRequirement(requirementId : number | string | undefined, file : File): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                await CoordinatorApi.uploadSelectedStudentAdditionalRequirement(coordSelectedStudent.userInfo.id, requirementId, file);
                await this.loadSelectedStudentAdditionalRequirement();

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

    async downloadSelectedStudentAdditionalRequirement(requirementId : number | string): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.downloadSelectedStudentAdditionalRequirement(coordSelectedStudent.userInfo.id, requirementId)).data;
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

    async removeSelectedStudentAdditionalRequirement(requirementId : number | string): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                await CoordinatorApi.removeSelectedStudentAdditionalRequirement(coordSelectedStudent.userInfo.id, requirementId);
                await this.loadSelectedStudentAdditionalRequirement();
                
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