import { defineStore } from "pinia";
import CoordinatorApi from "../services/CoordinatorApi";
import { useCoordSelectedStudent } from "./coordSelectedStudent";
import { IVisaSponsorRequirement } from "./studentVisaSponsorRequirement";
import { downloadFile } from "../hooks/useFileDownload";

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
        async loadSelectedStudentSponsorRequirement() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.getSelectedStudentVisaSponsorRequirement(coordSelectedStudent.userInfo.id)).data;
                this.sponsorRequirements = response.data;

                this.isLoading = false;
                this.isSuccess = true;                
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async uploadSelectedStudentVisaSponsorRequirement(requirementId : number | string | undefined, file : File) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                await CoordinatorApi.uploadSelectedStudentVisaSponsorRequirement(coordSelectedStudent.userInfo.id, requirementId, file);
                await this.loadSelectedStudentSponsorRequirement();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async downloadSelectedStudentVisaSponsorRequirement(requirementId : number | string) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.downloadSelectedStudentVisaSponsorRequirement(coordSelectedStudent.userInfo.id, requirementId)).data;
                downloadFile(response); 

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async removeSelectedStudentVisaSponsorRequirement(requirementId : number | string) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                await CoordinatorApi.removeSelectedStudentVisaSponsorRequirement(coordSelectedStudent.userInfo.id, requirementId);
                this.loadSelectedStudentSponsorRequirement();
                
                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})