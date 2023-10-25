import { defineStore } from "pinia";
import CoordinatorApi from "../services/CoordinatorApi";
import { useCoordSelectedStudent } from "./coordSelectedStudent";
import { IPaymentRequirement } from "./paymentRequirement";

export interface ICoordStudentPaymentRequirement {
    isSuccess: boolean;
    isLoading: boolean;
    paymentRequirements: IPaymentRequirement[]
}

export const useCoordStudentPaymentRequirement = defineStore({
    id: 'coordStudentPaymentRequirement',
    state: () : ICoordStudentPaymentRequirement => ({
        isLoading: false,
        isSuccess: false,
        paymentRequirements: [] as IPaymentRequirement[]
    }),
    getters: {},
    actions: {
        async loadSelectedStudentAdditionalRequirement() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.getSelectedStudentPaymentRequirement(coordSelectedStudent.userInfo.id)).data;
                this.paymentRequirements = response.data;

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

                await CoordinatorApi.downloadSelectedStudentPaymentRequirement(coordSelectedStudent.userInfo.id, requirementId);

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

                await CoordinatorApi.removeSelectedStudentPaymentRequirement(coordSelectedStudent.userInfo.id, requirementId);
                
                this.paymentRequirements = this.paymentRequirements.map(rq => {
                    if (requirementId === rq.id) {
                        rq.student_payment = undefined;
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