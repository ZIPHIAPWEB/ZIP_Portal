import { defineStore } from "pinia";
import CoordinatorApi from "../services/CoordinatorApi";
import { useCoordSelectedStudent } from "./coordSelectedStudent";
import { IPaymentRequirement } from "./paymentRequirement";
import { downloadFile } from "../hooks/useFileDownload";
import { IActionResult } from "../interfaces/IActionResult";
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
    async loadSelectedStudentAdditionalRequirement(): Promise<IActionResult<IPaymentRequirement[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.getSelectedStudentPaymentRequirement(coordSelectedStudent.userInfo.id)).data;
                this.paymentRequirements = response.data;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.paymentRequirements };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                const message = error.response?.data?.message ?? 'Failed to load payment requirements';
                const errors = error.response?.data?.errors ?? {};
                return { success: false, message, errors };
            }
        },

    async downloadSelectedStudentAdditionalRequirement(requirementId : number | string): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.downloadSelectedStudentPaymentRequirement(coordSelectedStudent.userInfo.id, requirementId)).data;
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

    async acknowledgeStudentPayment(requirementId : number | string): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                await CoordinatorApi.acknowledgeStudentPayment(coordSelectedStudent.userInfo.id, requirementId);

                this.paymentRequirements = this.paymentRequirements.map(rq => {
                    if (rq.id === requirementId) {
                        if (rq.student_payment) {
                            rq.student_payment.acknowledgement = true;
                        }
                    }

                    return rq;
                });

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                const message = error.response?.data?.message ?? 'Failed to acknowledge payment';
                const errors = error.response?.data?.errors ?? {};
                return { success: false, message, errors };
            }
        },

    async removeSelectedStudentAdditionalRequirement(requirementId : number | string): Promise<IActionResult> {
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
                return { success: true };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                const message = error.response?.data?.message ?? 'Failed to remove payment';
                const errors = error.response?.data?.errors ?? {};
                return { success: false, message, errors };
            }
        }
    }
})