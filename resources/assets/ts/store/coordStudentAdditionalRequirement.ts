import { defineStore } from "pinia";
import CoordinatorApi from "../services/CoordinatorApi";
import { useCoordSelectedStudent } from "./coordSelectedStudent";
import { IAdditionalRequirement } from "./studentAdditionalRequirement";
import { downloadFile } from "../hooks/useFileDownload";

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
        async loadSelectedStudentAdditionalRequirement() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.getSelectedStudentAdditionalRequirement(coordSelectedStudent.userInfo.id)).data;
                this.additionalRequirement = response.data;

                this.isLoading = false;
                this.isSuccess = true;                
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async uploadSelectedStudentAdditionalRequirement(requirementId : number | string | undefined, file : File) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                await CoordinatorApi.uploadSelectedStudentAdditionalRequirement(coordSelectedStudent.userInfo.id, requirementId, file);
                await this.loadSelectedStudentAdditionalRequirement();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async downloadSelectedStudentAdditionalRequirement(requirementId : number | string) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.downloadSelectedStudentAdditionalRequirement(coordSelectedStudent.userInfo.id, requirementId)).data;
                downloadFile(response);

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async removeSelectedStudentAdditionalRequirement(requirementId : number | string) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                await CoordinatorApi.removeSelectedStudentAdditionalRequirement(coordSelectedStudent.userInfo.id, requirementId);
                await this.loadSelectedStudentAdditionalRequirement();
                
                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})