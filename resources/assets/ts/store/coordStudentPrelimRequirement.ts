import { defineStore } from "pinia";
import CoordinatorApi from "../services/CoordinatorApi";
import { useCoordSelectedStudent } from "./coordSelectedStudent";
import { IBasicRequirement } from "./basicRequirement";
import { downloadFile } from "../hooks/useFileDownload";

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
        async loadSelectedStudentPrelimRequirement() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.getSelectedStudentPrelimRequirement(coordSelectedStudent.userInfo.id)).data;
                this.prelimRequirement = response.data;

                this.isLoading = false;
                this.isSuccess = true;                
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async downloadSelectedStudentPrelimRequirement(requirementId : number | string) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.downloadSelectedStudentPrelimRequirement(coordSelectedStudent.userInfo.id, requirementId)).data;
                
                downloadFile(response);

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async removeSelectedStudentPrelimRequirement(requirementId : number | string) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                await CoordinatorApi.removeSelectedStudentPrelimRequirement(coordSelectedStudent.userInfo.id, requirementId);
                
                this.prelimRequirement = this.prelimRequirement.map(rq => {
                    if (requirementId === rq.id) {
                        rq.student_preliminary = undefined;
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