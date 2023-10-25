import { defineStore } from "pinia";
import CoordinatorApi from "../services/CoordinatorApi";
import { useCoordSelectedStudent } from "./coordSelectedStudent";
import { IAdditionalRequirement } from "./studentAdditionalRequirement";

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

        async downloadSelectedStudentAdditionalRequirement(requirementId : number | string) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                await CoordinatorApi.downloadSelectedStudentAdditionalRequirement(coordSelectedStudent.userInfo.id, requirementId);

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
                
                this.additionalRequirement = this.additionalRequirement.map(rq => {
                    if (requirementId === rq.id) {
                        rq.student_additional = undefined;
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