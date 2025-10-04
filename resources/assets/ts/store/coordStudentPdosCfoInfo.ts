import { defineStore } from "pinia";
import { IStudentPdosCfoSchedule } from "./studentPdosCfoSchedule";
import CoordinatorApi from "../services/CoordinatorApi";
import { useCoordSelectedStudent } from "./coordSelectedStudent";
import { IActionResult } from "../interfaces/IActionResult";

export interface ICoordStudentPdosCfoInfoState {
    isSuccess: boolean;
    isLoading: boolean;
    pdosCfoSchedule: IStudentPdosCfoSchedule
}

export const useCoordStudentPdosCfoInfo = defineStore({
    id: 'coordStudentPdosCfoInfo',
    state: () : ICoordStudentPdosCfoInfoState => ({
        isLoading: false,
        isSuccess: false,
        pdosCfoSchedule: {} as IStudentPdosCfoSchedule
    }),
    getters: {},
    actions: {
    async loadPdosCfoInfo(): Promise<IActionResult<any>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.getSelectedStudentPdosCfoInfo(coordSelectedStudent.userInfo.id)).data;
                this.pdosCfoSchedule = response.data;

                this.isLoading = false;
                this.isSuccess = true;

                return { success: true, data: this.pdosCfoSchedule };
            } catch (error: any) {
                this.isLoading = false;
                this.isSuccess = false;

                return {
                    success: false,
                    message: error?.response?.data?.message || 'Failed to load PDOS/CFO info',
                    errors: error?.response?.data?.errors ?? null
                };
            }
        },

    async updatePdosCfoInfo(data: IStudentPdosCfoSchedule): Promise<IActionResult<any>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.updateStudentPdosCfoInfo(coordSelectedStudent.userInfo.id, data)).data;
                this.pdosCfoSchedule = response.data;

                this.isLoading = false;
                this.isSuccess = true;

                return { success: true, data: this.pdosCfoSchedule };
            } catch (error: any) {
                this.isLoading = false;
                this.isSuccess = false;

                return {
                    success: false,
                    message: error?.response?.data?.message || 'Failed to update PDOS/CFO info',
                    errors: error?.response?.data?.errors ?? null
                };
            }
        }
    }
})