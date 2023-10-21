import { defineStore } from "pinia";
import { IStudentPdosCfoSchedule } from "./studentPdosCfoSchedule";
import CoordinatorApi from "../services/CoordinatorApi";
import { useCoordSelectedStudent } from "./coordSelectedStudent";

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
        async loadPdosCfoInfo() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.getSelectedStudentPdosCfoInfo(coordSelectedStudent.userInfo.id)).data;
                this.pdosCfoSchedule = response.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async updatePdosCfoInfo(data : IStudentPdosCfoSchedule) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = (await CoordinatorApi.updateStudentPdosCfoInfo(coordSelectedStudent.userInfo.id, data)).data;
                this.pdosCfoSchedule = response.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                
            }
        }
    }
})