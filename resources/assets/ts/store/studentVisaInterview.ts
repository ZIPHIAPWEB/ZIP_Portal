import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";

export interface IVisaInterview {
    program_id_number: string;
    sevis_id: string;
    visa_interview_schedule: string;
    visa_interview_time: string;
    trial_interview_schedule: string;
    trial_interview_time: string;
}

export interface IStudentVisaInterview {
    isSuccess: boolean;
    isLoading: boolean;
    visaInterview: IVisaInterview | undefined,
    error: string | undefined
}

export const useStudentVisaInterview = defineStore({
    id: 'studentVisaInterview',
    state: () : IStudentVisaInterview => ({
        isSuccess: false,
        isLoading: false,
        visaInterview: {
            program_id_number: '',
            sevis_id: '',
            visa_interview_schedule: '',
            visa_interview_time: '',
            trial_interview_schedule: '',
            trial_interview_time: ''
        },
        error: undefined
    }),
    getters: {

    },
    actions: {
        async loadVisaInterview() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.getStudentVisaInterviewDetails();
                this.visaInterview = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})