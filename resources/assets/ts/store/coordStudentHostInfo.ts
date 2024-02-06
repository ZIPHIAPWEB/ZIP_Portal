import { defineStore } from "pinia";
import { IVisaSponsor } from "./studentVisaSponsor";
import { useCoordSelectedStudent } from "./coordSelectedStudent";
import CoordinatorApi from "../services/CoordinatorApi";

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
        async loadCoordStudentHostInfo() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudentStore = useCoordSelectedStudent();
                
                const response = await CoordinatorApi.getSelectedStudentHostInfo(coordSelectedStudentStore.userInfo.id);
                this.visaSponsor = response.data.data.visa_sponsor;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async updateCoordStudentHostInfo(data : IVisaSponsor) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudentStore = useCoordSelectedStudent();
                
                const response = await CoordinatorApi.updateStudentHostInfo(coordSelectedStudentStore.userInfo.id, data);
                this.visaSponsor = response.data.data;
                
                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
});