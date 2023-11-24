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
        async loadSelectedStudentAdditionalRequirement() {
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

        async downloadSelectedStudentAdditionalRequirement(requirementId : number | string) {
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

        async removeSelectedStudentAdditionalRequirement(requirementId : number | string) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                await CoordinatorApi.removeSelectedStudentVisaSponsorRequirement(coordSelectedStudent.userInfo.id, requirementId);
                
                this.sponsorRequirements = this.sponsorRequirements.map(rq => {
                    if (requirementId === rq.id) {
                        rq.student_visa = undefined;
                    }

                    return rq;
                });
                
                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})