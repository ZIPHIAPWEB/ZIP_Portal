import { defineStore } from "pinia";
import { IVisaInterview } from "./studentVisaInterview";
import CoordinatorApi from "../services/CoordinatorApi";
import { useCoordSelectedStudent } from "./coordSelectedStudent";

export interface ICoordStudentInterviewInfoState {
    isSuccess: boolean;
    isLoading: boolean;
    error: undefined;
    visaInterview: IVisaInterview;
}

export const useCoordStudentInterviewInfo = defineStore({
    id: 'coordStudentInterviewInfo',
    state: () : ICoordStudentInterviewInfoState => ({
        isLoading: false,
        isSuccess: false,
        error: undefined,
        visaInterview: {} as IVisaInterview
    }),
    getters: {},
    actions: {
        async loadCoordStudentInterviewInfo() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = await CoordinatorApi.getSelectedStudentInterviewInfo(coordSelectedStudent.userInfo.id);
                this.visaInterview = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;                
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false; 
            }
        },

        async updateCoordStudentInterviewInfo(data : IVisaInterview) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const coordSelectedStudent = useCoordSelectedStudent();

                const response = await CoordinatorApi.updateStudentInterviewInfo(coordSelectedStudent.userInfo.id, data);
                this.visaInterview = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;     
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false; 
            }
        }
    }
})