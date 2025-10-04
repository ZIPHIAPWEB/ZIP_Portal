import { defineStore } from "pinia";
import { IVisaSponsor } from "./studentVisaSponsor";
import { useCoordSelectedStudent } from "./coordSelectedStudent";
import CoordinatorApi from "../services/CoordinatorApi";
import { IActionResult } from "../interfaces/IActionResult";

export interface ICoordStudentHostInfoState {
    isSuccess: boolean;
    isLoading: boolean;
    error: undefined;
    visaSponsor: IVisaSponsor
}

export const useCoordStudentHostInfo = defineStore({
    id: 'coordStudentHostInfo',
    state: () : ICoordStudentHostInfoState => ({
        isSuccess: false,
        isLoading: false,
        error: undefined,
        visaSponsor: {} as IVisaSponsor
    }),
    getters: {},
    actions: {
    async loadCoordStudentHostInfo(): Promise<IActionResult<IVisaSponsor>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudentStore = useCoordSelectedStudent();
                
                const response = await CoordinatorApi.getSelectedStudentHostInfo(coordSelectedStudentStore.userInfo.id);
                this.visaSponsor = response.data.data.visa_sponsor;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.visaSponsor };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                const message = error.response?.data?.message ?? 'Failed to load host info';
                const errors = error.response?.data?.errors ?? {};
                return { success: false, message, errors };
            }
        },

    async updateCoordStudentHostInfo(data : IVisaSponsor): Promise<IActionResult<IVisaSponsor>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudentStore = useCoordSelectedStudent();
                
                const response = await CoordinatorApi.updateStudentHostInfo(coordSelectedStudentStore.userInfo.id, data);
                this.visaSponsor = response.data.data;
                
                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.visaSponsor };
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
                const message = error.response?.data?.message ?? 'Failed to update host info';
                const errors = error.response?.data?.errors ?? {};
                return { success: false, message, errors };
            }
        }
    }
});